ARG ELASTIC_VERSION

# https://www.docker.elastic.co/
FROM bitnami/elasticsearch:${ELASTIC_VERSION}

USER root

RUN set -eux; \
	mkdir /state; \
	chmod 0775 /state;

RUN groupadd elasticsearch

ENTRYPOINT ["/entrypoint.sh"]
