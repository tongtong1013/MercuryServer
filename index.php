<?php
header('Content-Type:application/json;charset=utf8');
$id = $_POST['username'];
$password = $_POST['password'];
//echo $id;
//echo $password;

$filetemp = dirname(__FILE__) . '/ConfigFile/TempInfo.txt';

//file_put_contents($filetemp, json_encode($id + " and " + $password));

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

$db = mysqli_connect($dbData['host'],$dbData['user'],$dbData['password']);
if(!$db)
{
    die("Could not connect!" . mysqli_error());
}
mysqli_select_db($db,"mercury");
$result = mysqli_query($db,"SELECT * FROM tbl_idpassword WHERE ID = '" . $id . "' AND Password = '" . $password . "'");

$answerYes = array(
    'yes' => 1
);
$answerNo = array(
    'no' => 0
);
$jsonStrYse = json_encode($answerYes);
$jsonStrNo = json_encode($answerNo);
$answer = array(
    'answer' => 0
);
if(mysqli_num_rows($result)>0)
{
	$answer['answer'] = 1;
}
else
{
    $answer['answer'] = 0;
}
$jsonStr = json_encode($answer);
echo $jsonStr;
/*
while($row = mysql_fetch_array($result))
{
    echo $row['ID'] . " " . $row['Password'];
    echo "<br />";
}
*/
mysqli_close($db);

?>