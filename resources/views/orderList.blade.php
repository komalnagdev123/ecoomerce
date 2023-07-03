@extends('layouts.app')

@section('content')
<?php $MAIN_URL = Config::get('constants.MAIN_URL'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Error Alert!</strong> {{ $message }}
            </div>
            @endif
            {!! Session::forget('error') !!}
            @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Success Alert!</strong> {{ $message }}
            </div>
            @endif
            {!! Session::forget('success') !!}
        </div>
    </div>
</div>
<div class="container">
    @if (session('success_message'))
        <div class="alert alert-success" role="alert">
            {{ session('success_message') }}
        </div>
    @endif
    <h1>Your Order List</h1>
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
                                    <div>
                                        <div style="float: left">
                                            Order Status:- 
                                        </div>
                                        <div>
                                            {{ App\Models\OrderStatus::find($item->order_status)->name ?? '--'}}
                                        </div>
                                        <div style="float: left">
                                            Payment Method:- 
                                        </div>
                                        <div>
                                            {{ $item->payment_method }}
                                        </div>
                                        <div style="float: left">
                                            Payment Status:- 
                                        </div>
                                        <div>
                                            {{ $item->payment_status }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                    <div class="d-flex flex-row align-items-center mb-1">
                                        <h4 class="mb-1 me-1">Price:- Rs.{{ $item->price }}</h4>
                                        
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
               No Order placed yet.
            @endif
        </div>
    </section>
</div>

@endsection
