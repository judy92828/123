<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //广告位
        Schema::create('ad_position', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('name',200)->comment('广告位名称');
            $table->integer('position')->comment('广告位置');
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
        //删除广告位
        Schema::dropIfExists('ad_position');
    }
}
