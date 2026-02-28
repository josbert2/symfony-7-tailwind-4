FROM php:8.2-apache

# Instalar git
RUN apt-get update && \
    apt-get install -y git


WORKDIR /var/www/html

# Instalar wkhtmltopdf
RUN apt-get update && apt-get install -y wget \
    && wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6.1-3/wkhtmltox_0.12.6.1-3.bookworm_amd64.deb \
    && apt-get install -y ./wkhtmltox_0.12.6.1-3.bookworm_amd64.deb \
    && rm wkhtmltox_0.12.6.1-3.bookworm_amd64.deb \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# --- Imagick + WEBP support (LiipImagineBundle) ---
RUN apt-get update && apt-get install -y \
    libmagickwand-dev \
    libwebp-dev \
    --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && rm -rf /var/lib/apt/lists/*

# Instalar dependencias necesarias para Symfony
RUN apt-get update && \
    apt-get install -y unzip libzip-dev && \
    docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql
# Configurar Apache
RUN a2enmod rewrite
RUN a2enmod headers
RUN a2enmod ssl
# Copiar y configurar tu aplicación Symfony
COPY . /var/www/html
RUN ln -s /etc/apache2/sites-available/ssl.conf /etc/apache2/sites-enabled/
RUN echo "ServerName localhost" | tee -a /etc/apache2/apache2.conf

# Instalar dependencias para la extensión GD
RUN apt-get update && \
    apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd
