# Backend-NEXT
This is the code for the NEXT iteration of the backend running ATLauncher.

## What is it?
This is the code used to run the backend code for ATLauncher which simply contains just an API which is used by the frontend code.

It's written in PHP using Laravel 5.3.

## Development
To begin development simply install Virtualbox and Vagrant on your machine and change into this directory and run:

```
vagrant up
```

This will setup a virtual machine which contains this code and runs a nginx and PHP 7 FPM server with this code.

Next simply copy the `.env.example` file to `.env`. These files may not show on your machine depending on if you have hidden files shown or not. If you cannot find the files then run the following:

```
vagrant ssh -- cd /var/www && cp .env.example .env
```

Lastly we need to install the composer dependencies, and other important setup, which can be done by running the following:

```
vagrant ssh -- cd /var/www && composer install
vagrant ssh -- touch /var/www/storage/database/atl_backend.sqlite
vagrant ssh -- cd /var/www && php artisan migrate
vagrant ssh -- cd /var/www && php artisan passport:install
vagrant ssh -- cd /var/www && php artisan db:seed
```

When running the last command a client id and secret will be printed out to console which you can use to input into the Swagger page to test out authenticated routes with.

You can then access the site from your browser using `https://localhost:8000` (port configurable in the `Vagrantfile` file).

### SSHing into the machine
To SSH into the machine simply change into this directory and run:

```
vagrant ssh
```

The code is stored in the `/var/www/` directory (which is automatically changed into upon login). All `artisan` commands should be run from this directory.

## License
This code is licensed under the MIT license and can be found in the `LICENSE` file in the root directory of this repository.