<?php

class m121011_003849_create_identity_field_move_password_to_identity_field extends CDbMigration
{

	public function up()
	{
		$trans = $this->getDbConnection()->beginTransaction();
		try
		{
			$this->createTable('Identity', array(
				'uid' => 'BIGINT NOT NULL',
				'accid' => 'BIGINT NOT NULL',
				'type' => 'INT NOT NULL',
				'validationData' => 'VARCHAR(128) NOT NULL',
				'salt' => 'VARCHAR(256) NOT NULL',
				//crating indicies
				'Primary Key(`uid`,`accid`,`type`)'
			));
			$this->dropColumn("Users", 'password');
			$this->addForeignKey('Identity-userId', 'Identity', 'uid', 'Users', 'id','CASCADE','CASCADE');
			$trans->commit();
		}
		catch (Exception $e)
		{
			echo $e;
			$trans->rollback();
		}
	}

	public function down()
	{
		$this->dropForeignKey('Identity-userId', 'Identity');
		$this->dropTable('Identity');
		$this->addColumn("Users", 'password', 'VARCHAR(40) NOT NULL');
	}
	/*
	  // Use safeUp/safeDown to do migration with transaction
	  public function safeUp()
	  {
	  }

	  public function safeDown()
	  {
	  }
	 */
}