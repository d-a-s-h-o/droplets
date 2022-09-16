<?php
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
?>