<?php
class SubmguestsController extends Controller
{
 	public function actionIndex()
	{       
        $model=new Guests;
        $model->name=$_POST['name'];
        $model->mail=$_POST['mail'];
        $model->text=$_POST['text'];
        $name=$_POST['name'];
        $mail=$_POST['mail'];
        $text=$_POST['text'];
        //$model->save(false);
                      
                
        $this->render('index');           
    }   
}    