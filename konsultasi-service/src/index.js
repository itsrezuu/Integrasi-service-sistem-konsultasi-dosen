const express = require('express');
const cors = require('cors');
require('dotenv').config();

const konsultasiRoutes = require('./routes/konsultasiRoutes');

const app = express();

app.use(cors());
app.use(express.json());

app.use('/api/konsultasi', konsultasiRoutes);

const PORT = process.env.PORT || 3002;
app.listen(PORT, () => {
    console.log(`Konsultasi Service running on port ${PORT}`);
});

module.exports = app;