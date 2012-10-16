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
 * @proeprty string $removedTime time when user's record is flagged as removed.
 * 
 * @author Petra Barus <petra.barus@gmail.com>
 * @package application.models
 */

namespace application\models;

use \Yii;

class User extends \CActiveRecord
{
	/**
	 * List of constants for scopes.
	 */
	const SCOPE_SELECT_LABELS = 'selectLabels';
	const SCOPE_ORDER_NEWEST = 'orderNewest';
	const SCOPE_EMAIL_LOGIN = 'emailLogin';


	/**
	 * List of Constant for scenario
	 */
	const SCENARIO_INSERT_STANDARD_TYPE = 'standardInsert';
	const SCENARIO_UPDATE_PASSWORD = 'updatePassword';

	/** 	
	 * @var string Password for Identity 
	 */
	public $password;
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
			array('password', 'required', 'on' => self::SCENARIO_INSERT_STANDARD_TYPE),
			array('passwordRepeat', 'safe', 'on' => self::SCENARIO_INSERT_STANDARD_TYPE),
			array('password', 'compare', 'compareAttribute' => 'passwordRepeat', 'on' => self::SCENARIO_INSERT_STANDARD_TYPE),
			array('newPassword', 'compare', 'compareAttribute' => 'passwordRepeat', 'on' => self::SCENARIO_UPDATE_PASSWORD),
			array('password', 'compare', 'compareAttribute' => 'newPassword', 'operator' => '!=', 'on' => self::SCENARIO_UPDATE_PASSWORD),
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
			'identity' => array(self::HAS_MANY, '\\application\\models\\Identity', 'uid')
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
					"`{$t}`.`id`", "`{$t}`.`username`", "`{$t}`.`fullname`"
				),
				'with' => array(
					array(
						'identity' => array(
							'select' => array(
								'validationData'
							),
							'condition' => 'type=:type',
							'params' => array(':type' => \application\models\Identity::TYPE_EMAIL_LOGIN)
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

	public function search()
	{
		return new CActiveDataProvider('User');
	}

	public function beforeValidate()
	{
		if ($this->getIsNewRecord())
		{
			$this->createdTime = new \CDbExpression('NOW()');
		}
		return parent::beforeValidate();
	}

	public function beforeSave()
	{
		if ($this->getScenario() === self::SCENARIO_INSERT_STANDARD_TYPE && $this->getIsNewRecord())
		{
			$this->password = \HHash::generatePassword($this->password);
			$this->salt = \HHash::generateSalt();
		}

		if ($this->getScenario() === self::SCENARIO_UPDATE_PASSWORD)
		{
			$this->password = \HHash::generatePassword($this->newPassword);
			$this->salt = \HHash::generateSalt();
		}

		return parent::beforeSave();
	}
}