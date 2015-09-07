#!/usr/bin/env make

all:
	echo "Run the Ellipsis server"
	echo "Browse to 'localhost:8000'"
	php -S localhost:8000 -t .
