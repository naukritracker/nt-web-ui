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
        if(!Schema::hasTable('users')){
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
        } 

        //PASSWORD RESETS TABLE
        if(!Schema::hasTable('password_resets')){
            Schema::create('password_resets', function (Blueprint $table) {
                $table->string('email')->index();
                $table->string('token')->index();
                $table->timestamp('created_at');
            });
        }

        //CREATE MEDIA TABLE
        if(!Schema::hasTable('media')){
            Schema::create('media', function($table){
                $table->increments('id');
                $table->string('content')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }

         //CREATE COUNTRY TABLE
        if(!Schema::hasTable('country')){
            Schema::create('country', function($table){
                $table->increments('id');
                $table->string('country')->unique();
                 $table->string('slug')->unique();
                $table->timestamps();
            });
        }

        //CREATE STATE TABLE
        if(!Schema::hasTable('state')){
            Schema::create('state', function($table){
                $table->increments('id');
                $table->integer('country_id')->unsigned()->referenes('id')->on('country')->onDelete('cascade')->onUpdate('cascade');
                $table->string('state');
                $table->string('slug');
                $table->timestamps();
            });
        }

        //CREATE VISA TABLE
        if(!Schema::hasTable('visa')){
             Schema::create('visa',function($table){
                $table->increments('id');
                $table->string('visa');
                $table->integer('country_id')->unsigned()->references('id')->on('country')->onDelete('cascade')->onUpdate('cascade');
                $table->timestamps();
            });
        }

        //CREATE Industry TABLE
        if(!Schema::hasTable('industry')){
             Schema::create('industry',function($table){
                $table->increments('id');
                $table->string('industry')->unique();
                $table->string('slug')->unique();
                $table->timestamps();
            });
        }

        //CREATE FUNCTIONAL AREA TABLE
        if(!Schema::hasTable('functional_area')){
             Schema::create('functional_area',function($table){
                $table->increments('id');
                $table->string('functional_area')->unique();
                $table->string('slug')->unique();
                $table->timestamps();
            });
        }


         //CREATE COMPANY TABLE
        if(!Schema::hasTable('company')){
            Schema::create('company', function($table){
                $table->increments('id');
                $table->string('name')->nullable();
                $table->text('description')->nullable();
                $table->string('city')->nullable();
                $table->integer('state_id')->unsigned()->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('country_id')->unsigned()->references('id')->on('country')->onDelete('cascade')->onUpdate('cascade');
                $table->text('address')->nullable();
                $table->string('website')->nullable();
                $table->integer('contactno')->unsigned();
                $table->timestamps();
            });
        }

        //USER DETAILS TABLE
        if(!Schema::hasTable('user_details')){
            Schema::create('user_details', function($table){
                $table->increments('id');
                $table->integer('user_id')->unsigned()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');			
                $table->integer('state_id')->unsigned()->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('resume_media_id')->unsigned()->references('id')->on('media')->onDelete('cascade')->onUpdate('cascade');
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('profile_headline')->nullable();
                $table->integer('contact_no')->unsigned();
                $table->integer('country_code')->unsigned();
                $table->string('city')->nullable();
                $table->string('profile_image')->nullable();

                $table->text('industry')->nullable();
                $table->text('functional_area')->nullable();
                $table->text('role')->nullable();

                $table->integer('current_location')->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('preferred_location')->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('dob_day')->unsigned();
                $table->integer('dob_month')->unsigned();
                $table->integer('dob_year')->unsigned();
                $table->string('gender')->nullable();
                $table->string('marital_status')->nullable();
                $table->text('permanent_address')->nullable();

                $table->string('sse_institution');
                $table->date('sse_start_date');
                $table->date('sse_end_date');
                $table->string('sse_type')->nullable();
                $table->integer('sse_marks')->unsigned();

                $table->string('hsse_institution');
                $table->date('hsse_start_date');
                $table->date('hsse_end_date');
                $table->string('hsse_type')->nullable();
                $table->integer('hsse_marks')->unsigned();

                $table->string('ug_institution');
                $table->date('ug_start_date');
                $table->date('ug_end_date');
                $table->string('ug_type')->nullable();
                $table->integer('ug_marks')->unsigned();

                $table->string('pg_institution');
                $table->date('pg_start_date');
                $table->date('pg_end_date');
                $table->string('pg_type')->nullable();
                $table->integer('pg_marks')->unsigned();

                $table->string('other_institution');
                $table->date('other_start_date');
                $table->date('other_end_date');
                $table->string('other_type')->nullable();
                $table->integer('other_marks')->unsigned();

                $table->softDeletes();
                $table->timestamps();
            });
        }

        //CREATE EXPERIENCE TABLES
        if(!Schema::hasTable('experience')){
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
                $table->string('currency')->nullable();
                $table->string('industry')->nullable();
                $table->string('functional_area')->nullable();
                $table->string('role')->nullable();
                $table->timestamps();
            });
        }

        //CREATE JOBS TABLE
        if(!Schema::hasTable('jobposting')){
             Schema::create('jobposting',function($table){
                $table->increments('id');
                $table->integer('user_id')->unsigned()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
                $table->string('title');
                $table->text('short_description');
                $table->text('description');
                $table->text('requirements');
                $table->string('role')->nullable();
                $table->integer('open_positions')->default(0);
                $table->string('minimum_education')->nullable();
                $table->string('minimum_experience')->nullable();
                $table->string('job_locations')->nullable();
                $table->integer('salary_range_start')->default(0);
                $table->integer('salary_range_end')->default(0);
                $table->string('preferred_nationality')->nullable();
                $table->string('job_type');
                $table->string('employment_type');
                $table->string('gender_type');
                $table->integer('country_id')->unsigned()->references('id')->on('country')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('state_id')->unsigned()->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
                $table->string('visa')->nullable();
                $table->string('industry')->nullable(); 
                $table->integer('company_id')->unsigned()->references('id')->on('company')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('walkin')->unsigned()->default(0);
                $table->text('apply');
                $table->integer('active_flag');
                $table->timestamps();
            });
        }


        //ENTRUST TABLES FOR ROLE MANAGEMENT
         // Create table for storing roles
        if(!Schema::hasTable('roles')){
            Schema::create('roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('display_name')->nullable();
                $table->string('description')->nullable();
                $table->timestamps();
            });
        }

        // Create table for associating roles to users (Many-to-Many)
        if(!Schema::hasTable('role_user')){
            Schema::create('role_user', function (Blueprint $table) {
                $table->integer('user_id')->unsigned();
                $table->integer('role_id')->unsigned();

                $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('roles')
                    ->onUpdate('cascade')->onDelete('cascade');

                $table->primary(['user_id', 'role_id']);
            });
        }

        // Create table for storing permissions
        if(!Schema::hasTable('permissions')){
            Schema::create('permissions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('display_name')->nullable();
                $table->string('description')->nullable();
                $table->timestamps();
            });
        }

        // Create table for associating permissions to roles (Many-to-Many)
        if(!Schema::hasTable('permission_role')){
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

        //USER TABLE
        if(!Schema::hasTable('banners')){
            Schema::create('banners', function (Blueprint $table) {
                $table->increments('id');
                $table->string('banner');
                $table->integer('active_flag')->unsigned();
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

        // if(Schema::hasTable('users')){
        //     Schema::drop('users');
        // }

        if(Schema::hasTable('password_resets')){
            Schema::drop('password_resets');
        }

        if(Schema::hasTable('media')){
            Schema::drop('media');
        }

        if(Schema::hasTable('country')){
            Schema::drop('country');
        }

        if(Schema::hasTable('state')){
            Schema::drop('state');
        }

        if(Schema::hasTable('visa')){
            Schema::drop('visa');
        }

        if(Schema::hasTable('company')){
            Schema::drop('company');
        }

        if(Schema::hasTable('user_details')){
            Schema::drop('user_details');
        }

        if(Schema::hasTable('experience')){
            Schema::drop('experience');
        }

        if(Schema::hasTable('jobposting')){
            Schema::drop('jobposting');
        }
        
        //ENTRUST TABLES
        if(Schema::hasTable('permission_role')){
            Schema::drop('permission_role');
        }

        if(Schema::hasTable('permissions')){
            Schema::drop('permissions');
        }

        if(Schema::hasTable('role_user')){
            Schema::drop('role_user');
        }

        if(Schema::hasTable('roles')){
            Schema::drop('roles');
        }
    }
}
