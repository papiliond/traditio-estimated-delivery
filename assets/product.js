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
