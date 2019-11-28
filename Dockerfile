FROM 255331728746.dkr.ecr.eu-west-1.amazonaws.com/php7-nginx:master

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
