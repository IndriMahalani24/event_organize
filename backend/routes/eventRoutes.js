const express = require('express');
const router = express.Router();
const EventController = require('../controllers/eventController');
const upload = require('../middleware/upload');

router.get('/', EventController.index);
router.post('/', EventController.store);
router.get('/myevents/:id', EventController.getByUser);
router.post('/', upload.single('poster'), EventController.store);


module.exports = router;

// 