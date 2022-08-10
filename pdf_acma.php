<?php
//require_once "result.php";

session_start();
//$file1 = $_SESSION["pdfac"];
//echo __DIR__;
//exit();
//var_dump($_GET['pdfac']);
//set_include_path('uploads/');

//exit();
if(isset($_GET['pdfac'])){
   
    header('Content-type:application/pdf');
    header('Content-Description:inline;filename="'.$_GET['pdfac'].'"');
    header('Content-Transfer-Encoding:binary');
    header('Accept-Ranges:bytes');
   // @readfile($_GET['pdfac']);
   echo file_get_contents('uploads/'.$_GET['pdfac']);
}
//var_dump($file1);

?>