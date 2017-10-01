<?php
/**
 * Created by PhpStorm.
 * User: lintong
 * Date: 2017/9/27
 * Time: 0:30
 */
header('Content-Type:application/json;charset=utf8');
$ownerID = $_GET['ownerID'];
$filename = dirname(__FILE__) . '/ConfigFile/ServerInfo.txt';
if(!is_file($filename))
{
    echo 'file do not exit!';
    exit;
}
$dbData = json_decode(file_get_contents($filename),true);
$db = mysqli_connect($dbData['host'],$dbData['user'],$dbData['password']);
if(!$db)
{
    die("Could not connect!" . mysqli_error());
}
mysqli_select_db($db,"mercury");
$result = mysqli_query($db,sprintf("SELECT * FROM tbl_relationship WHERE ownerID = '%s'",$ownerID));
//$num = mysqli_num_rows($result);
$answers = array();
while($row = mysqli_fetch_row($result))
{
    $answers[$row[1]] = (int)$row[2];
/*
    $answer = array(
        //'OwnerID' => $row[0],
        //'FriendID' => $row[1],
        //'Group' => (int)$row[2]
        $row[1]=>(int)$row[2]
    );

    $answers[] = $answer;//一个一个answer加进去...amazing
*/
}
$jsonStr = json_encode($answers);
echo $jsonStr;
