# Gift Stock
> API pour le père noel et ses lutins

## Table of contents
* [General info](#general-info) 
* [Technologies](#technologies)
* [Tools](#tools)
* [Setup](#setup)
* [Status](#status) 
* [Contact](#contact)

## General info

API pour aider le père noel et ses lutins à gérer les cadeaux.   

## Technologies

* PHP - version 8.0
* Symfony - version 5.3
* Mysql 8.0 
  
## Tools

* Docker 
* Git 
* Makefile

## Setup

Clone repository from source 

```
git clone https://github.com/rabehasy/giftstock.git
```

Setup can be done with:

* Docker and make

#### Create application project

```
cd giftstock
```

### Setup with Docker

Go inside docker folder after clone and build

``` 
make init
``` 

#### Install libraries (composer and npm) and build webpack

```
docker exec -it giftstock /usr/bin/composer install 
```

#### Load fixtures

```
docker exec -it giftstock /home/giftstock/bin/console doctrine:load:fixtures -n 
```

#### Test Login

```
curl -X POST -H "Content-Type: application/json" https://127.0.0.1:8080/api/login_check -d '{"username":"admin@noel.noel","password":"test"}'
```

## Status
Project is: _in progress_ 
 
## Contact
Created by [@miary](https://miary.dev/) - feel free to contact me!
