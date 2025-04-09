<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

##  Project Setup <a name="project-setup"></a>

1. **Clone the repository**:

    ```bash
    git clone https://github.com/your-username/delivery-app.git
    cd lucky-game-app
    ```
   
2. **Create a `.env` file in the root directory of the project and add the variables**:
    
    ```bash
    cp .env.example .env
    ```

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=laravel
    DB_PASSWORD=laravel
        
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    SESSION_ENCRYPT=false
    SESSION_PATH=/
    SESSION_DOMAIN=null
        
    BROADCAST_CONNECTION=log
    FILESYSTEM_DISK=local
    QUEUE_CONNECTION=redis
    QUEUE_RETRY_AFTER=60
        
    CACHE_STORE=database
       
    REDIS_CLIENT=predis
    REDIS_HOST=redis
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    ```

## ⌨️ Commands <a name="commands"></a>

- **Started the project in daemon**:

    ```bash
    docker-compose up -d --build
    ```

- **Sign In to the container**:
    ```
    docker exec -it laravel-app bash
    ```

- **Run migration**:
    ```
    php artisan migrate

- **Started queue worker**:
    ```
    php artisan queue:work
    ```
