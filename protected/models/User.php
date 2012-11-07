<?php

/**
 * This is the model class for table "Users".
 *
 * The followings are the available columns in table 'Users':
 * 
 * @property int $id the ID of the user's record in the database.
 * @property string $username the user's handle name.
 * @property string $fullName user's full name.
 * @property string $email user's email address.
 * @property string $createdTime time when user's record is created.
 * @property string $updatedTime time when user's record is updated.
 * @property boolean $isRemoved whether user's record is flagged as removed.
 * @property string $removedTime time when user's record is flagged as removed.
 * @property Identity $loginIdentity login identity for user that login with email / username.
 * @method User emailLogin using emailLogin scope
 * @method User selectLabels using selectLabels scope
 * @method User orderNewest using orderNewest scope
 * @method User findByAttributes
 * 
 * @author Petra Barus <petra.barus@gmail.com>
 * @package application.models
 */
class User extends CActiveRecord
{
	/**
	 * List of constants for scopes.
	 */
	const SCOPE_SELECT_LABELS = 'selectLabels';
	const SCOPE_ORDER_NEWEST = 'orderNewest';
	/**
	 * @return string 'emailLogin' 
	 */
	const SCOPE_EMAIL_LOGIN = 'emailLogin';


	/**
	 * List of Constant for scenario
	 */
	/**
	 * @return string standardInsert
	 */
	const SCENARIO_INSERT_STANDARD_TYPE = 'standardInsert';
	/**
	 * @return string 'updatePassword' 
	 */
	const SCENARIO_UPDATE_PASSWORD = 'updatePassword';

	/** 	
	 * @var string Password for Identity 
	 */
	public $password;
	public $oldPassword;
	public $newPassword;

	/**
	 * @var string confirmation password for Identity 
	 */
	public $passwordRepeat;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('username', 'match', 'pattern' => '/^[a-zA-Z][a-zA-Z0-9_]+$/', 'message' => Yii::t('rules', '{attribute} is invalid. Only alphabet, number, and underscore allowed')),
			array('username, fullName, email', 'required'),
			array('username,email', 'unique'),
			array('email', 'email'),
			array('password', 'required', 'on' => self::SCENARIO_INSERT_STANDARD_TYPE),
			array('passwordRepeat', 'safe'),
			array('password', 'compare', 'compareAttribute' => 'passwordRepeat', 'on' => self::SCENARIO_INSERT_STANDARD_TYPE),
			array('newPassword,oldPassword', 'required', 'on' => self::SCENARIO_UPDATE_PASSWORD),
			array('newPassword', 'compare', 'compareAttribute' => 'passwordRepeat', 'on' => self::SCENARIO_UPDATE_PASSWORD),
			array('oldPassword', 'compare', 'compareAttribute' => 'password', 'on' => self::SCENARIO_UPDATE_PASSWORD, 'message' => Yii::t('rules', 'Type your {attribute} correctly.')),
			array('username', 'length', 'max' => 64, 'min' => 5),
			array('email', 'email'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'identity' => array(self::HAS_MANY, 'Identity', 'uid'),
			'loginIdentity' => array(self::HAS_ONE, 'Identity', 'uid', 'condition' => sprintf('type= %s ', Identity::TYPE_EMAIL_LOGIN)),
		);
	}

	/**
	 * @return array the scope definition. {@link CActiveRecord}.
	 */
	public function scopes()
	{
		$t = $this->getTableAlias();
		return array(
			self::SCOPE_SELECT_LABELS => array(
				'select' => array(
					"`{$t}`.`id`", "`{$t}`.`username`", "`{$t}`.`fullName`", "`{$t}`.`email`", "`{$t}`.`createdTime`"
				),
			),
			self::SCOPE_ORDER_NEWEST => array(
				'order' => "`{$t}`.`createdTime` DESC",
			),
			self::SCOPE_EMAIL_LOGIN => array(
				'select' => array(
					"`{$t}`.`id`", "`{$t}`.`username`", "`{$t}`.`fullName`", "`{$t}`.`email`", "`{$t}`.`isRemoved`"
				),
				'with' => array(
					array(
						'identity' => array(
							'select' => array(
								'validationData'
							),
							'condition' => "type=:type",
							'params' => array(':type' => Identity::TYPE_EMAIL_LOGIN)
						)
					)
				)
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('label', 'ID'),
			'username' => Yii::t('label', 'Username'),
			'fullName' => Yii::t('label', 'Full Name'),
			'email' => Yii::t('label', 'Email'),
			'password' => Yii::t('label', 'Password'),
			'passwordRepeat' => Yii::t('label', 'Confirm Password'),
		);
	}

	/**
	 * @return \application\models\CActiveDataProvider 
	 */
	public function search()
	{
		$t = $this->getTableAlias();
		$criteria = new CDbCriteria();
		$criteria->scopes = array(
			User::SCOPE_SELECT_LABELS,
			User::SCOPE_ORDER_NEWEST,
		);
		if (trim($this->isRemoved) !== '')
		{
			$criteria->condition = "`{$t}`.`isRemoved` = :isRemoved";
			$criteria->params[':isRemoved'] = $this->isRemoved;
		}

		return new \CActiveDataProvider($this,
						array(
							'criteria' => $criteria,
							'pagination' => array(),
				));
	}

	/**
	 * Method that called before validate object.
	 * @return boolean 
	 */
	public function beforeValidate()
	{
		if ($this->getIsNewRecord())
		{
			$this->createdTime = new \CDbExpression('NOW()');
		}
		return parent::beforeValidate();
	}

	/**
	 * Method that called before saving
	 * @return boolean
	 */
	public function beforeSave()
	{
		return parent::beforeSave();
	}

	/**
	 * method that called after save.
	 * if method after@link{$this::getScenario()} is exists 

	 */
	public function afterSave()
	{
		if (parent::afterSave())
		{
			if (method_exists($this, $methodName = "after" . ucfirst($this->getScenario())))
			{
//				Calling another method.
				call_user_func_array(array($this, $methodName), array());
			}
		}
	}

	/**
	 *  method that called on afterSave where scenario is updatePassword
	 */
	protected function afterUpdatePassword()
	{
//		TODO: update Identity model validationData,salt, and send confirmation email here. 
	}
}