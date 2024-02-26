const express = require('express');
const port = process.env.PORT || 8000;
const app = express();
var path = require('path');

app.listen(port, () => {
    console.log(`App is running on port ${port}!`);
});

app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname + '/index.html'));
});

// load all endpoints
const healthcheck = require("./endpoints/healthcheck.js");
const resetPasses = require("./endpoints/resetpasses.js");
const resetStations = require("./endpoints/resetstations.js");
const resetVehicles = require("./endpoints/resetvehicles.js");
const chargesBy = require("./endpoints/chargesBy.js");
const passesAnalysis = require("./endpoints/passesAnalysis.js");
const passesCost = require("./endpoints/passesCost.js");
const passesPerStation = require("./endpoints/passesPerStation.js");

//bind all endpoints to app router with base url
//router -> when the URL is modified somehow, it will detect that change and render the view that is associated with the new URL
app.use('/interoperability/api', healthcheck);
app.use('/interoperability/api', resetPasses);
app.use('/interoperability/api', resetStations);
app.use('/interoperability/api', resetVehicles);
app.use('/interoperability/api', chargesBy);
app.use('/interoperability/api', passesAnalysis);
app.use('/interoperability/api', passesCost);
app.use('/interoperability/api', passesPerStation);
app.use((err, req, res, next) => {
    console.error(err);
    res.status(500).send("500: Internal server error");
})
