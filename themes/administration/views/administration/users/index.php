<?php
/* @var $this UsersController */
/* @var $model \User */

?>

<div class="row-fluid sortable ui-sortable">		
	<div class="box span12">
		<div data-original-title="" class="box-header well">
			<h2><i class="icon-user"></i> <?php echo \Yii::t('messages', 'Members'); ?></h2>
			<div class="box-icon">
				<a class="btn btn-setting btn-round" href="#"><i class="icon-cog"></i></a>
				<a class="btn btn-minimize btn-round" href="#"><i class="icon-chevron-up"></i></a>
			</div>
			<div class="filterRemovedUser pull-right">
				<a class="btn" id="removedUser_0" href="javascript:void(0);;"><?php echo Yii::t('messages', 'Active User') ?></a>
				<a class="btn" id="removedUser_1" href="javascript:void(0);;"><?php echo Yii::t('messages', 'Removed User') ?></a>
				<script type="text/javascript">
					$(document).on('click.user-grid','.filterRemovedUser a',function(e){
						var id=$(this).attr('id').replace('removedUser_','');
						var label="<?php echo CHtml::activeName($model, 'isRemoved') ?>";
						$.fn.yiiGridView.update('user-grid',{
							url:$.fn.yiiGridView.getUrl('user-grid') ,
							data:$("#user-grid input").serialize()+"&"+label+"="+id
						});
					});
					$(document).on('click.user-grid','#user-grid a.restore',function(e){
						if(!confirm('Are you sure you want to restore this user?')) return false;
						$.ajax({
							url:$(this).attr('href')+"?ajax=user-grid",
							type:'post',
							data:{ <?php echo Yii::app()->request->csrfTokenName ?> : "<?php echo Yii::app()->request->csrfToken ?>"},
							success:function(){
								$.fn.yiiGridView.update('user-grid');
							}
						})
						e.preventDefault();
					});

				</script>
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
						'template' => !$model->isRemoved ? "{view}\n{update}\n{delete}" : "{view}\n{update}\n{restore}",
						'deleteConfirmation' => Yii::t('messages', 'Are you sure you want to delete this user?'),
						'buttons' => array(
							'restore' => array(
								'label' => Yii::t('messages', 'Restore'),
								'url' => "array('restore','id'=>\$data->id)",
								'options' => array(
									'class' => 'restore'
								)
							)
						)
					)
				),
				'dataProvider' => $model->search(),
					));

			?>
		</div>
	</div><!--/span-->

</div>