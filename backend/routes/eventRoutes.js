const express = require('express');
const router = express.Router();
const EventController = require('../controllers/eventController');
const multer = require('multer');
const path = require('path');

const storage = multer.diskStorage({
    destination: 'uploads/',
    filename: (req, file, cb) => {
        cb(null, Date.now() + path.extname(file.originalname));
    }
});

const upload = multer({ storage });

router.get('/event/user/:id', EventController.getByUser);     
router.get('/event/:id', EventController.getById);            

router.post('/event/user', upload.single('poster'), EventController.store);
router.put('/event/user/:id', upload.single('poster'), EventController.update);
router.delete('/event/:id', EventController.destroy);

module.exports = router;
