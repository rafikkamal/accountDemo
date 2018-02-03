<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


// $table->integer('category')->unsigned();
// $table->foreign('category')->references('id')->on('categories');
// $table->integer('sub_category')->unsigned();
// $table->foreign('category')->references('id')->on('categories');

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100);
            $table->decimal('price');
            $table->text('description',500)->nullable();
            $table->integer('priority')->default(1);
            $table->enum('status',['active','inactive'])->default('active');
            $table->softDeletes();
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
        Schema::dropIfExists('items');
    }
}
