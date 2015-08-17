#!/bin/bash
if [ "$1" = "generate" ]; then
	echo "Generating migrations"
	phalcon migration generate --directory=app/console --config=config/config.php
else 
	echo "Running migrations"
	phalcon migration run --directory=app/console --config=config/config.php
fi
