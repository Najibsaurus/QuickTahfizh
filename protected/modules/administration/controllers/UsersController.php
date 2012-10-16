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
use application\models\User;
use application\models\Identity;

class UsersController extends \CAdministrationController
{

	/**
	 * User list display action.
	 * 
	 * This page will display list of users along with actions for user
	 * management.
	 */
	public function actionIndex()
	{
		$dataProvider = new \CActiveDataProvider(User::model(), array(
					'criteria' => array(
						'scopes' => array(
							User::SCOPE_SELECT_LABELS,
							User::SCOPE_ORDER_NEWEST,
						)
					),
					'pagination' => array(
					),
				));
		$this->render('index', array(
			'dataProvider' => $dataProvider
		));
	}

	public function actionCreate()
	{
		$model = new User(User::SCENARIO_INSERT_STANDARD_TYPE);
		if (isset($_POST[get_class($model)]))
		{
			$model->setAttributes($_POST[get_class($model)]);
			if ($model->save())
				$this->redirect('/administration/users/index');
		}
		$this->render('create', compact('model'));
	}
}