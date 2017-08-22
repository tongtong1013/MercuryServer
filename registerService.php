<?php
header('Content-Type:application/json;charset=utf8');
$id = $_POST['id'];
$password = $_POST['password'];
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
$result = mysqli_query($db,sprintf("INSERT INTO tbl_idpassword VALUES ('%s','%s')",$id,$password));
//echo $result;
//var_dump($result);
$answer = array(
    'answer' => 0
);
if($result === true)
{
    $answer['answer'] = 1;
}
else
{
    $answer['answer'] = 0;
}
$jsonStr = json_encode($answer);
echo $jsonStr;
?>