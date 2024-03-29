<?php

class GuestsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
     
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Guests;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Guests']))
		{
			$model->attributes=$_POST['Guests'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Guests']))
		{
			$model->attributes=$_POST['Guests'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{	 
	   
       $serviceName = Yii::app()->request->getQuery('service');
		if (isset($serviceName)) {
			/** @var $eauth EAuthServiceBase */
			$eauth = Yii::app()->eauth->getIdentity($serviceName);
			$eauth->redirectUrl = Yii::app()->user->returnUrl;
			$eauth->cancelUrl = $this->createAbsoluteUrl('guests/index');

			try {
				if ($eauth->authenticate()) {
					$identity = new EAuthUserIdentity($eauth);

//					var_dump($eauth->getIsAuthenticated(), $eauth->getAttributes());

					// successful authentication
					if ($identity->authenticate()) {
						Yii::app()->user->login($identity);
						//var_dump($identity->id, $identity->name, Yii::app()->user->id);exit;

						// Save the attributes to display it in layouts/main.php
						$session = Yii::app()->session;
						$session['eauth_profile'] = $eauth->attributes;

						// redirect and close the popup window if needed
						$eauth->redirect();
					}
					else {
						// close popup window and redirect to cancelUrl
						$eauth->cancel();
					}
				}

				// Something went wrong, redirect back to login page
				$this->redirect(array('guests/index'));
			}
			catch (EAuthException $e) {
				// save authentication error to session
				Yii::app()->user->setFlash('error', 'EAuthException: '.$e->getMessage());

				// close popup window and redirect to cancelUrl
				$eauth->redirect($eauth->getCancelUrl());
			}
		}
        $this->render('index');        
       /**
	 * Lists all models.
	 */       
    }
    
	public function actionAdmin()
	{
		$model=new Guests('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Guests']))
			$model->attributes=$_GET['Guests'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Guests the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Guests::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Guests $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='guests-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
