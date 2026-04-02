# AssurCRM - Documentation Projet (Laravel)

Application web de gestion de clients et de contrats d'assurance, preparee pour une demonstration E6.

## 1. Objectif

AssurCRM permet de:
- gerer des clients,
- creer, modifier et supprimer des contrats,
- associer des garanties a un contrat (relation N,N),
- suivre rapidement les echeances et les indicateurs metier.

## 2. Stack technique

- Back-end: PHP 8.2, Laravel 12
- Front-end: Blade, Tailwind CSS, Alpine.js
- Build assets: Vite
- Base de donnees locale: SQLite (configuration actuelle)
- Authentification: Laravel Breeze

## 3. Installation rapide

### Prerequis

- PHP >= 8.2
- Composer
- Node.js + npm

### Commandes

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
php artisan serve
```

Application disponible sur:
- http://127.0.0.1:8000

## 4. Lancement en developpement

Pour lancer serveur + logs + Vite en une commande:

```bash
composer run dev
```

## 5. Parcours fonctionnel

1. Se connecter (routes Breeze).
2. Creer un client.
3. Creer un contrat rattache au client.
4. Selectionner une ou plusieurs garanties sur le contrat.
5. Verifier le tableau de bord: stats, recherche, echeances.
6. Modifier puis supprimer un contrat.

## 6. Modele de donnees

### Relations

- Client 1,N Contract
- Contract N,N Garantie (table pivot contract_garantie)

### Tables principales

- clients
- contracts
- garanties
- contract_garantie

## 7. Regles metier implementees

- email client unique,
- numero de police unique,
- date de fin > date de debut,
- client obligatoire pour creer un contrat,
- suppression en cascade des contrats lors de la suppression d'un client.

## 8. Structure de code utile pour l'oral

- routes/web.php
- app/Http/Controllers/ContractController.php
- app/Http/Controllers/ClientController.php
- app/Models/Client.php
- app/Models/Contract.php
- app/Models/Garantie.php
- database/migrations/2025_12_25_211335_create_contracts_table.php
- database/migrations/2026_03_30_100000_create_garanties_table.php
- database/migrations/2026_03_30_100100_create_contract_garantie_table.php

## 9. Commandes utiles

```bash
# lancer les tests
php artisan test

# nettoyer les caches
php artisan optimize:clear

# relancer les migrations proprement
php artisan migrate:fresh
```

