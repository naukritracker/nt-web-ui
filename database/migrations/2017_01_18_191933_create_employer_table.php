<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('employers')){
            Schema::create('employers', function (Blueprint $table) {
                $table->increments('id');
                $table->text('name');
                $table->string('address')->nullabe()->default(null);
                $table->string('email');
                $table->string('phone');
                $table->integer('admin_id')->unsigned()->referenes('id')->on('employer_has_users')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('active_flag')->unsigned();
                $table->softDeletes();
                $table->timestamps();
            });
        }

        if(!Schema::hasTable('employer_memberships')){
            Schema::create('employer_memberships', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('period')->unsigned()->default(0);
                $table->integer('limit')->unsigned()->default(0);
                $table->integer('access_level')->unsigned()->default(1);
                $table->softDeletes();
                $table->timestamps();
            });
        }

        if(!Schema::hasTable('employer_has_memberships')){
            Schema::create('employer_has_memberships', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('employer_id')->unsigned()->referenes('id')->on('employers')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('membership_id')->unsigned()->referenes('id')->on('employer_memberships')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('count')->unsigned()->default(0);
                $table->timestamp('expiry');
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
        Schema::drop('employer_has_memberships');
        Schema::drop('employer_memberships');
        Schema::drop('employer_users');
        Schema::drop('employers');
    }
}
