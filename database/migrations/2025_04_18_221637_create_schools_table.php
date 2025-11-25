<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique(); // Example: "FLLA", "FS" etc.
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('school_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['school_id']);
        $table->dropColumn('school_id');
    });

    Schema::dropIfExists('schools');
}
};
