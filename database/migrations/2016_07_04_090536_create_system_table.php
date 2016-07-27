<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //系统设置
        Schema::create('system', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('webtitle',200)->comment('网站标题');
            $table->string('keywords',200)->comment('关键词');
            $table->text('description')->comment('网站描述');
            $table->string('img',200)->comment('网站logo');
            $table->string('weixin',200)->comment('网站微信二维码');
            $table->string('weibo',200)->comment('网站微博二维码');
            $table->string('weixinurl',200)->comment('网站微信链接');
            $table->string('weibourl',200)->comment('网站微博链接');
            $table->string('icp',200)->comment('网站备案编号');
            $table->string('tongji',200)->comment('网站统计代码');
            $table->text('about')->comment('关于我们');
            $table->text('contact')->comment('联系我们');
            $table->text('follow')->comment('关注我们');
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
        //删除系统设置
        Schema::dropIfExists('system');
    }
}
