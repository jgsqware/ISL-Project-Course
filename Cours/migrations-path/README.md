
```docker run --name migrations-path-mysql \
      -p 3306:3306 \
      -e MYSQL_ROOT_PASSWORD=root-pwd \
      -e MYSQL_DATABASE=migrations-path \
      -e MYSQL_USER=migrations-path-user \
      -e MYSQL_PASSWORD=migrations-path-pwd \
      -d mysql:5.7```