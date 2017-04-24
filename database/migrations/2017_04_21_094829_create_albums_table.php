<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cover')->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('rate_number')->default('0');
            $table->float('rate_point')->default('0');
            $table->integer('comment_number')->default('0');
            $table->integer('is_hot')->default('0');
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
        Schema::dropIfExists('albums');
    }
}
