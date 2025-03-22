# Sử dụng PHP 8.1 với Apache
FROM php:8.1-apache

# Đặt ServerName để tránh cảnh báo
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Cài đặt MySQL extension
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Copy mã nguồn vào container
COPY . .

# Thiết lập quyền cho thư mục làm việc
RUN chown -R www-data:www-data /var/www/html


EXPOSE 80

# Chạy Apache
CMD ["apache2-foreground"]
