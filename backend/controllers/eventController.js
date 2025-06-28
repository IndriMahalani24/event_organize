const Event = require('../model/event');
const event = new Event();

const index = (req, res) => {
    event.all()
        .then(data => res.json(data))
        .catch(err => res.status(500).json({ error: err.message }));
};

const store = (req, res) => {
    const { title, description, location, max_participants, status, speaker, event_time, event_date, users_iduser } = req.body;

    event.create({ title, description, location, max_participants, status, speaker, event_time, event_date, users_iduser })
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


module.exports = { index, store };
