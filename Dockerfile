# Use the official PHP image from the dockerhub
FROM webdevops/php-dev:8.2

RUN apt-get update \
    && apt-get install -y \
        libglu1 \
        libxi6 \
        libgconf-2-4 \
        default-jre \
        libreoffice-writer \
        smbclient \
        libsmbclient-dev \
    && ldconfig

RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

ARG RANDOM_ID=158158
ARG MY_UID=1000
ARG MY_GID=1000
RUN usermod -u $RANDOM_ID $(id -un $MY_UID > /dev/null 2>&1) > /dev/null 2>&1 || true \
    && usermod -u $MY_UID $APPLICATION_USER \
    && groupmod -g $RANDOM_ID $(getent group $MY_GID | cut -d: -f1) > /dev/null 2>&1 || true \
    && groupmod -g $MY_GID $APPLICATION_GROUP \
    && chown -R $APPLICATION_USER:$APPLICATION_GROUP -R /app \
    && chown -R $APPLICATION_USER:$APPLICATION_GROUP -R /home/$APPLICATION_USER
CMD ["symfony", "server:start", "--allow-http", "--port=8000"]
