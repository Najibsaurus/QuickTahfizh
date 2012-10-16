<?php

/**
 * This is the model class for table "Identity".
 *
 * The followings are the available columns in table 'Identity':
 * @property string $uid application\models\User Id
 * @property string $accid account Id. 0 for email/username, facebook account id / twitter account id if use oauth
 * @property integer $type identity type. 0 => email/username, 1=>facebook, 2=>twitter
 * @property string $validationData password or authentication id of oauth connector.
 * @property \application\models\User $user
 * 
 * @author Nurcahyo al Hidayah <2light.hidayah@gmail.com>
 * @package application.models
 */
namespace application\models;
use \Yii;

class Identity extends \CActiveRecord
{
	const TYPE_EMAIL_LOGIN=0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Identity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Identity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, type, validationData', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('uid, accid', 'length', 'max'=>20),
			array('validationData', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('uid, accid, type, validationData', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user'=>array(self::BELONGS_TO,"\\application\\models\\User",'uid')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'Uid',
			'accid' => 'Accid',
			'type' => 'Type',
			'validationData' => 'Password',
		);
	}


}