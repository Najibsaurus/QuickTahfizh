<?php

namespace facebook;

/**
 * Component class file.
 *
 * @author Nurcahyo al hidayah <2light.hidayah@gmail.com>
 * @link http://oneaccess.co.id/
 * @copyright Copyright &copy; 2012-2012 One Access Interactive
 * @license http://oneaccess.co.id/license
 * @version $Id$
 * @package system
 * @since 1.0
 */
use Yii;
use CHtml;

require dirname(__FILE__) . '/vendor/src/facebook.php';

class Component extends \CApplicationComponent
{
	/**
	 *
	 * @var Facebook facebook sdk that will overide on {@see facebook\Component::__get} 
	 */
	private $_sdk;

	/**
	 *
	 * @var string facebook appId 
	 */
	private $_appId;

	/**
	 *
	 * @var string facebook app secret key 
	 */
	private $_appSecret;

	/**
	 *
	 * @var string facebook login scope 
	 */
	public $scope;

	/**
	 *
	 * @var type string registerUrl 
	 */
	public $registerUrl;

	/**
	 * Set Application ID
	 * @param string $id set private property {@see self::_appId} 
	 * @throws \CException 
	 */
	public function setAppId($id)
	{
		if ($this->isInitialized)
			throw new \CException('Cant set appid when component has been initialized');
		$this->_appId = $id;
	}

	/**
	 * Set Application Secret Key
	 * @param type $key
	 * @throws \CException 
	 */
	public function setAppSecret($key)
	{
		if ($this->isInitialized)
			throw new \CException('Cant set secret when component has been initialized');
		$this->_appSecret = $key;
	}

	/**
	 * Get Application Id
	 * @return type 
	 */
	protected function getAppId()
	{
		return $this->_appId;
	}

	/**
	 * Get Application Secret Key
	 * @return type 
	 */
	protected function getAppSecret()
	{
		return $this->_appSecret;
	}

	/**
	 * Initialize Component 
	 */
	public function init()
	{
		$this->_sdk = new \Facebook(array(
					'appId' => $this->getAppId(),
					'secret' => $this->getAppSecret(),
				));
		$sdk = $this->_sdk;
		$this->registerUrl = CHtml::normalizeUrl($this->registerUrl);
		Yii::app()->user->onBeforeLogoutArrays[] = function() use($sdk) {
					$sdk->destroySession();
				};
		parent::init();
	}
	/**
	 *
	 * @var array User Provile 
	 */
	private $_userProfile;

	public function getUserProfile()
	{
		if ($this->_userProfile === null && $this->user)
			try
			{
				// Proceed knowing you have a logged in user who's authenticated.
				$this->_userProfile = $this->api('/me');
			}
			catch (FacebookApiException $e)
			{
				if (YII_DEBUG)
					echo $e->getMessages();
				$this->user = null;
			}

		return $this->_userProfile;
	}

	public function login() {
		$identity = new UserIdentity($this->userProfile);
		if (!$identity->authenticate())
			return false;
		$webUser = Yii::app()->user;
		/* @var $webUser \WebUser */
		return $webUser->login($identity, 0);
	}

	/**
	 * Magic method that overide {@see Facebook} to this Class
	 * @param string $args
	 * @return type 
	 */
	public function __get($args)
	{
		if ($this->getIsInitialized())
		{
			if (isset($this->_sdk->$args))
				return $this->_sdk->$args;
			else if (method_exists($this->_sdk, $getter = "get$args"))
			{
				return call_user_func_array(array($this->_sdk, $getter), array());
			}
			else if (method_exists($this->_sdk, $getter = "get" . ucfirst($args)))
			{
				return call_user_func_array(array($this->_sdk, $getter), array());
			}
		}
		return parent::__get($args);
	}

	/**
	 * Magic method that overide {@see Facebook} method into this Class
	 * @param type $name
	 * @param type $parameters
	 * @return type 
	 */
	public function __call($name, $parameters = array())
	{
		if ($this->getIsInitialized())
		{
			if (method_exists($this->_sdk, $name))
				return call_user_func_array(array($this->_sdk, $name), $parameters);
		}
		return parent::__call($name, $parameters);
	}

	public function getSDK()
	{
		return $this->_sdk;
	}
}

?>
