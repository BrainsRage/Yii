<?php
echo $_POST['name'];
 print_r($_POST);
$model=new Guests;
$model->name=$_POST['name'];
$model->mail=$_POST['mail'];
$model->text=$_POST['text'];
$model->save(false);
?>