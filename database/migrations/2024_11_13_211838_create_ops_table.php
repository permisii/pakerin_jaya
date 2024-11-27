<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('ops', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            /**
             * TODO: possible new revision (and applied to op_presets too)
             *  $table->string('department_code')->nullable();
             *  $table->string('department_name')->nullable();
             */
            $table->string('code');
            $table->string('no')->nullable();
            $table->string('date_needed');
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
        Schema::dropIfExists('ops');
    }
};
