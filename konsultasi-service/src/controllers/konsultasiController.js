const db = require('../config/db');
const { getUserById, getJadwalById } = require('../services/externalService');

// GET semua konsultasi
const getAllKonsultasi = async (req, res) => {
    try {
        const [rows] = await db.query('SELECT * FROM konsultasi');
        res.json({ success: true, data: rows });
    } catch (error) {
        res.status(500).json({ success: false, message: error.message });
    }
};

// GET konsultasi by ID
const getKonsultasiById = async (req, res) => {
    try {
        const [rows] = await db.query('SELECT * FROM konsultasi WHERE id = ?', [req.params.id]);
        if (rows.length === 0) return res.status(404).json({ success: false, message: 'Konsultasi tidak ditemukan' });
        res.json({ success: true, data: rows[0] });
    } catch (error) {
        res.status(500).json({ success: false, message: error.message });
    }
};

// POST buat konsultasi baru
const createKonsultasi = async (req, res) => {
    try {
        const { id_mahasiswa, id_dosen, jadwal_id, topik, catatan } = req.body;

        // Consume user-service (ambil data mahasiswa & dosen)
        const mahasiswa = await getUserById('mahasiswa', id_mahasiswa);
        const dosen = await getUserById('dosen', id_dosen);
        // Consume jadwal-service
        const jadwal = await getJadwalById(jadwal_id);

        const [result] = await db.query(
            'INSERT INTO konsultasi (id_mahasiswa, id_dosen, jadwal_id, topik, catatan, status) VALUES (?, ?, ?, ?, ?, ?)',
            [id_mahasiswa, id_dosen, jadwal_id, topik, catatan || null, 'pending']
        );

        res.status(201).json({
            success: true,
            message: 'Konsultasi berhasil dibuat',
            data: {
                id: result.insertId,
                mahasiswa,
                dosen,
                jadwal,
                topik,
                catatan: catatan || null,
                status: 'pending'
            }
        });
    } catch (error) {
        res.status(500).json({ success: false, message: error.message });
    }
};

// PUT update status konsultasi
const updateKonsultasi = async (req, res) => {
    try {
        const { status } = req.body;
        const [result] = await db.query(
            'UPDATE konsultasi SET status = ? WHERE id = ?',
            [status, req.params.id]
        );
        if (result.affectedRows === 0) return res.status(404).json({ success: false, message: 'Konsultasi tidak ditemukan' });
        res.json({ success: true, message: 'Konsultasi berhasil diupdate' });
    } catch (error) {
        res.status(500).json({ success: false, message: error.message });
    }
};

// DELETE konsultasi
const deleteKonsultasi = async (req, res) => {
    try {
        const [result] = await db.query('DELETE FROM konsultasi WHERE id = ?', [req.params.id]);
        if (result.affectedRows === 0) return res.status(404).json({ success: false, message: 'Konsultasi tidak ditemukan' });
        res.json({ success: true, message: 'Konsultasi berhasil dihapus' });
    } catch (error) {
        res.status(500).json({ success: false, message: error.message });
    }
};

module.exports = { getAllKonsultasi, getKonsultasiById, createKonsultasi, updateKonsultasi, deleteKonsultasi };