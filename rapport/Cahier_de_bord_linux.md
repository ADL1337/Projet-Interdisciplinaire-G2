Voici le cahier de bord de l'installation Linux

```bash
sudo dnf install httpd (and httpd-tools)
sudo systemctl enable httpd.service 
```
- Dans /etc/httpd/conf httpd.conf 
	- modifier DocumentRoot "/web" 
		- en desous rajouter ServerName www.isims.park
		- dans <Directory "/web">
			- supp tout les Rewrite
			- remplacer par 

```bash
RewriteEngine On

    RewriteCond %{REQUEST_FILENAME} !\.css$
    RewriteCond %{REQUEST_FILENAME} !\.ttf$
    RewriteCond %{REQUEST_FILENAME} !\.svg$
    RewriteRule . index.php [L]
```
- dans /etc/selinux 
	- Modifier SELINUX = disable

 ```bash
sudo dnf install iptables 
sudo systemctl enable iptable 
sudo systemctl start iptables
```

-  créer un fichier  firewall.sh 
```bash
!/bin/bash

iptables -F   #vider la table au début

iptables -P INPUT DROP # remet les politiques par défault
iptables -P OUTPUT DROP # remet les politiques par défault

# accepter les connections etablies 
iptables -A INPUT -m state --state RELATED,ESTABLISHED -j ACCEPT 
iptables -A OUTPUT -m state --state RELATED,ESTABLISHED -j ACCEPT

# autoriser le SSH
iptables -A INPUT -p TCP --dport 6969 -j ACCEPT 
iptables -A OUTPUT -p TCP --sport 6969 -j ACCEPT

# autoriser le trafic web
iptables -A INPUT -p tcp --dport 80 -j ACCEPT 
iptables -A OUTPUT -p tcp --dport 80 -j ACCEPT
iptables -A INPUT -p tcp --dport 443 -j ACCEPT 
iptables -A OUTPUT -p tcp --dport 443 -j ACCEPT

# Autoriser le dns
iptables -A INPUT -p tcp --dport 53 -j ACCEPT 
iptables -A OUTPUT -p tcp --dport 54 -j ACCEPT
iptables -A INPUT -p udp --dport 53 -j ACCEPT 
iptables -A OUTPUT -p udp --dport 54 -j ACCEPT

# pour autoiser le ping
iptables -A INPUT -p icmp -j ACCEPT
iptables -A OUTPUT -p icmp -j ACCEPT

# autoriser  LDAP 
iptables -A OUTPUT -p TCP --sport 389 -j ACCEPT
```

- créer firewall.service 
```bash
[Unit]
Description=firewall

[Service]
ExecStart=/etc/firewall.sh
Restart=no-failure
Type=oneshot

[Install]
WantedBy=default.target
```

- php
```bash
sudo dnf install -y https://rpms.remirepo.net/enterprise/remi-release-8.rpm[]()
sudo dnf module reset php
sudo dnf module enable php:8.1
sudo dnf install php php-ldap
sudo dnf install php-mysqlnd
sudo dnf intall mod_ssl
sudo systemctl restart httpd.service
```

- mysql
```bash
sudo dnf search mysql
sudo dnf install mysql-server mysql
sudo systemctl enable mysqld
sudo systemctl start mysqld.service
```

- ssl 
```bash
sudo openssl genrsa -out server.key 2048
sudo openssl req -new -key server.key -out server.csr
openssl req -text -noout -in server.csr
sudo openssl x509 -req -days 365 -in server.csr -signkey server.key -out server.crt
```
	- modif /etc/httpd/conf httpd.conf 

-  Key 
	- termius > paramètres > generate key > copy puplic key > /home/admin/.ssh/authorized_keys > paste key 
	-  /etc/ssh/sshd_config > uncomment # PermitRootLogin and PubkeyAuthentication yes

- Backup
	- nouvelle partition 
		```bash
		sudo fdisk -l
		sudo fdisk /dev/nvme0n2
		n
		p




		l
		t
		8e
		w


		mkdir backup 
		mount /dev/nvme0n2 /backup
		nano /etc/fstab 
		/dev/nvme0n2    /backup ext4    defaults,noexec,nosuid  1 2
		umount /backup
		mount /backup 
				
```

- sauvegardes
	- mysqldump -u root --password="bC>K5j9AC/WyJ5v<t3/URt?S;rJJ2z" --databases isimsparkg2 > /backup/sql/db.sql
	- rsync -vr /web/ /backup/web
	- rsync -vr /etc/httpd/conf/httpd.conf /backup/config_de_base
	- rsync -vr /etc/ssh/sshd_config  /backup/config_de_base/
	- rsync -vr /home/admin/.ssh/authorized_keys   /backup/config_de_base/
	- rsync -vr /etc/systemd/system/firewall.service  /backup/config_de_base/
	- rsync -vr /etc/firewall.sh  /backup/config_de_base/
	- rsync -vr /etc/selinux/config  /backup/config_de_base/
