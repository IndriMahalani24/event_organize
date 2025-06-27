const mysql = require('mysql2');

// Koneksi langsung
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'dbpertama'
});

// Cek koneksi
connection.connect((err) => {
    if (err) {
        console.error('❌ Gagal konek ke database:', err.message);
    } else {
        console.log('✅ Koneksi ke database berhasil!');
    }
});

module.exports = connection;
