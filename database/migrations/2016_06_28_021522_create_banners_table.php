<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //首页Banner
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('url')->comment('文章或者视频url');
            $table->string('title',50)->comment('标题');
            $table->string('thumb',200)->comment('缩略图');
            $table->integer('views')->default('0')->comment('点击次数');
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
        //删除视频
        Schema::dropIfExists('banners');
    }
}
