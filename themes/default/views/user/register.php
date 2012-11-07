<?php
/* @var $this UserController */

$this->breadcrumbs = array(
	'User' => array('/user'),
	'Register',
);

?>
<h3><?php echo Yii::t('message', 'Sign up for {name}', array('{name}' => Yii::app()->name)); ?>
	<br/>
	<small><?php echo Yii::t('message', 'Join {name} to use this application and create your own profile.', array('{name}' => Yii::app()->name)) ?> <?php
$message = function() {
			if (!isset($_GET['via'])) {
				return Yii::t('message', 'You can login {here}.', array('{here}' => CHtml::link(Yii::t('message', 'here'), Yii::app()->user->loginUrl)));
			}
			else if ($_GET['via'] === 'fb') {
				return Yii::t('message', 'You can Connect Your Facebook account after login using email {here}.', array('{here}' => CHtml::link(Yii::t('message', 'here'), Yii::app()->user->loginUrl)));
			}
			else if ($_GET['via'] === 'twitter') {
				return Yii::t('message', 'You can Connect Your Twitter account after login using email {here}.', array('{here}' => CHtml::link(Yii::t('message', 'here'), Yii::app()->user->loginUrl)));
			}
		};
echo Yii::t('message', 'Already have account? {message}', array(
	'{message}' => $message(),
));

?>
	</small>
</h3>

<div class="row-fluid">
	<div class="span12">
		<?php $this->renderPartial('_form', compact('model')) ?>
	</div>
</div>
