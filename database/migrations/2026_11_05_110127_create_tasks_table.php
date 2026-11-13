<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // Assignee
            $table->string('title');
            $table->text('description')->nullable();
            
            // Using our Enum values as defaults
            $table->string('status')->default(TaskStatusEnum::BACKLOG->value);
            $table->string('priority')->default(TaskPriorityEnum::MEDIUM->value);
            
            $table->dateTime('due_date')->nullable();
            $table->timestamps();

            // Indexes for lightning-fast queries and filtering
            $table->index(['project_id', 'status']);
            $table->index('priority');
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