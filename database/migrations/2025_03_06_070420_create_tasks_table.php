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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Task title
            $table->text('description')->nullable(); // Task description
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'Blocked'])->default('Pending'); // Task status
            $table->enum('priority', ['High', 'Medium', 'Low'])->default('Medium'); // Task priority
            $table->dateTime('deadline')->nullable(); // Task deadline
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
