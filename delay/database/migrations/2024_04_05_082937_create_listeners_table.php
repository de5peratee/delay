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
        Schema::create('listeners', function (Blueprint $table) {
            $table->id('ID_listeners');
            $table->string('Login');
            $table->string('Password');
            $table->string('Personal_information')->nullable();
            $table->string('Status')->default('listener');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listeners');
    }
};
