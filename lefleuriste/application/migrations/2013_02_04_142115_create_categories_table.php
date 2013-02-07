<?php

class Create_Categories_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function($table)
		{
		$table->increments('id');
		$table->string('nom', 250);
		$table->integer('categorie_id')->unsigned()->nullable();
		$table->foreign('categorie_id')->references('id')->on('categories')->on_delete('cascade')->on_update('cascade');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}