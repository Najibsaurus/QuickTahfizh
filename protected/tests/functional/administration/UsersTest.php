<?php

/**
 * User management functional testing..
 * 
 * @author Petra Barus <petra.barus@gmail.com>
 * @package application.tests.functional.administration
 */
class UsersTest extends WebTestCase
{

	/**
	 * User management list test.
	 */
	public function testIndex()
	{
		$this->open('/administration/users');

		$users = User::model()->findAll();
		foreach ($users as $user)
		{
			/* @var $user User */
			$this->assertTextPresent($user->id);
			$this->assertTextPresent($user->username);
			$this->assertTextPresent($user->fullName);
			$this->assertTextPresent($user->email);
			$this->assertTextPresent(Yii::app()->dateFormatter->format('yyyy/MM/dd', $user->createdTime));
		}
	}
	
}