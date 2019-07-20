FROM nginx:1.12

MAINTAINER Puraskar Sapkota <@ems>

WORKDIR /srv

# Copy configuration files.
# Copy certificates.

COPY nginx.conf /etc/nginx/nginx.conf
COPY default.conf /etc/nginx/conf.d/default.conf
# COPY certificates/api.certificate.crt /etc/ssl/certs/api.certificate.crt
# COPY certificates/api.private.key /etc/ssl/private/api.private.key

# Substitute the api-domain, php host, and php port.

ARG ADMIN_DOMAIN
RUN sed -i -e 's/ADMIN_DOMAIN_TO_BE_REPLACED/'"$ORDSYS_ADMIN_DOMAIN"'/g' /etc/nginx/conf.d/default.conf
ARG PHP_HOST
RUN sed -i -e 's/PHP_CONTAINER_NAME_TO_BE_REPLACED/'"$PHP_HOST"'/g' /etc/nginx/conf.d/default.conf
ARG PHP_PORT
RUN sed -i -e 's/PHP_PORT_TO_BE_REPLACED/'"$PHP_PORT"'/g' /etc/nginx/conf.d/default.conf