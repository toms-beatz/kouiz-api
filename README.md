# Kouiz API

## Description

Cette API permet de gérer des utilisateurs, des quiz et des questions. Les utilisateurs peuvent avoir différents rôles, tels que 'superadmin', 'admin' ou 'utilisateur normal', et en fonction de leur rôle, ils ont accès à un certain nombre de fonctionnalités.

## Installation avec Docker

1. Assurez-vous d'avoir installé Docker et Docker Compose sur votre machine. Vous pouvez les télécharger à partir de [https://www.docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop).

2. Clonez ce dépôt sur votre machine locale : `git clone https://github.com/MDS-NICE-B3-DEVWEB/api_Thomas.git`

3. Naviguez jusqu'au répertoire du projet cloné.

4. Exécutez la commande suivante pour construire et démarrer les conteneurs Docker :

    ```bash
    docker-compose up -d
    ```

5. Une fois les conteneurs Docker en cours d'exécution, exécutez les commandes suivantes pour installer les dépendances et configurer l'application :

    ```bash
    docker-compose exec app composer install
    docker-compose exec app cp .env.example .env
    docker-compose exec app php artisan key:generate
    docker-compose exec app php artisan migrate
    ```
6. Une fois que vous avez configuré votre application, vous devez créer la base de données. Vous pouvez le faire en exécutant la commande suivante :

    ```bash
    docker-compose exec db mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS nom_de_votre_base_de_donnees;"
    ```

    Remplacez "nom_de_votre_base_de_donnees" par le nom que vous souhaitez donner à votre base de données.

7. Ensuite, vous devez modifier le fichier `.env` pour qu'il utilise la base de données que vous venez de créer. Modifiez les valeurs des variables d'environnement suivantes :

    ```env
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=nom_de_votre_base_de_donnees
    DB_USERNAME=root
    DB_PASSWORD=your_mysql_root_password
    ```

    Remplacez "nom_de_votre_base_de_donnees" par le nom de votre base de données et "your_mysql_root_password" par le mot de passe root de votre MySQL.

8. Enfin, exécutez les migrations pour créer les tables dans votre base de données :

    ```bash
    docker-compose exec app php artisan migrate
    ```

    Si vous avez des seeders pour remplir votre base de données avec des données de test, vous pouvez les exécuter avec la commande suivante :

    ```bash
    docker-compose exec app php artisan db:seed
    ```