#!/bin/sh

db_init() {
    docker exec -i mysql mysql -uroot -p1234 june-test < prepareTable.sql
}

build_images() {
    docker-compose build
}

run_containers() {
    docker-compose up
}

stop_containers() {
    docker-compose stop
}

restart_containers() {
    docker-compose restart
}

start() {
    build_images    
    run_containers
    db_init
}

"$@"