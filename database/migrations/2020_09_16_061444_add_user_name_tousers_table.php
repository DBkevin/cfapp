<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserNameTousersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //email
            $table->dropUnique('users_email_unique');
            $table->string('email')->nullable()->change();
            $table->unique('name');
            $table->string('phone')->unique()->after('name')->nullbale();
            $table->string('introduction')->nullable()->after('password')->comment("个人简介");
            $table->string('avatar')->nullable()->after('introduction')->commetn("头像框");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->unique('email', 'users_email_unique');
            $table->string('email')->nullable(false)->change();
            $table->dropColumn('phone');
            $table->dropColumn('introduction');
            $table->dropColumn('avatar');
            $table->dropUnique('name');
        });
    }
}
