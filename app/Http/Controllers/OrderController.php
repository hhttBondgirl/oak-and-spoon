<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $menus = Menu::all();

        return view('orders.index', compact('menus'));
    }

    public function confirmShow(Request $request): View|RedirectResponse
    {
        $data = $request->session()->get('pending_order');

        if (! is_array($data) || empty($data['orderItems'])) {
            return redirect()->route('orders.index');
        }

        return view('orders.confirm', [
            'orderItems' => $data['orderItems'],
            'total' => $data['total'],
        ]);
    }

    public function confirm(Request $request): RedirectResponse
    {
        $menus = Menu::all()->keyBy('id');
        $quantities = $request->input('counts', []);

        $total = 0;
        $orderItems = [];

        foreach ($quantities as $id => $qty) {
            if ($qty > 0) {
                $menu = $menus->get($id);

                if ($menu) {
                    $priceWithTax = floor($menu->price * 1.1);
                    $subtotal = $priceWithTax * $qty;
                    $total += $subtotal;

                    $orderItems[] = [
                        'id' => $menu->id,
                        'name' => $menu->name,
                        'qty' => $qty,
                        'subtotal' => $subtotal,
                    ];
                }
            }
        }

        if ($orderItems === []) {
            return redirect()
                ->route('orders.index')
                ->withErrors(['order' => '1品目以上選択してください。']);
        }

        $request->session()->put('pending_order', compact('orderItems', 'total'));

        return redirect()->route('orders.confirm.show');
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $counts = $request->validated('counts');

        DB::transaction(function () use ($counts): void {
            $menuIds = array_map(intval(...), array_keys($counts));
            $menus = Menu::query()->whereIn('id', $menuIds)->get()->keyBy('id');

            $total = 0;
            $lines = [];

            foreach ($counts as $menuId => $qty) {
                $menuId = (int) $menuId;
                $menu = $menus->get($menuId);

                if (! $menu) {
                    throw ValidationException::withMessages([
                        'counts' => '無効なメニューが含まれています。',
                    ]);
                }

                $unitPrice = (int) floor($menu->price * 1.1);
                $subtotal = $unitPrice * $qty;
                $total += $subtotal;

                $lines[] = [
                    'menu_id' => $menu->id,
                    'quantity' => $qty,
                    'unit_price' => $unitPrice,
                    'subtotal' => $subtotal,
                ];
            }

            $order = Order::query()->create(['total' => $total]);

            foreach ($lines as $line) {
                $order->items()->create($line);
            }
        });

        $request->session()->flush();

        return redirect()
            ->route('orders.index')
            ->with('status', '送信しました。発送までしばらくお待ちください');
    }

    public function show(Menu $menu): View
    {
        $reviews = $menu->reviews;

        return view('orders.show', compact('menu', 'reviews'));
    }
}