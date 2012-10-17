<?php
/* @var $this UsersController */
/* @var $model application\models\Users */

?>

<div class="row-fluid sortable ui-sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title="">
			<h2><i class="icon-edit"></i> <?php echo Yii::t('messages','Add new member') ?></h2>
			<div class="box-icon">
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
			$this->renderPartial('_form', compact('model'));
			?>

		</div>
	</div><!--/span-->

</div>