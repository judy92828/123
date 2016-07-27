<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //文章类别
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('name',30)->comment('类别名称');
            $table->tinyInteger('type')->default(0)->comment('0-文章，1-视频');
            $table->string('alias',30)->comment('类别别名(英文名)');
            $table->integer('parent_id')->unsigned()->default('0')->comment('类别名称');
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
        //删除文章类别
        Schema::dropIfExists('categories');
    }
}
