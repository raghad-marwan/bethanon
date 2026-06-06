<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropUnique('organizations_national_id_unique');
            $table->string('national_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('national_id')->unique()->change();
        });
    }
};
