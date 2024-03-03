FROM nginx:latest

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/default.conf /etc/nginx/conf.d/

#RUN rm /etc/nginx/sites-enabled/default
#RUN ln -s /etc/nginx/sites-available/symfony /etc/nginx/sites-enabled/