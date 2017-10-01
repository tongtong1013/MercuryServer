<?php
/**
 * Created by PhpStorm.
 * User: lintong
 * Date: 2017/9/24
 * Time: 23:59
 */
header('Content-Type:application/json;charset=utf8');
//$value = json_decode(file_get_contents('php://input'),true);//false是object格式，true是array格式

$id = $_GET['id'];
/*
$name = $value['Name'];
$sexual = $value['Sexual'];
$birthday = $value['Birthday'];
$bloodType = $value['BloodType'];
$vocation = $value['Vocation'];
$hometown = $value['Hometown'];
$location = $value['Location'];
$school = $value['School'];
$company = $value['Company'];
$phoneTel = $value['PhoneTel'];
$mail = $value['Mail'];
$sign = $value['Sign'];
$detail = $value['Detail'];
$photo = $value['Photo'];
*/
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
$result = mysqli_query($db,sprintf("SELECT * FROM tbl_personinfo WHERE id = '%s'",$id));
$row = mysqli_fetch_row($result);

$answer = array(
    'ID' => $row[0],
    'Name' => $row[1],
    'Sexual' => (int)$row[2],
    'Birthday' => $row[3],
    'BloodType' => $row[4],
    'Vocation' => $row[5],
    'Hometown' => $row[6],
    'Location' => $row[7],
    'School' => $row[8],
    'Company' => $row[9],
    'PhoneTel' => $row[10],
    'Mail' => $row[11],
    'Sign' => $row[12],
    'Detail' => $row[13],
    'Photo' => $row[14]
);
$jsonStr = json_encode($answer,JSON_UNESCAPED_UNICODE);
echo $jsonStr;
?>