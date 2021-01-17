FROM prestashop/prestashop:1.6

RUN apt-get update -y &&\
    apt-get install -y git
	  
RUN a2enmod rewrite ssl
      
RUN cd .. &&\
	git clone https://github.com/wazniak96/BiznesElektroniczny &&\
	rm -rf /var/www/html/* &&\
	cp -rf BiznesElektroniczny/prestashop/* /var/www/html/ &&\
	cp BiznesElektroniczny/.htaccess /var/www/html/ &&\
	chown -R www-data:www-data /var/www/html/ &&\
	chmod -R 755 /var/www/html/ &&\
	cp BiznesElektroniczny/ssl/server.crt /etc/ssl/certs/ssl-cert-snakeoil.pem &&\
	cp BiznesElektroniczny/ssl/private.key /etc/ssl/private/ssl-cert-snakeoil.key

RUN a2ensite default-ssl