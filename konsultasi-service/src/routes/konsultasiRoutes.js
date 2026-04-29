const express = require('express');
const router = express.Router();
const {
    getAllKonsultasi,
    getKonsultasiById,
    createKonsultasi,
    updateKonsultasi,
    deleteKonsultasi
} = require('../controllers/konsultasiController');

router.get('/', getAllKonsultasi);
router.get('/:id', getKonsultasiById);
router.post('/', createKonsultasi);
router.put('/:id', updateKonsultasi);
router.delete('/:id', deleteKonsultasi);

module.exports = router;