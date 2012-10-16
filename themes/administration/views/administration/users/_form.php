<?php
/* @var $this UsersController */
/* @var $model application\models\Users */
/* @var $form CActiveForm */

?>
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'create-user-form',
	'htmlOptions' => array(
		'form-horizontal'
	)
		));

?>
<fieldset>
	<legend><?php echo Yii::t('messages', 'Fill this field for the user login Credintial.'); ?></legend>
	<?php echo $form->errorSummary($model); ?>
	<?php
	echo $form->labelEx($model, 'username');
	echo $form->textField($model, 'username');
	echo $form->error($model, 'username');
	?>
	<?php
	echo $form->labelEx($model, 'fullName');
	echo $form->textField($model, 'fullName');
	echo $form->error($model, 'fullName');
	?>
	<?php
	echo $form->labelEx($model, 'email');
	echo $form->textField($model, 'email');
	echo $form->error($model, 'email');

	?>
	<?php
	echo $form->labelEx($model, 'password');
	echo $form->passwordField($model, 'password');
	echo $form->error($model, 'password');

	?>
	<?php
	echo $form->labelEx($model, 'passwordRepeat');
	echo $form->passwordField($model, 'passwordRepeat');
	echo $form->error($model, 'passwordRepeat');

	?>
</fieldset>

<div class="form-actions">
	<?php echo CHtml::submitButton('submit', array('class' => 'btn btn-primary')) ?>
</div>

<?php $this->endWidget(); ?>