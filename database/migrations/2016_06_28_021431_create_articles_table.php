<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //文章
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->integer('category_id')->comment('类别ID');
            $table->string('title',50)->comment('文章标题');
            $table->string('summary',200)->comment('文章描述');
            $table->string('thumbnail',200)->comment('缩略图');
            $table->string('image',200)->comment('详情大图');
            $table->text('content')->comment('文章内容');
            $table->string('keywords',200)->comment('关键字');
            $table->string('source',50)->comment('来源');
            $table->string('author',50)->comment('责任编辑');
            $table->integer('views')->comment('阅读量');
            $table->integer('recommend')->comment('推荐（0-未推荐，1-推荐）');
            $table->integer('status')->default('0')->comment('状态（0-创建未审核，1-已审核，2-已发布');
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
        //删除文章
        Schema::dropIfExists('articles');
    }
}
