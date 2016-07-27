<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //合作机构
        Schema::create('agency', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('title',200)->comment('机构名称');
            $table->string('url',300)->comment('机构链接');
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
        //删除合作机构
        Schema::dropIfExists('agency');
    }
}
