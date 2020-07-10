$(function() {
  // カテゴリ検索
  $('.category-link').on('click', function (e) {
    e.preventDefault();
    var category_id = $(this).attr('id');
    $('#category-val').val(category_id);
    $('.post-form').submit();
  });

  // ソート
  $('.sort-link').on('click', function (e) {
    e.preventDefault();
    var sort_id = $(this).attr('id');
    $('#sort-val').val(sort_id);
    $('.post-form').submit();
  });

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
      $.each(data[1], function(key, value) {
        $('#children').append($('<option>').text(value.name).attr('value', value.id));
      })
    })
    .fail(function() {
      console.log('失敗');
    }); 
  });

  // セレクトボックスの連動、編集ページの場合
  if ($('#parent').val()) {
    var cate_val = $('#parent').val();
    var path = location.pathname;
    // postsテーブルのidをurlパスから取得
    var post_id = path.replace(/[^\d]/g, '');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/fetch/category/',
      type: 'POST',
      data: { 'category_val': cate_val, 'post_id': post_id },
      datatype: 'json',
    })
    .done(function (data) {
      $('#children option').remove();
      $.each(data[1], function (key, value) {
        $('#children').append($('<option>').text(value.name).attr('value', value.id));
      });
      // DBのサブカテゴリを選択状態に
      $(`#children option[value=${data[0].sub_category_id}]`).prop('selected', true);
    })
    .fail(function () {
      console.log('失敗');
    }); 
  }

  $('#delete').on('click', function () {
    if (!window.confirm('本当に削除しますか？')) {
      window.alert('キャンセルされました');
      return false;
    }
    document.deleteform.submit();
  })


});
