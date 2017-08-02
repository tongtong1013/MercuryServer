<?php
$filename = dirname(__FILE__) . '/ConfigFile/ServerInfo.txt';
if(!is_file($filename))
{
    echo 'file do not exit!';
    exit;
}
$dbData = json_decode(file_get_contents($filename),true);
//var_dump($dbData);

/*
$dbData = array(
    'host' => '',
    'user' => '',
    'password' => ''
);
*/

//echo $dbData['host'];
//echo $dbData['user'];
//echo $dbData['password'];

$db = mysql_connect($dbData['host'],$dbData['user'],$dbData['password']);
if(!$db)
{
    die("Could not connect!" . mysql_error());
}
mysql_select_db("mercury",$db);
$result = mysql_query("SELECT * FROM tbl_idpassword");
while($row = mysql_fetch_array($result))
{
    echo $row['ID'] . " " . $row['Password'];
    echo "<br />";
}
mysql_close($con);
?>