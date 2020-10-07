# SocialNetworkA.N.Lab

## Prerequiries
- PHP 6
- Composer
- NodeJs
- MySQL
- JWT
- VueJS
- Socket.io
- Redis

## Installation
- Clone the repository
- Build docker `docker-compose build`
- Run docker `docker-compose up`
- Run server Nodejs `cd NodeJS` `node server.js`
- Launch migrations with `php artisan migrate --seed`.
- Launch `php artisan db:seed --class=UserSeeder`
- Build front with `npm run dev`
- Run: `npm run watch`
- Database: http://127.0.0.1:8080/


## Usage

Log as admin with `admin@test.com:admin` or as user with `user@test.com:secret`

