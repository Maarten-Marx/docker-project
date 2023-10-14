The command below creates a `Vagrantfile` containing the configurations needed to create an Ubuntu 22.04 virtual machine.
```bash
$ vagrant init generic/ubuntu2204
```

Open the file, and add this line of code:
```diff
Vagrant.configure("2") do |config|
  config.vm.box = "generic/ubuntu2204"
+ config.vm.network "forwarded_port", guest: 80, host: 8085
end
```
This will ensure that port 8085 on the host machine will be forwarded to port 80 on the guest machine. 
Port 80 is the port that gets used for http requests.

Save the file, then run:
```bash
$ vagrant up
```

This will start your guest machine with the configurations from `Vagrantfile`.  
This may take a few attempts. If it fails initially, run:
```bash
$ vagrant reload
```

When the machine has started successfully, use the command below to access the machine's terminal.
```bash
$ vagrant ssh
```

Now that you have access to the machine, start by installing docker through the following commands:
```bash
$ wget -O docker.sh https://get.docker.com/
$ bash docker.sh
```
`wget` will download a bash script from the provided url, `https://get.docker.com/`. `-O docker.sh` is used to specify that `docker.sh` should be used as an output file.  
`docker.sh` now contains a script that will install docker on our machine. `bash docker.sh` runs the script and thus installs docker.

Create a new user by using the command below. Fill in any necessary info.
```bash
$ sudo adduser <username>
```
> **Note:** replace `<username>` with your username of choice, in this command and any that follow.
> 
> Example: `sudo adduser maarten`

Then, add the created user to the `docker` group using the following command:
```bash
$ sudo usermod -aG docker <username>
```
The options `-ag` specify that the user needs to be added to a group. `docker` is the group the user is being added to.  
By adding the user to this group, the use of `sudo` won't be necessary from this point on.

Lastly, switch to the new user, then move to its home directory.
```bash
$ su <username>
$ cd ~
```
`~` refers to the user's home directory, `/home/<username>/`.

Next, clone the files from [this](https://github.com/Maarten-Marx/docker-project) GitHub repository into your home directory.
```bash
$ git clone https://github.com/Maarten-Marx/docker-project.git
```

This should create a directory named `docker-project`. You can check using the following command:
```bash
$ ls
```

Provided that the directory is present, move into said directory by using the following command:
```bash
$ cd docker-project
```

Lastly, run the command below to start the services defined in `docker-compose.yaml`. This can take a while.
```bash
$ docker compose up
```

If all went well, the hosted webpage should now be available at http://localhost:8085 on the host machine.
