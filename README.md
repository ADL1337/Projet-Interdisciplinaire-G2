# Projet Interdisciplinaire 2023

This project was made for educational purposes.
It's a basic web application, capable of handling user and admin features.
NOTE: Not all pages were fully implemented

Notable features:
- HTTP error handling
- Login system
- Privilege system
- Contains a micro MVC framework made from scratch
- Allows LDAP (Active Directory) authentication

This project runs on:
- php 8.1
- php-ldap 8.1.14-1.module_el9.2.0+24+ca6bd7c2
- php-mysqlnd 8.1.14-1.module_el9.2.0+24+ca6bd7c2
- httpd apache/2.4.57
- httpd-tools 2.4.57-5.e19
- mysql 8.0.32-1.el9_2
- mysql-server 8.0.32-1.el9_2
- iptables 5.9.0-5.el8

To test it:
1. Import the .sql file
2. Insert rows in the "users" table:
- user_email: used for login
- user_reservation: set to 1
- user_admin: 0 if user, 1 if admin
- user_password: empty if LDAP user or a BCRYPT hashed password with a cost of 10

3. Modify the httpd.conf file using the project's configuration
4. Navigate to the root directory "/"