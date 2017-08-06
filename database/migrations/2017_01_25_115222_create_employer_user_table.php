<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('employer_has_users')){
            Schema::create('employer_has_users', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('employer_id')->unsigned()->referenes('id')->on('employers')->onDelete('cascade')->onUpdate('cascade');
                $table->string('name');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email')->unique();
                $table->string('password', 60);
                $table->string('reset_token')->nullable();
                $table->integer('active_flag')->unsigned();
                $table->integer('is_user')->unsigned()->default(0);
                $table->integer('user_id')->default(0)->unsigned()->referenes('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
                $table->timestamp('last_logged_in_date_time');
                $table->softDeletes();
                $table->rememberToken();
                $table->timestamps();
            });
        }
        if(!Schema::hasTable('employer_user_has_details')){
            Schema::create('employer_user_has_details', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('employer_user_id')->unsigned()->references('id')->on('employer_has_users')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('state_id')->unsigned()->references('id')->on('state')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('resume_media_id')->unsigned()->references('id')->on('media')->onDelete('cascade')->onUpdate('cascade');
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('profile_headline');
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
