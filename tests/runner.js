const fs = require("fs");
const path = require("path");
const logger = require("./logger");

const testFolder = path.resolve(__dirname, "./fixtures");

function run() {
  fs.readdirSync(testFolder).forEach((file) => {
    const fixtures = require(path.resolve(__dirname, "./fixtures/" + file));

    const passed = fixtures.map((fixture, i) => logger(i + 1, fixture)).every((t) => t);

    const format = passed ? "\x1b[32m%s\x1b[0m" : "\x1b[31m%s\x1b[0m";
    console.log(format, "\n###FIXTURE " + file + (passed ? " PASSED" : " FAILED") + "###\n");
  });
}

module.exports = run;
