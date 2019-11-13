## Routerapp
RouterApp demo showcasing RESTful routing

[![Build Status](https://travis-ci.org/adamculp/api-consumer.svg?branch=master)](https://travis-ci.org/dolcy/routerapp)

## Install and Startup
First, create .env with database credentials (i.e. .env.default)

Second, install **routerapp.sql** located in the Data folder via your db client  

Then finally...

``` bash
$ composer install && composer start
```

## Testing
Use Insomnia or Postman to test API; phpunit testing/code quality integration (in progress)

``` bash
$ phpunit
```
