@extends('layouts.app')

@section('content')
<div class="container">
<h2>商品新規登録画面</h2>
<form method="post" action="{{ route('product.store') }}">
@csrf
        <div><label>商品名</label> <input type="text" name="product_name" id="product_name" value="{{ old('product_name') }}">
        @if($errors->has('product_name'))
                        <p>{{ $errors->first('product_name') }}</p>
                    @endif</div>
        <div><label>メーカー名</label> <select type="text" name="company_name" id="company_name" size="1" value="{{ old('company_name') }}">
        <option value="" selected disabled>メーカー名</option>
        @foreach ($company_lists as $company_list)
                <option>{{ $company_list->company_name }} </option>
                @endforeach
            </select>
            @if($errors->has('company_name'))
                        <p>{{ $errors->first('company_name') }}</p>
                    @endif
        </div>
        <div><label>価格</label> <input type="text" name="price" id="price" value="{{ old('price') }}">
        @if($errors->has('price'))
                        <p>{{ $errors->first('price') }}</p>
                    @endif</div>
        <div><label>在庫数</label> <input type="text" name="stock" id="stock" value="{{ old('stock') }}">
        @if($errors->has('stock'))
                        <p>{{ $errors->first('stock') }}</p>
                    @endif</div>
        <div><label>コメント</label> <textarea name="comment" id="comment" value="{{ old('comment') }}"></textarea></div>
        <div><label>商品画像</label> <input type="file" name="img_path"></div>
        <div><button type="submit">新規登録</button><button type="button" onclick="location.href='{{ route('product.index') }}'">戻る</button></div>
    </form>
</div>
@endsection
