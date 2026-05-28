#!/bin/sh

echo "Ожидание готовности базы данных..."
until nc -z -v -w30 db 3306
do
  echo "База данных еще не готова, ждем 2 секунды..."
  sleep 2
done

echo "База данных запущена. Применяем миграции и сидеры..."
php artisan migrate:fresh --seed --force

echo "Запуск сервера Spotly Backend..."
exec php artisan serve --host=0.0.0.0 --port=8000
