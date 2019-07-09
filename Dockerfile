FROM registry.piber.network/php:v1.0.8

COPY . /var/www/module

COPY ./entrypoint.sh /entrypoint.sh

ENV PHINX_ENVIRONMENT=PRODUCTION
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"***REMOVED***
CMD [***REMOVED***
