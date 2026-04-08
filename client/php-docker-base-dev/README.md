# PHP Docker Base Dev

## Description

Environnement de développement PHP prêt à l'emploi basé sur Docker. Cette configuration permet de démarrer rapidement un projet PHP avec une base de données MySQL, PHPMyAdmin, Nginx et PHP-FPM.

## Fonctionnalités

- PHP 8.4 avec FPM
- MySQL (dernière version LTS)
- PHPMyAdmin pour la gestion de la base de données
- Nginx comme serveur web
- Extensions PHP installées :
  - PDO MySQL
  - Intl (internationalisation)

## Prérequis

- Docker
- Docker Compose

## Installation

1. Clonez ce dépôt :
   ```bash
   git clone git@github.com:Webanimus/php-docker-base-dev.git
   cd php-docker-base-dev
   ```

2. Créez un dossier `www` pour vos fichiers PHP :
   ```bash
   mkdir -p www
   ```

3. Démarrez les conteneurs :
   ```bash
   docker compose up -d
   ```

## Mise à jour

```bash
docker compose pull
docker compose build
docker compose up -d
```

## Structure du projet

```
php-docker-base-dev/
├── docker-compose.yml    # Configuration Docker Compose
├── php.dockerfile       # Configuration de l'image PHP
├── mysql/               # Données persistantes MySQL (créé automatiquement)
├── nginx/
│   └── conf.d/          # Configuration Nginx
│       └── default.conf  # Configuration par défaut du serveur
└── www/                # Répertoire pour vos fichiers PHP
```

## Accès aux services

- **Site web** : http://localhost
- **PHPMyAdmin** : http://localhost:8080
  - Serveur : mysql-lamanu
  - Utilisateur : root
  - Mot de passe : root
  - Base de données : lamanu

## Configuration de la base de données

- **Serveur** : mysql-lamanu
- **Port** : 3306
- **Base de données** : lamanu
- **Utilisateur** : lamanu
- **Mot de passe** : lamanu

## Personnalisation

### Ajouter des extensions PHP

Modifiez le fichier `php.dockerfile` pour ajouter des extensions PHP supplémentaires :

```dockerfile
# Install additional extensions
RUN docker-php-ext-install mysqli
```

Puis reconstruisez l'image :

```bash
docker compose build
docker compose up -d
```

### Modifier la configuration Nginx

Modifiez le fichier `nginx/conf.d/default.conf` selon vos besoins, puis redémarrez le conteneur Nginx :

```bash
docker compose restart nginx
```

## Commandes utiles

- Démarrer les conteneurs : `docker compose up -d`
- Arrêter les conteneurs : `docker compose down`
- Voir les logs : `docker compose logs`
- Accéder au shell PHP : `docker compose exec php-fpm bash`
- Exécuter une commande PHP : `docker compose exec php-fpm php -v`

## Contribution

Les contributions sont les bienvenues ! N'hésitez pas à ouvrir une issue ou une pull request.

## Licence

MIT
