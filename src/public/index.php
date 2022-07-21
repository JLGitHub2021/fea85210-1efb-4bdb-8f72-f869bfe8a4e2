<?php
//These are the defined authentication environment in the db service

// The MySQL service named in the docker-compose.yml.
//$host = 'mysql';

// Database use name
//$user = 'june';

//database user password
//$pass = '5678';

// database name
//$mydatabase = 'june-test';
// check the mysql connection status

//$conn = new mysqli($host, $user, $pass, $mydatabase);
$data_source = '';
$redis = new Redis();
$redis->connect('redis','6379');


// select query
$sql = 'SELECT * FROM `june-test`';

$cache_key = md5($sql);

if ($redis->exists($cache_key)) {

    $data_source = "Data from Redis Server";
    $data = unserialize($redis->get($cache_key));

} else {

    $data_source = 'Data from MySQL Database';

    $db_name     = 'june-test';
    $db_user     = 'june';
    $db_password = '5678';
    $db_host     = 'mysql';

    $pdo = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = []; 

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {          
       $data[] = $row;  
    }  

    $redis->set($cache_key, serialize($data)); 
    $redis->expire($cache_key, 20);


}
echo "<tr><td colspan = '3' align = 'center'><h2>$data_source</h2></td></tr>";

foreach ($data as $record) {
   echo '<tr>';
   echo '<br>' . $record['username'] . '</td>';
   echo '<br>' . $record['password'] . '</td>';                   
   echo '</tr>';
}
?>