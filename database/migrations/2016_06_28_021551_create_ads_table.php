<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //广告
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->integer('position_id')->comment('广告位ID');
            $table->string('title',200)->comment('广告标题');
            $table->string('thumb',200)->comment('缩略图');
            $table->string('url',300)->comment('广告链接');
            $table->integer('views')->comment('阅读量');
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
        //删除广告
        Schema::dropIfExists('ads');
    }
}
