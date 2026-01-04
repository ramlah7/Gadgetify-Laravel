<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function processOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
        ]);

        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->get(); // Removed eager load of product as we need to lock rows

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty.');
        }

        try {
            DB::transaction(function () use ($user, $cartItems, $request) {
                $totalPrice = 0;
                
                // Calculate total and verify stock first (or do it while processing)
                // To be safe and calculate total correctly based on current prices, we should do it in the loop.
                // But we need the total for the Order.
                
                // Let's create the Order first with 0 total, then update it? 
                // Or calculate total first using locked products?
                
                // Better approach:
                // 1. Lock all products and calculate total.
                // 2. Create Order.
                // 3. Create OrderItems and deduct stock.
                
                // However, iterating twice is slightly less efficient but safer. 
                // Let's try to do it in one pass if possible.
                // We need Order ID for OrderItems.
                
                // Let's just sum it up first.
                $orderTotal = 0;
                $processedItems = [];

                foreach ($cartItems as $item) {
                    $product = Product::where('id', $item->product_id)->lockForUpdate()->first();
                    
                    if (!$product) {
                        throw new \Exception("Product not found.");
                    }

                    if ($product->stock < $item->quantity) {
                        throw new \Exception("Insufficient stock for product: " . $product->name);
                    }
                    
                    $orderTotal += $product->price * $item->quantity;
                    $processedItems[] = [
                        'cart_item' => $item,
                        'product' => $product
                    ];
                }

                $order = Order::create([
                    'user_id' => $user->id,
                    'total_price' => $orderTotal,
                    'status' => 'pending',
                    'shipping_address' => $request->shipping_address,
                ]);

                foreach ($processedItems as $data) {
                    $item = $data['cart_item'];
                    $product = $data['product'];

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item->quantity,
                        'price_at_purchase' => $product->price,
                    ]);

                    $product->decrement('stock', $item->quantity);
                }

                // Clear cart
                CartItem::where('user_id', $user->id)->delete();
            });

            return redirect()->route('products.index')->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }
}
