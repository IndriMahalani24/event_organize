const db = require('../db');

class Panitia {
    all() {
        return new Promise((resolve, reject) => {
            const sql = `
                SELECT panitia.*, user.name, user.email
                FROM panitia
                JOIN user ON panitia.users_id = user.id
            `;
            db.query(sql, (err, results) => {
                if (err) return reject(err);
                resolve(results);
            });
        });
    }

    save(data) {
        return new Promise((resolve, reject) => {
            const insertUser = `
                INSERT INTO user (name, email, password, role_id)
                VALUES (?, ?, ?, ?)
            `;
            const defaultRoleId = 2; // Role ID untuk panitia

            db.query(insertUser, [data.name, data.email, data.password, defaultRoleId], (err, userResult) => {
                if (err) return reject(err);

                const userId = userResult.insertId;

                const insertPanitia = `
                    INSERT INTO panitia (divisi, users_id)
                    VALUES (?, ?)
                `;
                db.query(insertPanitia, [data.divisi, userId], (err, panitiaResult) => {
                    if (err) return reject(err);
                    resolve({
                        message: "Panitia berhasil ditambahkan",
                        panitia_id: panitiaResult.insertId,
                        user_id: userId
                    });
                });
            });
        });
    }

    update(id, data) {
        return new Promise((resolve, reject) => {
            const updateUser = `UPDATE user SET name = ?, email = ? WHERE id = ?`;
            db.query(updateUser, [data.name, data.email, id], (err) => {
                if (err) return reject(err);

                const updatePanitia = `UPDATE panitia SET divisi = ? WHERE users_id = ?`;
                db.query(updatePanitia, [data.divisi, id], (err) => {
                    if (err) return reject(err);
                    resolve({ message: "Data panitia berhasil diperbarui" });
                });
            });
        });
    }

    delete(id) {
        return new Promise((resolve, reject) => {
            const deletePanitia = `DELETE FROM panitia WHERE users_id = ?`;
            db.query(deletePanitia, [id], (err) => {
                if (err) return reject(err);

                const deleteUser = `DELETE FROM user WHERE id = ?`;
                db.query(deleteUser, [id], (err) => {
                    if (err) return reject(err);
                    resolve({ message: "Panitia dan user berhasil dihapus" });
                });
            });
        });
    }
}

module.exports = Panitia;
