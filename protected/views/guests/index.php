<?php
		$session = Yii::app()->session;
		if (isset($session['eauth_profile'])) {
			//echo '<div style="padding: 20px;"><strong>EAuth profile:</strong><br/>';
			//CVarDumper::dump($session['eauth_profile'], 10, true);
             $name=$session['eauth_profile'][name];	
             		
		}
?>        
<P> <H3 ALIGN=CENTER> Оставить отзыв </H3> 
<!-- 
<FORM METHOD="POST" ACTION="/index.php?r=submguests">
--!>
<FORM METHOD="POST">
<table align="center">
<tr>
<TD ALIGN=CENTER data-min-length=1> Ваше имя: </TD> <td><INPUT NAME="name" SIZE="48" VALUE=
 <?php  if(isset($name)) {echo $name;} else echo '' ?>> </td> 
</tr>
<tr>
<td align=right> Электронный адрес: </td>  <td><INPUT NAME="mail" SIZE="48"></td>
</tr>
<tr>
<td align=right> Комментарий: </td>  <td><TEXTAREA NAME="text" COLS=48 ROWS=3></TEXTAREA></td>
</tr>
<tr>
<td> <INPUT TYPE=SUBMIT></td> <td><INPUT TYPE=RESET></td>
</tr>
</FORM>
</table>

<?php
    $model=new Guests;
    $model->name=$_POST['name'];
    $model->mail=$_POST['mail'];
    $model->text=$_POST['text'];
    $name=$_POST['name'];
    $mail=$_POST['mail'];
    $text=$_POST['text'];
    if(($name!="") or ($mail!="") or ($text!="")) {      
        If(preg_match("/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/", $mail)) {
            $model->save(false);
            header("Location: http://guestbook.ru/index.php?r=submguests");
         }
     else
     echo "Ошибка: невалидный email или не заполнены некоторые поля";
    }
    
          
     echo "<h2>Также вы можете авторизироваться через социальные сети</h2>";

	$this->widget('ext.eauth.EAuthWidget');
     
                
     $sql = "select * from guests";
        $rows = Yii::app()->db->createCommand($sql)->queryAll();
        $count = count($rows);
        $SqldataProvider = new CSqlDataProvider($sql, array(        
         'keyField'=>'id',        
         'totalItemCount'=>$count,
         'pagination'=>array(
         'pageSize'=>100,
         ),
        ));
        
      $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$SqldataProvider,
	'enablePagination' => true
	)); 
	    
?>
