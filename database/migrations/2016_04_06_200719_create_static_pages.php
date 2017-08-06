<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        //USER TABLE
        if(!Schema::hasTable('static_pages')){
            Schema::create('static_pages', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('slug');
                $table->text('keywords');
                $table->text('description');
                $table->longText('content');
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
        //
    }
}
