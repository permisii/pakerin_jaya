<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('op_presets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('department');
            $table->string('code');
            $table->string('no');
            $table->date('date');
            $table->string('first_requestor');
            $table->string('second_requestor');
            $table->string('approved_by');
            $table->foreignId('head_of_section_id')->constrained('users');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('op_presets');
    }
};
