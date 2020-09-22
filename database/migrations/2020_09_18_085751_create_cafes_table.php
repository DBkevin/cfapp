<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCafesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment("店铺名称");
            $table->string("address")->comment("店铺地址");
            $table->string("city")->comment("所在城市");
            $table->string("state")->comment("所在省份");
            $table->string('tel')->comment('店铺联系电话');
            $table->string('description')->nullable()->default("这个店铺没有留下简介")->comment('店铺简介');
            $table->decimal('longitude', 11, 8)->nullabl()->comment('店铺地址转换后的经度');
            $table->decimal('latitude', 11, 8)->nullable()->comment("店铺地址转换后的维度");
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
        Schema::dropIfExists('cafes');
    }
}
