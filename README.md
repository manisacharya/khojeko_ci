# Khojeko Project

This is Client Selling and Buying Website

### Installation:

`git clone` this repository and `cd` inside the project root, then enter the following commands

1. `cp application/config/config_example.php application/config/config.php`

2. `cp application/config/database_example.php application/config/database.php`

4. Import `khojeko.sql` file

3. Configure your `config['base_url']` in config.php
    Now open `database.php` file and make necessary changes to the in that section.
    
    **Yes, of course, you'll have to setup a database and it's user already before the next step!**

6. `php -S localhost:8080` in root directory

Open the browser and go to `http://localhost:8000`

### Please Note

This software uses the [Codeigniter 3](https://codeigniter.com/ "Codeigniter 3") framework.

If you are getting any error, it is most probably due to 
unfulfilled [requirements](https://github.com/bcit-ci/CodeIgniter "Server Requirements") 
of the framework itself.

Also, make sure that you have proper database drivers. For an example, make sure 
you have installed php7.1-mysql package so that you can use mysql database with php7.1 in your project.