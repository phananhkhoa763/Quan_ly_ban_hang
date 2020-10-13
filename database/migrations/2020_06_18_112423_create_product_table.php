<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedInteger('category_id');
			$table->unsignedInteger('brand_id');
			$table->unsignedInteger('user_id');
			$table->string('name');
			$table->string('image')->nullable();
			$table->string('web_id');
			$table->integer('price');
			$table->tinyInteger('status')->comment = '1:sale 0:new';
			$table->integer('sale');
			$table->string('condition');
			$table->text('detail');
			$table->string('company_profile');
			$table->tinyInteger('highlight');
			$table->tinyInteger('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
