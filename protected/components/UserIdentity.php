<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 *
	 * @var int user uniqueId 
	 */
	private $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->emailLogin()->findByAttributes(array('username' => $this->username), array(
			'condition' => '1=1 OR t.email = :email',
			'params' => array(
				':email' => $this->username
				))
		);

		if (!$user)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if (isset($user->loginIdentity->validationData) && $user->loginIdentity->validationData !== HHash::hash($this->password, $user->loginIdentity->salt))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->errorCode = self::ERROR_NONE;
			$this->_id = $user->id;
			$this->setPersistentStates(array('__fullName' => $user->fullName, '__email' => $user->email));
		}
		return !$this->errorCode;
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