function getEstimatedDelivery(deliveryInDays, deadlineTime, holidays = []) {
  const startDate = new Date();

  if (!getIsHoliday(startDate, holidays) && !getIsWeekend(startDate) && isAfterDeadline(startDate, deadlineTime)) {
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
  return holidays.some((strDate) => normalizeStrDate(strDate) === toStrDate(date));
}

function normalizeStrDate(strDate) {
  return strDate.trim().replace("\r", "");
}

function getIsWeekend(date) {
  return date.getDay() === 6;
}

function toStrDate(date) {
  return new Intl.DateTimeFormat("en", { year: "2-digit", day: "2-digit", month: "2-digit" }).format(date);
}

function toStrTime(date) {
  return new Intl.DateTimeFormat("en", { timeStyle: "short" }).format(date);
}

function parseStrTime(str) {
  return new Date("1970-01-01T" + str + "Z");
}

function isAfterDeadline(date, deadlineTime) {
  const startTime = toStrTime(date);
  return parseStrTime(deadlineTime).getTime() < parseStrTime(startTime).getTime();
}

function formatToHungarian(date) {
  const en = [4, 5, 7, 9, 0, 11, 12];
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

function getEstimatedDeliveryLabel(estimatedDelivery, deadlineTime) {
  let label = "";
  if (estimatedDelivery === 2 && !getIsWeekend(new Date()) && !isAfterDeadline(new Date(), deadlineTime)) {
    label = "holnap";
  } else if (estimatedDelivery === 2 || estimatedDelivery === 3) {
    label = "holnapután";
  } else {
    const deliveryDate = new Date();
    deliveryDate.setDate(deliveryDate.getDate() + estimatedDelivery);
    label = formatToHungarian(deliveryDate);
  }

  return label;
}
