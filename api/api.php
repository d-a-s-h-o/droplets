<?php

// make a new sqlite3('test.db');
$db = new SQLite3('test.db');
$generator = new Randomizer();

//// $mysqli = new mysqli($dbconfig['host'], $dbconfig['username'], $dbconfig['password'], $dbconfig['database']);

//// function to check the database connection
//// function checkConnection($mysqli) {
////     if ($mysqli->connect_errno) {
////         echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
////     }
//// }

// check sqllite connection
function checkConnection($db)
{
    if (!$db) {
        echo $db->lastErrorMsg();
    } else {
        echo "Opened database successfully";
    }
}

// function to get all parts of uri
function getUriParts()
{
    $uri = $_SERVER['REQUEST_URI'];
    $uriParts = explode('/', $uri);
    if (validateUriParts($uriParts)) {
        return $uriParts;
    } else {
        return array('No URI Parts Found.', 'Error Encountered'); // 'No URI Parts
    }
}

//function to validate uri parts
function validateUriParts($uriParts)
{
    if (count($uriParts) != 3) {
        return false;
    }
    if ($uriParts[1] != 'v1') {
        return false;
    }
    return true;
}

// print all uri parts
function printUriParts($uriParts)
{
    echo 'URI parts: ';
    foreach ($uriParts as $part) {
        echo $part . ' ';
    }
    echo ' ';
}

function test()
{
    global $db;
    checkConnection($db);
    echo '<br>';
    printUriParts(getUriParts());
    echo '<br>';
    if (!tableExists('droplets')) {
        createTable();
    }
    if (!recordExists(1)) {
        insertRecord();
    }
    // deleteAllRecords('droplets');
    printAllRecords('droplets');
    dropTable('droplets');
}

test();

// check if table exists
function tableExists($tableName)
{
    global $db;
    $sql = "SELECT name FROM sqlite_master WHERE type='table' AND name='$tableName'";
    $result = $db->query($sql);
    if ($result->fetchArray(SQLITE3_ASSOC)) {
        return true;
    } else {
        return false;
    }
}

// create table
function createTable()
{
    global $db;
    $sql = "CREATE TABLE droplets (
        id INTEGER PRIMARY KEY,
        username TEXT,
        apikey TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        droplet_id INTEGER,
        ip_address TEXT,
        status BOOLEAN,
        generation INTEGER,
        UNIQUE (id, username, droplet_id)
    )";
    $db->exec($sql);
}

// insert record
function insertRecord()
{
    global $db, $generator;
    $sql = "INSERT INTO droplets (username, apikey, droplet_id, ip_address, status, generation) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $generator->userName());
    $stmt->bindValue(2, $generator->apiKey());
    $stmt->bindValue(3, 123456);
    $stmt->bindValue(4, '127.0.0.1');
    $stmt->bindValue(5, 1);
    $stmt->bindValue(6, 1);
    $stmt->execute();
}

// check if record exists
function recordExists($id)
{
    global $db;
    $sql = "SELECT * FROM droplets WHERE id = $id";
    $result = $db->query($sql);
    if ($result->fetchArray(SQLITE3_ASSOC)) {
        return true;
    } else {
        return false;
    }
}

// update record
function updateRecord()
{
    global $db;
    $sql = "UPDATE droplets set salary = 25000.00 where id = 1";
    $db->exec($sql);
}

// delete record
function deleteRecord()
{
    global $db;
    $sql = "DELETE from droplets where id = 2";
    $db->exec($sql);
}

// delete all records
function deleteAllRecords($table)
{
    global $db;
    $sql = "DELETE from ".$table;
    $db->exec($sql);
}

// drop table
function dropTable()
{
    global $db;
    $sql = "DROP TABLE droplets";
    $db->exec($sql);
}

// print all records in the database
function printAllRecords($table)
{
    global $db;
    $sql = "SELECT * FROM ".$table;
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    // print table of results
    echo '<table>';
    echo '<tr>';
    echo '<th>id</th>';
    echo '<th>username</th>';
    echo '<th>apikey</th>';
    echo '<th>created_at</th>';
    echo '<th>updated_at</th>';
    echo '<th>droplet_id</th>';
    echo '<th>ip_address</th>';
    echo '<th>status</th>';
    echo '<th>generation</th>';
    echo '</tr>';
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo '<tr>';
        echo '<td>'.$row['id'].'</td>';
        echo '<td>'.$row['username'].'</td>';
        echo '<td>'.$row['apikey'].'</td>';
        echo '<td>'.$row['created_at'].'</td>';
        echo '<td>'.$row['updated_at'].'</td>';
        echo '<td>'.$row['droplet_id'].'</td>';
        echo '<td>'.$row['ip_address'].'</td>';
        echo '<td>'.$row['status'].'</td>';
        echo '<td>'.$row['generation'].'</td>';
        echo '</tr>';
    }
    echo '</table>';
}

// class for generating random strings
class Randomizer
{
    public static function userName($length = 10)
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
}
