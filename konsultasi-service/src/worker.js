const amqp = require("amqplib");

const queue = "konsultasi_queue";

async function start() {
  const conn = await amqp.connect("amqp://rabbitmq");
  const ch = await conn.createChannel();

  await ch.assertQueue(queue, { durable: true });

  console.log("📥 Waiting for messages...");

  ch.consume(queue, (msg) => {
    const data = JSON.parse(msg.content.toString());

    console.log("🔔 NOTIFIKASI BARU:");
    console.log(`Konsultasi ID: ${data.konsultasi_id}`);
    console.log(`Mahasiswa: ${data.nim}`);
    console.log(`Dosen: ${data.nip}`);
    console.log(`Tanggal: ${data.tanggal}`);
    console.log(`Waktu: ${data.waktu}`);
    console.log(`Topik: ${data.topik}`);
    console.log("--------------------------");

    ch.ack(msg);
  });
}

start();
