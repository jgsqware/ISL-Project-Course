# Upload image to CDN Cloudinary

## Run MySQL DB in docker

  ```bash
  docker run --name cloudinary-example-mysql \
      -p 3306:3306 \
      -e MYSQL_ROOT_PASSWORD=root-pwd \
      -e MYSQL_DATABASE=cloudinary-example \
      -e MYSQL_USER=cloudinary-example-user \
      -e MYSQL_PASSWORD=cloudinary-example-pwd \
      -d mysql:5.7
  ```

  Initialize database

  ```bash
  php bin/console doctrine:database:drop --force
  php bin/console doctrine:database:create
  php bin/console doctrine:migrations:migrate
  ```

## Install Cloudinary dependencies

  ```
  composer require cloudinary/cloudinary_php
  ```

## Configure cloudinary 

  
  Set **Cloudinary** variables (found here: https://cloudinary.com/console) in `.env` file:

  ```
  CLOUDINARY_CLOUD=<cloudinary cloud name>
  CLOUDINARY_API_KEY=<cloudinary api key>
  CLOUDINARY_SECRET_KEY=<cloudinary secret key>
  ```

  ```php
    \Cloudinary::config(array(
      "cloud_name" => getenv('CLOUDINARY_CLOUD'),
      "api_key" => getenv('CLOUDINARY_API_KEY'),
      "api_secret" => getenv('CLOUDINARY_SECRET_KEY')
  ));
  ```

  [Example here](src/Controller/ProfileController.php#L54)

## Cloudinary Upload

  ```php
  $result = \Cloudinary\Uploader::upload($file);
  ```

  [Example here](src/Controller/ProfileController.php#L60)


