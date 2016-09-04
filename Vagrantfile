# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
    config.vm.box = "ubuntu/trusty64"
    config.vm.network "forwarded_port", guest: 443, host: 8000

    config.vm.synced_folder ".", "/var/www"

    config.vm.provider "virtualbox" do |vb|
        vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root", "1"]
        vb.memory = 2048
        vb.cpus = 2
    end

    config.vm.provision "shell", inline: <<-SHELL
        apt-get -y update
        apt-get -y upgrade
        apt-get -y install software-properties-common
        echo 'cd /var/www' >> /home/vagrant/.bashrc

        # Install nginx
        curl -o /tmp/nginx_signing.key http://nginx.org/keys/nginx_signing.key
        apt-key add /tmp/nginx_signing.key
        rm -f /tmp/nginx_signing.key
        echo 'deb http://nginx.org/packages/ubuntu/ trusty nginx' >> /etc/apt/sources.list
        echo 'deb-src http://nginx.org/packages/ubuntu/ trusty nginx' >> /etc/apt/sources.list
        apt-get -y update
        apt-get -y install nginx
        update-rc.d nginx defaults

        # Install PHP7
        add-apt-repository ppa:ondrej/php
        apt-get -y update
        apt-get -y install php7.0-fpm php7.0-sqlite3 php7.0-mbstring php7.0-xml php7.0-bz2 php7.0-curl php7.0-mcrypt php7.0-zip
        update-rc.d php7.0-fpm defaults

        # Create ssl certificate
        mkdir /etc/nginx/ssl

        PATH_SSL="/etc/nginx/ssl"
        PATH_KEY="${PATH_SSL}/atlauncher-api.key"
        PATH_CSR="${PATH_SSL}/atlauncher-api.csr"
        PATH_CRT="${PATH_SSL}/atlauncher-api.crt"

        if [ ! -f $PATH_KEY ] || [ ! -f $PATH_CSR ] || [ ! -f $PATH_CRT ]
        then
          openssl genrsa -out "$PATH_KEY" 2048 2>/dev/null
          openssl req -new -key "$PATH_KEY" -out "$PATH_CSR" -subj "/CN=localhost/O=Vagrant/C=UK" 2>/dev/null
          openssl x509 -req -days 365 -in "$PATH_CSR" -signkey "$PATH_KEY" -out "$PATH_CRT" 2>/dev/null
        fi

        # Configure nginx site
        sudo sed -i 's/user.*nginx;/user www-data;/g' /etc/nginx/nginx.conf

        cat > /etc/nginx/conf.d/atlauncher-api.conf <<NGINXCONF
            server {
                listen 443 default_server ssl http2;

                ssl_certificate     /etc/nginx/ssl/atlauncher-api.crt;
                ssl_certificate_key /etc/nginx/ssl/atlauncher-api.key;

                root /var/www/public;

                server_name localhost;

                index index.html index.htm index.php;

                charset utf-8;

                location / {
                    try_files \\$uri \\$uri/ /index.php?\\$query_string;
                }

                location = /favicon.ico { access_log off; log_not_found off; }
                location = /robots.txt  { access_log off; log_not_found off; }
                access_log off;
                error_log  /var/log/nginx/atlauncher-api-error.log error;
                sendfile off;
                client_max_body_size 100m;

                location ~ \.php$ {
                    try_files \\$uri =404;
                    fastcgi_split_path_info ^(.+\.php)(/.+)$;
                    fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
                    fastcgi_index index.php;
                    fastcgi_param SCRIPT_FILENAME \\$document_root\\$fastcgi_script_name;
                    include fastcgi_params;

                    fastcgi_intercept_errors off;
                    fastcgi_buffer_size 16k;
                    fastcgi_buffers 4 16k;
                    fastcgi_connect_timeout 300;
                    fastcgi_send_timeout 300;
                    fastcgi_read_timeout 300;
                }
            }
NGINXCONF

        rm -f /etc/nginx/conf.d/default.conf
        service nginx reload
SHELL
end
