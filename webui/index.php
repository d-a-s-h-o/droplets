<?php
function index(){
    global $config;
    print_start();
    echo '<h1>'.$config['siteName'].'</h1>';
    echo '<p>To get started, login below.</p>';
    echo '<br><br>';
    echo '<form class="aligned" action="/login" method="POST">';
    echo '<div><label>Username: </label><input type="text" name="username" required  /></div>';
    echo '<div><label>Password: </label><input type="password" name="password" required/></div>';
    echo '<div><label></label><input type="submit" value="Login"/></div>';
    echo '<div><label></label><a href="/register" style="color: white; text-decoration: underline white dotted">Register</a></div>';
    echo '</form>';
    print_end();
}

function register_page(){
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
?>