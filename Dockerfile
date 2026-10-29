FROM richarvey/nginx-php-fpm:3.1.6

# Set working directory
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Image Configuration for Laravel & Nginx
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Production Environment Settings
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMP_ALLOW_SUPERUSER 1

# Ensure deployment script is executable
RUN chmod +x /var/www/html/scripts/00-laravel-deploy.sh

CMD ["/start.sh"]
