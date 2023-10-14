# Use the latest mysqsl image as a base.
FROM mysql:latest

# Copies the database schema from the host machine to the container.
# Any SQL file in /docker-entrypoint-initdb.d/ will get executed on initialization.
# This is necessary for initially filling the database.
# After running once, this script will not run again until the database is cleared.
COPY schema.sql /docker-entrypoint-initdb.d/
