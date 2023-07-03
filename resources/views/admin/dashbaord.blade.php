@extends('layouts.app')
@section('content')

<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<div class="container">
    <div class="row">
        <h1>Orders List</h1>
            <a href="{{ route('products.index') }}" class="btn btn-info" role="button">
                Products List
            </a>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Payment Id</th>
                        <th>User Id</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                        {{-- <th width="100px">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
      
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('admindashboard') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'i_payment_id', name: 'i_payment_id'},
              {data: 'user_id', name: 'user_id'},
              {data: 'amount', name: 'amount'},
              {data: 'payment_status', name: 'payment_status'},
            //   {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>
@endsection
