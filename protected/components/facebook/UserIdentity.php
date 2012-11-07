<?php

namespace facebook;

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
use \Yii;
use \User;
use \Identity;
use \CHtml;

class UserIdentity extends \CUserIdentity
{
	/**
	 *
	 * @var int user uniqueId 
	 */
	private $_id;
	public $profile;

	/**
	 * Constructor.
	 */
	public function __construct($profile)
	{
		$this->profile = $profile;
	}

	/**
	 * Authenticates a user.
	 * Authenticate facebook user using persistent user identity or create a new one if user not registered.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		//check if user facebook id found on identity table
		$identity = Identity::model()->with('user')->findByAttributes(array('accid' => $this->profile['id'], 'type' => Identity::TYPE_FACEBOOK_LOGIN));
		//if facebook id not found find it by email
		if (!$identity) {
			$user = User::model()->findByAttributes(array('email' => $this->profile['email']));
			//if email found 
			if ($user) {
				//create new Identity
				$identity = new Identity;
				//set Identity attributes 
				$identity->setAttributes(array(
					'uid' => $user->id,
					'accid' => $this->profile['id'],
					'type' => Identity::TYPE_FACEBOOK_LOGIN
				));
				//validate and save
				if ($identity->save()) {
					$identity->user = $user;
				}
			}
			else
				return false;
		}
		$user = $identity->user;
		//Create user session
		$this->_id = $user->id;
		$this->username = $user->username;
		$this->setPersistentStates(array('__fullName' => CHtml::encode($user->fullName), '__email' => CHtml::encode($user->email)));
		//if the user are removed account and login back set the user isRemoved 0 and give a wellcome back message to him/her.
		if ($user->isRemoved == 1)
		{
			$user->isRemoved = 0;
			if ($user->save())
				$this->setState('welcome', Yii::t('messages', 'Welcome back {fullName}', array('{fullName}' => $user->fullName)));
		}
		return true;
	}

	/**
	 * Returns the unique identifier for the identity.
	 * The default implementation simply returns {@link username}.
	 * This method is required by {@link IUserIdentity}.
	 * @return string the unique identifier for the identity.
	 */
	public function getId()
	{
		return $this->_id;
	}
}