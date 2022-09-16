<?php

// print a list of all users
function printAllUsers() {
    foreach (User::all() as $user) {
        echo $user['username'] . '<br>';
    }
}

// fuction to add a new user to the database
function add_user($username, $password, $email, $droplet, $totp, $admin, $active, $created, $updated, $lastlogin)
{
    global $db;
    // check if the user already exists
    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindValue(':username', $username);
    $req = $stmt->execute();
    $user = $req->fetchArray();
    if ($user) {
        return false;
    }
    // add the user to the database
    $req = $db->prepare('INSERT INTO users (username, password, email, droplet, totp, admin, active, created, updated, lastlogin) VALUES (:username, :password, :email, :droplet, :totp, :admin, :active, :created, :updated, :lastlogin)');
    $req->execute(array(
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'droplet' => $droplet,
        'totp' => $totp,
        'admin' => $admin,
        'active' => $active,
        'created' => $created,
        'updated' => $updated,
        'lastlogin' => $lastlogin,
    ));
    return true;
}
 
// function to update a user in the database
function update_user($username, $password, $email, $droplet, $totp, $admin, $active, $created, $updated, $lastlogin)
{
    global $db;
    // check if the user already exists
    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindValue(':username', $username);
    $req = $stmt->execute();
    $user = $req->fetchArray();
    if (!$user) {
        return false;
    }
    // update the user in the database
    $req = $db->prepare('UPDATE users SET password = :password, email = :email, droplet = :droplet, totp = :totp, admin = :admin, active = :active, created = :created, updated = :updated, lastlogin = :lastlogin WHERE username = :username');
    $req->execute(array(
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'droplet' => $droplet,
        'totp' => $totp,
        'admin' => $admin,
        'active' => $active,
        'created' => $created,
        'updated' => $updated,
        'lastlogin' => $lastlogin,
    ));
    return true;
}

// function to delete a user from the database
function delete_user($username)
{
    global $db;
    // check if the user already exists
    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->bindValue(':username', $username);
    $req = $stmt->execute();
    $user = $req->fetchArray();
    if (!$user) {
        return false;
    }
    // delete the user from the database
    $req = $db->prepare('DELETE FROM users WHERE username = :username');
    $req->execute(array('username' => $username));
    return true;
}

// function to show the admin page
function admin()
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