<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobHasApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('jobposting_has_application')){
            Schema::create('jobposting_has_application', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('jobposting_id')->unsigned()->references('id')->on('jobposting')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('user_id')->unsigned()->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('count')->unsigned();
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
