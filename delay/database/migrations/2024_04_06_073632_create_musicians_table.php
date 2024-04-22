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
        Schema::create('musicians', function (Blueprint $table) {
            $table->id('ID_musician');
            $table->foreignId('ID_listeners')->constrained('listeners', 'ID_listeners');
            $table->char('Musician_name');
            $table->text('Musician_icon');
            $table->text('Musician_description');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musicians');
    }
};
