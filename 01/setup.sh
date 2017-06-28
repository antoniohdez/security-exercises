#!/bin/bash

# Clean everything up 
rm -R users

# Create basic structure
mkdir -p users
mkdir "users/user"{1..500}

# Create files
for f in {1..500}
do
	touch users/user${f}/file${f}.txt
	touch users/user${f}/garbage${f}.tmp
done

# Rename random file and put content on it
random=$(( ( RANDOM % 500 )  + 1 ))
mv users/user${random}/file${random}.txt users/user${random}/BINGO${random}.txt

echo "My lucky number is: 527" > users/user${random}/BINGO${random}.txt