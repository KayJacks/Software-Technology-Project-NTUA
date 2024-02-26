const express = require('express');
const router = express.Router();
var mysql = require('mysql');

var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    port: 3306,
    database:"tolls_db"
})

router.post('/admin/resetvehicles', (req, res) => {
    const queryRemove = `DELETE FROM vehicle;`
    con.query(queryRemove, (err, _) => {
        if (err) {
            console.error(err);
            res.send({ status: "failed" })
        } else {
            res.send({ status: "ok" })
        }
    })
});

module.exports = router;
