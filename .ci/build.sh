#!/bin/sh


cat database/sql/init.sql | mysql -p -u devel --password=devel
