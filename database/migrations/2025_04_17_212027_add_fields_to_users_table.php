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
    Schema::table('users', function (Blueprint $table) {
        $table->string('fonction')->nullable();
        $table->string('tele')->nullable();
        $table->string('userName')->nullable();
        $table->string('mac')->nullable();
        $table->string('strg1')->nullable();
        $table->string('strg2')->nullable();
        $table->string('strg3')->nullable();
        $table->string('strg4')->nullable();
        for ($i = 1; $i <= 9; $i++) {
            $table->boolean('p'.$i)->nullable();
        }
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'fonction', 'tele', 'userName', 'mac',
            'strg1', 'strg2', 'strg3', 'strg4'
        ]);

        for ($i = 1; $i <= 9; $i++) {
            $table->dropColumn('p'.$i);
        }
    });
}
};
