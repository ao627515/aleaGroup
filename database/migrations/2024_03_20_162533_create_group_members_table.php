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
        Schema::create('group_members', function (Blueprint $table) {
            $table->foreignId('group_id')
            ->constrained('groups','id', 'fk_groupMembers_events')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
    $table->foreignId('participant_id')
            ->constrained('participants','id', 'fk_groupMembers_participants')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->primary(['group_id', 'participant_id'], 'pk_group_members');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_members');
    }
};
