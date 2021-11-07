function getEstimatedDeliveryDisplay() {
  const estimatedDelivery = window.__ESTIMATED_DELIVERY__;

  const deliveryDate = new Date();
  deliveryDate.setDate(deliveryDate.getDate() + estimatedDelivery);
  const label = formatToHungarian(deliveryDate);

  return `Csomagod várhatóan <span class="estimatedDelivery-days-label">${label}</span> érkezik.`;
}
