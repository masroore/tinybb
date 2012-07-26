<?php
$this->breadcrumbs=array(
	'Forums'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Forum', 'url'=>array('index')),
	array('label'=>'Create Forum', 'url'=>array('create')),
	array('label'=>'Update Forum', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Forum', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Forum', 'url'=>array('admin')),
);
?>

<h1>View Forum #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'is_active',
		'sort_order',
		'name',
		'group_name',
		'description',
		'created_on',
		'updated_at',
		'redirect_url',
	),
)); ?>
