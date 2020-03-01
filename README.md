# eCommerce Website

A Symfony project

## Installation

Use this [DockerFile](https://github.com/YoannPaquereau/L3-Framework-2019) to create my workspace.

## Usage

```
composer install
bin/console doctrine:database:create # Optional if your database already exist
bin/console doctrine:make:migration
symfony server:start
```
A SQL file contains database data (just in case)

Admin account already exist in database
```
username: admin
password: admin
```

## Features
* List all products available on homepage
* The client can add product(s) in his basket
* He can order his items
* He can consult his old orders and his personnal informations

* The shopkeeper can see, edit, add, or remove some products
* He can see all orders make on his website
* He can place an order as shipped, and the client is informed by receive an email