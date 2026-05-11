const amqp = require("amqplib");

async function test() {
  try {
    const conn = await amqp.connect("amqp://rabbitmq");
    console.log("✅ Connected to RabbitMQ");
    await conn.close();
  } catch (err) {
    console.error("❌ Failed:", err);
  }
}

test();
