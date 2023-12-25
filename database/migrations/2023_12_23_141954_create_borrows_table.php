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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('book_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->dateTime('borrowed_at')->nullable();
            $table->dateTime('due_at')->nullable();
            $table->dateTime('returned_at')->nullable();
            $table->bigInteger('user_returned_id')->unsigned()->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['borrowed', 'returned'])->default('borrowed');
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books')->restrictOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('user_returned_id')->references('id')->on('users')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
