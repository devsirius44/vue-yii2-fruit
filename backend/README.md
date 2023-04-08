## Backend (Yii2 framework) for Fruity Test
The minimum requirement by this project template that your Web server supports PHP 7.4.

## INSTALLATION

Clone the repository:

```
git clone https://github.com/webstar0103/YII2_CRUD.git
```

Install the dependencies using Composer:

```
composer install
```

Create a new MySQL database and name it 'fruit_db'.
Update `config/db.php` file.

```
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=fruit_db;port=3306',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

Run the migrations to create the necessary tables:

```
yii migrate/up --interactive=0
```

Seed Database and send email

```
yii fruit
```

Start api server

```
php yii serve --port=3001
```
