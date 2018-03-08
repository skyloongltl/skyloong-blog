<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration 
{
	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->text('body');
            $table->integer('tags_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('reply_count')->unsigned()->defult(0);
            $table->integer('view_count')->unsigned()->default(0);
            $table->tinyInteger('is_top')->unsigned()->default(0);
            $table->text('excerpt');
            $table->string('slug')->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('articles');
	}
}
