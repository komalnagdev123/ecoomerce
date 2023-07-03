@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">

        <div class="alert alert-danger" id="order_status_failure" style="display: none; margin:20px;"></div>
        <div class="alert alert-success" id="order_status_success" style="display: none; margin:20px;"></div>

        <section class="h-100 h-custom" style="background-color: #eee;">
            <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
                    <div class="card-body p-5">
        
                    <p class="lead fw-bold mb-5" style="color: #f37a27;">Order Summary</p>
        
                    <div class="row">
                        <div class="col mb-3">
                            <p class="small text-muted mb-1">Date</p>
                            <p><?php $date = explode(' ',$orders->created_at); ?>{{ $date[0] }}</p>
                        </div>
                        <div class="col mb-3">
                            <p class="small text-muted mb-1">Order No.</p>
                            <p>{{ $orders->order_no }}</p>
                        </div>
                        <div class="col mb-3">
                            <p class="small text-muted mb-1">Order Status</p>
                            <p>
                                <select class="order_detail_select order_status_change" id="option-{{ $orders->order_status_id }}" @if ($orders->order_status_id == 2) disabled @endif>
                                    @foreach ($orderStatus as $item)
                                        <option id="option-{{ $item->id }}" value="{{ $item->id }}" @if ($item->id == $orders->order_status_id) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <p class="small text-muted mb-1">Customer Name</p>
                            <p>{{ $userDetails->name ?? '--' }}</p>
                        </div>
                        <div class="col mb-3">
                            <p class="small text-muted mb-1">Phone Number.</p>
                            <p>{{ $userDetails->contact_no ?? '--' }}</p>
                        </div>
                        <div class="col mb-3">
                            <p class="small text-muted mb-1">Delivery Address</p>
                            <p>{{ $userDetails->address ?? '--' }}</p>
                        </div>
                        <div class="col mb-3">
                            <p class="small text-muted mb-1">Email ID</p>
                            <p>
                                {{ $userDetails->email ?? '--' }}
                        </div>
                    </div>
        
                    <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
                        @if (count($viewOrderDetails) > 0)
                        <?php $total = 0;?>
                        @foreach ($viewOrderDetails as $value )
                        <div class="row">
                            <div class="col-md-8 col-lg-9">
                                <p>{{ App\Models\Product::find($value->product_id)->name ?? '--'}}</p>
                            </div>
                            <div class="col-md-4 col-lg-3">
                                <p>Rs. {{ App\Models\Product::find($value->product_id)->price ?? '--'}}</p>
                                <?php $selling_price_total = App\Models\Product::find($value->product_id)->price ?>
                            </div>
                        </div>
                        <?php
                        $total += $selling_price_total;
                        ?>
                        @endforeach
                        @endif
                        <div class="row">
                        <div class="col-md-8 col-lg-9">
                            <p class="mb-0">Tax</p>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <p class="mb-0">Rs. 10</p>
                        </div>
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9">
                        <p class="lead fw-bold mb-0" style="color: #f37a27;">Rs. {{ $total+10 }}</p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
    </div>
</div>
<script>
    //change order status
    jQuery(document).ready(function($) 
    {
        $(".order_status_change").on('change', function() {
            var order_status_id = $(this).val();
            let text = "Are you sure you want to change order status? !\nPress Either OK or Cancel.";
            if (confirm(text) == true)
            { 
                $.ajax({
                    type: 'POST',
                    url: '{{ route('changeStatus') }}',
                
                    data: {
                        _token: '{{ csrf_token() }}',
                        order_status_id: order_status_id,
                        order_id : {{ $orders->id }}
                    },
                    success: function (response) {
                        text = "Status updated successfully!";
                        document.getElementById("order_status_success").innerHTML = text;
                        $("#order_status_success").show().delay(4000).fadeOut(); 
                        setTimeout(function(){
                        window.location.reload();
                        }, 4000);
                    },
                    error: function (error) {
                        text = "An error occurred while updating the status.";
                        document.getElementById("order_status_failure").innerHTML = text;
                        $("#order_status_failure").show().delay(5000).fadeOut();
                    }
                });
            }
            else
            {
                text = "Order status not changed.";
                document.getElementById("order_status_failure").innerHTML = text;
                $("#order_status_failure").show().delay(5000).fadeOut();
                setTimeout(function(){
                    window.location.reload();
                    }, 5000);
            }
        });
   });
</script>

@endsection