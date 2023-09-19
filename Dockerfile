# Utilisez une image PHP avec Apache
FROM php:7.4-apache

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copiez les fichiers de votre projet
COPY . .

# Installez les dépendances nécessaires
RUN apt-get update \
    && apt-get install -y \
        git \
        unzip \
        libpq-dev \
        libzip-dev \
        libicu-dev \
        libsodium-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl opcache

# Installation de l'extension ext-sodium pour utiliser jwt
RUN pecl install libsodium

# Activation de l'extension ext-sodium
RUN docker-php-ext-enable sodium

# Installez les dépendances PHP avec Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir les autorisations pour le répertoire des caches
RUN chown -R www-data:www-data var

# Activez le module Apache mod_rewrite 
RUN a2enmod rewrite

# Exposez le port 80 pour Apache
EXPOSE 80

# Lancez Apache en premier plan
CMD ["apache2-foreground"]

# Configuration personnalisée pour Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf