module.exports = [
  {
    startDate: new Date("2021-11-08T12:00:00"),
    holidays: [],
    deadlineTime: "13:00",
    deliveryInDays: 2,
    expectedResult: new Date("2021-11-09T12:00:00"),
  },
  {
    startDate: new Date("2021-11-08T14:00:00"),
    holidays: [],
    deadlineTime: "13:00",
    deliveryInDays: 2,
    expectedResult: new Date("2021-11-10T14:00:00"),
  },
];
