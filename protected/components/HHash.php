<?php

/**
 * HHash class file.
 * This file included statics method for hashing.
 *
 * @author Nurcahyo al hidayah <2light.hidayah@gmail.com>
 * @link http://oneaccess.co.id/
 * @copyright Copyright &copy; 2012-2012 One Access Interactive
 * @license http://oneaccess.co.id/license
 * @version $Id$
 * @package helper
 * @since 1.0
 */
class HHash
{
	public static $_SALT_LENGTH = 20;
	private static $_salt = null;

	public static function generateSalt()
	{
		if (is_null(self::$_salt))
			self::$_salt = substr(md5(uniqid(rand(), true)), 0, self::$_SALT_LENGTH);
		return self::$_salt . sha1(self::$_salt);
	}

	public static function generatePassword($password)
	{
		return self::hash($password, self::generateSalt());
	}

	public static function hash($password, $salt)
	{
		return md5($password . $salt);
	}
}

?>
