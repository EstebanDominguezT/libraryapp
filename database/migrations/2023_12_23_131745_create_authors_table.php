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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->dateTime('born_date')->nullable();
            $table->string('email')->nullable();
            $table->text('biography')->nullable();
            $table->text('awards')->nullable();
            $table->text('published_books')->nullable();
            $table->bigInteger('user_created_id')->unsigned()->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('user_created_id')->references('id')->on('users')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
