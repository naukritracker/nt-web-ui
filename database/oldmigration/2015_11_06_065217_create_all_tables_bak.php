<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //USER TABLE
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('reset_token')->nullable();
            $table->integer('active_flag')->unsigned();
            $table->timestamp('last_logged_in_date_time');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });

        //PASSWORD RESETS TABLE
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });

        //CREATE MEDIA TABLE
         Schema::create('media', function($table){
            $table->increments('id');
            $table->string('content');
            $table->softDeletes();
            $table->timestamps();
        });

         //CREATE COUNTRY TABLE
        Schema::create('country', function($table){
            $table->increments('id');
            $table->string('country');
             $table->string('slug');
            $table->timestamps();
        });

        //CREATE STATE TABLE
        Schema::create('state', function($table){
            $table->increments('id');
            $table->integer('country_id')->unsigned()->referenes('id')->on('country')->onDelete('cascade')->onUpdate('cascade');
            $table->string('state');
            $table->string('slug');
            $table->timestamps();
        });

        //CREATE VISA TABLE
         Schema::create('visa',function($table){
            $table->increments('id');
            $table->string('visa');
            $table->integer('country_id')->unsigned()->references('id')->on('country')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });


         //CREATE COMPANY TABLE
        Schema::create('company', function($table){
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('city');
            $table->integer('state_id')->unsigned()->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('country_id')->unsigned()->references('id')->on('country')->onDelete('cascade')->onUpdate('cascade');
            $table->text('address');
            $table->string('website');
            $table->integer('contactno')->unsigned();
            $table->timestamps();
        });

        //USER DETAILS TABLE
        Schema::create('user_details', function($table){
            $table->increments('id');
            $table->integer('user_id')->unsigned()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('state_id')->unsigned()->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('resume_media_id')->unsigned()->references('id')->on('media')->onDelete('cascade')->onUpdate('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_headline');
            $table->integer('contact_no')->unsigned();
            $table->integer('country_code')->unsigned();
            $table->string('city');
            $table->string('profile_image');

            $table->text('industry');
            $table->text('functional_area');
            $table->text('role');

            $table->string('current_location')->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
            $table->string('preferred_location')->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('dob_day')->unsigned();
            $table->integer('dob_month')->unsigned();
            $table->integer('dob_year')->unsigned();
            $table->string('gender');
            $table->string('martial_status');
            $table->text('permanent_address');

            $table->string('sse_institution');
            $table->date('sse_start_date');
            $table->date('sse_end_date');
            $table->string('sse_type');
            $table->integer('sse_marks')->unsigned();

            $table->string('hsse_institution');
            $table->date('hsse_start_date');
            $table->date('hsse_end_date');
            $table->string('hsse_type');
            $table->integer('hsse_marks')->unsigned();

            $table->string('ug_institution');
            $table->date('ug_start_date');
            $table->date('ug_end_date');
            $table->string('ug_type');
            $table->integer('ug_marks')->unsigned();

            $table->string('pg_institution');
            $table->date('pg_start_date');
            $table->date('pg_end_date');
            $table->string('pg_type');
            $table->integer('pg_marks')->unsigned();

            $table->string('other_institution');
            $table->date('other_start_date');
            $table->date('other_end_date');
            $table->string('other_type');
            $table->integer('other_marks')->unsigned();

            $table->softDeletes();
            $table->timestamps();
        });

        //CREATE EXPERIENCE TABLES
        Schema::create('experience', function($table){
            $table->increments('id');
            $table->integer('company_id')->unsigned()->references('id')->on('company')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('state_id')->unsigned()->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id')->unsigned()->refernces('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('total_experience')->unsigned();
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->text('description');
            $table->integer('annual_lakh')->unsigned();
            $table->integer('annual_thousand')->unsigned();
            $table->string('currency');
            $table->string('industry');
            $table->string('functional_area');
            $table->string('role');
            $table->text('description');
            $table->timestamps();
        });

        //CREATE JOBS TABLE
         Schema::create('jobposting',function($table){
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('role');
            $table->integer('offered');
            $table->string('currency');
            $table->integer('state_id')->unsigned()->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('country_id')->unsigned()->references('id')->on('country')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('company_id')->unsigned()->references('id')->on('company')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('visa_id')->unsigned()->references('id')->on('visa')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('priority')->unsigned();
            $table->text('tags');
            $table->string('industry'); 
            $table->integer('active_flag');
            $table->timestamps();
        });


        //ENTRUST TABLES FOR ROLE MANAGEMENT
         // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('users');
        Schema::drop('password_resets');
        Schema::drop('media');
        Schema::drop('country');
        Schema::drop('state');
        Schema::drop('visa');
        Schema::drop('company');
        Schema::drop('user_details');
        Schema::drop('experience');
        Schema::drop('jobposting');
        
        //ENTRUST TABLES
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
    }
}
