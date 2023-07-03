@extends('layouts.app')

@section('content')
<?php $MAIN_URL = Config::get('constants.MAIN_URL'); ?>
<div class="container">
    @if (session('success_message'))
        <div class="alert alert-success" role="alert">
            {{ session('success_message') }}
        </div>
    @endif
    @if(count($products) > 0)
    <a href="{{ route('order_now') }}">
        <button type="button" class="btn" style="background-color:blue; color: #fff" ;>
            Order Now</button></a>
    @endif
    <section style="background-color: #eee;">
        <div class="container py-5">
            @if(count($products) > 0)
            @foreach ($products as $item)
                <div class="row justify-content-center mb-3">
                    <div class="col-md-12 col-xl-10">
                        <div class="card shadow-0 border rounded-3">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                    <img src="{{ url($MAIN_URL . 'storage/products/' . $item->image) }}"
                                        class="w-100" />
                                    <a href="#!">
                                        <div class="hover-overlay">
                                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                        </div>
                                    </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <h5>{{ $item->name }}</h5>
                                    <p class="text-truncate mb-4 mb-md-0">
                                        {{ $item->description }}.
                                    </p>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                    <div class="d-flex flex-row align-items-center mb-1">
                                    <h4 class="mb-1 me-1">Rs.{{ $item->price }}</h4>
                                    </div>
                                    <h6 class="text-success">Free shipping</h6>
                                    
                                    <div class="d-flex flex-column mt-4">
                                        <form action="{{ route('remove_cart') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="cart_id" value="{{ $item->id }}" />
                                            <button class="btn btn-info" type="submit">Remove from Cart</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
               No Product in cart 
            @endif
        </div>
    </section>
    @if(count($products) > 0)
    <a href="{{ route('order_now') }}">
        <button type="button" class="btn" style="background-color:blue; color: #fff" ;>
            Order Now</button></a>
    @endif
</div>

@endsection
