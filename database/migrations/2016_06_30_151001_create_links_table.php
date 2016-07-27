<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //链接管理
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('title',200)->comment('链接标题');
            $table->string('url',300)->comment('链接');
            $table->integer('type')->comment('类型');
            $table->integer('status')->default('0')->comment('状态（0-创建未审核，1-已发布');
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
        //删除友情链接
        Schema::dropIfExists('links');
    }
}
