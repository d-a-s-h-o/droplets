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
    echo "     -c | --check <container>         This will tell you if your droplet is running or not.";
    echo "     -s | --start <container>         This will start your droplet - and all it's processes.";
    echo "     -d | --stop <container>          This will turn off your droplet.";
    echo "     -r | --restart <container>       This will restart your droplet and all it's processes.";
    echo "     -n | --new <container> <type>    This will create a new droplet with the name and hostname <container>, and type <type>.";
    echo "                            [ apache2 | ubuntu ]";
    echo "     -b | --backup <container>        This will backup your droplet in a snapshot style.";
    echo "     -h | --help                      This displays this help prompt.";
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
    if [ $type == "ubuntu" ]; then
        docker run --restart unless-stopped -d --name $container -h $container onionz/ubuntu:latest sleep infinity;
        docker exec $container ddrun;
    else
        docker create --restart unless-stopped -d --name $container -h $container onionz/apache2:latest;
        docker start $container;
        docker exec $container bash ddrun;
    fi
    echo "Created "$container
}

backup () {
    docker stop $container;
    test=$( sudo docker images -q onionz/backups:$container );
    if [[ -n "$test" ]]; then
        docker rmi onionz/backups:$container;
    fi
    docker commit $container onionz/backups:$container;
    docker push onionz/backups:$container;
    docker rmi onionz/backups:$container;
    docker start $container;
    docker exec -d $container bash ddrun;
    echo "Backed up "$container
}

start_container () {
    docker start $container;
    docker exec -d $container bash ddrun;
    echo "Started "$container
}

stop_container () {
    docker stop $container;
    echo "Stopped "$container
}

restart_container () {
    docker stop $container;
    docker start $container;
    docker exec -d $container bash ddrun;
    echo "Restarted "$container
}

usage () {
    echo "usage: ddd [[[-c | --check] | [-s | --start] | [-d | --stop] | [-r | --restart] | [-n | --new] | [-b | --backup]] <container> (<type>)?]  | [-h | --help]]"
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
                                type=${1:-"null"}
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
        -b | --backup )         shift
                                container="$1"
                                backup
                                ;;
        -h | --help )           help
                                exit
                                ;;
        * )                     usage
                                exit 1
    esac
    shift
done