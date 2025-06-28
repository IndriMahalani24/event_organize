const db = require('../db');

class Event {
    all() {
        return new Promise((resolve, reject) => {
            db.query('SELECT * FROM event', (err, results) => {
                if (err) return reject(err);
                resolve(results);
            });
        });
    }

    create(data) {
        const sql = `INSERT INTO event (title, description, location, max_participants, status, speaker, event_time, event_date, created_at, updated_at, users_iduser) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)`;
        return new Promise((resolve, reject) => {
            db.query(sql, [
                data.title,
                data.description,
                data.location,
                data.max_participants,
                data.status,
                data.speaker,
                data.event_time,
                data.event_date,
                data.users_iduser
            ], (err, result) => {
                if (err) return reject(err);
                resolve(result);
            });
        });
    }
}

module.exports = Event;
