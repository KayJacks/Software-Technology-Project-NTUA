const express = require('express');
const router = express.Router();
const { convertDate, getCurrentTimestamp, sendFormattedResult } = require('../functions');
var mysql = require('mysql');

var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    port: 3306,
    database:"tolls_db"
})

function chargesByQuery(op_ID, date_from, date_to) {
    let query = `
        SELECT
            tag.providerId as VisitingOperator,
            COUNT(tag.providerId) as NumberOfPasses,
            SUM(charge) as PassesCost
        FROM
            pass
            INNER JOIN station ON pass.stationRef = station.id
            INNER JOIN tag ON pass.vehicleRef = tag.vehicleId
        WHERE
            station.stationProvider = '${op_ID}'
            AND station.stationProvider != tag.providerId
            AND pass.timestamp BETWEEN '${date_from}' AND '${date_to}'
        GROUP BY tag.providerId;
    `;
    return query;
}

function chargesBy(req, res) {
    let requestTimestamp = getCurrentTimestamp();

    let op_ID = req.params.op_ID;
    let date_from = convertDate(`${req.params.date_from}`);
    let date_to = convertDate(`${req.params.date_to}`);

    let query = chargesByQuery(op_ID, date_from, date_to);
    con.query(query, (err, resultPPOList) => {
        if (err) {
            console.error(err);
            return res.status(500).send("Internal error");
        }
        let resultJson = {
            "op_ID": op_ID,
            "RequestTimestamp": requestTimestamp,
            "PeriodFrom": date_from,
            "PeriodTo": date_to,
            "PPOList": resultPPOList
        }
        if (resultPPOList.length == 0)
            res.status(402).send("Data not found");
        else
            sendFormattedResult(req, res, resultJson);
    });
}

router.get('/ChargesBy/:op_ID/:date_from/:date_to',chargesBy)
module.exports = router;
