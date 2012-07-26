<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('body')); ?>:</b>
	<?php echo CHtml::encode($data->body); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('topic_id')); ?>:</b>
	<?php echo CHtml::encode($data->topic_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forum_id')); ?>:</b>
	<?php echo CHtml::encode($data->forum_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('poster_id')); ?>:</b>
	<?php echo CHtml::encode($data->poster_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('poster_ip')); ?>:</b>
	<?php echo CHtml::encode($data->poster_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_edited')); ?>:</b>
	<?php echo CHtml::encode($data->is_edited); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('edited_by')); ?>:</b>
	<?php echo CHtml::encode($data->edited_by); ?>
	<br />

	*/ ?>

</div>