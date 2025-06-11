$(".owl-section-carousel").owlCarousel({
  items: 3,
  loop: false,
  margin: 30, // Augmenté pour l'espacement
  nav: false,
  center: true,
  responsive: {
    0: { items: 1 },
    600: { items: 1 },
    1000: { items: 3 }
  }
});

