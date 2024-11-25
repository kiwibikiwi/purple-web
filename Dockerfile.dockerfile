# Use PHP 8.2 with Apache as the base image
FROM php:8.2-apache

# Enable Apache mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Install MySQL client library (optional, if needed for MySQL connections)
RUN apt-get update && apt-get install -y libmysqlclient-dev

# Copy the application code to the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html

# Expose port 80 to allow traffic
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
