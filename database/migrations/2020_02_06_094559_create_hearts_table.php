<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeartsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('hearts', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id')->unsigned()->index();
      $table->integer('comment_id')->unsigned()->index();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('hearts');
  }
}
