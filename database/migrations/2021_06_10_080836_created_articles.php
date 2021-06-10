<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatedArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {            

            $table->id();
            $table->string('title', 250)->nullable();
            $table->string('image', 250)->nullable();
            $table->string('slug', 250)->nullable();
            $table->text('text')->nullable();
            $table->date('date')->nullable();
            $table->boolean('published')->default('0');

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
        Schema::dropIfExists('articles');
    }
}
