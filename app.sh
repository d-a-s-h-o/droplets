#!/bin/bash

# Dashed Droplet Manager
container=
help () {
    echo;
    echo;
    echo "    __                        __                           ";
    echo "    ) ) _   _ ( _   _   _ )   ) ) _ _   _   )  _  _)_ _    ";
    echo "   /_/ (_( (   ) ) )_) (_(   /_/ ) (_) )_) (  )_) (_ (     ";
    echo "           _)     (_                  (      (_      _)    ";
    echo;
    echo;
    echo "This is the CLI tool to manage your Droplets, but works for all docker containers.";
    echo;
    echo "To get started, try any of the following parameters:";
    echo "     -c | --check <container>         This will tell you if your droplet is running or not."
    echo "     -s | --start <container>         This will start your droplet - and all it's processes."
    echo "     -d | --stop <container>          This will turn off your droplet."
    echo "     -r | --restart <container>       This will restart your droplet and all it's processes."
    echo "     -n | --new <container>           This will create a new droplet with the name and hostname <container>"
    echo "     -h | --help                      This displays this help prompt."
    echo;
    echo;
    echo;
    echo;
    echo;
    echo;
    echo;
}

check () {
    if [ "$( docker container inspect -f '{{.State.Status}}' $container )" == "running" ]; then
        echo "True"
    else
        echo "False"
    fi
}
create () {
    if [ $type == "apache2" ]; then
        docker create --restart unless-stopped --name $container -h $container apache2
    else
        docker create --restart unless-stopped --name $container -h $container ubuntu
    fi
    docker start $container;
    docker exec $container bash ./run.sh;
    echo "Created "$container
}

start_container () {
    docker start $container;
    docker exec $container bash ./run.sh;
    echo "Started "$container
}

stop_container () {
    docker stop $container;
    echo "Stopped "$container
}

restart_container () {
    docker stop $container;
    docker start $container;
    docker exec $container bash ./run.sh;
    echo "Restarted "$container
}

usage () {
    echo "usage: ./app.sh [[[-c | --check] | [-s | --start] | [-d | --stop] | [-r | --restart]] <container>]  | [-h | --help]]"
}

while [ "$1" != "" ]; do
    case $1 in
        -c | --check )          shift
                                container="$1"
                                check
                                ;;
        -n | --new )            shift
                                container="$1"
                                shift
                                type="$1"
                                create
                                ;;
        -s | --start )          shift
                                container="$1"
                                start_container
                                ;;
        -d | --stop )           shift
                                container="$1"
                                stop_container
                                ;;
        -r | --restart )        shift
                                container="$1"
                                restart_container
                                ;;
        -h | --help )           help
                                exit
                                ;;
        * )                     usage
                                exit 1
    esac
    shift
done
