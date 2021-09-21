FROM docker.io/bitnami/laravel:8
COPY . /app
WORKDIR /app
EXPOSE 3000