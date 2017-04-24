<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cover')->nullable();
            $table->string('link');
            $table->text('description')->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->string('type');
            $table->string('author')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('singer_id')->unsigned()->nullable();
            $table->integer('rate_number')->unsigned()->default('0');
            $table->float('rate_point')->default('0');
            $table->integer('comment_number')->unsigned()->default('0');
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
        Schema::dropIfExists('songs');
    }
}
