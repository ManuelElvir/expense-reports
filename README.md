# Expense Report Management

This program is a simple api implementation

## Table of contents

- [Overview](#overview)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Use](#use)
- [Structure du Projet](#structure-du-projet)
- [Contributions](#contributions)
- [Licence](#licence)

## Overview

This api allows you to manage your expenses reports.

## Requirements

Listez ici les prérequis nécessaires pour exécuter votre projet. Par exemple :
- docker et docker compose
ou
- PHP 7.2.0 ou supérieur
- Composer
- Base de données (MySQL)

## Installation


```bash
# Clonez le dépôt
git clone https://github.com/ManuelElvir/expense-reports.git


# (Si vous utilisez docker)
# Démarrez docker avec l'argument build la première fois
docker-composer up --build

# (Si vous utilisez docker)
# Installez les dépendances
composer install

# Configurez l'application (par exemple, définissez les variables d'environnement)
cp .env.example .env
```	

## Configuration 
(Vous pouvez passer cette étape si vous utilisez doker)
```bash
# Crééz la base de donnée
php bin/console doctrine:database:create

# Mettez à jour l'url vers la base de donnée
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4"
```	

## Use

```bash
# (Si vous utilisez docker)
# Démarrez le conteneur docker
docker-compose up

# (Si vous utilisez docker)
# Démarrez le serveur php
php -S localhost:8000 -t public

# Créer un utilisateur
php bin/console app:create-user <username> <password>

# consultez la documentation sur /docs pour savoir comment interagir avec le serveur
```	
[Documentation des notes de frais](docs/expensereports.md)


## Project repository

```bash
/
|-- bin/
|-- config/
|-- docs/
|-- migrations/
|-- public/
|-- src/
|-- tests/
|-- var/
|-- vendor/
|-- .env
|-- .gitignore
|-- composer.json
|-- phpunit.xml.dist
|-- README.md
|-- symfony.lock
```

## License