<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerMembershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('employer_memberships')){
            Schema::create('employer_memberships', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('cv_limit')->unsigned()->nullable();
                $table->integer('job_limit')->unsigned()->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
        if(!Schema::hasTable('employer_has_memberships')){
            Schema::create('employer_has_memberships', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('employer_id')->unsigned()->references('id')->on('employer_has_users')->onDelete('cascade')->onUpdate('cascade');
                $table->string('membership_id')->unsigned()->references('id')->on('employer_memberships')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('cv_count')->unsigned()->nullable();
                $table->integer('job_count')->unsigned()->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
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
