<?php
$this->breadcrumbs=array(
	'Forums'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Forum', 'url'=>array('index')),
	array('label'=>'Create Forum', 'url'=>array('create')),
	array('label'=>'View Forum', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Forum', 'url'=>array('admin')),
);
?>

<h1>Update Forum <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>