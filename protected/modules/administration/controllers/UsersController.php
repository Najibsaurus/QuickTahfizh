<?php

/**
 * UsersController handles user management in the administration panel.
 * 
 * This controller will show user list and handles all operation for user
 * management e.g. user creation, update, etc.
 * 
 * @author Petra Barus <petra.barus@gmail.com>
 * @package administration.controllers
 */

class UsersController extends \CAdministrationController
{

	public function filters()
	{
		return array_merge(parent::filters(), array(
					'postOnly +delete',
					'ajaxOnly +ajaxUpdateProfile, +ajaxUpdatePassword'
						)
		);
	}

	/**
	 * User list display action.
	 * 
	 * This page will display list of users along with actions for user
	 * management.
	 */
	public function actionIndex()
	{
		$model = new User('search');

		$this->render('index', array(
			'model' => $model
		));
	}

	/**
	 * Create new User 
	 */
	public function actionCreate()
	{
		$model = new User(User::SCENARIO_INSERT_STANDARD_TYPE);
		if (isset($_POST[get_class($model)]))
		{
			$trans = $model->getDbConnection()->beginTransaction();
			try
			{
				$model->setAttributes($_POST[get_class($model)]);
				if ($model->save())
				{
					$model->setScenario(User::SCENARIO_INSERT_STANDARD_TYPE);
					$identity = new Identity;
					$identity->setAttributes(array(
						'uid' => $model->id,
						'accid' => 0,
						'type' => Identity::TYPE_EMAIL_LOGIN,
						'salt' => \HHash::generateSalt(),
						'validationData' => \HHash::generatePassword($model->password),
					));
					if ($identity->save())
					{
						$trans->commit();
						$this->redirect(array('/administration/users/index'));
					}
				}
			}
			catch (Exception $e)
			{
				echo $e;
				$trans->rollback();
			}
		}
		$this->render('create', compact('model'));
	}

	/**
	 * Update User 
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModelById($id);
		$this->render('update', compact('model'));
	}

//Ajax action listed here.

	public function actionAjaxUpdateProfile($id)
	{
		$model = $this->loadModelById($id);
		if (isset($_POST[get_class($model)]))
		{
			if (isset($_POST['ajax']) && $_POST['ajax'] === 'profile-form')
			{
				echo \CActiveForm::validate($model);
				\Yii::app()->end();
			}
			$model->setAttributes($_POST[get_class($model)]);
			$model->save();
			
		}
	}

	public function actionAjaxUpdatePassword($id)
	{
		
	}

	public function actionDelete($id)
	{
		User::model()->updateByPk($id, array(
			'isRemoved' => 1,
			'removedTime' => new CDbExpression("NOW()"),
		));
		//if request from grid view we shouldnt redirect
		if (isset($_GET['ajax']) && $_GET['ajax'] === 'user-grid')
		{
			return;
		}
		$this->redirect(array('/administration/users/index'));
	}

	/**
	 *
	 * @param int $id user Id
	 * @return User User model
	 * @throws CHttpException 
	 */
	protected function loadModelById($id)
	{
		$model = User::model()->findByPk($id);
		if (!$model)
			throw new CHttpException(404, Yii::t('messages', 'Page Not Found'));
		return $model;
	}
}