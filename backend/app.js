const express = require('express');
const cors = require('cors');
const app = express();
const panitiaRoutes = require('./routes/panitiaRoutes');
const db = require('./db'); // koneksi MySQL

// Middleware
app.use(cors());
app.use(express.json());

// Route utama
app.get('/', (req, res) => {
  res.send('🎉 Backend Event Organizer jalan!');
});

// Route Panitia
app.use('/panitia', panitiaRoutes);

app.listen(3000, () => {
    console.log('Server running on http://localhost:3000');
});
