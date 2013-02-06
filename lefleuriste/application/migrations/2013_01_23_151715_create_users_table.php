<?php

class Create_Users_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
    	Schema::create('users', function($table)
    	{
        	$table->increments('id');
			$table->string('name', 100);
        	$table->string('firstname', 100);
			$table->string('adresse', 250);
			$table->string('ville', 50);
			$table->string('code_postal', 10);
			$table->string('pays', 50);
			$table->string('telephone', 15);
			$table->string('email', 320)->unique();
        	$table->string('username', 32)->unique();
        	$table->string('password', 64);
			$table->boolean('admin?', 0);
			$table->timestamps();
		});
	}
	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}