<?php

/**
 * WebUser class file.
 *
 * @author Nurcahyo al hidayah <2light.hidayah@gmail.com>
 * @link http://oneaccess.co.id/
 * @copyright Copyright &copy; 2012-2012 One Access Interactive
 * @license http://oneaccess.co.id/license
 * @version $Id$
 * @package system
 * @since 1.0
 */
class WebUser extends CWebUser
{

	/**
	 *
	 * @return string Fullname that setted in {@link UserIdentity::authenticate} that call {@link UserIdentity::setPresistenStates} method
	 */
	public function getFullName()
	{
		return $this->getState('__fullName');
	}

	/**
	 *
	 * @return string email that setted in {@link UserIdentity::authenticate} that call {@link UserIdentity::setPresistenStates} method
	 */
	public function getEmail()
	{
		return $this->getState('__email');
	}
}

?>
