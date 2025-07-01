const Event = require('../model/event');
const event = new Event();

const index = (req, res) => {
    event.all()
        .then(data => res.json(data))
        .catch(err => res.status(500).json({ error: err.message }));
};

const store = (req, res) => {
    const { name, description, location, max_participants, status, speaker, event_time, event_date, registration_fee, users_iduser } = req.body;

    event.create({ name, description, location, max_participants, status, speaker, event_time, event_date, registration_fee, users_iduser })
        .then(result => res.json({ message: 'Event berhasil ditambahkan', result }))
        .catch(err => res.status(500).json({ error: err.message }));
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

    const sql = `
        UPDATE event 
        SET name = ?, description = ?, location = ?, max_participants = ?, status = ?, speaker = ?, event_time = ?, event_date = ?, registration_fee = ?
        WHERE id = ?
    `;

    db.query(sql, [
        name, description, location, max_participants, status, speaker, event_time, event_date, registration_fee, id
    ], (err, result) => {
        if (err) return res.status(500).json({ error: err });
        res.json({ message: 'Event berhasil diupdate', result });
    });
};


module.exports = { index, store, getByUser, update };
