<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_sticky')); ?>:</b>
	<?php echo CHtml::encode($data->is_sticky); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_locked')); ?>:</b>
	<?php echo CHtml::encode($data->is_locked); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug')); ?>:</b>
	<?php echo CHtml::encode($data->slug); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('poster_id')); ?>:</b>
	<?php echo CHtml::encode($data->poster_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('forum_id')); ?>:</b>
	<?php echo CHtml::encode($data->forum_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('num_hits')); ?>:</b>
	<?php echo CHtml::encode($data->num_hits); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_reply_on')); ?>:</b>
	<?php echo CHtml::encode($data->last_reply_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_reply_user')); ?>:</b>
	<?php echo CHtml::encode($data->last_reply_user); ?>
	<br />

	*/ ?>

</div>