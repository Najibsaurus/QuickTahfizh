<?php

/**
 * UserController class file.
 *
 * @author Nurcahyo al hidayah <2light.hidayah@gmail.com>
 * @link http://phpindonesia.net/
 * @copyright Copyright &copy; 2012-2012 PHP ID Jawabarat
 * @license http://phpindonesia.net/license
 * @version $Id$
 * @package Frontend
 * @since 1.0
 */
class UserController extends Controller
{

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionRegister()
	{
		$model = new User(User::SCENARIO_INSERT_STANDARD_TYPE);
		if (isset($_GET['via'])) {
			switch ($_GET['via']) {
				case "fb":
					if (Yii::app()->facebook->user === 0)
						$this->redirect('/user/register');
					$profile = Yii::app()->facebook->getUserProfile();
					$model->fullName = $profile['name'];
					$model->email = $profile['email'];
					break;
				case "twitter":
					break;
			}
		}
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
		$this->render('register', compact('model'));
	}

	public function actionUpdate()
	{
		$this->render('update');
	}

	public function actionView()
	{
		$this->render('view');
	}
}