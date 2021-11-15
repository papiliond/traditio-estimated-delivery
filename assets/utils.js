function getEstimatedDelivery(deliveryInDays, deadlineTime, holidays = [], startDate = new Date()) {
  if (!getIsHoliday(startDate, holidays) && !getIsWeekend(startDate) && isAfterDeadline(startDate, deadlineTime)) {
    startDate.setDate(startDate.getDate() + 1);
  }

  let daysNeeded = getDaysNeeded(startDate, holidays, deliveryInDays);

  const endDate = new Date(startDate);
  endDate.setDate(endDate.getDate() + (daysNeeded - 1));
  if (!getIsHoliday(endDate, holidays) && !getIsWeekend(endDate)) {
    daysNeeded -= 1;
  }

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

function getEstimatedDeliveryLabel(estimatedDelivery, deadlineTime, startDate = new Date()) {
  let label = "";
  if (estimatedDelivery === 2 && !getIsWeekend(startDate) && !isAfterDeadline(startDate, deadlineTime)) {
    label = "holnap";
  } else if (estimatedDelivery === 2 || estimatedDelivery === 3) {
    label = "holnapután";
  } else {
    const deliveryDate = startDate;
    deliveryDate.setDate(deliveryDate.getDate() + estimatedDelivery);
    label = formatToHungarian(deliveryDate);
  }

  return label;
}

// Utility functions

function getIsHoliday(date, holidays) {
  return holidays.some((strDate) => normalizeStrDate(strDate) === toStrDate(date));
}

function normalizeStrDate(strDate) {
  return strDate.trim().replace("\r", "");
}

function getIsWeekend(date) {
  return date.getDay() === 6 || date.getDay() === 0;
}

function toStrDate(date) {
  return new Intl.DateTimeFormat("en", { year: "2-digit", day: "2-digit", month: "2-digit" }).format(date);
}

function toStrTime(date) {
  return new Intl.DateTimeFormat("en", { timeStyle: "short", hour12: false }).format(date);
}

function parseStrTime(str) {
  return new Date("1970-01-01T" + str + "Z");
}

function isAfterDeadline(date, deadlineTime) {
  const startTime = toStrTime(date);
  return parseStrTime(deadlineTime).getTime() < parseStrTime(startTime).getTime();
}

function formatToHungarian(date) {
  const en = [4, 5, 7, 9, 0, 11, 12, 21, 22, 31];
  const jen = [1];
  const an = [2, 3, 6, 8];

  const getEndsWith = (date, array) => array.some((end) => String(date.getDate()).endsWith(String(end)));

  let suffix = "";
  if (getEndsWith(date, en)) {
    suffix = "-én";
  } else if (getEndsWith(date, jen)) {
    suffix = "-jén";
  } else if (getEndsWith(date, an)) {
    suffix = "-án";
  }

  return Intl.DateTimeFormat("hu", { month: "long", day: "numeric" }).format(date).replace(".", "") + suffix;
}

// module.exports = { getEstimatedDelivery, getEstimatedDeliveryLabel };
