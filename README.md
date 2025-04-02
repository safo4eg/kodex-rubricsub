# Инструкция по разворачиванию проекта

Для начала клонируем сам проект в любое место, в примере создается папка kodex

```
    git clone https://github.com/safo4eg/kodex-rubricsub.git kodex
```

***Все дальнейшие команды должны выполняться из корня с файлом docker-compose.yml***

## Первый запуск

Поднимаем контейнеры

```
    docker compose up -d --build
```

## Подключение к контейнеру приложения

Для того чтобы выполнить необходимые команды для работы приложения laravel, нужно подключиться
к контейнеру kodex_app через bash-оболочку

```
    docker exec -it kodex_app bash
```

## Подгружаем зависимости

С помощью композера загружаем зависимости

```
    composer install
```


## Настройка Laravel приложения

Все эти команды выполняются последовательно внутри контейнера kodex_app

```
    cp .env.example .env
```

```
    php artisan key:generate
```


```
    php artisan passport:keys
```

```
    php artisan migrate --seed
```

После чего у нас будет тестовый клиент (доверенное приложение) с такими данными:


```
    "client_id": 1
```


```
    "client_secrect": "OoNa3SDhUIl2BUG5BPwbhs8xxW55VX5Bj6OKuV7U"
```

Их можно использовать для получения токена по маршруту /api/register после регистрации, либо /oauth/token.

## Необходимые ресурсы

1. [Документация Postman](https://documenter.getpostman.com/view/35026712/2sB2cSfhkx)