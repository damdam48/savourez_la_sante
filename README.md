# Savourez La Santé - Projet Symfony

Ce projet est une application Symfony. Suivez les étapes ci-dessous pour configurer et lancer l'application.

## Prérequis

- PHP (version 7.4 ou supérieure)
- Composer
- Node.js (version 14 ou supérieure)
- Yarn


## Installation

1. Clonez le dépôt du projet :
   ```bash
   git clone https://github.com/votre-utilisateur/savourez_la_sante.git
   cd savourez_la_sante
   ```

### Prés-installation

1. Créée un fichier .env.local
    ```bash
    DATABASE_URL="mysql://UTILISATEUR:UTILISATEUR@IP:PORT/savourez_la_sante?serverVersion=8.0.36&charset=utf8mb4"
    ```

2. Installez les dépendances PHP :
   ```bash
   composer install
   ```
3. Installez les dépendances JavaScript :
   ```bash
   yarn install
   ```
4. Configurez les variables d'environnement :
   ```bash
   composer dump-env dev
   ```

Développement

1. Lancez le serveur de développement Symfony :

   ```bash
   symfony server:start
   ```

2. Lancez le processus de surveillance des fichiers JavaScript et CSS :
   ```bash
   yarn watch
   ```
