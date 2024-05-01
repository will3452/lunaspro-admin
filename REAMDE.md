# Installation

## Prerequisites
- XAMPP
- Composer
- Laravel

## Step 1: Install XAMPP
Download and install XAMPP from [https://www.apachefriends.org/index.html].

## Step 2: Install Composer
Install Composer by following the instructions for your operating system at [https://getcomposer.org/].

## Step 3: Clone the Laravel project
Clone the Laravel project repository from GitHub:
git clone https://github.com/username/projectname.git

## Step 4: Install Laravel dependencies
Navigate to the project directory and run:
composer install

## Step 5: Create a new Laravel environment file
Copy the .env.example file and rename it:
cp .env.example .env

## Step 6: Generate the Laravel application key
Generate a new key:
php artisan key:generate

## Step 7: Configure Virtual Hosts
Modify the httpd-vhosts.conf file in the XAMPP\apache\conf\extra directory:
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/projectname/public"
    ServerName projectname.local
    <Directory "C:/xampp/htdocs/projectname">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

## Step 8: Update the hosts file
Update the hosts file on your system to map the virtual host name to the IP address 127.0.0.1:
127.0.0.1 projectname.local

## Step 9: Start Apache and MySQL in XAMPP
Start Apache and MySQL in XAMPP using the XAMPP control panel.

## Step 10: Access the Laravel application
Open your web browser and go to http://projectname.local.
