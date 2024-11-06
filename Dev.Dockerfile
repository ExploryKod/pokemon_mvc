# syntax = docker/dockerfile:1.2
FROM php:8.1.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql \
    && a2enmod rewrite \
    && a2enmod ssl

RUN apt-get update && \
apt-get install -y \
libzip-dev \
curl \
unzip \
libonig-dev \
libxml2-dev \
libpng-dev \
libjpeg-dev && \
docker-php-ext-configure gd --with-jpeg && \
docker-php-ext-install \
pdo_mysql \
zip \
mbstring \
exif \
pcntl \
bcmath \
gd

# Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html/

ADD /conf/pokemon-mvc.conf /etc/apache2/sites-available/
RUN ln -s /etc/apache2/sites-available/pokemon-mvc.conf /etc/apache2/sites-enabled/

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"


RUN composer install

# Node.js 18
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Enable Corepack and install pnpm
RUN corepack enable && corepack prepare pnpm@latest --activate

# Install dependencies and build with pnpm
RUN pnpm install --frozen-lockfile

#Run the Webpack build (modify the command according to your needs)
RUN pnpm run build

RUN npx tailwindcss -i ./assets/style.css -o ./assets/output.css --watch

RUN composer dump-autoload

# Make port 80 available to the world outside this container
EXPOSE 80

# Define environment variable
ENV URL "http://localhost:8000"
ENV BASE_SITE_URL "http://localhost:8000"
ENV HOST_URL="localhost"

ENV DB_HOST="db"
ENV DB_USER="root"
ENV DB_PORT="3307"
ENV DB_PASSWORD="root"
ENV DB_NAME="db"
ENV DB_DRIVER="mysql"
ENV VITE_HOST_URL="https://local.pokemon.com"

# Run apache when the container launches
CMD ["apache2-foreground"]
