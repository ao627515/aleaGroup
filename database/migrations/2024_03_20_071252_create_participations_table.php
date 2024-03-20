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
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->foreignId('event_id')
                    ->constrained('events','id', 'fk_participations_events')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
            $table->foreignId('participant_id')
                    ->constrained('participants','id', 'fk_participations_participants')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participations');
    }
};
