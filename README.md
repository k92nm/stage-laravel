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

## 3. Demarrer le projet

Depuis la racine du projet, execute ces commandes dans cet ordre :

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
npm install
```

Puis lance l'application avec :

```bash
composer run dev
```

L'application sera disponible sur :

- http://127.0.0.1:8000

## 4. Installation rapide

### Prerequis

- PHP >= 8.2
- Composer
- Node.js + npm

### Commandes

```bash
npm run build
php artisan serve
```

## 5. Parcours fonctionnel

1. Se connecter (routes Breeze).
2. Creer un client.
3. Creer un contrat rattache au client.
4. Selectionner une ou plusieurs garanties sur le contrat.
5. Verifier le tableau de bord: stats, recherche, echeances.
6. Modifier puis supprimer un contrat.

