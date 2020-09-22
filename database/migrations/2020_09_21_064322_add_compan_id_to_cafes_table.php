<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanIdToCafesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafes', function (Blueprint $table) {
            //
            $table->foreignId('companies_id')->after('latitude')->constrained()->onDelete('cascade')->comment("所属公司");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cafes', function (Blueprint $table) {
            //
            $table->dropForeign(['companies_id']);
        });
    }
}
