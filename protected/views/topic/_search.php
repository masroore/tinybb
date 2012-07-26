<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_sticky'); ?>
		<?php echo $form->textField($model,'is_sticky'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_locked'); ?>
		<?php echo $form->textField($model,'is_locked'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'poster_id'); ?>
		<?php echo $form->textField($model,'poster_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'forum_id'); ?>
		<?php echo $form->textField($model,'forum_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'num_hits'); ?>
		<?php echo $form->textField($model,'num_hits'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_reply_on'); ?>
		<?php echo $form->textField($model,'last_reply_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_reply_user'); ?>
		<?php echo $form->textField($model,'last_reply_user',array('size'=>48,'maxlength'=>48)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->