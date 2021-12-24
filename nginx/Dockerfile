FROM nginx:alpine

WORKDIR /var/www

RUN mkdir -p "/var/log/nginx"
RUN chmod -R a+x /var/log/nginx

CMD [ "nginx" ]

EXPOSE 8001