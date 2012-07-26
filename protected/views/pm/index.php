<?php
$this->breadcrumbs=array(
	'Private Messages',
);

$this->menu=array(
	array('label'=>'Create PrivateMessage', 'url'=>array('create')),
	array('label'=>'Manage PrivateMessage', 'url'=>array('admin')),
);
?>

<h1>Private Messages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
