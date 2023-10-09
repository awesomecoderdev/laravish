# Laravel in WordPress Theme


## Table of contents

- [Requirement](#requirement)
- [Dev server](#devserver)
- [Development](#development)

## Requirement

It's a laravel 8 application as Wordpress theme using https://github.com/laraish/laraish
it requires 
 PHP8 and Woocommerce as well as the plugins
Plugins: license generator

## Devserver

run
```sh
composer install --ignore-platform-reqs
npm install
```
in the theme directory to get going. 
Import the database 000resources/database_dbdpccdpggym1e.sql and create a suitable .env file.


## Development

For CSS please refer to .\resources\css\tailwindInput.css (tailwind) and
resources\sass\app.scss (remaining SASS), respectively.

Tailwind can be compiled like this
```php
npx tailwindcss -i .\resources\css\tailwindInput.css -o .\public\css\tailwindOutput.css
```

SASS /can/  be compiled like this
```php
sass resources\sass\app.scss public\css\app.css
```
but usually one would build the thing using
```php
npm run prod
```
