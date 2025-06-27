const Panitia = require('../models/Panitia');

const index = (req, res) => {
    const panitia = new Panitia();
    panitia.all()
        .then((data) => res.json(data))
        .catch((err) => res.status(500).json({ error: err.message }));
};

const store = (req, res) => {
    const panitia = new Panitia();
    const { name, email, password, divisi } = req.body;

    if (!name || !email || !password || !divisi) {
        return res.status(400).json({ error: "Semua field wajib diisi." });
    }

    panitia.save({ name, email, password, divisi })
        .then((result) => res.status(201).json(result))
        .catch((err) => res.status(500).json({ error: err.message }));
};

const update = (req, res) => {
    const panitia = new Panitia();
    const id = req.params.id;
    const { name, email, divisi } = req.body;

    if (!name || !email || !divisi) {
        return res.status(400).json({ error: "Field tidak boleh kosong." });
    }

    panitia.update(id, { name, email, divisi })
        .then((result) => res.json(result))
        .catch((err) => res.status(500).json({ error: err.message }));
};

const destroy = (req, res) => {
    const panitia = new Panitia();
    const id = req.params.id;

    panitia.delete(id)
        .then((result) => res.json(result))
        .catch((err) => res.status(500).json({ error: err.message }));
};

module.exports = { index, store, update, destroy };
