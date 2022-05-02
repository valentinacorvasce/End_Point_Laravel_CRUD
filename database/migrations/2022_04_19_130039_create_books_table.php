<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author', 800)->nullable();
            $table->string('country', 800)->nullable();
            $table->longText('imageLink')->nullable();
            $table->string('language', 800)->nullable();
            $table->longText('link1', 800)->nullable();
            $table->longText('link2', 800)->nullable();
            $table->bigInteger('pages')->nullable();
            $table->string('title', 800)->nullable();
            $table->string('year', 100)->nullable();
            $table->text('descr')->nullable();
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
        Schema::dropIfExists('books');
    }
};
