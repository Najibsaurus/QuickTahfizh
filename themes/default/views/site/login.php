<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
	'Login',
);

?>

<h3><?php echo Yii::t('message', 'Login to your {name} account', array('{name}' => Yii::app()->name)) ?>
	<br/>
	<small>
		<?php echo Yii::t('message', "Don't have Account yet? {learn more} about {name} or {sign up}.", array('{learn more}' => CHtml::link(Yii::t('message', 'Learn more')), '{name}' => Yii::app()->name, '{sign up}' => CHtml::link(Yii::t('message', 'Sign Up')))) ?>
	</small>
</h3>
<div class="summary">
	<?php
	if (Yii::app()->user->hasState('error'))
	{
		echo Yii::app()->user->getState('error');

		?>
		<?php
		Yii::app()->user->setState('error', null);
	}

	?>
</div>
<?php
$form = $this->beginWidget('CActiveForm', array(
	'id' => 'login-form',
	'enableClientValidation' => true,
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
		));

?>
<div class="row-fluid">
	<div class="span6">
		<?php echo $form->labelEx($model, 'username'); ?>
		<?php echo $form->textField($model, 'username'); ?>
		<?php echo $form->error($model, 'username'); ?>

		<?php echo $form->labelEx($model, 'password'); ?>
		<?php echo $form->passwordField($model, 'password'); ?>
		<?php echo $form->error($model, 'password'); ?>
		<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>
		<?php echo $form->checkBox($model, 'rememberMe'); ?>
		<?php echo $form->label($model, 'rememberMe'); ?>
		<?php echo $form->error($model, 'rememberMe'); ?>
		<div class="form-actions">
			<?php echo CHtml::submitButton('Login'); ?>
		</div>

	</div>
	<div class="span6">
		<?php
		$this->widget('zii.widgets.CMenu', array(
			'htmlOptions' => array(
				'class' => 'login-method'
			),
			'items' => array(
				array('label' => 'Facebook', 'url' => array('/oauth/facebook'), 'linkOptions' => array(
						'id' => 'facebook-login'
				)),
				array('label' => 'Twitter', 'url' => array('/oauth/twitter'), 'linkOptions' => array(
						'id' => 'twitter-login'
				)),
			)
		));
		Yii::app()->clientScript->registerScript('LoginButton', <<<EOD
		$('#facebook-login').oauth({"popup":{"width":900,"height":550},"id":"facebook",name:"Facebook Connect"});
		$('#twitter-login').oauth({"popup":{"width":900,"height":550},"id":"twitter",name:"Twitter Connect"});
EOD
		);

		?>
	</div>
</div>
<?php $this->endWidget(); ?>
