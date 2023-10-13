@extends('layouts.app')

@section('content')
<div class="container">
    <div>
    <form action="{{ route('product.index') }}" method="GET">

    @csrf

            <input type="text" name="keyword" placeholder="検索キーワード">
            <select type="text" name="company" size="1">
            <option value="" selected disabled>メーカー名</option>
                @foreach ($company_lists as $company_list)
                <option value="{{ $company_list->company_name }}" @if(old('company') == $company_list->company_name) selected @endif>{{ $company_list->company_name }} </option>
                @endforeach
            </select>
            <input type="submit" value="検索">
        </form>
    <table>
     <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th><button type="button" class="btn btn-primary" onclick="location.href='{{ route('showList.create') }}'">{{ __('新規登録') }}</button></th>
        </tr>
    </thead>
    <tbody>
    @forelse ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->img_path }}</td>
            <td>{{ $product->product_name }}</td>
            <td>￥{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company_name }}</td>
            <td><button type="button" onclick="location.href='{{ route('showList.detail', ['id'=>$product->id]) }}'">{{ __('詳細') }}</button></td>
        </tr>
        @empty
        <p>No data</p>
    @endforelse
    </tbody>
  </table>
    </div>
</div>
@endsection
