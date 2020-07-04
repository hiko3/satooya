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

  // セレクト2
  $('#js-multiple').select2({
    placeholder: "都道府県を選択",
    width: "resolve"
  });

  // セレクトボックスの連動
  // カテゴリのselect要素が変更になるとイベントが発生
  $('#parent').change(function () {
    var cate_val = $(this).val();

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/fetch/category',
      type: 'POST',
      data: {'category_val' : cate_val},
      datatype: 'json',
    })
    .done(function(data) {
      $('#children option').remove();
      $.each(data, function(key, value) {
        $('#children').append($('<option>').text(value.name).attr('value', value.id));
      })
    })
    .fail(function() {
      console.log('失敗');
    }); 
    
  });


});
