<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() :void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // Identifiant unique

            //Informations du client
            $table->string('firstname'); // Prenom 
            $table->string('lastname'); // Nom
            $table->string('email')->unique(); // Email unique
            $table->string('phone')->nullable(); // Telephone, peut etre nul
            

            // Adresse du client
            $table->string('adress')->nullable(); // Adresse, peut etre nulle
            $table->string('city')->nullable(); // Ville, peut etre nulle
            $table->string('zip_code')->nullable(); // Code postal, peut etre nul

            $table->timestamps(); // Crée auto 'created_at' et 'updated_at'
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};