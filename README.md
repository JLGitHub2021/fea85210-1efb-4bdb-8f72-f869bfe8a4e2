Source Code that I found online:
https://www.section.io/engineering-education/dockerized-php-apache-and-mysql-container-development-environment/
https://github.com/krepysh-spec/lamp-docker-php-skeleton


1. Open a command prompt in this directory.
2. Run "python server.py".
    - This script will build images and run containders.
    - Create a table "june-table" and insert 2 rows sample data.

    website url is http://127.0.0.1:80

    Database connection details:
      username: june
      password: 5678
      port: 9906

    you can use phpmysqladmin to access database using this url: http://127.0.0.1:8080/

    redis connection: http://127.0.0.1:8081/

3. After finishing work, run "python stopContainers.py" to bring down all containers.