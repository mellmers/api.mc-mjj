# API for Project-X @ HSBremen - REST-API

## Benötigte Software
- [Git](https://git-scm.com/) (Quellcodeverwaltung)
- [VirtualBox](https://www.virtualbox.org/) (Virtualisierungs Software)
- [Vagrant](https://www.vagrantup.com/) (Automatisierte VM Konfiguration)
- [XAMPP](https://www.apachefriends.org) oder lokale PHP Installation (für lokale Tests [geht auch ohne])
- [Composer](https://getcomposer.org/) PHP Paketmanager (geht auch ohne, über die VM)
- Einen Editor (vorzugsweise [Phpstorm](https://www.jetbrains.com/phpstorm/))

## Initiales Setup
1. Klone dieses Repository `git clone git@github.com/mellmers/api.project-x.git`
2. Wechsel in das Verzeichnis `cd api.project-x`
3. Starte die VM mit `vagrant up`
4. Warte bis die VM erstellt wurde, währenddessen folgendes, als neue Zeile, in die Datei `C:\Windows\System32\drivers\etc\hosts` bzw. `/etc/hosts/` eintragen (Als Administrator/root bearbeiten):  
```
192.168.56.222 api.project-x.vm
```
5. Wenn die VM fertig gebaut ist, sieht das in etwa so aus:  
```
       + Zwei Elefanten +++++++++++ Zwei Elefanten +
       
       + Viel Text +++++++++++++++++++++ Viel Text +
       
 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 |  ____                _      _    _                    _  |
 | |  _ \ ___  __ _  __| |    / \  | |__   _____   _____| | |
 | | |_) / _ \/ _` |/ _` |   / _ \ | '_ \ / _ \ \ / / _ \ | |
 | |  _ <  __/ (_| | (_| |  / ___ \| |_) | (_) \ V /  __/_| |
 | |_| \_\___|\__,_|\__,_| /_/   \_\_.__/ \___/ \_/ \___(_) |
 |                                                          |
 ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++       
```
6. Installiere die erforderlichen PHP Pakete: `composer install` (wenn lokale PHP Installation, sonst unter `/var/www/src` per SSH auf der VM)
7. Browser öffnen und `http://api.project-x.vm/` eingeben.
8. Das `api.project-x` Verzeichnis im Editor deiner Wahl öffnen.

## Vor jeder Session
1. `vagrant up` (dauert jetzt nicht mehr so lange)

## Nach jeder Session
1. `vagrant halt` (fährt die VM runter)

## Per SSH auf die VM
Host: localhost
Port: 2222
User: vagrant
Private-Key: `./puphpet/files/dot/ssh/id_rsa`
Kein Password

### Was ist auf der VM installiert?
- Ubuntu 14.04 LTS x64 (1 CPU, 512 MB RAM)
- IP: 192.168.56.222
- Offene Ports: TCP 9000 (xDebug) und TCP 3306 (MySQL)
- vim, htop
- nginx
- PHP 5.6
- Nodejs 5
- MySQL 5.5 (user: project-x, pw: project-x)