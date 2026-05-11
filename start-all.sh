#!/bin/bash

echo "🚀 Setup Network..."
docker network create eai-network 2>/dev/null

echo "🚀 Starting All Microservices..."

cd user-service && docker compose up -d --build && cd ..
cd jadwal-service && docker compose up -d --build && cd ..
cd konsultasi-service && docker compose up -d --build && cd ..
cd rabbitmq && docker compose up -d --build && cd ..

echo "✅ All services are running!"