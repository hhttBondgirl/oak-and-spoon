@extends('layouts.app')

@section('content')
    <div class="confirm-container">
        <h2>注文確認</h2>

        @if ($errors->any())
            <ul class="form-errors" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <ul>
            @foreach($orderItems as $item)
                <li>{{ $item['name'] }} × {{ $item['qty'] }}個 = ¥{{ number_format($item['subtotal']) }}</li>
            @endforeach
        </ul>
        <p>合計金額: ¥{{ number_format($total) }}</p>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            @foreach ($orderItems as $item)
                <input type="hidden" name="counts[{{ $item['id'] }}]" value="{{ $item['qty'] }}">
            @endforeach
            <div>
                <button type="submit" class="order-button">注文を確定する</button>
            </div>
        </form>

    </div>

    <div class="back-link">
        <a href="{{ route('orders.index') }}">← メニュー一覧へ</a>
    </div>
@endsection