<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIndustryAnFunctionalAreaInUserTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function($table)
        {
            $table->integer('industry')->unsigned()->referenes('id')->on('industry')->onDelete('cascade')->onUpdate('cascade')->change();
            $table->integer('functional_area')->unsigned()->referenes('id')->on('functional_area')->onDelete('cascade')->onUpdate('cascade')->change();
        });
        Schema::table('employer_user_has_details', function($table)
        {
            $table->integer('industry')->unsigned()->referenes('id')->on('industry')->onDelete('cascade')->onUpdate('cascade')->change();
            $table->integer('functional_area')->unsigned()->referenes('id')->on('functional_area')->onDelete('cascade')->onUpdate('cascade')->change();
        });

        Schema::table('experience', function($table)
        {
            $table->integer('industry')->unsigned()->referenes('id')->on('industry')->onDelete('cascade')->onUpdate('cascade')->change();
            $table->integer('functional_area')->unsigned()->referenes('id')->on('functional_area')->onDelete('cascade')->onUpdate('cascade')->change();
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
