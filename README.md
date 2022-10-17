
## Requirements

* Composer >=2.4.1

* PHP >= 8.0.2

* MySQL >=8.0 

* npm >= 8.18.0

## Installation
* Run `git@github.com:suburban-fiber-company/legend-academy-admin.git`

* `cd legend-academy-admin`

* Run `composer install` <br>
If you get a lock file error, delete the **composer.lock file** in the root directory, then try install again. `composer install` <br>

* From the projects root run `cp .env.example .env` (Copy .env.example content into a new file .env)

* Run `php artisan key:generate`

* Configure database credentials in `.env` file

* Run `php artisan migrate`

* Run `php artisan db:seed`

* Run `npm install && npm run dev`

* Start the Laravel server `php artisan serve`