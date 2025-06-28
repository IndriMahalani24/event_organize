const express = require('express');
const router = express.Router();
const PanitiaController = require('../controllers/panitiaController');

// List semua panitia
router.get('/', PanitiaController.index);

// Tambah panitia baru
router.post('/', PanitiaController.store);

// Ambil data panitia event dan panitia keuangan
router.get('/event', PanitiaController.getEventPanitia);
router.get('/keuangan', PanitiaController.getKeuanganPanitia);

// Update data panitia
router.put('/:id', PanitiaController.update);

router.get('/:id', PanitiaController.getById);

// Hapus panitia
router.delete('/:id', PanitiaController.destroy);

module.exports = router;
