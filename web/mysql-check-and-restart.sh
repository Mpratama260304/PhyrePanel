#!/bin/bash


if ! systemctl is-active --quiet mysql; then
    echo "$(date): MySQL is down. Restarting..." >> /var/log/mysql_monitor.log
    systemctl enable mysql
    systemctl restart mysql
else
    echo "$(date): MySQL is running."
fi
