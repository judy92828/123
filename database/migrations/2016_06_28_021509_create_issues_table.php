<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //视频期数
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->integer('video_id')->comment('视频ID');
            $table->string('name',20)->comment('期数');
            $table->string('summary',200)->comment('文章摘要');
            $table->string('url',300)->comment('视频链接地址');
            $table->integer('views')->default('0')->comment('播放次数');
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
        //删除视频期数
        Schema::dropIfExists('issues');
    }
}
