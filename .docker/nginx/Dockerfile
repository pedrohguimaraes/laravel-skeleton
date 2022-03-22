FROM nginx:1.15.0-alpine AS nginx-1.1

RUN apk update && apk add bash

RUN rm /etc/nginx/conf.d/default.conf
COPY ./nginx.conf /etc/nginx/conf.d