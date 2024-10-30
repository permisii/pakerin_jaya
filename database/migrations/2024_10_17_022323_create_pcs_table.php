<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('pcs', function (Blueprint $table) {
            $table->id();
//            $table->string('name');
            $table->string('user_name');
//            $table->foreignId('user_id')->constrained();
            $table->date('date_of_initial_use');
            $table->string('index');
            $table->string('section');
            $table->string('monitor');
            $table->string('vga');
            $table->string('processor');
            $table->string('ram');
            $table->string('hdd');
            $table->string('keyboard');
            $table->string('mouse');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('pcs');
    }
};
