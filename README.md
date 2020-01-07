# Laravel/Vue App

> Laravel 6 API with a Vue.js frontend

## Commands to run

``` bash
# Install Dependencies
composer install

# Databse Migrations with seed
php artisan migrate:fresh --seed

# Install JS Dependencies
npm install

```

## Endpoints

### List all articles with links and meta
``` bash
GET api/articles
```
### Get single article
``` bash
GET api/article/{id}
```

### Delete article
``` bash
DELETE api/article/{id}
```

### Add  article
``` bash
POST api/article
title/body
```

### Update article
``` bash
PUT api/article/{id}
title/body
```

