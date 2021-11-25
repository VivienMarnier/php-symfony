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
