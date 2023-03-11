<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->longText('name');
			$table->longText('description');
			$table->decimal('price');
			$table->integer('store_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}