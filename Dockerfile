FROM php:8.2-cli

# تثبيت MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /app
COPY . /app

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000"]
