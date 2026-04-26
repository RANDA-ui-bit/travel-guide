FROM php:8.2-cli

# تثبيت مكتبات PostgreSQL قبل التثبيت
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql

WORKDIR /app
COPY . .

CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
