@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table">
        <tbody>
          <tr>
            <td scope="row">Amount</td>
            <td>Rs. {{ $total }}</td>
          </tr>
          <tr>
            <td>Tax</td>
            <td>Rs. 10</td>
          </tr>
          <tr>
            <td>Delivery Charges</td>
            <td>Rs. 0</td>
          </tr>
          <tr>
            <td>Sub Total</td>
            <td>Rs. {{ $total + 10 }}</td>
          </tr>
        </tbody>
      </table>

      <div>
        <form action="{{ route('order_confirm') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="hidden" name="final_amt" value="{{ $total+10 }}" />
            </div>
            <button type="submit" class="btn btn-success">Pay Now with Instamojo</button>
          </form>
      </div>
</div>

@endsection
