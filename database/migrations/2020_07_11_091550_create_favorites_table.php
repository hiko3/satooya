<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::disableForeignKeyConstraints();
      Schema::create('favorites', function (Blueprint $table) {
          $table->id();
          $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

          $table->foreignId('post_id')
                  ->constrained()
                  ->onDelete('cascade');
          
          $table->timestamps();
          
          $table->unique(['user_id', 'post_id']);
      });
      Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('favorites');
        Schema::enableForeignKeyConstraints();
    }
}
