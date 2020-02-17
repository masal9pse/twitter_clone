<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('ユーザID');
            $table->unsignedInteger('comment_id')->comment('ツイートID');
            $table->string('text')->comment('本文');
            $table->softDeletes(); //add deleted_at
            $table->timestamps();
      
            // what is index()?
            $table->index('id');
            $table->index('user_id');
            $table->index('comment_id');
      
            $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      
            $table->foreign('comment_id')
              ->references('id')
              ->on('comments')
              ->onDelete('cascade')
              ->onUpdate('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
