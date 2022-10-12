# Dashed Droplets
Dashed Droplets is a Docker solution to set up a native PHP web-hosting suite that can work over clearnet and tor, with native compatibility for other setups also, like NodeJS and Python3. It automates the building of your server effectively meaning you only have to write three commands to get going. You can allocate your time and energy on building your website rather than worrying about the server side of it all. It has now been expanded to also allow control of practically any docker container you like so... that's nice.


---
**You can pull the Docker image (pre-built), and skip to step 2, with:**
```
docker pull itsokka/web
```
You can also do the same for our simple ubuntu image: `docker pull itsokka/ubuntu`.

---

## Build from Source
First, clone this git repo into your server/compter:
```
mkdir /host && git clone https://github.com/d-a-s-h-o/droplets /host
```
Then alias the app.py file to your path:
```
cp /host/app.py /usr/bin/ddd && chmod +x /usr/bin/ddd
```
Getting started is really simple, once your in the folder with the Dockerfile (the /docker/(web | ubuntu) folder), all you have to do is build and run your image. Literally three commands.
1. To build the docker image, simply run `docker build -t <NAME> .` in your command line/terminal where the `<NAME>` is any string without a space or special character. For my example, I ran it as:
```
cd /host/docker/web && docker build -t web .
```
**You must include the `.` and the space before it at the end.**

2. Once the build is complete (which should take between 3-15 minutes on your first build), you can run it straight away. Do this by running (as root) `ddd -n <CONT_NAME>` in your terminal.

3. That's it. All your information should appear after the setup of your droplet is finished. Congratulations.

### Your server is live!
Simply paste your IP address into your webbrowser (or your private link into the Tor Browser) and **follow the instructions that follow**.
Have fun.
