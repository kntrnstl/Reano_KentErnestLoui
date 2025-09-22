FROM php:8.2-apache

# Install PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Copy app files
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# 🔑 Use Render's dynamic port instead of 80
EXPOSE 10000

# Tell Apache to listen on Render's $PORT
CMD ["bash", "-c", "sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf && apache2-foreground"]
