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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();

        $table->foreignId('owner_id')
              ->constrained('users')
              ->cascadeOnDelete();

        $table->string('name', 150);
        $table->text('description')->nullable();

        $table->string('status')->default('active');

        $table->date('start_date')->nullable();
        $table->date('due_date')->nullable();

        $table->timestamps();

        $table->index(['owner_id', 'status']);
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
