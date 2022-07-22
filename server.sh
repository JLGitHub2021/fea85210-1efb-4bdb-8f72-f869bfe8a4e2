#!/bin/bash

db_init() {
    docker exec -i mysql mysql -uroot -p1234 june-test < prepareTable.sql
}

build_images() {
    docker-compose build
}

run_containers() {
    docker-compose up -d
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

if declare -f "$1" >/dev/null;
then
    "$@"
else
    echo "'$1' is not a known function name" >&2
    exit 1
fi