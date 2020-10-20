# Curious Hosting
Curious Hosting is a Docker solution to setting up a PHP web-hosting over tor. It automates the building of tor hidden services effectivly meaning you only have to write three commands to get going. You can allocate your time and energy pn building your hidden service rather than worring about the server.

Getting started is really simple, once your in the folder with the Dockerfile, all you have to do is build, run and setup. Literraly three commands.
1. To build the docker image, simply run `docker build -t <NAME> .` in your command line/terminal where the `<NAME>` is any string without a space or special character. For my example, I ran it as:
```
docker build -t phptor .
```
**You must include the `.` and the space before it at the end.**

2. Once the build is complete (which should take between 1-5 minutes on your first build), you can run it straight away. Do this by running in your terminal `docker run -p <FREE_PORT>:80 <NAME>`. The `<FREE_PORT>` is a port that your localhost on your host os isn't listening to at the moment. It can be any available port. The `<NAME>` is the same as the one from the build step. Example of a run:
```
docker run -p 8081:80 phptor
```

3. That's it. If you're running Docker Desktop, you'll see the running container listed. Just click the CLI option for the container to continue to the setup.
 > If you are running completely from a CLI, run `docker ps` to see running containers. It will look like this:
 > ```
 > $ docker ps
 > CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                  NAMES
 > e948e26d9935        <NAME>              "docker-php-entrypoi…"   2 mins ago          Up 2 mins           0.0.0.0:8081->80/tcp   nervous_gauss
 > ```
 > In this case, to access the cli run `docker exec -it <CNT_NAME> /bin/sh`. Replace `<CNT_NAME>` with the value in the "NAMES" column. You will now be in the containers terminal.
 
 After that, simply run the command `./setup` in the containers terminal. You should (and hopefully will) see this:
 ```
 # ./setup
: not found ./setup:
... # other stuff
: not found: ./setup:
```
All of those `: not found: ./setup:`'s are normal, expected, and even important. They do run a bunch of important commands.

Once that's done, well, conngrats.
### Your server is live!
Simply follow up with the `cat onion.url` command to see your new onion url (duh). Paste it into the Tor Browser and **follow the instructions that follow**.
Have fun.
