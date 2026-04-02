<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('garanties', function (Blueprint $table) {
            $table->id();
            $table->string('label')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('garanties')->insert([
            [
                'label' => 'Responsabilite civile',
                'description' => 'Prise en charge des dommages causes a des tiers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Protection juridique',
                'description' => 'Accompagnement et prise en charge des frais juridiques',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Assistance 0 km',
                'description' => 'Depannage meme au domicile',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Bris de glace',
                'description' => 'Reparation et remplacement des surfaces vitrees',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('garanties');
    }
};
