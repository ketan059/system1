<!DOCTYPE HTML>  
<html lang="ja">  
<head>
<link rel="stylesheet" href="{{asset('/css/style.css')}}">
<script src="{{ asset('/js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="index__main__container">
<h1>商品一覧画面</h1>
<div class="index__search">
    <form action="{{ route('product.index') }}" method="GET">

    @csrf
            <input type="text" name="keyword" placeholder="検索キーワード">
            <select type="text" name="company" size="1">
            <option value="" selected disabled>メーカー名</option>
                @foreach ($company_lists as $company_list)
                <option value="{{ $company_list->id }}" id="company_id">{{ $company_list->company_name }} </option>
                @endforeach
            </select>
            <input class="index__search__btn" type="submit" value="検索">
        </form>
</div>
    <table class="index__main__table">
     <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th><button type="button" class="index__create__btn" onclick="location.href='{{ route('showList.create') }}'">{{ __('新規登録') }}</button></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><img src="{{ asset($product->img_path) }}" class="index__main__table__img"></td>
            <td>{{ $product->product_name }}</td>
            <td>￥{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company_name }}</td>
            <td class="index__main__td__btn"><button class="index__detail__btn" type="button" onclick="location.href='{{ route('showList.detail', ['id'=>$product->id]) }}'">{{ __('詳細') }}</button>
            <form class="index__main__form" action="{{ route('product.delete', ['id'=>$product->id]) }}" method="POST">
          @csrf
          <button class="index__delete__btn" type="submit" onClick="delete_alert(event);return false;">削除</button>
        </form>
        @endforeach
        </td>
        </tr>
    </tbody>
  </table>
</div>
