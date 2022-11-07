<?php

// Run the webui by running `php -S localhost:8080 app.php` in the webui directory

// =================== CONFIG =================== //
    $config = [
        'enabled' => 1, /* 0=FALSE, 1=TRUE */

        'siteName' => 'Dashed Droplet Manager', /* The name for the site */
        'root' => 'https://mgmt.sokka.io', /* The base url for the site (including http(s):// protocol) */

        'proMode' => 0, /* 0=FALSE, 1=TRUE */

        'copyRightName' => 'Dasho <o_o@dasho.dev>', /* Copyright Notice */

        'api' => 'https://api.sokka.io', /* The base url for the api (including http(s):// protocol) */
        'apiVersion' => 'v1', /* The version of the api */

        'totp' => 1, /* 0=FALSE, 1=TRUE */
        'totpLength' => 6, /* The length of the TOTP */

        'session' => 1, /* 0=FALSE, 1=TRUE */
        'sessionLength' => 60*60*24*365, /* The length of the session in seconds */

        'hash' => 'sha512', /* The hash algorithm to use */

        'pattern' => '/^([a-zA-Z0-9]{1,})(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?(\_([a-zA-Z0-9]{1,}))?$/', /* The pattern for the droplet codename */

        'pepper' => '/* Removed for Safety */', /* Make hash cracking more challenging */

        'adminkey' => '/* Removed for Safety */', /* The admin key for the webui */
    ];

    function encrypt($string, $key)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_iv = '/* Removed for Safety */';
        $key = hash('sha256', $key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    function decrypt($string, $key)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_iv = '/* Removed for Safety */';
        $key = hash('sha256', $key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }

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

    function setup(){
        global $config, $db;
        // make sure the admin key is set
        if($config['adminkey'] != '/* Removed for Safety */'){
            $config['adminkey'] = Randomizer::string(32);
            $config['adminkey'] = encrypt($config['adminkey'], $config['pepper']);
            $db->exec('INSERT INTO '.$config['db']['tables']['settings'].' (name, value) VALUES ("adminkey", "'.$config['adminkey'].'")');
        }
    }

    // function to show the admin page
    function send_admin()
    {
        global $config;
        // check if the user is an admin
        if (check_session()) {
            if ($_SESSION['admin'] === TRUE && $_SESSION['adminkey'] === $config['adminkey']) {
                // show the admin page
                echo '<h1>Admin</h1>';
                echo '<h2>Users</h2>';
                echo '<h3>Add User</h3>';
                echo '<form action="/admin" method="post">';
                echo '<input type="hidden" name="do" value="add_user" />';
                echo '<div><label>Username: </label><input type="text" name="username" required /></div>';
                echo '<div><label>Password: </label><input type="password" name="password" required /></div>';
                echo '<div><label>Email: </label><input type="email" name="email" required /></div>';
                echo '<div><label>Droplet: </label><input type="text" name="droplet" required /></div>';
                echo '<div><label>Admin: </label><input type="checkbox" name="admin" /></div>';
                echo '<div><label>Active: </label><input type="checkbox" name="active" /></div>';
                echo '<div><label></label><input type="submit" value="Add User" /></div>';
                echo '</form>';
                echo '<h3>Update User</h3>';
                echo '<form action="/admin" method="post">';
                echo '<input type="hidden" name="do" value="update_user" />';
                echo '<div><label>Username: </label><input type="text" name="username" required /></div>';
                echo '<div><label>Password: </label><input type="password" name="password" required /></div>';
                echo '<div><label>Email: </label><input type="email" name="email" required /></div>';
                echo '<div><label>Droplet: </label><input type="text" name="droplet" required /></div>';
                echo '<div><label>Admin: </label><input type="checkbox" name="admin" /></div>';
                echo '<div><label>Active: </label><input type="checkbox" name="active" /></div>';
                echo '<div><label></label><input type="submit" value="Update User" /></div>';
                echo '</form>';
                echo '<h3>Delete User</h3>';
                echo '<form action="/admin" method="post">';
                echo '<input type="hidden" name="do" value="delete_user" />';
                echo '<div><label>Username: </label><input type="text" name="username" required /></div>';
                echo '<div><label></label><input type="submit" value="Delete User" /></div>';
                echo '</form>';
                echo '<h2>Settings</h2>';
                echo '<h3>Update Settings</h3>';
                echo '<form action="/admin" method="post">';
                echo '<input type="hidden" name="do" value="update_settings" />';
                echo '<div><label>Admin Key: </label><input type="text" name="adminkey" required /></div>';
                echo '<div><label>Site Title: </label><input type="text" name="sitetitle" required /></div>';
                echo '<div><label>Site URL: </label><input type="text" name="siteurl" required /></div>';

                echo '<div><label>SMTP Host: </label><input type="text" name="smtphost" required /></div>';
                echo '<div><label>SMTP Port: </label><input type="text" name="smtpport" required /></div>';
                echo '<div><label>SMTP Username: </label><input type="text" name="smtpusername" required /></div>';
                echo '<div><label>SMTP Password: </label><input type="text" name="smtppassword" required /></div>';
                echo '<div><label>SMTP From: </label><input type="text" name="smtpfrom" required /></div>';
                echo '<div><label>SMTP From Name: </label><input type="text" name="smtpfromname" required /></div>';
                echo '<div><label>SMTP Secure: </label><input type="text" name="smtpsecure" required /></div>';
                echo '<div><label></label><input type="submit" value="Update Settings" /></div>';
                echo '</form>';
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
    }

// ========================= ROUTES ========================= //

    function route(){
        // if post is set, then we are doing something
        if(isset($_POST['do'])){
            switch($_POST['do']){
                case 'login':
                    send_login();
                    break;
                case 'logout':
                    logout();
                    break;
                case 'register':
                    send_register();
                    break;
                case 'forgot':
                    send_forgot();
                    break;
                case 'reset':
                    send_reset();
                    break;
                case 'add_user':
                    add_user();
                    break;
                case 'update_user':
                    update_user();
                    break;
                case 'delete_user':
                    delete_user();
                    break;
                case 'update_settings':
                    update_settings();
                    break;
                default:
                    header("Location: /");
                    break;
            }
        } else {
            send_login();
        }
    }

// ========================= AUTH ========================= //

    function hashPassword($password){
        global $config;
        return hash('sha512', $password.$config['pepper']);
    }

    function verify_totp($user, $totp){
        global $db, $config;
        // get totp column from database
        $stmt = 'SELECT `totp` FROM `'.$config['db']['tables']['users'].'` WHERE `username` = "'.$user.'"';
        // prepare the statement
        $stmt = $db->prepare($stmt);
        // execute the statement
        $result = $stmt->execute();
        $result = $result->fetchArray();
        // get the totp code from the result
        $totp = $result['totp'];
        $stmt = 'echo  | ./totp.sh';
        $run = trim(strval(shell_exec($stmt)));
        $totp = trim(strval($totp));
        if($run == $totp){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function generate_droplet(){
        global $config;
        $stmt = 'ddrun -n '.$config['droplet']['name'];
        $run = trim(strval(shell_exec($stmt)));
        return $run;
    }

// ======================= APP =======================
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

// ======================= INDEX ======================= //
    function send_login(){
        global $config;
        print_start();
        echo '<h1>'.$config['siteName'].'</h1>';
        echo '<p>To get started, login below.</p>';
        echo '<br><br>';
        echo '<form class="aligned" action="/login" method="POST">';
        echo '<div><label>Username: </label><input type="text" name="username" required  /></div>';
        echo '<div><label>Password: </label><input type="password" name="password" required/></div>';
        echo '<div><label></label><input type="submit" value="Login"/></div>';
        echo '<div><label></label><input type="submit" formaction="/register" value="Register"/></div>';
        echo '</form>';
        print_end();
    }

    function send_register(){
        global $config;
        print_start();
        echo '<h1>'.$config['siteName'].'</h1>';
        echo '<p>To get started, register below.</p>';
        echo '<br><br>';
        echo '<form class="aligned" action="/register" method="POST">';
        echo '<div><label>Username: </label><input type="text" name="username" required  /></div>';
        echo '<div><label>Password: </label><input type="password" name="password" required/></div>';
        echo '<div><label>Email: </label><input type="email" name="email" required/></div>';
        echo '<div><label></label><input type="submit" value="Register"/></div>';
        echo '</form>';
        print_end();
    }

    // send the forgot password page
    function send_forgot(){
        global $config;
        print_start();
        echo '<h1>'.$config['siteName'].'</h1>';
        echo '<p>To get started, enter your email below.</p>';
        echo '<br><br>';
        echo '<form class="aligned" action="/forgot" method="POST">';
        echo '<div><label>Email: </label><input type="email" name="email" required/></div>';
        echo '<div><label></label><input type="submit" value="Send"/></div>';
        echo '</form>';
        print_end();
    }

// ======================= RAND ======================= //
    class Randomizer
    {
        public static function userName($length = 10)
        {
            $words = file('words.txt', FILE_IGNORE_NEW_LINES);
            $randomString = '';
            // join 5 random words together with a underscore
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $words[rand(0, count($words) - 1)];
                if ($i < $length - 1) {
                    $randomString .= '_';
                }
            }
            return $randomString;
        }

        // function to generate a random salt
        public static function salt($length = 8)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        public static function apiKey()
        {
            return md5(uniqid(rand(), true));
        }

        public static function password($length = 50)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        // function to generate a random string
        public static function string($length = 50)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        // generate a uuid4
        public static function uuid4()
        {
            return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                // 32 bits for "time_low"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                // 16 bits for "time_mid"
                mt_rand(0, 0xffff),
                // 16 bits for "time_hi_and_version",
                // four most significant bits holds version number 4
                mt_rand(0, 0x0fff) | 0x4000,
                // 16 bits, 8 bits for "clk_seq_hi_res",
                // 8 bits for "clk_seq_low",
                // two most significant bits holds zero and one for variant DCE1.1
                mt_rand(0, 0x3fff) | 0x8000,
                // 48 bits for "node"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
            );
        }

        // generate a totp secret
        public static function totpSecret()
        {
            return base64_encode(Randomizer::string(16));
        }
    }

// ======================= GENERAL FUNCTIONS ======================= //
    function fresh_session(){
        session_unset();
    }

    function destroy_session(){
        session_destroy();
    }

    function print_start(){
        global $config;
        echo '<!DOCTYPE html><html>';
        echo '<head>
        <title>'.$config['siteName'].'</title><link rel="shortcut icon" href="https://cdn.onionz.dev/global/images/favicon.svg" /><style>body {background: #14191F;color: #eee;font-family: Arial;}form.aligned {display: table;}.aligned div {display: table-row}.aligned label {display: table-cell;padding: 5px;margin: 5px;text-align: right;}.aligned input, select {display: table-cell;padding: 5px;margin: 5px;}.warning {padding: 14px;background-color: #ff0000;color: black;font-weight: bolder;font-size: large;}.info {padding: 14px;background-color: #0c93e4;color: black;font-weight: bolder;font-size: large;}.success {padding: 14px;background-color: #00bb00;color: white;font-weight: bolder;font-size: large;text-align: center;}.rule-breaker {padding: 5px;border: solid red;border-radius: 5px;}select {cursor: pointer; padding: 5px;margin: 5px;}.aligned input[type=submit] {width: 100%} input[type=submit] {color:#eee;background-color: #111;border: solid #eee 1px;border-radius: 5px;cursor: pointer; padding: 5px;margin: 5px;}input[type=submit]:hover {background-color: #000;}</style></head>';
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

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }