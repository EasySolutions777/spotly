# 📍 Spotly — Сервис бронирования временных слотов

Прототип системы бронирования окон доставки/склада с защитой от Race Condition (оверсела) и Cache Stampede.
Стек: PHP 8.3 (Laravel 11) + React (Vite) + MySQL 8 + Redis 7 + Docker Compose.

## 🚀 Быстрый старт после клонирования

### 1. Подготовка конфигурационных файлов
Убедитесь, что в корне проекта и в папке бэкенда созданы файлы окружения:

```bash
# В корне проекта (spotly/)
cp .env.example .env

# В папке бэкенда (spotly/backend/)
cp backend/.env.example backend/.env
```

### 2. Генерация ключа приложения Laravel
Для работы сессий и шифрования Laravel необходим уникальный ключ [link](https://laravel.com). Сгенерируйте его одной командой:
```bash
docker run --rm -v \$(pwd)/backend:/var/www -w /var/www php:8.3-cli php artisan key:generate
```

### 3. Развертывание инфраструктуры
Запустите сборку и старт всех контейнеров [link](https://docker.com):
```bash
docker compose up --build
```
*Автоматически применятся миграции и база заполнится тестовыми слотами (Seeders).*

---

## ⚠️ Возможные проблемы и их решение

### 1. Конфликты портов (Адрес уже используется)
Если у вас локально запущены MySQL или Redis, контейнеры не поднимутся.  
**Решение:** Откройте корневой `.env` и измените внешние порты (например, `MYSQL_EXTERNAL_PORT=3307`, `REDIS_EXTERNAL_PORT=6380`). На внутреннюю работу контейнеров это не повлияет.

### 2. Ошибка запуска `entrypoint.sh` на Windows (`exec format error`)
Если при старте бэкенда возникает ошибка `standard_init_linux.go`, это значит, что Git изменил переводы строк скрипта на `CRLF`.  
**Решение:** Измените формат конца строк файла `backend/docker/entrypoint.sh` обратно на `LF` (в правом нижнем углу вашего VS Code / PhpStorm) или выполните команду:
```bash
dos2unix backend/docker/entrypoint.sh