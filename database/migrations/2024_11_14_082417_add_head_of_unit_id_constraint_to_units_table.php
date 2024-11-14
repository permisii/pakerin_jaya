<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('units', function (Blueprint $table) {
            //            $table->foreignId('head_of_unit_id')->nullable()->index()->constrained('users')->onDelete('set null');
            $table->foreignId('head_of_unit_id')->nullable()->index()->after('unit_code')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('units', function (Blueprint $table) {
            $table->dropForeign(['head_of_unit_id']);
            $table->dropColumn('head_of_unit_id');
        });
    }
};
