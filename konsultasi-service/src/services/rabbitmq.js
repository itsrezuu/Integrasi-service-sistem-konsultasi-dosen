const amqp = require("amqplib");

async function sendToQueue(data) {
  try {
    const conn = await amqp.connect("amqp://rabbitmq");
    const ch = await conn.createChannel();

    const queue = "konsultasi_queue";

    await ch.assertQueue(queue, { durable: true });

    ch.sendToQueue(queue, Buffer.from(JSON.stringify(data)));

    console.log("📤 Sent to queue:", data);

    setTimeout(() => conn.close(), 500);
  } catch (error) {
    console.error("❌ RabbitMQ Error:", error.message);
  }
}

module.exports = { sendToQueue };
