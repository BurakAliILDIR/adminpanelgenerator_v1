// metin girişi engelleyici
$(function () {
  $('[data-mask="only_number"]').on('input',
    function (e) {
      $(this).val($(this).val().replace(/[^0-9\.,]/g, ''));
    });
});
