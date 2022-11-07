#!/usr/bin/env python
import os
import sys
import pyotp
import pyqrcode

def help():
    print()
    print()
    print("    __                        __                           ")
    print("    ) ) _   _ ( _   _   _ )   ) ) _ _   _   )  _  _)_ _    ")
    print("   /_/ (_( (   ) ) )_) (_(   /_/ ) (_) )_) (  )_) (_ (     ")
    print("           _)     (_                  (      (_      _)    ")
    print()
    print()
    print("This is the CLI tool to manage your Droplets, but works for all docker containers.")
    print()
    print("To get started, try any of the following parameters:")
    print()
    print("     -c | --check <container>         This will tell you if your droplet is running or not.")
    print("     -s | --start <container>         This will start your droplet - and all it's processes.")
    print("     -d | --stop <container>          This will turn off your droplet.")
    print("     -r | --restart <container>       This will restart your droplet and all it's processes.")
    print("     -l | --list                      This will list all your droplets.")
    print("     -n | --new <container> <type>    This will create a new droplet with the name and hostname <container>, and type <type>.")
    print("                            [ web | ubuntu ]")
    print("     -i | --ips                       This will list all containers and their corresponding ip addressess (local network only).")
    print("    -ip | --ip <container>            This will return the ip address of a specific droplet.")
    print("     -b | --backup <container>        This will backup your droplet in a snapshot style.")
    print("     -h | --help                      This will display this help message.")
    print()
    print("For more information, please visit https://droplets.dasho.dev")
    print()
    print()
    print()
    print()
    print()
    print()
    print()

def check(droplet):
    if os.system("docker container inspect -f '{{.State.Running}}' " + droplet) == "running":
        return True
    else:
        return False

def start(droplet):
    os.system("docker start " + droplet)
    os.system("docker exec -d " + droplet + " /bin/bash ddrun")
    if check(droplet) == True:
        print("Droplet started.")
    else:
        print("Droplet failed to start.")

def stop(droplet):
    os.system("docker stop " + droplet)
    if check(droplet) == False:
        print("Droplet stopped.")
    else:
        print("Droplet failed to stop.")

def restart(droplet):
    stop(droplet)
    start(droplet)
    if check(droplet) == True:
        print("Droplet restarted.")
    else:
        print("Droplet failed to restart.")

def new(droplet, type="web"):
    if type == "web":
        os.system("docker run -d -p 80:80 --name " + droplet + " -h " + droplet + " dasho/droplet-web")
    elif type == "ubuntu":
        os.system("docker run -d --name " + droplet + " -h " + droplet + " dasho/droplet-ubuntu")
    if check(droplet) == True:
        secret = generate_secret()
        qr = generate_qr(secret, droplet)
        with open(f"{droplet}.txt", "a") as f:
            f.write(f"{droplet} => {secret}")
        qr.svg(f"{droplet}.svg", scale=6)
        print("Droplet created.")
    else:
        print("Droplet failed to create.")

def listIps():
    os.system("docker ps | awk 'NR>1{ print $1 }' | xargs docker inspect -f '{{range .NetworkSettings.Networks}}{{$.Name}}{{\" \"}}{{.IPAddress}}{{end}}'")

def listIp(droplet):
    os.system("docker inspect --format '{{ .NetworkSettings.IPAddress }}' " + sys.argv[2])

def ps():
    os.system("docker ps")

def ls():
    os.system("docker ps -a")

def lsi():
    os.system("docker images")

def size():
    os.system("docker system df")

def sizev():
    os.system("docker system df -v")

def backup(droplet):
    if(os.system(f"sudo docker images -q {droplet}") != 0):
        print("Droplet does not exist.")
    else:
        os.system(f"sudo docker commit {droplet} itsokka/backups:{droplet}")
        os.system(f"sudo docker push itsokka/backups:{droplet}")
        os.system(f"sudo docker rmi itsokka/backups:{droplet}")
        print("Droplet backed up.")

def main():
    if len(sys.argv) == 1:
        help()
    elif sys.argv[1] == "-c" or sys.argv[1] == "--check":
        if check(sys.argv[2]) == True:
            print("Droplet is running.")
        else:
            print("Droplet is not running.")
    elif sys.argv[1] == "-s" or sys.argv[1] == "--start":
        start(sys.argv[2])
    elif sys.argv[1] == "-d" or sys.argv[1] == "--stop":
        stop(sys.argv[2])
    elif sys.argv[1] == "-r" or sys.argv[1] == "--restart":
        restart(sys.argv[2])
    elif sys.argv[1] == "-l" or sys.argv[1] == "--list":
        os.system("docker ps -a")
    elif sys.argv[1] == "-n" or sys.argv[1] == "--new":
        new(sys.argv[2], sys.argv[3])
    elif sys.argv[1] == "-i" or sys.argv[1] == "--ips":
        listIps()
    elif sys.argv[1] == "-ip" or sys.argv[1] == "--ip":
        listIp(sys.argv[2])
    elif sys.argv[1] == "-b" or sys.argv[1] == "--backup":
        backup(sys.argv[2])
    elif sys.argv[1] == "-h" or sys.argv[1] == "--help":
        help()
    elif sys.argv[1] == "-ps":
        ps()
    elif sys.argv[1] == "-ls":
        ls()
    elif sys.argv[1] == "-lsi":
        lsi()
    elif sys.argv[1] == "-size":
        size()
    elif sys.argv[1] == "-sizev":
        sizev()
    else:
        help()

# def to generate a totp code from a secret
def generate_totp(secret):
    return pyotp.TOTP(secret).now()

# def to generate a new secret
def generate_secret():
    return pyotp.random_base32()

# def to generate a new qr code
def generate_qr(secret, name):
    return pyqrcode.create(f"otpauth://totp/{name}?secret={secret}&issuer=Dashed%20Droplets")

main()

# temp_secret = generate_secret()
# temp_totp = generate_totp(temp_secret)
# print(temp_secret)
# print(temp_totp)
# print(generate_qr(temp_secret, "test").terminal())
# print(generate_qr(temp_secret, "test").svg("test.svg", scale=1))