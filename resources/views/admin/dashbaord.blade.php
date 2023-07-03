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
            <table class="table table-bordered data-table" id="ordersTable">
                <thead>
                    <tr>
                        <th>ORDER ID</th>
                        <th>CUSTOMER NAME</th>
                        <th>ORDER DATE</th>
                        <th>ORDER AMOUNT</th>
                        <th>ORDER STATUS</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    getOrders();
    });

    function getOrders()    
        {  
            var table = $('#ordersTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax:{
                        url : "{{ route('admindashboard') }}",
                    },
                    columns: [
                        {
                            data: 'id',
                            name: 'id',
                            orderable: true,
                            class: 'text-left',
                            render: function(data, type, row) {
                                return `
                                <div style="text-transform: capitalize;">
                                        ${row.id}
                                </div>`;
                            }
                        },
                        {
                            data: 'customer_name',
                            name: 'customer_name',
                            orderable: true,
                            class: 'text-left',
                        },
                        
                        {
                            data: 'order_date',
                            name: 'order_date',
                            orderable: true,
                            class: 'text-left',
                        },
                        
                        {
                            data: 'total_amount',
                            name: 'total_amount',
                            orderable: true,
                            class: 'text-left',
                        },
                        {
                            data: 'order_status_id',
                            name: 'order_status_id',
                            orderable: true,
                            class: 'text-left',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
        }
  </script>
@endsection
