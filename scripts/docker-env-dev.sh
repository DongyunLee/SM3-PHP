#!/bin/bash

docker run -it --rm --name sm3-dev -v "$HOME"/.ssh/id_rsa:/root/.ssh/id_rsa  sm3-php:dev bash

