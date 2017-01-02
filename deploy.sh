#!/bin/bash

docker login -u="$QUAY_USERNAME" -p="$QUAY_PASSWORD" quay.io
docker tag keboola/processor-select-columns quay.io/keboola/processor-select-columns:$TRAVIS_TAG
docker tag keboola/processor-select-columns quay.io/keboola/processor-select-columns:latest
docker images
docker push quay.io/keboola/processor-select-columns:$TRAVIS_TAG
docker push quay.io/keboola/processor-select-columns:latest
