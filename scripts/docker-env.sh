#!/bin/bash

docker run -it --rm \
  --name sm3-php \
  -v $(pwd):/srv/www \
  sm3-php bash

