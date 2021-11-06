function getEstimatedDelivery(deliveryInDays, deadlineTime, holidays = []) {
  const startDate = new Date();
  const startTime = toStrTime(startDate);

  if (!getIsHoliday(startDate, holidays) && !getIsWeekend(startDate) && parseStrTime(deadlineTime).getTime() < parseStrTime(startTime).getTime()) {
    startDate.setDate(startDate.getDate() + 1);
  }

  const deliveryDates = [];
  for (let i = 0; i < deliveryInDays; i++) {
    const date = new Date(startDate);
    date.setDate(date.getDate() + i);
    deliveryDates.push(date);
  }

  let daysNeeded = getDaysNeeded(startDate, holidays, deliveryInDays);

  return daysNeeded;
}


// Calculates days needed to delivery related to 'startDate'
function getDaysNeeded(startDate, holidays, neededMore) {
  if (!neededMore) {
    return 0;
  }

  let nextDate = new Date(startDate);
  nextDate.setDate(nextDate.getDate() + 1);

  const isHolidayOrWeekend = getIsHoliday(startDate, holidays) || getIsWeekend(startDate);

  return 1 + getDaysNeeded(nextDate, holidays, isHolidayOrWeekend ? neededMore : neededMore - 1);
}

// Utility functions

function getIsHoliday(date, holidays) {
  return holidays.some((strDate) => strDate.trim() === toStrDate(date));
}

function getIsWeekend(date) {
  return date.getDay() === 6 || date.getDay() === 0;
}

function toStrDate(date) {
  return new Intl.DateTimeFormat("en-GB", { year: "2-digit", day: "2-digit", month: "2-digit" }).format(date);
}

function toStrTime(date) {
  return new Intl.DateTimeFormat("en-GB", { timeStyle: "short" }).format(date);
}

function parseStrTime(str) {
  return new Date("1970-01-01T" + str + "Z");
}
