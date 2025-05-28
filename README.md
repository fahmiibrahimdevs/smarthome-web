## Prerequisites

1. PHP >= 8.1 or new
2. Composer
3. Node.js last version
4. NPM last version
5. MySQL or MariaDB last version

## Installation

1. Clone this repository to your local machine:

```
git clone https://github.com/fhmiibrhimdev/smarthome-web
```

2. Install the dependencies for the Laravel project:

```
composer install
```

3. Create a .env file for your Laravel project and configure your database settings:

```
cp .env.example .env
```

4. Generate a new APP_KEY for your Laravel project:

```
php artisan key:generate
```

5. Run database migrations:

```
php artisan migrate:fresh --seed
```

7. Install the dependencies:

```
npm install
```

8. Start the development server:

```
npm run dev
```

9. Make 1 terminal again, start the development server for the Laravel project:

```
php artisan serve
```

10. Visit [Localhost](http://127.0.0.1:8000/) in your web browser to access the web application.
