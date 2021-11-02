<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            
            
            $table->string('email');
            $table->string('name');
            
            $table->text('body');
            $table->json('advantages');
            $table->json('disadvantages');
            
            $table->foreignId('article_id')->constrained();

            $table->integer('rate_participant_number');
            $table->integer('rate');
            
            $table->boolean('accepted')->default(false);
            
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
        Schema::dropIfExists('comments');
    }
}
