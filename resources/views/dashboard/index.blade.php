@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<style type="text/css">
    .table-header {
        cursor: pointer;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@lang('models/dashboards.header.index')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {!! Form::open(['route' => 'dashboard.search']) !!}
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                {!! Form::label('ProjectNo', 'Order Id:') !!}
                                {!! Form::text('ProjectNo', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('EquipBkDate', 'Date Created:') !!}
                                {!! Form::text('EquipBkDate', null, ['class' => 'form-control', 'id' => 'datepicker']) !!}
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('status', 'Status:') !!}
                                {!! Form::select('status', array('0' => 'Choose a status', '12984' => 'Complete - Billable', '13014' => 'Approved to Invoice', '48' => 'Invoiced', '9535869' => 'Cancelled', '49' => 'Quote Expired'), '0', ['class' => 'form-control custom-select']); !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('dashboard') }}" class="btn btn-default">Clear</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('flash::message')
                <div class="count-items row">
                    <div class="col-sm-6">
                        <span class="fw-bold">{{ 'Total records: ' . $detailstbls_count }}</span>
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right" href="{{ route('dashboard.createOrder') }}">
                            New
                        </a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><span class="table-header" id="Dealer">Dealer</span></th>
                            <th scope="col"><span class="table-header" id="Customer">Customer</span></th>
                            <th scope="col"><span class="table-header" id="Address">Address</span></th>
                            <th scope="col"><span class="table-header" id="ProjectNo">Project No.</span></th>
                            <th scope="col"><span class="table-header" id="StartTime">Start Time</span></th>
                            <th scope="col"><span class="table-header" id="SiteTime">Site Time</span></th>
                            <th scope="col"><span class="table-header" id="IhStaff">IhStaff</span></th>
                            <th scope="col"><span class="table-header" id="Subs">Subs</span></th>
                            <th scope="col"><span class="table-header" id="Vehicles">Vehicles</span></th>
                            <th scope="col"><span class="table-header" id="Screens">Screens</span></th>
                            <th scope="col"><span class="table-header" id="Double">Double</span></th>
                            <th scope="col"><span class="table-header" id="Opens">Opens</span></th>
                            <th scope="col"><span class="table-header" id="InstallNo">InstallNo</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ $currentPage = $detailstbls->currentPage() }}
                        {{ $perPage = $detailstbls->perPage() }}
                        @foreach ($detailstbls as $key=>$detailstbl)
                        <tr>
                            <th scope="row">{{ ($currentPage - 1) * $perPage  + $key + 1}}</th>
                            <td>{{ $detailstbl['Dealer'] }}</td>
                            <td>{{ $detailstbl['Customer'] }}</td>
                            <td>{{ $detailstbl['Address'] }}</td>
                            <td>{{ $detailstbl['ProjectNo'] }}</td>
                            <td>{{ date('Y/m/d', strtotime($detailstbl['StartTime'])) }}</td>
                            <td>{{ date('Y/m/d', strtotime($detailstbl['SiteTime'])) }}</td>
                            <td>{{ $detailstbl['IhStaff'] }}</td>
                            <td>{{ $detailstbl['Subs'] }}</td>
                            <td>{{ $detailstbl['Vehicles'] }}</td>
                            <td>{{ $detailstbl['Screens'] }}</td>
                            <td>{{ $detailstbl['Double'] }}</td>
                            <td>{{ $detailstbl['Opens'] }}</td>
                            <td>{{ $detailstbl['InstallNo'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="paging">
                    {{ $detailstbls->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<script>
  var sortOrder = 'desc';
  var pageUrl = '{{ route('dashboard') }}';
  var queryString = getUrlVars();
  console.log(queryString);
  console.log(queryString['sortOrder']);
  jQuery( function($) {
    $('#datepicker').datepicker();
    $('.table-header').click(function(){
        const columnId = $(this).attr('id');
        let sortOrder = 'desc';
        if(queryString['orderBy'] && queryString['orderBy'] === columnId && queryString['sortOrder']){
            sortOrder = queryString['sortOrder'] === 'desc' ? 'asc' : 'desc';
        }
        window.location.replace(pageUrl + '?orderBy=' + $(this).attr('id') + '&sortOrder=' + sortOrder);
    });
  } );
  </script>
@endsection
