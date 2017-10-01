<?php
/**
 * Created by PhpStorm.
 * User: lintong
 * Date: 2017/9/28
 * Time: 0:48
 */
header('Content-Type:application/json;charset=utf8');
//mysqli_query("SET NAMES 'utf-8'");
$id = $_GET['id'];
$filename = dirname(__FILE__) . '/ConfigFile/ServerInfo.txt';
if(!is_file($filename))
{
    echo 'file do not exit!';
    exit;
}
$dbData = json_decode(file_get_contents($filename),true);
$db = mysqli_connect($dbData['host'],$dbData['user'],$dbData['password']);
mysqli_query($db,"SET NAMES utf8");
if(!$db)
{
    die("Could not connect!" . mysqli_error());
}
mysqli_select_db($db,"mercury");
$result = mysqli_query($db,sprintf("SELECT * FROM tbl_groupInfo WHERE id = '%s'",$id));
$answers = array();
while($row = mysqli_fetch_row($result))
{
    $answers[$row[1]] = $row[2];//天煞的0居然为空，妈哒
}
$jsonStr = json_encode((object)$answers,JSON_UNESCAPED_UNICODE);
echo $jsonStr;
