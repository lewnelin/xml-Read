# XML PHP Challenge

To run this project you need to have composer and mysql installed and running.
  
Then execute the following commands:
 - composer install
 - doctrine:database:create
 - doctrine:schema:update --force 
 
To start the application:
 - symfony server:start

To run phpunit tests:
 - php bin/phpunit
