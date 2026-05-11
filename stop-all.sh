#!/bin/bash

echo "🛑 Stopping All Microservices..."

cd user-service && docker compose down && cd ..
cd jadwal-service && docker compose down && cd ..
cd konsultasi-service && docker compose down && cd ..

echo "✅ All services stopped!"