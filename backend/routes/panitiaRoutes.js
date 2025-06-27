const express = require('express');
const router = express.Router();
const PanitiaController = require('../controllers/panitiaController');

// List semua panitia
router.get('/', PanitiaController.index);

// Tambah panitia baru
router.post('/', PanitiaController.store);

// Update data panitia
router.put('/:id', PanitiaController.update);

// Hapus panitia
router.delete('/:id', PanitiaController.destroy);

module.exports = router;
