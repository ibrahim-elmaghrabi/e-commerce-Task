<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoresTable extends Migration {

	public function up()
	{
		Schema::create('stores', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->string('name');
			$table->decimal('shipping_cost')->nullable()->default('0.0');
			$table->boolean('vat_included');
			$table->decimal('vat_percentage')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('stores');
	}
}