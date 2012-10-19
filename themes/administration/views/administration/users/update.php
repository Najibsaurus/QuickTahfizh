<?php
/* @var $this UsersController */
/* @var $model \application\models\User */

Yii::app()->clientScript->registerScript('box-header well on Click', <<<JS
		$('.box-header.well').on('click.boxheader',function(e){
	e.preventDefault();
        var \$target = $(this).next('.box-content');
        if(\$target.is(':visible')) $('i',$(this).children().next()).removeClass('icon-chevron-down').addClass('icon-chevron-up');
        else 					   $('i',$(this).children().next()).removeClass('icon-chevron-up').addClass('icon-chevron-down');
        \$target.slideToggle();		
	});
JS
);
$lastScenario = $model->getScenario();

?>

<div class="row-fluid sortable ui-sortable">
	<div class="box span12">
		<!--Begin update profile form-->
		<div class="box-header well" data-original-title="<?php echo Yii::t('messages', 'Update Profile Information') ?>">
			<h2><i class="icon-edit"></i> <?php echo Yii::t('messages', 'Update Profile Information') ?></h2>
			<div class="box-icon">
				<a href="#" class="btn btn-round"><i class="icon-chevron-up"></i></a>
			</div>
		</div>
		<div class="box-content" style="display: none">
			<?php
			/* @var $form CActiveForm */
			$form = $this->beginWidget('CActiveForm', array(
				'action' => array('/administration/users/ajaxUpdateProfile', 'id' => $model->id),
				'id' => 'profile-form',
				'enableClientValidation' => false,
				'enableAjaxValidation' => true,
				'clientOptions' => array(
					'validateOnSubmit' => true,
					'validateOnChange' => false,
					'afterValidate' => 'js:function(f,r,e){
						if(!e){
								$.ajax({
									url:f.attr("action"),
									data:f.serialize(),
									type:\'post\',
									success:function(response){
										
									}
								});
						}
					}'
				),
					));

			?>
			<?php
			//set model scenario to update
			echo $form->labelEx($model, 'fullName');
			echo $form->textField($model, 'fullName');
			echo $form->error($model, 'fullName');
			echo $form->labelEx($model, 'email');
			echo $form->textField($model, 'email');
			echo $form->error($model, 'email');

			?>
			<div class="form-actions">
				<?php echo CHtml::submitButton(Yii::t('messages', 'Update'), array('class' => 'btn btn-primary', 'id' => 'update-btn', 'name' => 'update-btn')); ?>
			</div>
			<?php
			$this->endWidget();

			?>
		</div> <!--	end update profile form-->
		<!--Begin update password form-->
		<div class="box-header well" data-original-title="<?php echo Yii::t('messages', 'Update password') ?>">
			<h2><i class="icon-lock"></i> <?php echo Yii::t('messages', 'Update Password') ?></h2>
			<div class="box-icon">
				<a href="#" class="btn btn-round"><i class="icon-chevron-up"></i></a>
			</div>
		</div>
		<div class="box-content" style="display: none">
			<?php
			/* @var $form CActiveForm */
			$form = $this->beginWidget('CActiveForm', array(
				'action' => array('/administration/users/ajaxUpdatePassword', 'id' => $model->id),
				'id' => 'password-form',
				'enableClientValidation' => true,
				'enableAjaxValidation' => true,
				'clientOptions' => array(
					'validateOnSubmit' => true,
					'validateOnChange' => false,
					'afterValidate' => 'js:function(f,r,e){
						
					}'
				),
					));

			?>
			<?php
			//set update password scenario
			$model->setScenario(User::SCENARIO_UPDATE_PASSWORD);
			echo $form->labelEx($model, 'oldPassword');
			echo $form->passwordField($model, 'oldPassword');
			echo $form->error($model, 'oldPassword');
			echo $form->labelEx($model, 'newPassword');
			echo $form->passwordField($model, 'newPassword');
			echo $form->error($model, 'newPassword');
			echo $form->labelEx($model, 'passwordRepeat');
			echo $form->passwordField($model, 'passwordRepeat');
			echo $form->error($model, 'passwordRepeat');

			?>
			<div class="form-actions">
				<?php echo CHtml::submitButton(Yii::t('messages', 'Update'), array('class' => 'btn btn-primary', 'id' => 'password-btn')); ?>
			</div>
			<?php
			$this->endWidget('CActiveForm');
			// set scenario back to last scenario
			$model->setScenario($lastScenario);

			?>
		</div> <!--	end update password form-->
	</div><!--/span-->

</div>	