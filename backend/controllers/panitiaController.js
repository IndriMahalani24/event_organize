const bcrypt = require('bcrypt');
const Panitia = require('../model/panitia');
const db = require('../db');

const index = (req, res) => {
    const panitia = new Panitia();
    res.send("Panitia route");
    panitia.all()
        .then((data) => res.json(data))
        .catch((err) => res.status(500).json({ error: err.message }));
};

const store = async (req, res) => {
    const { name, email, password, divisi, role_id } = req.body;

    try {
        // hash password dulu sebelum masuk ke DB
        const hashedPassword = await bcrypt.hash(password, 10);

        // masukkan ke tabel user
        const sqlUser = 'INSERT INTO user (name, email, password, role_id) VALUES (?, ?, ?, ?)';
        db.query(sqlUser, [name, email, hashedPassword, role_id], (err, result) => {
            if (err) return res.status(500).json({ error: err });

            const userId = result.insertId;

            // insert ke tabel panitia
            const sqlPanitia = 'INSERT INTO panitia (divisi, users_id) VALUES (?, ?)';
            db.query(sqlPanitia, [divisi, userId], (err2, result2) => {
                if (err2) return res.status(500).json({ error: err2 });

                res.status(201).json({ message: 'Panitia berhasil ditambahkan' });
            });
        });
    } catch (error) {
        return res.status(500).json({ error: error.message });
    }
};

// Ambil panitia event (selain keuangan)
const getEventPanitia = (req, res) => {
  const sql = `
    SELECT u.id, u.name, u.email, p.divisi 
    FROM user u 
    JOIN panitia p ON u.id = p.users_id 
    WHERE u.role_id = 2 
  `;
  db.query(sql, (err, results) => {
    if (err) return res.status(500).json({ error: err });
    res.json(results);
  });
};

// Ambil panitia keuangan
const getKeuanganPanitia = (req, res) => {
  const sql = `
    SELECT u.id, u.name, u.email, p.divisi 
    FROM user u 
    JOIN panitia p ON u.id = p.users_id 
    WHERE u.role_id = 3
  `;
  db.query(sql, (err, results) => {
    if (err) return res.status(500).json({ error: err });
    res.json(results);
  });
};

const update = (req, res) => {
    const id = req.params.id;
    const { name, password, divisi } = req.body;

    console.log("UPDATE PANITIA");
    console.log("ID:", id);
    console.log("Request body:", req.body);
    
    const sqlGet = 'SELECT password FROM user WHERE id = ?';
    db.query(sqlGet, [id], (err, result) => {
        if (err || result.length === 0) {
            console.error("Error SELECT:", err);
            return res.status(500).json({ error: 'User tidak ditemukan' });
        }

        const currentPassword = result[0].password;

        if (password === currentPassword) {
            console.log("Password sama, tidak perlu hash.");
            updateData(id, name, password, divisi, res); 
        } else {
            console.log("Password beda, lakukan hash...");
            bcrypt.hash(password, 10, (errHash, hashedPassword) => {
                if (errHash) {
                    console.error("Hashing error:", errHash);
                    return res.status(500).json({ error: errHash });
                }
                updateData(id, name, hashedPassword, divisi, res);
            });
        }
    });
};


function updateData(id, name, hashedPassword, divisi, res) {
    console.log("Updating user:", { id, name, hashedPassword, divisi });

    const sqlUser = 'UPDATE user SET name = ?, password = ? WHERE id = ?';
    db.query(sqlUser, [name, hashedPassword, id], (err) => {
        if (err) {
            console.error("Error update user:", err);
            return res.status(500).json({ error: err });
        }

        const sqlPanitia = 'UPDATE panitia SET divisi = ? WHERE users_id = ?';
        db.query(sqlPanitia, [divisi, id], (err2) => {
            if (err2) {
                console.error("Error update panitia:", err2);
                return res.status(500).json({ error: err2 });
            }

            res.json({ message: 'Panitia berhasil diupdate' });
        });
    });
}



const getById = (req, res) => {
    const id = req.params.id;
    const sql = `
        SELECT u.id, u.name, u.email, p.divisi
        FROM user u
        JOIN panitia p ON u.id = p.users_id
        WHERE u.id = ?
    `;
    db.query(sql, [id], (err, results) => {
        if (err) return res.status(500).json({ error: err });
        if (results.length === 0) return res.status(404).json({ error: "Panitia not found" });
        res.json(results[0]);
    });
};

const destroy = (req, res) => {
    const panitia = new Panitia();
    const id = req.params.id;

    panitia.delete(id)
        .then((result) => res.json(result))
        .catch((err) => res.status(500).json({ error: err.message }));
};




module.exports = { index, store, getEventPanitia,
  getKeuanganPanitia, update, getById, destroy  };
