
<P> <H3 ALIGN=CENTER> �������� ����� </H3> 
<FORM METHOD="POST" ACTION="/index.php?r=submguests">
<table align="center">
<tr>
<TD ALIGN=CENTER> ���� ���: </TD> <td><INPUT NAME="name" SIZE="48"></td>
</tr>
<tr>
<td align=right> ����������� �����: </td>  <td><INPUT NAME="mail" SIZE="48"></td>
</tr>
<tr>
<td align=right> �����������: </td>  <td><TEXTAREA NAME="text" COLS=48 ROWS=3></TEXTAREA></td>
</tr>
<tr>
<td> <INPUT TYPE=SUBMIT></td> <td><INPUT TYPE=RESET></td>
</tr>
</FORM>
</table>
<?php  
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
