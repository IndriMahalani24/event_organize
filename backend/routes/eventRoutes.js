const express = require('express');
const router = express.Router();
const EventController = require('../controllers/eventController');

router.get('/', EventController.index);
router.post('/', EventController.store);
router.get('/myevents/:id', EventController.getByUser);


module.exports = router;

// 