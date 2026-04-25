@extends('layouts.app')

@section('slider')
    <div class="main-slider">
        <div class="slider-item">
            <img src="{{ asset('images/slider1.jpg') }}" loading="lazy" alt="Oak & Spoon">
            <div class="slider-content">
                <h2>Oak & Spoon</h2>
                <p>森に溶け込む、小さなカフェ</p>
            </div>
        </div>
        <div class="slider-item">
            <img src="{{ asset('images/slider2.jpg') }}" loading="lazy" alt="Oak & Spoon">
            <div class="slider-content">
                <h2>Oak & Spoon</h2>
                <p>森に溶け込む、小さなカフェ</p>
            </div>
        </div>
        <div class="slider-item">
            <img src="{{ asset('images/slider3.jpg') }}" loading="lazy" alt="Oak & Spoon">
            <div class="slider-content">
                <h2>Oak & Spoon</h2>
                <p>森に溶け込む、小さなカフェ</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="menu-container">
        <p class="menu-description">森に溶け込む、小さなカフェ「Oak & Spoon」。<br>
            自然素材にこだわり、ひとつひとつ丁寧に仕上げたやさしい味わい。<br>
            軽井沢の静かな時間とともに、心とからだに寄り添うひと皿をお届けします。</p>
        @if ($errors->any())
            <ul class="form-errors" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('orders.confirm') }}" method="POST">
            @csrf

            <div class="menu-wrapper">
                @foreach($menus as $menu)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ asset('images/' . $menu->image) }}" loading="lazy" alt="{{ $menu->name }}">
                        </div>
                        <div class="menu-item-content">
                            <h3><a href="{{ route('orders.show', $menu) }}">{{ $menu->name }}</a></h3>
                            <p>{{ number_format(floor($menu->price * 1.1)) }}円(税込)</p>

                            @if (strtolower((string) $menu->type) === 'drink' && filled($menu->spiciness))
                                <p>
                                    @if (strtolower((string) $menu->spiciness) === 'hot')
                                        ホット
                                    @elseif (strtolower((string) $menu->spiciness) === 'ice')
                                        アイス
                                    @else
                                        {{ $menu->spiciness }}
                                    @endif
                                </p>
                            @elseif (strtolower((string) $menu->type) === 'food' && filled($menu->spiciness))
                                <p>
                                    辛さ：
                                    @if (is_numeric($menu->spiciness))
                                        @for ($i = 0; $i < max(1, min(5, (int) $menu->spiciness)); $i++)
                                            🌶️
                                        @endfor
                                    @else
                                        {{ $menu->spiciness }}
                                    @endif
                                </p>
                            @endif

                            <div class="quantity-input">
                                <input type="number" name="counts[{{ $menu->id }}]" value="0" min="0" max="10">
                                <span class="quantity-unit">個</span>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div>
                <button type="submit" class="order-button">注文内容を確認する</button>
            </div>


        </form>
    </div>
@endsection