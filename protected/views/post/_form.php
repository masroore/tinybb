<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
		<?php echo $form->error($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_at'); ?>
		<?php echo $form->textField($model,'updated_at'); ?>
		<?php echo $form->error($model,'updated_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'topic_id'); ?>
		<?php echo $form->textField($model,'topic_id'); ?>
		<?php echo $form->error($model,'topic_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'forum_id'); ?>
		<?php echo $form->textField($model,'forum_id'); ?>
		<?php echo $form->error($model,'forum_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'poster_id'); ?>
		<?php echo $form->textField($model,'poster_id'); ?>
		<?php echo $form->error($model,'poster_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'poster_ip'); ?>
		<?php echo $form->textField($model,'poster_ip',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'poster_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_edited'); ?>
		<?php echo $form->textField($model,'is_edited'); ?>
		<?php echo $form->error($model,'is_edited'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edited_by'); ?>
		<?php echo $form->textField($model,'edited_by'); ?>
		<?php echo $form->error($model,'edited_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->