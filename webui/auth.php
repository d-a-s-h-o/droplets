<?php

function register_user($username="admin", $password="admin", $email=null, $adminkey=null){
    global $config, $db;
    // check if username is already taken
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $result = $stmt->execute();
    $result = $result->fetchArray(PDO::FETCH_ASSOC);
    if($result){
        return "Username already taken";
    }
    // check if email is already taken
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $result = $stmt->execute();
    $result = $result->fetchArray(PDO::FETCH_ASSOC);
    if($result){
        return "Email already taken";
    }
    // check if adminkey is correct
    if($adminkey === $config['adminkey']){
        $admin = TRUE;
    }else{
        $admin = FALSE;
    }
    // hash password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // generate totp secret
    $totp = new Randomizer();
    $totp_secret = $totp->totpSecret();
    // generate droplet
    $droplet = generate_droplet();
    // insert user into database
    $stmt = $db->prepare("INSERT INTO users (username, password, email, admin, totp_secret, droplet) VALUES (:username, :password, :email, :admin, :totp_secret, :droplet)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':admin', $admin);
    $stmt->bindParam(':totp_secret', $totp_secret);
    $stmt->bindParam(':droplet', $droplet);
    $stmt->execute();
    return "User registered";
}

// function to login a user
function login_user($username, $password)
{
    global $config, $db;
    // check if the user exists
    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindValue(':username', $username);
    $result = $stmt->execute();
    $user = $result->fetchArray();
    if (!$user) {
        return false;
    }
    // check if the password is correct
    if (password_verify($password, $user['password'])) {
        // password is correct
        // check if the user is active
        if ($user['active'] == 1) {
            // user is active
            // check if the user has 2FA enabled
            if ($user['totp'] == 1) {
                // user has 2FA enabled
                // check if the user has a valid 2FA token
                if (isset($_SESSION['2fa'])) {
                    // user has a valid 2FA token
                    // check if the token is valid
                    if (verify_totp($_SESSION['2fa'], $user['droplet'])) {
                        // token is valid
                        // update the lastlogin timestamp
                        $req = $db->prepare('UPDATE users SET lastlogin = :lastlogin WHERE username = :username');
                        $req->execute(array(
                            'username' => $username,
                            'lastlogin' => time(),
                        ));
                        // set the session variables
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['admin'] = $user['admin'];
                        // unset the 2FA token
                        unset($_SESSION['2fa']);
                        // return true
                        return true;
                    } else {
                        // token is not valid
                        // return false
                        return false;
                    }
                } else {
                    // user does not have a valid 2FA token
                    // return false
                    return false;
                }
            } else {
                // user does not have 2FA enabled
                // update the lastlogin timestamp
                $req = $db->prepare('UPDATE users SET lastlogin = :lastlogin WHERE username = :username');
                $req->execute(array(
                    'username' => $username,
                    'lastlogin' => time(),
                ));
                // set the session variables
                $_SESSION['username'] = $user['username'];
                $_SESSION['admin'] = $user['admin'];
                // return true
                return true;
            }
        } else {
            // user is not active
            // return false
            return false;
        }
    } else {
        // password is not correct
        // return false
        return false;
    }
}

function createAdmin($username, $password){
    global $db;
    $sql = "INSERT INTO admin (username, passhash) VALUES (:username, :passhash);";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':passhash', hashPassword($password), SQLITE3_TEXT);
    $stmt->execute();
}

function checkAdmin($username, $password){
    global $db;
    $sql = "SELECT * FROM admin WHERE username = :username AND passhash = :passhash;";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':passhash', hashPassword($password), SQLITE3_TEXT);
    $result = $stmt->execute();
    $row = $result->fetchArray();
    if($row){
        return true;
    }else{
        return false;
    }
}

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