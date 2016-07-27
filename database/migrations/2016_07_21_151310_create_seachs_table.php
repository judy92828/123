<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeachsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //搜索管理
        Schema::create('seachs', function (Blueprint $table) {
            $table->integer('id')->comment('文章或者视频ID');
            $table->integer('type')->default('0')->comment('文章类别（0-文章，1-视频');
            $table->string('title',200)->comment('标题');
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
        //
    }
}
