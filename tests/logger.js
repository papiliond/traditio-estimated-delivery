const { getEstimatedDelivery, getEstimatedDeliveryLabel } = require("../assets/utils");

const logger = (no, { startDate, holidays, deliveryInDays, deadlineTime, expectedResult, expectedLabel }) => {
  const estimatedDelivery = getEstimatedDelivery(deliveryInDays, deadlineTime, holidays, startDate);
  const label = getEstimatedDeliveryLabel(estimatedDelivery, deadlineTime, startDate);

  const endDate = new Date(startDate);
  endDate.setDate(startDate.getDate() + estimatedDelivery);

  const passed = expectedResult.getTime() === endDate.getTime() && expectedLabel === label;
  const format = passed ? "\x1b[32m%s\x1b[0m" : "\x1b[31m%s\x1b[0m";

  console.log(format, `### TEST CASE ${no} ###`);
  // console.log(format, "Start date: " + startDate.toString());
  // console.log(format, "Holidays: " + holidays);
  // console.log(format, "Delivery in days: " + deliveryInDays);

  if (!passed) {
    console.log(format, "Expected result: " + expectedResult);
    console.log(format, "Got: " + endDate);
    console.log(format, "Expected label: " + expectedLabel);
    console.log(format, "Got: " + label);
  } else {
    console.log(format, "PASSED");
  }

  return passed;
};

module.exports = logger;
