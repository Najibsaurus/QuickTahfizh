<?php

/**
 * Additional user's fields migration.
 * 
 * This migration will add some additional fields.
 * 
 * @author Petra Barus <petra.barus@gmail.com>
 */
class m120925_003809_add_additional_user_fields extends CDbMigration
{
	const USERS = 'Users';

	/**
	 * Applies the migration.
	 */
	public function up()
	{
		$trans = $this->dbConnection->beginTransaction();
		try
		{
			if ($this->dbConnection->getDriverName() === 'pgsql')
			{
				$this->addColumn(self::USERS, 'password', 'VARCHAR(40) NOT NULL');
				$this->addColumn(self::USERS, 'createdTime', 'TIMESTAMP NOT NULL');
				$this->addColumn(self::USERS, 'updatedTIme', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
				$this->addColumn(self::USERS, 'isRemoved', 'SMALLINT NOT NULL DEFAULT 0');
				$this->addColumn(self::USERS, 'removedTime', 'TIMESTAMP NULL');
				//Creating indices
				$this->createIndex('createdTime', self::USERS, 'createdTime');
				$this->createIndex('updatedTIme', self::USERS, 'updatedTIme');
				$this->createIndex('isRemoved', self::USERS, 'isRemoved');
				$this->createIndex('removedTime', self::USERS, 'removedTime');
			}
			else
			{

				$this->addColumn(self::USERS, 'password', 'VARCHAR(40) NOT NULL');
				$this->addColumn(self::USERS, 'createdTime', 'DATETIME NOT NULL');
				$this->addColumn(self::USERS, 'updatedTIme', 'TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
				$this->addColumn(self::USERS, 'isRemoved', 'TINYINT NOT NULL DEFAULT 0');
				$this->addColumn(self::USERS, 'removedTime', 'DATETIME NULL');

				//Creating indices
				$this->createIndex('createdTime', self::USERS, 'createdTime');
				$this->createIndex('updatedTIme', self::USERS, 'updatedTIme');
				$this->createIndex('isRemoved', self::USERS, 'isRemoved');
				$this->createIndex('removedTime', self::USERS, 'removedTime');
			}
			$trans->commit();
			return TRUE;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			$trans->rollback();
			return FALSE;
		}
	}

	/**
	 * Removes the migration.
	 */
	public function down()
	{
		$trans = $this->dbConnection->beginTransaction();
		try
		{
			//Removing indices
			$this->dropIndex('removedTime', self::USERS);
			$this->dropIndex('isRemoved', self::USERS);
			$this->dropIndex('updatedTIme', self::USERS);
			$this->dropIndex('createdTime', self::USERS);
			//Removing fields
			$this->dropColumn(self::USERS, 'removedTime');
			$this->dropColumn(self::USERS, 'isRemoved');
			$this->dropColumn(self::USERS, 'updatedTIme');
			$this->dropColumn(self::USERS, 'createdTime');
			$this->dropColumn(self::USERS, 'password');
			$trans->commit();
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			$trans->rollback();
		}
	}
}