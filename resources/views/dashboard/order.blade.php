@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script>
  jQuery( function($) {
    $( "#datepicker1" ).datepicker();
    $( "#datepicker2" ).datepicker();
  } );
  </script>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Work Info</h1>
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
            <div class="col-sm-12">
                @include('flash::message')
                <div class="card">
                    {!! Form::open(['route' => 'dashboard.storeOrder']) !!}
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                {!! Form::label('Dealer', 'Dealer') !!}
                                {!! Form::select('Dealer', array('0' => 'Dealer', '12984' => 'Complete - Billable', '13014' => 'Approved to Invoice', '48' => 'Invoiced', '9535869' => 'Cancelled', '49' => 'Quote Expired'), '0', ['class' => 'form-control custom-select']); !!}
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('Customer', 'Customer') !!}
                                {!! Form::select('Customer', array('0' => 'Customer', '12984' => 'Complete - Billable', '13014' => 'Approved to Invoice', '48' => 'Invoiced', '9535869' => 'Cancelled', '49' => 'Quote Expired'), '0', ['class' => 'form-control custom-select']); !!}
                            </div>
                            <div class="form-group row col-sm-6">
                                {!! Form::label('Address', 'Address') !!}
                                {!! Form::text('Address', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group row col-sm-6">
                                {!! Form::label('ProjectNo', 'Project No') !!}
                                {!! Form::text('ProjectNo', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group row col-sm-6">
                                {!! Form::label('StartTime', 'Start Time') !!}
                                {!! Form::text('StartTime', null, ['class' => 'form-control', 'id' => 'datepicker1']) !!}
                            </div>
                            <div class="form-group row col-sm-6">
                                {!! Form::label('SiteTime', 'Site Time') !!}
                                {!! Form::text('SiteTime', null, ['class' => 'form-control', 'id' => 'datepicker2']) !!}
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('IhStaff', 'IhStaff') !!}
                                {!! Form::select('IhStaff', array('0' => 'IhStaff', '12984' => 'Complete - Billable', '13014' => 'Approved to Invoice', '48' => 'Invoiced', '9535869' => 'Cancelled', '49' => 'Quote Expired'), '0', ['class' => 'form-control custom-select']); !!}
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('Subs', 'Subs') !!}
                                {!! Form::text('Subs', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('Vehicle', 'Vehicle') !!}
                                {!! Form::select('Vehicle', array('0' => 'Vehicle', '12984' => 'Complete - Billable', '13014' => 'Approved to Invoice', '48' => 'Invoiced', '9535869' => 'Cancelled', '49' => 'Quote Expired'), '0', ['class' => 'form-control custom-select']); !!}
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('Screens', 'Screens') !!}
                                <input type="number" name="Screens" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('Dolies', 'Dolies') !!}
                                <input type="number" name="Dolies" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('Opens', 'Opens') !!}
                                <input type="number" name="Opens" class="form-control" />
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('Misc', 'Misc') !!}
                                {!! Form::text('Misc', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('InstallNo', 'Install No') !!}
                                {!! Form::text('InstallNo', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('dashboard.createOrder') }}" class="btn btn-default">Clear</a>
                        <a href="{{ route('dashboard') }}" class="btn btn-default">Cancel</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
