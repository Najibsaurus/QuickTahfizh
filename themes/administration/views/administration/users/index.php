<?php
/* @var $this UsersController */
/* @var $dataProvider \CActiveDataProvider */

?>

<div class="row-fluid sortable ui-sortable">		
	<div class="box span12">
		<div data-original-title="" class="box-header well">
			<h2><i class="icon-user"></i> <?php echo \Yii::t('messages', 'Members'); ?></h2>
			<div class="box-icon">
				<a class="btn btn-setting btn-round" href="#"><i class="icon-cog"></i></a>
				<a class="btn btn-minimize btn-round" href="#"><i class="icon-chevron-up"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
			//See AdministrationModule::init() widget factory line to change default settings
			/* @var $grid \CGridView */
			$grid = $this->widget('\\bootstrap\\widgets\\GridView', array(
				'id' => 'user-grid',
				'filter' => $model,
				'htmlOptions' => array(
					'role' => 'grid',
					'class' => 'grid dataTables_wrapper'
				),
				'columns' => array(
					array(
						'name' => 'id',
						'htmlOptions' => array('class' => 'sorting_1')
					),
					array(
						'name' => 'username',
						'htmlOptions' => array('class' => 'center')
					),
					array(
						'name' => 'fullName',
						'htmlOptions' => array('class' => 'center')
					),
					array(
						'name' => 'email',
						'htmlOptions' => array('class' => 'center')
					),
					array(
						'name' => 'createdTime',
						'value' => '$data->createdTime',
						'type' => 'date',
						'htmlOptions' => array('class' => 'center')
					),
					array(
						'class' => 'CButtonColumn',
						'header' => Yii::t('messages', 'Actions'),
					)
				),
				'dataProvider' => $model->search(),
					));

			?>
		</div>
	</div><!--/span-->

</div>