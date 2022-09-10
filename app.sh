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
    echo "                            [ web | ubuntu ]";
    echo "     -i | --ips                       This will list all containers and their corresponding ip addressess (local network only).";
    echo "    -ip | --ip <container>            This will return the ip address of a specific droplet."
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
    if [ $type == "web" ]; then
        docker run -d --restart unless-stopped --name $container -h $container itsokka/web:latest sleep infinity;
        docker exec $container bash ddrun;
    else
        docker run -d --restart unless-stopped --name $container -h $container itsokka/ubuntu:latest sleep infinity;
        docker exec $container bash ddrun;
    echo "Created "$container
}

backup () {
    docker stop $container;
    test=$( sudo docker images -q itsokka/backups:$container );
    if [[ -n "$test" ]]; then
        docker rmi itsokka/backups:$container;
    fi
    docker commit $container itsokka/backups:$container;
    docker push itsokka/backups:$container;
    docker rmi itsokka/backups:$container;
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

list_ips () {
    docker ps | awk 'NR>1{ print $1 }' | xargs docker inspect -f '{{range .NetworkSettings.Networks}}{{$.Name}}{{" "}}{{.IPAddress}}{{end}}';
}

list_ip () {
    docker inspect -f '{{ .NetworkSettings.IPAddress }}' $container;
}

usage () {
    echo "usage: ddd [[[-c | --check] | [-s | --start] | [-d | --stop] | [-r | --restart] | [-n | --new] | [-b | --backup] | [-ip | --ip]] <container> (<type>)?]  | [-i | --ips] | [-h | --help]]"
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
        -i | --ips  )           shift
                                list_ips
                                ;;
        -ip | --ip  )           shift
                                container="$1"
                                list_ip
                                ;;
        -h | --help )           help
                                exit
                                ;;
        * )                     usage
                                exit 1
    esac
    shift
done