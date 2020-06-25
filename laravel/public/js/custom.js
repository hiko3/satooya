$(function() {
  // カテゴリ検索用
  $('.search-wrap .nav-link').on('click', function (e) {
    e.preventDefault();
    var category_id = $(this).attr('id');
    $('#category-val').val(category_id);
    $('.post-form').submit();
  });

  // タブのアクティブ切り替え
  const params = new URLSearchParams(location.search);
  const categoryId = params.get("tag_category_id");
  if (categoryId) {
    $('.nav-link').removeClass("active");
    $('#' + categoryId).addClass("active");
  }

  
    $('#js-multiple').select2({
      placeholder: "都道府県を選択",
    });


});
