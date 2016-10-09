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
        //创建表结构
        Schema::create('links', function (Blueprint $table) {
            $table->engine='MyISAM';
            $table->increments('links_id')->comment('友情链接id');
            $table->string('links_name')->default('')->comment('连接名称');
            $table->string('links_title')->default('')->comment('连接标题');
            $table->string('links_url')->default('')->comment('连接地址');
            $table->integer('links_order')->default(0)->comment('连接排序');
            $table->timestamps('links_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除表
        Schema::drop('links');
    }
}
