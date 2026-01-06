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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id(); // Identifiant unique

            // On lie le contrat a un client, en creant une colonne pour l'ID du client, verifier que le client existe dans la table, et si on supprime le client, ses contrats s'effacent aussi
            $table->foreignId('client_id')->constrained()->onDelete('cascade');

            // Informations du contrat
            $table->string('company_name'); // Nom de la compagnie d'assurance
            $table->string('policy_number'); // Numero de police
            $table->string('type'); // Type de contrat

            //Dates importantes
            $table->date('start_date'); // Date de debut
            $table->date('end_date'); // Date de fin

            // Montant du contrat
            $table->decimal('premium_amount', 10, 2); // Montant de la prime

            $table->timestamps(); // Crée 'created_at' (date de création) et 'updated_at'
        });
    }
};
