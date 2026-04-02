<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_garantie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained('contracts')->onDelete('cascade');
            $table->foreignId('garantie_id')->constrained('garanties')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['contract_id', 'garantie_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_garantie');
    }
};
