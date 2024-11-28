<?php

use App\Support\Enums\PPStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('pps', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('remaining')->nullable();
            $table->integer('need')->nullable();
            $table->integer('buy')->nullable();
            $table->string('unit');
            $table->date('need_date');
            $table->text('description');
            $table->enum('status', PPStatusEnum::toArray())->default(PPStatusEnum::Input);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('pps');
    }
};
