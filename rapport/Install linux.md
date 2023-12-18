
```bash
dnf install httpd (and httpd-tools)
systemctl enable httpd.service 
```
- Dans /etc/httpd/conf httpd.conf 
	- modifier DocumentRoot "/web" 
- dans /etc/selinux 
	- Modifier SELINUX = disable

 ```bash
systemctl stop iptables.service
systemctl enable firewalld.service
systemctl start firewalld.service # ATTENTION SSH
firewall-cmd --permanent --zone=public --add-service=http
sudo firewall-cmd --zone=public --add-port=22/tcp
sudo firewall-cmd --zone=public --add-port=5813/tcp
sudo firewall-cmd --zone=public --add-port=5813/udp
firewall-cmd --reload

```
- php
```bash
dnf module enable php:8.1
dnf install php
dnf install php php-ldap
dnf install -y https://rpms.remirepo.net/enterprise/remi-release-8.rpm
dnf install php
systemctl restart httpd.service
```

- mysql
```bash
dnf search mysql
dnf install mysql-server mysql
systemctl enable mysqld
systemctl start mysqld.service
```

