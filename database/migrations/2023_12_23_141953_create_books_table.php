<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique();
            $table->string('title');
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('genre_id')->unsigned()->nullable();
            $table->integer('total_copies')->default(0);
            $table->integer('available_copies')->default(0);
            $table->text('description')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->integer('pages')->nullable();
            $table->enum('format', ['paperback', 'hardcover'])->default('paperback');
            $table->bigInteger('user_created_id')->unsigned()->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('authors')->restrictOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->restrictOnDelete();
            $table->foreign('genre_id')->references('id')->on('genres')->restrictOnDelete();
            $table->foreign('user_created_id')->references('id')->on('users')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
