<?php
function manage($droplet=""){
    global $config, $db;
    print_start();
    $pattern = '/^([a-zA-Z0-9]{1,})(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?$/';
    if(preg_match($pattern, $droplet)){
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
                $codeContents = 'otpauth://totp/'.$droplet.'?secret='.$S[hash('sha512', $droplet.$config['pepper'])].'&issuer=Dashed%20Droplets';
                
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
    print_end();
}

function act($action, $type='web'){
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


if(!isset($_POST['do'])){
    if(check_session()){
        manage($_SESSION['droplet']);
    }else{
        index();
    }
}

?>