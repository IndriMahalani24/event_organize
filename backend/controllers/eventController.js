const Event = require('../model/event');
const event = new Event();
const db = require('../db');

const index = (req, res) => {
    event.all()
        .then(data => res.json(data))
        .catch(err => res.status(500).json({ error: err.message }));
};

const store = async (req, res) => {
    console.log("📥 req.body:", req.body);
    console.log("🖼 req.file:", req.file);
    const {
        name, description, location, max_participants,
        status, speaker, event_time, event_date,
        registration_fee, users_iduser
    } = req.body;

    // ambil file poster
    const poster = req.file ? req.file.filename : null;

    try {
        const sql = `INSERT INTO event (
            name, description, location, max_participants, status,
            speaker, event_time, event_date, registration_fee, poster,
            created_at, updated_at, users_iduser
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)`;

        db.query(sql,  [
            name, description, location, max_participants, status,
            speaker, event_time, event_date, registration_fee, poster,
            users_iduser
        ], (err, result) => {
            if (err) {
                console.error("❌ Gagal insert event:", err);
                return res.status(500).json({ error: err.message });
            }

            return res.status(201).json({
                message: 'Event berhasil ditambahkan',
                eventId: result.insertId
            });
        });
    } catch (error) {
        return res.status(500).json({ error: error.message });
    }
};

const getById = (req, res) => {
    const id = req.params.id;
    const sql = 'SELECT * FROM event WHERE id = ?';

    db.query(sql, [id], (err, results) => {
        if (err) return res.status(500).json({ error: err.message });

        if (results.length === 0) {
            return res.status(404).json({ message: 'Event tidak ditemukan' });
        }

        res.json(results[0]);
    });
};


const getByUser = (req, res) => {
    const userId = req.params.id;
    const sql = 'SELECT * FROM event WHERE users_iduser = ?';
    db.query(sql, [userId], (err, results) => {
        if (err) return res.status(500).json({ error: err });
        res.json(results);
    });
};

const update = (req, res) => {
    const id = req.params.id;
    const { name, description, location, max_participants, status, speaker, event_time, event_date,registration_fee  } = req.body;

    const poster = req.file ? req.file.filename : null;

    const fields = [
        'name', 'description', 'location', 'max_participants',
        'status', 'speaker', 'event_time', 'event_date', 'registration_fee'
    ];
    const values = [
        name, description, location, max_participants,
        status, speaker, event_time, event_date, registration_fee
    ];

    if (poster) {
        fields.push('poster');
        values.push(poster);
    }

    const setClause = fields.map(field => `${field} = ?`).join(', ');
    const sql = `UPDATE \`event\` SET ${setClause} WHERE id = ?`;
    values.push(id); 

    db.query(sql, values, (err, result) => {
        if (err) return res.status(500).json({ error: err });
        res.json({ message: 'Event berhasil diupdate', result });
    });
};

const destroy = (req, res) => {
    const id = req.params.id;
    const sql = 'DELETE FROM event WHERE id = ?';

    db.query(sql, [id], (err, result) => {
        if (err) return res.status(500).json({ error: err.message });
        res.json({ message: 'Event berhasil dihapus', result });
    });
};


module.exports = { index, store, getById, getByUser, update, destroy  };
