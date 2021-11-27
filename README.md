# How to install php-symfony

## Pre-requisites

Having docker installed

https://docs.docker.com/get-docker/

Having git installed

https://git-scm.com/book/fr/v2/D%C3%A9marrage-rapide-Installation-de-Git

 
 ## First clone project repository 
 
 Run git clone https://github.com/VivienMarnier/php-symfony.git from your target repository
 
 ## Secondly build and mount docker container and images
 
 From project repository, run docker-compose build
 
 Then docker-compose up -d
 
 ## Thirdly install the project dependencies
 
 Run docker-compose run php8-service composer install
 
 Run docker-compose run node-service npm install
 
 ## Fifth setup database
 
 Run docker-compose run php8-service php bin/console doctrine:migrations:migrate
 
 Run docker-compose run php8-service php bin/console doctrine:fixtures:load
 
 ## Sixth build assets
 
 Run docker-compose run --rm node-service npm run dev
 
 ## Navigate !
 
 You can now access to the site from http://localhost:8080/ 
 
 Admin : http://localhost:8080/admin
 
 ## More : unit and functionnal tests
 
 For unit test run : docker-compose run php8-service ./vendor/bin/phpunit
 
 
 
