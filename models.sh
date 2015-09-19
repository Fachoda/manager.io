#!/bin/bash

module="frontend"
table=""

while [ $# -gt 0 ]; do
  case "$1" in
    --module=*)
      module="${1#*=}"
      ;;
	--table=*)
	  table="${1#*=}"
	  ;;
    *)
      printf "***************************\n"
      printf "* Error: Invalid argument.*\n"
	  printf "* Using frontend module.  *\n"
      printf "***************************\n"
      exit 1
  esac
  shift
done

if [ "$table" != "" ]; then
	echo "Generating model for " "$table" "on" "$module"
	phalcon model --name=$table --namespace=app\\$module\\models\\base --output=app/$module/models/base --doc --get-set --force --abstract
else
	echo "No table specified"
	exit 1
fi