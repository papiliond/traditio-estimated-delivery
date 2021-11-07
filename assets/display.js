function getEstimatedDeliveryDisplay() {
  const deadlineTime = window.__ESTIMATED_DEADLINE_TIME__;
  const estimatedDelivery = window.__ESTIMATED_DELIVERY__;

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

  return `Ha most rendelsz, csomagod várhatóan <span class="estimatedDelivery-days-label">${label}</span> érkezik.`;
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
