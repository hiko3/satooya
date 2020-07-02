$(function() {
  // カテゴリ検索用
  $('.search-wrap .category-link').on('click', function (e) {
    e.preventDefault();
    var category_id = $(this).attr('id');
    $('#category-val').val(category_id);
    $('.post-form').submit();
  });

  $('.search-wrap .sort-link').on('click', function (e) {
    e.preventDefault();
    var sort_id = $(this).attr('id');
    $('#sort-val').val(sort_id);
    $('.post-form').submit();
  })

  // カテゴリタブのアクティブ切り替え
  let params = new URLSearchParams(location.search);
  const categoryId = params.get("tag_category_id");
  if (categoryId) {
    $('.category-link').removeClass("active");
    $('#' + categoryId).addClass("active");
  }

  // ソートタブのアクティブ切り替え
  let = new URLSearchParams(location.search);
  const sortId = params.get("sort");
  if (sortId) {
    $('.sort-link').removeClass("active");
    $('#' + sortId).addClass("active");
  }

  
  $('#js-multiple').select2({
    placeholder: "都道府県を選択",
    width: "resolve"
  });

  $(window).on('resize', function() {
    $('form-group').each(function() {
      var formGroup = $(this),
        formgroupWidth = formGroup.outerWidth();
      formGroup.find('.select2-container').css('width', formgroupWidth);
    });
  });


});
