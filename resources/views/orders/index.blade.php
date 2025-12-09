@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Order History') }}</div>

                <div class="card-body">
                    @if ($orders->isEmpty())
                        <div class="alert alert-info">You have no orders yet.</div>
                    @else
                        <div class="accordion" id="ordersAccordion">
                            @foreach ($orders as $order)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $order->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}" aria-expanded="false" aria-controls="collapse{{ $order->id }}">
                                            Order #{{ $order->id }} - {{ $order->created_at->format('M d, Y') }} - ${{ number_format($order->total_price, 2) }} - <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'secondary' }} ms-2">{{ ucfirst($order->status) }}</span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $order->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $order->id }}" data-bs-parent="#ordersAccordion">
                                        <div class="accordion-body">
                                            <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->items as $item)
                                                        <tr>
                                                            <td>{{ $item->product ? $item->product->name : 'Product Deleted' }}</td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>${{ number_format($item->price_at_purchase, 2) }}</td>
                                                            <td>${{ number_format($item->quantity * $item->price_at_purchase, 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
