# Crud App

- Este projeto feito com o framework Symfony.


***

## Instalação

Clone Repositório

```sh
git clone https://github.com/rccheruti/crud_app.git
```

Mude o .env com as configurações do seu mysql local


Com o .env configurado, na pasta do projeto, entre no terminal e digite:
```sh
php bin/console doctrine:database:create
```
Logo após:

```sh
php bin/console make:migration
```

```sh
php bin/console doctrine:migrations:migrate
```
Pronto, agora só rodar o servidor do Symfony:
```sh
php bin/console serve
```
***
###### Roger Cheruti
###### Whatsapp (48) 99171-9504
