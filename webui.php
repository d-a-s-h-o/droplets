<?php
$config = [
	'enabled' => 1, /* 0=FALSE, 1=TRUE */

	'siteName' => 'Dashed Droplet Manager', /* The name for the site */
	'root' => 'https://mgmt.onionz.dev', /* The base url for the site (including http(s):// protocol) */

	'proMode' => 1, /* 0=FALSE, 1=TRUE */

	'copyRightName' => 'Dasho <dasho@onionz.dev>', /* Copyright Notice */

    'salt' => '/* Removed for Safety */', /* Make hash cracking more challenging */

];

if(!$config['enabled']){
	if(!$config['proMode']){
		die("Service disabled. Check the php file, and enable the web-ui within the \$config array.");
	}else{
		die("Service disabled.");
	}
}
if(!$config['proMode']){
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}else{
	error_reporting(0);
	ini_set('display_errors', 0);
}

session_start();
route();

function route(){
    global $config;
    if(isset($_GET['hash'])){
        $pattern = '/^([a-zA-Z0-9]{1,})(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?$/';
        $raw = htmlspecialchars(htmlentities($_GET['hash']));
       if(preg_match($pattern, $raw)){
           die(hash('sha512', $raw.$config['salt']));
       }else{
           header("Location: ".$config['root']."");
       }
    }if(!isset($_POST['do'])){
            if(check_session()){
                manage($_SESSION['droplet']);
            }else{
                index();
            }
    }elseif($_POST['do']==='manage'){
        if((isset($_POST['droplet']) & isset($_POST['totp'])) || check_session()){
            if(check_session()){
                manage($_SESSION['droplet']);
            }else{
                manage(htmlspecialchars(htmlentities($_POST['droplet'])), htmlspecialchars(htmlentities(strval($_POST['totp']))));
            }
        }else{
            header("Location: ".$config['root']."");
        }
    }elseif($_POST['do']==='logout'){
        session_reset();
        session_destroy();
        header("Location: ".$config['root']."");
    }else{
        header("Location: ".$config['root']."");
    }
}

function index(){
    global $config;
    print_start();
    echo '<h1>'.$config['siteName'].'</h1>';
    echo '<p>To get started, enter the necessary details below and click submit.</p>';
    echo '<br><br>';
    echo '<form class="aligned" method="POST">';
    echo '<div><label>Droplet Codename: </label><input type="text" name="droplet" required  /></div>';
    echo '<div><label>TOTP: </label><input type="number" name="totp" required/></div>';
    echo '<input type="hidden" name="do" value="manage" />';
    echo '<div><label></label><input type="submit" value="Submit"/></div>';
    echo '</form>';
    print_end();
}

function manage($droplet="", $totp=""){
    global $config;
    include('/* File with list of various droplets and their secrets */');
    print_start();
    $pattern = '/^([a-zA-Z0-9]{1,})(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?$/';
    if(preg_match($pattern, $droplet)){
        if(isset($S[hash('sha512', $droplet.$config['salt'])])){
            $stmt = 'echo "'.$S[hash('sha512', $droplet.$config['salt'])].'" | ./totp.sh';
            $run = trim(strval(shell_exec($stmt)));
            $totp = trim(strval($totp));
            if($totp == $run || check_session()){
                $_SESSION['active'] = TRUE;
                if(!isset($_SESSION['droplet'])){
                    $_SESSION['droplet'] = $droplet;
                }
                if(isset($_POST['action'])){
                    $action = $_POST['action'];
                    if(!isset($_SESSION['last_action'])){
                        $_SESSION['last_action'] = $action;
                        if($action === 's'){
                            $action = 'Start';
                        }elseif($action === 'd'){
                            $action = 'Stop';
                        }elseif($action === 'c'){
                            $action = 'Check';
                        }elseif($action === 'r'){
                            $action = 'Restart';
                        }elseif($action === 'n'){
                            $action = 'Create';
                        }elseif($action === 'b'){
                            $action = 'Backup';
                        }else{
                            unset($action);
                        }
                    }else{
                        if($action === $_SESSION['last_action']){
                            unset($action);
                        }else{
                            $_SESSION['last_action'] = $action;
                            if($action === 's'){
                                $action = 'Start';
                            }elseif($action === 'd'){
                                $action = 'Stop';
                            }elseif($action === 'c'){
                                $action = 'Check';
                            }elseif($action === 'r'){
                                $action = 'Restart';
                            }elseif($action === 'n'){
                                $action = 'Create';
                            }elseif($action === 'b'){
                                $action = 'Backup';
                            }else{
                                unset($action);
                            }
                        }
                    }
                }
                if(isset($action)){
                    if(isset($type)){
                        act($action, $type);
                    }else{
                        act($action);
                    }
                    echo '<div class="temp">Loading ...</div>';
                    echo '<style>.temp {display: block}</style>';
                    sleep(5);
                }
                echo '<style>.temp {display: none}</style>';
                echo '<form class="aligned" method="POST">';
                    echo '<div><label>Action: </label>';
                        echo'<select name="action"/>'; 
                            echo '<option value="s">Start</option>';
                            echo '<option value="d">Stop</option>';
                            echo '<option value="r">Restart</option>';
                            echo '<option value="b">Backup</option>';
                        echo '</select>';
                    echo '</div>';
                    echo '<div><label></label><input type="submit" value="Submit"/></div>';
                    echo '<input type="hidden" name="do" value="manage" />';
                echo '</form>';
                echo '<form method="POST">';
                    echo '<div style="position: absolute; right: 20px; top: 10px"><label></label><input type="submit" value="Logout"/></div>';
                    echo '<input type="hidden" name="do" value="logout" />';
                echo '</form>';
                echo 'Droplet Requested: <code>'.$_SESSION['droplet'].'</code>';
                $stmt = 'ddd -c '.$_SESSION['droplet'];
                if(trim(strval(shell_exec($stmt))) === 'False'){
                    echo '<br>Your server is offline.';
                }elseif(trim(strval(shell_exec($stmt))) === 'True'){
                    echo '<br>Your server is online.';
                }else{
                    echo '<br>Could not calculate server status. Unknown Error.';
                }
                if(isset($action)){
                    echo '<br>Last Action: <code>'.$action.'</code>';
                }
                echo '<br><br>Scan this QR to add 2FA to another device:<br><br>';
                
                include('qr/qrlib.php');

                // text output  
                $codeContents = 'otpauth://totp/'.$droplet.'?secret='.$S[hash('sha512', $droplet.$config['salt'])].'&issuer=Dashed%20Droplets';
                
                // generating
                $text = QRcode::text($codeContents);
                $raw = join("<br/>", $text);
                
                $raw = strtr($raw, array(
                    '0' => '<span style="display: inline; color:white">&#9608;&#9608;</span>',
                    '1' => '<span style="display: inline; color:black">&#9608;&#9608</span>'
                ));
                
                // displaying
                
                echo '<pre style="all: unset; display: block; font-size: 7px; transform: scale(.9, 1);">'.$raw.'</pre>'; 
            }else{
                echo 'Opps, you made some mistake. Try again.';
                sleep(2);
                echo '<form method="POST">';
                echo '<div><label></label><input type="submit" value="Try Again"/></div>';
                echo '<input type="hidden" name="do" value="logout" />';
                echo '</form>';
            }
        }else{
            echo 'Opps, you made some mistake. Try again.';
            sleep(2);
            echo '<form method="POST">';
            echo '<div><label></label><input type="submit" value="Try Again"/></div>';
            echo '<input type="hidden" name="do" value="logout" />';
            echo '</form>';
        }
    }else{
        echo "Opps, you made some mistake. Try again.";
        sleep(2);
        echo '<form method="POST">';
        echo '<div><label></label><input type="submit" value="Try Again"/></div>';
        echo '<input type="hidden" name="do" value="logout"/>';
        echo '</form>';
    }
    print_end();
}

function act($action, $type='apache2'){
    if($action === 'Start'){
        $stmt = 'ddd -s '.$_SESSION['droplet'];
        shell_exec($stmt);
    }elseif($action === 'Stop'){
        $stmt = 'ddd -d '.$_SESSION['droplet'];
        shell_exec($stmt);
    }elseif($action === 'Restart'){
        $stmt = 'ddd -r '.$_SESSION['droplet'];
        shell_exec($stmt);
    }elseif($action === 'Create'){
        $stmt = 'ddd -n '.$_SESSION['droplet'].' '.$type;
        shell_exec($stmt);
    }elseif($action === 'Backup'){
        $stmt = 'ddd -b '.$_SESSION['droplet'];
        shell_exec($stmt);
    }else{
        echo 'Bad Action';
    }
}

function fresh_session(){
    session_unset();
}

function destroy_session(){
    session_destroy();
}

function head(){
    global $config;
    echo '<head>
    <title>'.$config['siteName'].'</title><link rel="shortcut icon" href="https://cdn.onionz.dev/global/images/favicon.svg" /><style>body {background: #14191F;color: #eee;font-family: Arial;}form.aligned {display: table;}.aligned div {display: table-row}.aligned label {display: table-cell;padding: 5px;margin: 5px;text-align: right;}.aligned input, select {display: table-cell;padding: 5px;margin: 5px;}.warning {padding: 14px;background-color: #ff0000;color: black;font-weight: bolder;font-size: large;}.info {padding: 14px;background-color: #0c93e4;color: black;font-weight: bolder;font-size: large;}.success {padding: 14px;background-color: #00bb00;color: white;font-weight: bolder;font-size: large;text-align: center;}.rule-breaker {padding: 5px;border: solid red;border-radius: 5px;}select {cursor: pointer; padding: 5px;margin: 5px;}.aligned input[type=submit] {width: 100%} input[type=submit] {color:#eee;background-color: #111;border: solid #eee 1px;border-radius: 5px;cursor: pointer; padding: 5px;margin: 5px;}input[type=submit]:hover {background-color: #000;}</style></head>';
}

function print_start(){
    echo '<!DOCTYPE html><html>';
    head();
    echo '<body>';
}

function print_end(){
	echo '</body></html>';
	exit;
}

function check_session(){
	if(isset($_SESSION['active'])){
		return TRUE;
	}else{
		return FALSE;
	}
}

function find_key_value($array, $key, $val) {
    foreach ($array as $item) {
        if(is_array($item) && find_key_value($item, $key, $val)){
            return true;
        }
        if(isset($item[$key]) && $item[$key] == $val){
            return true;
            $_SESSION['$tempUID'] = $item;
        }
    }

    return false;
}
?>