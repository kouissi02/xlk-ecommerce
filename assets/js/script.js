// function resizeCenterItem() {
//   const container = $(".owl-section-carousel");
//   const stage = container.find('.owl-stage');
//   const items = container.find('.owl-item');
//   const containerWidth = container.width();

//   items.css('width', ''); // reset width
//   const containerNoMarge = containerWidth;
//   items.each(function () {
//     const item = $(this);
//     if (item.hasClass('center')) {
//       item.width(containerNoMarge * 0.38); // 38% pour l'item central
//     } else{
//       item.width(containerNoMarge * 0.31); // 31% pour les autres visibles
//     }
//   });
// }
  // onInitialized: resizeCenterItem,
  // onTranslated: resizeCenterItem,
  // onResized: resizeCenterItem

$(".owl-section-carousel").owlCarousel({
  margin : 30,
  loop: false,
  nav: false,
  center: true,
  autoWidth: false,
  startPosition: 1,
  touchDrag:false,
  responsive: {
    0: { items: 1 },
    600: { items: 1 },
    1000: { items: 3 }
  },

});

$(document).ready(function(){
  $(document).on("click",".open-section",function(){
    $(this).parent(".categorie-slide:first").find(".section-wrapper").removeClass("d-none");
  })
  $(document).on("click", ".close-section", function () {
  $(this).closest(".section-wrapper").addClass("d-none");
});
})