const express = require('express');
const cors = require('cors');
const app = express();
const panitiaRoutes = require('./routes/panitiaRoutes');
const db = require('./db'); 
const path = require('path');

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true })); 

// Route utama
app.get('/', (req, res) => {
  res.send('🎉 Backend Event Organizer jalan!');
});

// Route Panitia
app.use('/panitia', panitiaRoutes);

// Route Event
const eventRoutes = require('./routes/eventRoutes');
app.use('/', eventRoutes);

app.use('/uploads', express.static(path.join(__dirname, 'uploads')));

app.listen(3000, () => {
    console.log('Server running on http://localhost:3000');
});
