#!/bin/bash

# Ensure ddev is installed
if ! command -v ddev &> /dev/null
then
    echo "ddev is not installed. Please install ddev and try again."
    exit 1
fi

# Start ddev
echo "Starting ddev..."
ddev start
if [ $? -ne 0 ]; then
  echo "ddev start failed. Exiting."
  exit 1
fi

# Ask for the database file path or use a default
DB_FILE="database/db.sql"
echo "Enter the path to the database file to import (or press enter to use default: $DB_FILE):"
read -r input_file
if [ -n "$input_file" ]; then
  DB_FILE=$input_file
fi

# Check if the file exists
if [ ! -f "$DB_FILE" ]; then
  echo "Database file $DB_FILE not found. Exiting."
  exit 1
fi

# Import the database
echo "Importing database from $DB_FILE..."
ddev import-db --file="$DB_FILE"
if [ $? -ne 0 ]; then
  echo "Database import failed. Exiting."
  exit 1
fi

echo "ddev setup and database import completed successfully!"

ddev npm install
ddev npm run dev

