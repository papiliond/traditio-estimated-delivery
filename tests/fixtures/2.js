module.exports = [
    {
      startDate: new Date("2021-11-08T12:00:00"),
      holidays: ["11/08/21", "11/09/21", "11/10/21", "11/11/21"],
      deadlineTime: "13:00",
      deliveryInDays: 2,
      expectedResult: new Date("2021-11-15T12:00:00"),
    },
    {
      startDate: new Date("2021-11-08T14:00:00"),
      holidays: ["11/08/21", "11/09/21", "11/10/21", "11/11/21"],
      deadlineTime: "13:00",
      deliveryInDays: 2,
      expectedResult: new Date("2021-11-15T14:00:00"),
    },
    {
      startDate: new Date("2021-11-09T11:00:00"),
      holidays: ["11/08/21", "11/09/21", "11/10/21", "11/11/21"],
      deadlineTime: "13:00",
      deliveryInDays: 2,
      expectedResult: new Date("2021-11-15T11:00:00"),
    },
    {
      startDate: new Date("2021-11-10T11:00:00"),
      holidays: ["11/08/21", "11/09/21", "11/10/21", "11/11/21"],
      deadlineTime: "13:00",
      deliveryInDays: 2,
      expectedResult: new Date("2021-11-15T11:00:00"),
    },
    {
      startDate: new Date("2021-11-10T14:00:00"),
      holidays: ["11/08/21", "11/09/21", "11/10/21", "11/11/21"],
      deadlineTime: "13:00",
      deliveryInDays: 2,
      expectedResult: new Date("2021-11-15T14:00:00"),
    },
  ];
  