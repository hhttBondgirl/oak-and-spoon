@extends('layouts.app')

@section('content')
    <div class="review-wrapper">
        <div class="review-menu-item">
            {{-- 画像の表示 --}}
            <img src="{{ asset('images/' . $menu->image) }}" class="menu-item-image">
            <h3 class="menu-item-name">{{ $menu->name }}</h3>

            @if($menu->type === 'drink')
                {{-- DBのspiciness（hot/ice）を日本語に変換して表示 --}}
                <p class="menu-item-type">
                    {{ $menu->spiciness === 'hot' ? 'ホット' : 'アイス' }}
                </p>
            @elseif($menu->type === 'food')
                {{-- 辛さレベルの数だけ🌶️画像を並べる --}}
                <div class="spiciness-area">
                    辛さ：
                    @for ($i = 0; $i < (int) $menu->spiciness; $i++)
                        <img src="https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/chilli.png"
                            class='icon-spiciness' style="width: 20px;">
                    @endfor
                </div>
            @endif

            {{-- 税込価格の表示 --}}
            <p class="price">¥{{ number_format(floor($menu->price * 1.1)) }}</p>
        </div>

        <div class="review-list-wrapper">
            <div class="review-list">
                <div class="review-list-title">
                    <img src="{{ asset('images/review.svg') }}" class='icon-review'>
                    <h4>レビュー一覧</h4>
                </div>

                {{-- レビューを表示するループ（もしReviewモデルとリレーションがあれば） --}}
                {{-- まだレビュー機能が未実装なら、一旦ここは「準備中」でもOK！ --}}
                @forelse($menu->reviews as $review)
                    <div class="review-list-item">
                        <div class="review-user">
                            {{-- 性別でアイコンを変える（genderカラムがある場合） --}}
                            @if($review->gender == 'male')
                            <img src="{{ asset('images/male.svg') }}" class='icon-user'>
                            @else
                            <img src="{{ asset('images/female.svg') }}" class='icon-user'>
                            @endif
                            <p>{{ $review->user_name }}</p>
                        </div>
                        <p class="review-text">{{ $review->comment }}</p>
                    </div>
                @empty
                    <p>まだレビューはありません。</p>
                @endforelse
            </div>
        </div>

    </div>

    <div class="back-link">
        <a href="{{ route('orders.index') }}">← メニュー一覧へ</a>
    </div>
@endsection