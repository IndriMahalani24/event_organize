const express = require('express');
const QRCode = require('qrcode');
const cors = require('cors');

const app = express();
app.use(cors());

// Endpoint: /api/qr?text=YOUR_TEXT
app.get('/api/qr', async (req, res) => {
    const text = req.query.text;
    if (!text) return res.status(400).send('Missing text query');

    try {
        const qr = await QRCode.toDataURL(text);
        res.json({ qr });
    } catch (err) {
        res.status(500).send('QR generation failed');
    }
});

const PORT = 3001;
app.listen(PORT, () => console.log(`QR API running on http://localhost:${PORT}`));