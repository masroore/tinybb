<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'topic-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_sticky'); ?>
		<?php echo $form->textField($model,'is_sticky'); ?>
		<?php echo $form->error($model,'is_sticky'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_locked'); ?>
		<?php echo $form->textField($model,'is_locked'); ?>
		<?php echo $form->error($model,'is_locked'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'poster_id'); ?>
		<?php echo $form->textField($model,'poster_id'); ?>
		<?php echo $form->error($model,'poster_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'forum_id'); ?>
		<?php echo $form->textField($model,'forum_id'); ?>
		<?php echo $form->error($model,'forum_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'num_hits'); ?>
		<?php echo $form->textField($model,'num_hits'); ?>
		<?php echo $form->error($model,'num_hits'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
		<?php echo $form->error($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_reply_on'); ?>
		<?php echo $form->textField($model,'last_reply_on'); ?>
		<?php echo $form->error($model,'last_reply_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_reply_user'); ?>
		<?php echo $form->textField($model,'last_reply_user',array('size'=>48,'maxlength'=>48)); ?>
		<?php echo $form->error($model,'last_reply_user'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->