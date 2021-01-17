FROM mysql:5.7

RUN apt-get update -y &&\
    apt-get install -y git
      
RUN	git clone https://github.com/wazniak96/BiznesElektroniczny &&\
	cp BiznesElektroniczny/prestashop_db.sql /docker-entrypoint-initdb.d/ &&\
	rm -rf BiznesElektroniczny
