<?php
class SubmguestsController extends Controller
{
 	public function actionIndex()
	{	 
        $model=new Guests;
        $model->name=$_POST['name'];
        $model->mail=$_POST['mail'];
        $model->text=$_POST['text'];
        $model->save(false);
        $this->render('index');           
    }   
}    