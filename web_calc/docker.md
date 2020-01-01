# Installer phpunit

`composer require --dev phpunit/phpunit ^8`

# Ecrire des tests unitaires: phpunit
 
Dans un dossier "tests"

# Installer docker

# Test docker
docker run hello-world

# Créer deux dockerfile
- Un pour l'appli PHP:
```
FROM php:7.2-apache #On lance une instance de dokcer à partir une image docker avec PHP et Apache préinstallé
COPY . /var/www/html #On copie le dossier de notre application dans /var/www/html (dossier par défaut pour Apache) sur notre instance 
WORKDIR /var/www/html #On change de dossier dans notre instance
RUN docker-php-ext-install pdo pdo_mysql #On installe quelques extensions PHP (PDO par exemple)
RUN composer install --dev #On lance un composer install 
```
- L'autre pour la BDD:
```
FROM mysql:latest
COPY ./sql-scripts/ /docker-entrypoint-initdb.d/ #Au démarrage de notre instance tous les fichiers .sql se trouvant dans le dossier /docker-entrypoint-initdb.d/ seront lancés
```

# Build les images

# Tester les images

# Créer un Docker Compose:

Nos 2 services ne peuvent pas encore communiquer entre eux.
Le conteneur de notre appli est isolé du conteur pour la BDD.

Docker Compose permet de créer un réseau entre plusieurs instances de conteneur docker

```
version: 3

services: 
    db:
        build: database
        command: --default-authentication-plugin=mysql_native_password
        environment:
            - MYSQL_ROOT_PASSWORD=${DB_PASSWD}
            - MYSQL_DATABASE=${DB_NAME}
        expose:
            - 3306
        volumes:
            - db_volume:/var/lib/mysql
    app:
        build: web_calc
        environment:
            - DB_HOST=db
            - DB_NAME=${DB_NAME}
            - DB_USER=root
            - DB_PASSWD=${DB_PASSWD}
        depends_on:
            - "db"
        ports:
            - 80:8080
    app_test:
        build: web_calc
        environment:
            - DB_HOST=db
            - DB_NAME=${DB_NAME}
            - DB_USER=root
            - DB_PASSWD=${DB_PASSWD}
        depends_on:
            - "db"
        ports:
            - 80:8080
        command: ./vendor/bin/phpunit --bootsrap vendor/autoload tests --testdox

volumes:
    db_volume
```

## Bonne pratique: utiliser des variables d'environement:
- Au lieu de modifier le code on modifie l'environement dans lequel tourne le code
    
### Exemple:
- sur le PC de Toto (dev de l'application):
    - Son serveur MYSQL peut avoir comme identifiants:
        toto et mdpT0T0
    - Et comme hôte: localhost

- sur le PC de Tata (aussi dev de l'application):
    - Son serveur MYSQL peut avoir comme identifiants: tata et T4T4NumberWan
    - Et comme hôte: localhost

- sur le Serveur qui fait tourner l'application en production:
    - Le client souhaite surement avoir un mot de passe plus complexe: app-admin et !kdD54p$22*6LlXq=_
    - Et comme hôte: mysql-instance1.123456789012.us-east-1.rds.amazonaws.com

Pour éviter de changer à chaque fois le code en fonction de la machine qui fait tourner l'application (augmentant le risque d'erreurs), on utilisera dans le code des variables d'environement:

- Ansi Toto définira sur sa machine les variables d'environement suivante:
    `DB_USER=toto
    DB_PASSWD=mdpT0T0`

- Tata définira sur sa machine:
    `DB_USER=tata
    DB_PASSWD=T4T4NumberWan`

- L'administrateur système du client définira sur le serveur:
    `DB_USER=app-admin
    DB_PASSWD=!kdD54p$22*6LlXq=_`

On pourra alors récupérer la valeur de ces variables d'environement dans le code:
- `getenv()` pour PHP
- `os.environ.get()` pour Python
- etc...


 