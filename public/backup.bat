@echo off
mkdir C:\webserver\apache\htdocs\abrasil\public\storage\backup
C:\webserver\mariadb\bin\mysqldump -u root -p16050912 -h localhost sos > C:\webserver\apache\htdocs\abrasil\public\storage\backup\msos_backup.sql