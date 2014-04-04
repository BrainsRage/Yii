<?php
/* @var $this GuestsController */
/* @var $model Guests */

$this->breadcrumbs=array(
	'Guests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Guests', 'url'=>array('index')),
	array('label'=>'Manage Guests', 'url'=>array('admin')),
);
?>

<h1>Create Guests</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>