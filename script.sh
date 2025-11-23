#!/bin/bash

read -p "Kérlek add meg hogy a host melyik porton fusson a webszerver: " WEBPORT

export WEBPORT

echo "Indítás docker-compose-al (logok élőben, Ctrl+C leállít/töröl)"

function cleanup() {
    echo ""
    echo "Ctrl+C! A script törli a Docker konténereket és volume-okat..."
    docker compose down -v
    echo "A script lefutott"
}

trap cleanup EXIT

docker compose up

