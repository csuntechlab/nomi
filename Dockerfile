FROM csunmetalab/environment:base
  
# Add Yarn Debian Repo
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
 && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \

 && apt-get update \


  # Install Missing Dev Stack(LAMP) Specific for Nomi 
  && apt-get update && apt-get install -y \
  curl \
  imagemagick \
  php-imagick \
  php7.2-ldap \
  php7.2-sqlite3 \
  sqlite3 \
  vim \
  wget \
  yarn \
 # Install NVM
  && wget -qO- https://raw.githubusercontent.com/creationix/nvm/v0.33.11/install.sh | bash \
# Define Bashrc source
  && . ~/.bashrc \
  # Install NPM v9.6.1 and bower
  && nvm install 9.6.1 && npm install -g bower \

# Clean image
  && npm cache clean --force && apt-get clean && apt-get autoremove && rm -rf /var/lib/apt/lists/* \


