<p align="center">Finhack Challenge Quiz</p>

## Introduction 

This source code is a mix of PHP and Vue.js. You are required to run laravel mix in order to compile the SCSS and JS changes in the components written in Vue.js

## Deploying the source in the development environment

- Clone the source code from the GITHub
- The compatible database for this application is MySQL. Create a new database as "etc" and import the etc.sql file from the database folder within the source code.
- Rename the .env-dev file to .env and add your database credentials with the database name you added to your engine.
- Run the console and navigate to the root directory of the applicatoin in your development environment.
- Execute command "composer update". This will download and install the composer dependancies required with your development.
- One the above is done, Execute command "npm install" This will install the dependant node modules to your source code.
- Run command "php artisan config:cache" to clear and cache the new configuration files.
- Run command "php artisan serve" to run the virtual server to run the application.
- Update the APP_URL variable in the .env file for the application path

## User levels

- Student 

App root URL will display a login form for student user type to login. A sample set of student credentials to login, use the username as student@test.com and "password" as the password.


- Admin

{{Site URL}}/admin/login directory will show the user the admin login. Use hello@nilaksha.com as the username and "password" as the password. 
note that you need at least one admin account to login to this application. Administrator will have the privillages to add MCQs, presentations and puzzles while the admin is also able to view the examination sessions taken by the students. Individual student results can be viewed by the admin.

## Deployment

Once the application is ready to deploy in a live server. Please follow the below steps. to do so.

- Create a folder named "etc" in the root folder. 
- Move all the files and folders except the "public" folder into the etc folder. 
- Now move all the files and folders in the public folder into the root of the application.
- Delete the empty "public" folder.
- Open the index.php file in a code editor. Replace "'/../vendor/autoload.php'" with "'/fin/vendor/autoload.php'"
- Replace "'/../bootstrap/app.php'" with "'/fin/bootstrap/app.php'" and save the file.
- Update the APP_URL variable to the domain which you wish to host this application.
- Once the source files are uploaded to the server, open the "shortcut.php" file in the edit view. 
- Update the "{{server-path}}" with the absolute folder path of the server and save the changes.
- Once the appliction is ready. Run this URL once for the server to create a shortcut to the resource folder for the applicatoin to be linked properly "www.yourdomain.com/shortcut.php" If this was executed correct, you will have a working app. 
