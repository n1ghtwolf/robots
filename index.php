<form method ="POST" action="index.php" autocomplete="off" align="center">
<label> Введите ссылку на сайт </label></br>
<input type="text" name ="url">
<input type="submit" name="go" >
</form>
<?
require_once ('PHPExcel.php');
require_once('PHPExcel/Writer/Excel5.php');
include 'functions.php';


$url=$_POST['url'];
$result = get_web_page($url);
if (($result['errno'] != 0 )||($result['http_code'] != 200))
    {
	echo $result['errmsg'];
	}
else
	{
	$page = $result['content'];
	
	
}
if($_POST['go']){

if($result['http_code'] == 404 ) {
    $exists = false;
	
}
else {
    $exists = true;
	
}}

generate_report($result,$exists,$page,$url);



