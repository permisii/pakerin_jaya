<?php

use App\Support\Enums\AssignmentStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_instruction_id')->constrained();
            $table->string('assignment_number');
            $table->text('problem');
            $table->text('resolution');
            $table->text('material');
            $table->text('description');
            $table->tinyInteger('status')->default(AssignmentStatusEnum::Draft);
            $table->tinyInteger('percentage')->default(0);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('assignments');
    }
};
