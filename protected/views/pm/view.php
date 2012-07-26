<?php
$this->breadcrumbs=array(
	'Private Messages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PrivateMessage', 'url'=>array('index')),
	array('label'=>'Create PrivateMessage', 'url'=>array('create')),
	array('label'=>'Update PrivateMessage', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PrivateMessage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PrivateMessage', 'url'=>array('admin')),
);
?>

<h1>View PrivateMessage #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sender_id',
		'receiver_id',
		'is_read',
		'sent_at',
		'updated_at',
		'subject',
		'message',
	),
)); ?>
