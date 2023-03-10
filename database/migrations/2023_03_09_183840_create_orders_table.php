<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('store_id')->unsigned();
			$table->decimal('shipping_cost')->default('0.0');
			$table->decimal('total')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}