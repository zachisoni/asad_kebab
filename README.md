# Asad Kebab

## Overview
---
A Restaurant themed Point of Sales web application to manage menus, make transactions, and view the insight about our restaurant. Made with Code Igniter

## Instalation
---
To install and run this web app in your computer, make sure you have installed these programs:
1. PHP 8.3.7 or latest
2. Composer
3. MySQL database (you can install Laragon, or stand alone install)
4. git

After you have installed programs above, you can follow these steps to intall this web app:
1. Start your MySQL server

2. Create database `asad_kebab` in your MySQL 

3. Open your terminal / cmd, and change to directory where you want this app is installed using `cd` and followed by directory name

4. Clone this repository. In your ter
        git clone https://github.com/zachisoni/asad_kebab.git

5. Install packages in this projects
        composer install

6. Make environment variable
        cp env .env

7. Open .env, and uncomment line 17 (CI_ENVIRONMENT), 23 - 27 (app information), and 33 - 39 (database information). 

8. Replace value in `database.default.password` with your MySQL root password. If you not specified the password, empty this field

9. Replace `database.default.port` value with your MySQL port number. By default, the port is 3306

10. Migrate the database. In your terminal, open the project directory, and type
        php spark migrate --all
    
11. Seed the database. In terminal:
        php spark db:seed TypeSeeder

    and
        php spark db:seed UserSeeder

12. Start server
        php spark serve