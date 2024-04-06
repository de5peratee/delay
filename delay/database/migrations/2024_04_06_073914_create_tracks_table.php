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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id('ID_tracks');
            $table->foreignId('ID_musician')->constrained('musicians', 'ID_musician');
            $table->foreignId('ID_genre')->constrained('genres', 'ID_genre');
            $table->text('Track_name');
            $table->text('Track_icon');
            $table->text('Track_url');
            $table->date('Release_date');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
