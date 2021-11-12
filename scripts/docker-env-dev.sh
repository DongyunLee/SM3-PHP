#!/bin/bash

docker run -it --rm \
  --name sm3-dev \
  -v "$HOME"/.ssh/id_rsa:/root/.ssh/id_rsa \
  -v $(pwd):/srv/www \
  sm3-php:dev bash

