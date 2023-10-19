# Use the ubuntu:22.04 image as a base.
FROM ubuntu:22.04

# Fetches the most recent packages from Ubuntu's repository. This is necessary before installing.
RUN apt update

# Installs all necessary packages.
# -y is used to respond "yes" to every question by default.
# DEBIAN_FRONTEND=noninteractive is used to circumvent some questions that are asked during the installation process.
# Without either of these, the container would either stop automatically, or get stuck.
RUN apt install -y apache2
RUN DEBIAN_FRONTEND=noninteractive apt install -y libapache2-mod-php
RUN apt install -y php-mysql


# Copies the startup script from the host machine to the container.
COPY startup.sh /bin/
# Allows the startup script to be executed by adding the execute (x) permission.
RUN chmod +x /bin/startup.sh
# Runs the script containing necessary commands on startup,
# then prevents the container from shutting down by opening a command interface.
ENTRYPOINT /bin/startup.sh && bash
