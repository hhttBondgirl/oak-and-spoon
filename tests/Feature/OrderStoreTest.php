<?php

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('stores order and order items then redirects with flash', function () {
    $menu = Menu::factory()->create(['price' => 500]);

    $response = $this->from('/')
        ->post(route('orders.store'), [
            'counts' => [$menu->id => 2],
        ]);

    $response->assertRedirect(route('orders.index'));
    $response->assertSessionHas('status');

    $unit = (int) floor(500 * 1.1);
    expect(Order::query()->count())->toBe(1);
    $order = Order::query()->first();
    expect($order->total)->toBe($unit * 2);
    expect($order->items)->toHaveCount(1);
    expect($order->items->first()->menu_id)->toBe($menu->id)
        ->and($order->items->first()->quantity)->toBe(2)
        ->and($order->items->first()->unit_price)->toBe($unit)
        ->and($order->items->first()->subtotal)->toBe($unit * 2);
});

test('flushes session after successful order', function () {
    $menu = Menu::factory()->create();

    $response = $this->withSession(['pending_order' => [
        'orderItems' => [
            ['id' => $menu->id, 'name' => 'x', 'qty' => 1, 'subtotal' => 100],
        ],
        'total' => 100,
    ]])
        ->post(route('orders.store'), [
            'counts' => [$menu->id => 1],
        ]);

    $response->assertRedirect(route('orders.index'));
    $response->assertSessionMissing('pending_order');
});
