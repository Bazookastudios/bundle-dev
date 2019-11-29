FROM 255331728746.dkr.ecr.eu-west-1.amazonaws.com/php7-nginx:experimental

#Enable the blackfire php probe
ENV current_os=linux
ARG BUILD_ENV=prod
RUN if [ "${BUILD_ENV}" = "dev" ]; then \
        version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
        && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/$current_os/amd64/$version \
        && mkdir -p /tmp/blackfire \
        && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp/blackfire \
        && mv /tmp/blackfire/blackfire-*.so $(php -r "echo ini_get('extension_dir');")/blackfire.so \
        && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8707\n" > $PHP_INI_DIR/conf.d/blackfire.ini \
        && rm -rf /tmp/blackfire /tmp/blackfire-probe.tar.gz; \
    fi

#Override php.ini settings
RUN if [ "${BUILD_ENV}" != "dev" ]; then \
        #Add php.ini override to disable timestamp based opcache checks
        echo "opcache.validate_timestamps = 0\n" \
         > /usr/local/etc/php/conf.d/project-override.ini; \
    fi

ADD . /var/www

RUN mkdir -p var && chmod -R 777 var && \
 rm -rf var/cache && mkdir -p var/cache && chmod -R 777 var/cache && \
 rm -rf var/logs && mkdir -p var/logs && chmod -R 777 var/logs && \
 rm -rf var/sessions && mkdir -p var/sessions && chmod -R 777 var/sessions

RUN mkdir -p AR && chmod -R 777 AR && \
 mkdir -p web/media && chmod -R 777 web/media && \
 mkdir -p web/secure && chmod -R 777 web/secure && \
 mkdir -p web/uploads/images && chmod -R 777 web/uploads/images && \
 mkdir -p web/uploads/files && chmod -R 777 web/uploads/files && \
 mkdir -p web/uploads/videos && chmod -R 777 web/uploads/videos

RUN apt-get update && apt-get install ffmpeg -y --no-install-recommends
