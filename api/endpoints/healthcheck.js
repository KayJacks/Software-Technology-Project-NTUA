const mysql = require('mysql');
const express = require('express');
const router = express.Router();
const host_name = process.env.HOST_NAME || 'localhost';

function healthcheck(req,res) {
    const sqlConfig = {
        host: host_name,
        user: "root",
        password: "",
        database: "tolls_db"
    };

    const connection = mysql.createConnection(sqlConfig);

    let sqlConfigList = {
        host: sqlConfig.host,
        user: sqlConfig.user,
        databaseName: sqlConfig.database
    }
    connection.connect((err) => {
        let resultJson = {
            status: "failed",
            dbconnection: sqlConfigList
        };
        if (err) {
            res.send(resultJson);
            throw err;
        }
        else {
            resultJson = {
                status: "OK",
                dbconnection: sqlConfigList
            };
            res.send(resultJson);
        }
    });
}

router.get('/admin/healthcheck', healthcheck)
module.exports = router;
