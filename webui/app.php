<?php

// Run the webui by running `php -S localhost:8080 app.php` in the webui directory

$config = [
	'enabled' => 1, /* 0=FALSE, 1=TRUE */

	'siteName' => 'Dashed Droplet Manager', /* The name for the site */
	'root' => 'https://mgmt.sokka.io', /* The base url for the site (including http(s):// protocol) */

	'proMode' => 1, /* 0=FALSE, 1=TRUE */

	'copyRightName' => 'Dasho <dasho@sokka.io>', /* Copyright Notice */

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

// Database
$config['db'] = [
    'type' => 'sqlite', /* The type of database to use */
    'dbVersion' => '1.0.0', /* The version of the database */
    // create encrypted database with: sqlite3 -cmd ".cipher add" db.sqlite
    'file' => 'db.sqlite', /* The name of the database file */
    'key' => '/* Removed for Safety */', /* The key for the database */
    'tables' => [
        'users' => 'users', /* The name of the users table */
        'droplets' => 'droplets', /* The name of the droplets table */
        'sessions' => 'sessions', /* The name of the sessions table */
        'admin' => 'admin', /* The name of the admin table */
        'settings' => 'settings', /* The name of the settings table */
        'logs' => 'logs', /* The name of the logs table */
    ],
    'cipher' => 'aes-256-cbc', /* The cipher for the database */
    'userColoumns' => "
        'id INTEGER PRIMARY KEY',
        'username TEXT',
        'passhash TEXT',
        'email TEXT',
        'droplets JSON',
        'dropletCount INTEGER',
        'dropletLimit INTEGER',
        'totpEnabled BOOLEAN',
        'totpSecret TEXT',
        'apikey TEXT',
        'salt TEXT',
        'UNIQUE (id, username)'
    ",
    'dropletColoumns' => "
        'id INTEGER PRIMARY KEY',
        'name TEXT',
        'ip TEXT',
        'port INTEGER',
        'username TEXT',
        'password TEXT',
        'dropletType TEXT',
        'dropletStatus TEXT',
        'dropletOwner TEXT',
        'UNIQUE (id, name)'
    ",
    'sessionColoumns' => "
        'id INTEGER PRIMARY KEY',
        'username TEXT',
        'session TEXT',
        'UNIQUE (id, username)'
    ",
    'adminColoumns' => "
        'id INTEGER PRIMARY KEY',
        'username TEXT',
        'passhash TEXT',
        'UNIQUE (id, username)'
    ",
    'settingsColoumns' => "
        'id INTEGER PRIMARY KEY',
        'name TEXT',
        'value TEXT',
        'UNIQUE (id, name)'
    ",
    'logsColoumns' => "
        'id INTEGER PRIMARY KEY',
        'username TEXT',
        'action TEXT',
        'time TEXT',
        'UNIQUE (id, username)'
    "
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

//encryption for database
class DB extends SQLite3
{
    function __construct($filename)
    {
        $this->open($filename);
    }
    function key($key)
    {
        $this->exec('PRAGMA key = "'.$key.'"');
    }
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

// include all the files
include 'functions.php';
include 'classes.php';
include 'index.php';
include 'manage.php';
include 'route.php';
include 'head.php';
include 'random.php';
include 'admin.php';

initDB();
session_start();
setup();
route();


function setup(){
    global $config, $db;
    // make sure the admin key is set
    if($config['adminkey'] == '/* Removed for Safety */'){
        $config['adminkey'] = Randomizer::string(32);
        $config['adminkey'] = encrypt($config['adminkey'], $config['pepper']);
        $db->exec('INSERT INTO '.$config['db']['tables']['settings'].' (name, value) VALUES ("adminkey", "'.$config['adminkey'].'")');
    }
}

function initDB(){
    global $db, $config;
    $db = new DB($config['db']['file']);
    $db->key($config['db']['key']);
    // create tables if they don't exist
    $db->exec('CREATE TABLE IF NOT EXISTS '.$config['db']['tables']['users'].' ('.$config['db']['userColoumns'].')');
    $db->exec('CREATE TABLE IF NOT EXISTS '.$config['db']['tables']['droplets'].' ('.$config['db']['dropletColoumns'].')');
    $db->exec('CREATE TABLE IF NOT EXISTS '.$config['db']['tables']['sessions'].' ('.$config['db']['sessionColoumns'].')');
    $db->exec('CREATE TABLE IF NOT EXISTS '.$config['db']['tables']['admin'].' ('.$config['db']['adminColoumns'].')');
    $db->exec('CREATE TABLE IF NOT EXISTS '.$config['db']['tables']['settings'].' ('.$config['db']['settingsColoumns'].')');
    $db->exec('CREATE TABLE IF NOT EXISTS '.$config['db']['tables']['logs'].' ('.$config['db']['logsColoumns'].')');

    // create admin user if it doesn't exist
    $admin = $db->query('SELECT * FROM '.$config['db']['tables']['admin'].' WHERE username = :username', [':username' => 'admin'])->fetchArray();
    if(!$admin){
        $db->exec('INSERT INTO '.$config['db']['tables']['admin'].' (username, passhash) VALUES (:username, :passhash)', [':username' => 'admin', ':passhash' => hash($config['hash'], $config['adminkey'].$config['pepper'])]);
    }

    // create settings if they don't exist
    $settings = $db->query('SELECT * FROM '.$config['db']['tables']['settings'].' WHERE name = :name', [':name' => 'version'])->fetchArray();
    if(!$settings){
        $db->exec('INSERT INTO '.$config['db']['tables']['settings'].' (name, value) VALUES (:name, :value)', [':name' => 'version', ':value' => $config['db']['dbVersion']]);
    }

    // create logs if they don't exist
    $logs = $db->query('SELECT * FROM '.$config['db']['tables']['logs'].' WHERE id = :id', [':id' => 1])->fetchArray();
    if(!$logs){
        $db->exec('INSERT INTO '.$config['db']['tables']['logs'].' (id, username, action, time) VALUES (:id, :username, :action, :time)', [':id' => 1, ':username' => 'System', ':action' => 'System Started', ':time' => time()]);
    }
}