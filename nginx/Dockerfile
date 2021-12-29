FROM nginx:alpine

WORKDIR /var/www

RUN mkdir -p "/var/log/nginx"
RUN chmod -R a+x /var/log/nginx

COPY nginx.conf /etc/nginx/nginx.conf
COPY sites-available /etc/nginx/sites-available

CMD [ "nginx" ]

EXPOSE 8001
EXPOSE 8002