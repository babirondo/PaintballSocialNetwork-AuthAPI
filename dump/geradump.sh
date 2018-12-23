#!/bin/bash
pg_dump -h 172.18.0.7 -U postgres  authentication > /var/www/html/PaintballSocialNetwork-AuthAPI/dump/$(date +"%Y%m%d").sql
