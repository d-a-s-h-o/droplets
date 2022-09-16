<?php
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
?>