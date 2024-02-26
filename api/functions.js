const moment = require('moment');
const { Parser } = require('json2csv');

function convertDate(urlDate) {
    let year = urlDate.substring(0, 4);
    let month = urlDate.substring(4, 6);
    let day = urlDate.substring(6, 8);
    return `${year}-${month}-${day}`
}

function getCurrentTimestamp() {
    return moment(new Date()).format("YYYY-MM-DD HH:MM:SS");
}

function formatIsCSV(req) {
    let format = req.query.format
    return format != null && format == "csv";
}

function formatIsJson(req) {
    let format = req.query.format
    return format == null || format == "json";
}

function sendFormattedResult(req, res, json) {
    if (json.length == 0) {
        res.status(402).send("402: No data found");
        return;
    }
    if (formatIsCSV(req))
        res.send(toCSV(json));
    else if (formatIsJson(req))
        res.send(json);
    else
        res.status(400).send("400: Bad request");
}


function toCSV(json) {
    function isArray(what) {
        return Object.prototype.toString.call(what) === '[object Array]';
    }

    var array = [];
    for (var i in json) {
        if (isArray(json[i])) array = json[i];
    }

    let dataToParse;
    let fields;
    //If there is no array inside the json, proceed with simple csv parse
    if (array.length == 0) {
        fields = Object.keys(json);
        dataToParse = json;
    } else {
        // Find the json array, get its fields and concat with the simple scenario. (data is duplicated)
        var outer = [];
        Object.keys(json).forEach((prop) => {
            if (!isArray(json[prop])) {
                outer.push({
                    [prop]: json[prop]
                });
            }
        });

        const result = [];
        for (let i = 0; i < array.length; i++) {
            let path = JSON.parse(JSON.stringify(array[i]));
            result.push(Object.assign({}, ...outer, path));
        }

        fields = Object.keys(result[0]);
        dataToParse = result;
    }

    // Parse to csv
    try {
        const parser = new Parser({ fields });
        return parser.parse(dataToParse);
    } catch (err) {
        console.error(err);
    }
}

module.exports = { convertDate, getCurrentTimestamp, sendFormattedResult };