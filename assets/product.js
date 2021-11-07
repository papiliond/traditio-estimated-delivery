function getEstimatedDeliveryDisplay() {
  const deadlineTime = window.__ESTIMATED_DEADLINE_TIME__;
  const estimatedDelivery = window.__ESTIMATED_DELIVERY__;

  return `Ha most rendelsz, csomagod várhatóan <span class="estimatedDelivery-days-label">${getEstimatedDeliveryLabel(estimatedDelivery, deadlineTime)}</span> érkezik.`;
}
