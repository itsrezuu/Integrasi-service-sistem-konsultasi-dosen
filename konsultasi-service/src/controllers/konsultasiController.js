const db = require("../config/db");
const {
  getUserById,
  getJadwalByTanggal,
} = require("../services/externalService");

const getAllKonsultasi = async (req, res) => {
  try {
    const [rows] = await db.query("SELECT * FROM konsultasi");
    if (rows.length === 0)
      return res
        .status(404)
        .json({ status: "Failed", message: "Tidak ada konsultasi ditemukan" });

    res.json({ status: "Success", message: "GET all konsultasi", data: rows });
  } catch (error) {
    res.status(500).json({ status: "Failed", message: error.message });
  }
};

const getKonsultasiById = async (req, res) => {
  try {
    const [rows] = await db.query("SELECT * FROM konsultasi WHERE id = ?", [
      req.params.id,
    ]);
    if (rows.length === 0)
      return res
        .status(404)
        .json({ status: "Failed", message: "Konsultasi tidak ditemukan" });

    res.json({
      status: "Success",
      message: "GET konsultasi by id",
      data: rows[0],
    });
  } catch (error) {
    res.status(500).json({ status: "Failed", message: error.message });
  }
};

const createKonsultasi = async (req, res) => {
  try {
    const { nim, nip, tanggal, waktu, topik } = req.body;

    const mahasiswa = await getUserById("mahasiswa", nim);
    if (mahasiswa.data == null) {
      res
        .status(404)
        .json({ status: "Failed", message: "Mahasiswa tidak ditemukan" });
      return;
    }
    const dosen = await getUserById("dosen", nip);
    if (dosen.data == null) {
      res
        .status(404)
        .json({ status: "Failed", message: "Dosen tidak ditemukan" });
      return;
    }

    const jadwal = await getJadwalByTanggal(tanggal);
    if (jadwal.data != null) {
      res.status(400).json({
        status: "Failed",
        message:
          "Dosen Sudah memiliki jadwal pada tanggal tersebut sudah penuh",
      });
      return;
    }

    const [existing] = await db.query(
      "SELECT * FROM konsultasi WHERE nip = ? AND tanggal = ? AND waktu = ?",
      [nip, tanggal, waktu],
    );

    if (existing.length > 0) {
      res.status(400).json({
        status: "Failed",
        message:
          "Dosen sudah memiliki jadwal konsultasi di tanggal dan waktu tersebut",
      });
      return;
    }

    const [result] = await db.query(
      "INSERT INTO konsultasi (nim, nip, tanggal, waktu, topik, status) VALUES (?, ?, ?, ?, ?, ?)",
      [nim, nip, tanggal, waktu, topik, "pending"],
    );

    res.status(201).json({
      status: "Success",
      message: "Konsultasi berhasil dibuat",
      data: {
        id: result.insertId,
        mahasiswa,
        dosen,
        tanggal,
        waktu,
        topik,
        status: "pending",
      },
    });
  } catch (error) {
    res.status(500).json({ status: "Failed", message: error.message });
  }
};

const updateKonsultasi = async (req, res) => {
  try {
    const { status } = req.body;

    const [result] = await db.query(
      "UPDATE konsultasi SET status = ? WHERE id = ?",
      [status, req.params.id],
    );
    if (result.affectedRows === 0)
      return res
        .status(404)
        .json({ status: "Failed", message: "Konsultasi tidak ditemukan" });
    res.json({ status: "Success", message: "Konsultasi berhasil diupdate" });
  } catch (error) {
    res.status(500).json({ status: "Failed", message: error.message });
  }
};

const deleteKonsultasi = async (req, res) => {
  try {
    const [result] = await db.query("DELETE FROM konsultasi WHERE id = ?", [
      req.params.id,
    ]);
    if (result.affectedRows === 0)
      return res
        .status(404)
        .json({ status: "Failed", message: "Konsultasi tidak ditemukan" });
    res.json({ status: "Success", message: "Konsultasi berhasil dihapus" });
  } catch (error) {
    res.status(500).json({ status: "Failed", message: error.message });
  }
};

module.exports = {
  getAllKonsultasi,
  getKonsultasiById,
  createKonsultasi,
  updateKonsultasi,
  deleteKonsultasi,
};
