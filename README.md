# blog-app
Blog application in vanila PHP

# Installation

####  1. First, clone this repository:

```bash
$ git clone https://github.com/RazaChohan/blog-app.git
```

#### 2. Create a database and update env.php & phinx.xml file with database configuration:

```bash
'DB' => [
        'NAME' => 'blog',
        'USER_NAME' => 'root',
        'PASSWORD' => 'root',
        'HOST' => 'localhost'
    ]

 development:
        adapter: mysql
        host: localhost
        name: blog
        user: root
        pass: 'root'
        port: 3306
        charset: utf8
```

#### 3. Install composer packages:

```bash
$ composer install 
```
#### 5. Create Database schema:

```bash
$ php vendor/bin/phinx migrate
```

#### 6. Load data in Database:

```bash
$ php vendor/bin/phinx seed:run
```



#### 6. Run PHP server:

```bash
$ php -S localhost:9000
```
