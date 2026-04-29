# User Service

Repository ini berisi service yang menangani data user (mahasiswa & dosen)

## Tech Stack

**Framework:** Laravel 13

**Database:** Mysql

<!-- ## Endpoint & Features -->

<!-- Dokumentasi API: <https://documenter.getpostman.com/view/25808118/2sBXqDt3pK> -->

<!-- - Authentication (JWT)
- Get all data
- Get single data
- Create data
- Edit data
- Delete data -->

## Run Locally

Clone the project

```bash
  git clone https://github.com/itsrezuu/Integrasi-service-sistem-konsultasi-dosen.git
```

Go to the project directory

```bash
  cd Integrasi-service-sistem-konsultasi-dosen
  cd user-service
```

Install dependencies

```bash
  composer install

  npm install
```

Environment

```bash
  cp .env.example .env  
```

Database & App setup

```bash
  php artisan migrate
  or with seeder
  php artisan migrate:fresh --seed

  php artisan key:generate
```

Start the server

```bash
  php artisan serve --port=8001 
```

<!-- ## Authors

- [Surya Nata Ardhana](https://www.github.com/syrsdev) -->
