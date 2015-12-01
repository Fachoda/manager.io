#!/bin/bash

MODULE_NAME=$1

echo "Creating new directory $MODULE_NAME"

mkdir ./app/$MODULE_NAME;

echo "Copying files"
cp -R ./template/* ./app/$MODULE_NAME;

echo "Replacing module name in namespaces and class definitions"
find ./app/$MODULE_NAME -name \*.php -exec sed -i "s/\[\[module_name\]\]/$MODULE_NAME/g" {} \;

echo "Done!"
echo "Go to your application autoloader and register the new namespace"
echo "autoloader location: ./app/bootstrap/autoload_namespaces.php"
echo "Go to your application bootstrap config and add the route to your new module";
echo "routes location: ./app/bootstrap/config/routes.php"
echo "Add your new module to the application bootstrap"

