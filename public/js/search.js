function destroy(){
    $('.index__delete__btn').on('click', function() {
        var deleteConfirm = confirm('削除しますか？');
        if(deleteConfirm == true) {
            var clickEle = $(this)
            var productID = clickEle.attr('data-product_id');
            var deleteTarget = clickEle.closest('tr');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: 'destroy',
                dataType: 'json',
                data: {'id': productID},
            })
            .done(function() {
                console.log('通信成功');
                deleteTarget.remove();
            })
            .fail(function() {
                console.log('通信失敗');
                alert('エラー');
            });
        }  else {
            (function(e) {
              e.preventDefault()
            });
        };
      });
    };

$(function() {
    $('#index__search__btn').on('click', function(e){
    e.preventDefault();
    var keyword = $('#keyword').val();
    var company = $('#company').val();
    var minPrice = $('#minPrice').val();
    var maxPrice = $('#maxPrice').val();
    var minStock = $('#minStock').val();
    var maxStock = $('#maxStock').val();
    console.log(keyword);
    console.log(company);
    console.log(minPrice);
    console.log(maxPrice);
    console.log(minStock);
    console.log(maxStock);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "search/",
        type: "GET",
        dataType: "json",
        data: { keyword : keyword,
                company : company,
                minPrice : minPrice,
                maxPrice : maxPrice,
                minStock : minStock,
                maxStock : maxStock }
    })
    .done(function(data){
            console.log('成功');
            console.log(data.price);
            console.log(data.stock);
            console.log(Array.isArray(data.products));
            console.log(data);
            var $result = $('#search_result')
            $result.empty();
            $.each(data.products, function (index, product) {
                console.log(data.products);
            var html = `
            <tr>
            <td>${product.id}</td>
            <td><img src="http://localhost/system1/public/${product.img_path}" class="index__main__table__img"></td>
            <td>${product.product_name}</td>
            <td>￥${product.price}</td>
            <td>${product.stock}</td>
            <td>${product.company_name}</td>
            <td class="index__main__td__btn"><button class="index__detail__btn" type="button" onclick="location.href='http://localhost/system1/public/detail${product.id}'">詳細</button>
            <button data-product_id="${product.id}" class="index__delete__btn" type="submit" >削除</button>
        </td>
        </tr>
            `;
        $result.append(html);
        destroy();
    });
    }).fail(function(){
        alert('通信の失敗をしました');
    });
});
});