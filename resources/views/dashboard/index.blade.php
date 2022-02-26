@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<style type="text/css">
    .table-header {
        cursor: pointer;
    }
    .modal-order {
        width: 70%;
        height: 80%;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: 5%;
        background-color: #eeeeee;
        padding: 0!important;
    }
    table tr {
        cursor: pointer;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@lang('common.module.queues')</h1>
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
                                {!! Form::label('ProjectNo', 'Project No.:') !!}
                                {!! Form::text('ProjectNo', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('EquipBkDate', 'Date:') !!}
                                {!! Form::text('EquipBkDate', null, ['class' => 'form-control', 'id' => 'datepicker1']) !!}
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
                <div class="count-items row mb-3">
                    <div class="col-sm-6">
                        <span class="fw-bold">{{ 'Total records: ' . $detailstbls_count }}</span>
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right" href="{{ route('dashboard.createOrder') }}">
                            New
                        </a>
                    </div>
                </div>
                <table class="table" id="table_content">
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
                        @php
                            $currentPage = $detailstbls->currentPage();
                            $perPage = $detailstbls->perPage();
                        @endphp
                        @foreach ($detailstbls as $key=>$detailstbl)
                        <tr id="{{ $detailstbl['id'] }}" data-toggle="modal" data-target="#modal-{{ $detailstbl['id'] }}">
                            <th scope="row">{{ ($currentPage - 1) * $perPage  + $key + 1}}</th>
                            <td>{{ $detailstbl['Dealer'] }}</td>
                            <td>{{ $detailstbl['Customer'] }}</td>
                            <td>{{ $detailstbl['Address'] }}</td>
                            <td>{{ $detailstbl['ProjectNo'] }}</td>
                            <td>{{ date('h:i A', strtotime($detailstbl['StartTime'])) }}</td>
                            <td>{{ date('h:i A', strtotime($detailstbl['SiteTime'])) }}</td>
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
                @foreach ($detailstbls as $key=>$detailstbl)
                    <div class="modal modal-order" id="modal-{{ $detailstbl['id'] }}">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <?php $formId = 'order-'.$detailstbl['id']; ?>
                        {!! Form::open(['route' => ['dashboard.updateOrder', (int)$detailstbl['id']], 'method' => 'put', 'class' => 'update-order', 'id'=>$formId]) !!}
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('Dealer', 'Dealer') !!}
                                    {!! Form::text('Dealer', $detailstbl['Dealer'], ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('Customer', 'Customer') !!}
                                    {!! Form::text('Customer', $detailstbl['Customer'], ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('ProjectNo', 'Project No') !!}
                                    {!! Form::text('ProjectNo', $detailstbl['ProjectNo'], ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('StartTime', 'Start Time') !!}
                                    {!! Form::text('StartTime', date('h:i A', strtotime($detailstbl['StartTime'])), ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('StartWhere', 'Start Where') !!}
                                    {!! Form::text('StartWhere', $detailstbl['StartWhere'], ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('IhStaff', 'IhStaff') !!}
                                    {!! Form::text('IhStaff', $detailstbl['IhStaff'], ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('Subs', 'Subs') !!}
                                    {!! Form::text('Subs', $detailstbl['Subs'], ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('Equip', 'Equip') !!}
                                    {!! Form::text('Equip', $detailstbl['Equip'], ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('Vehicles', 'Vehicles') !!}
                                    {!! Form::text('Vehicles', $detailstbl['Vehicles'], ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('Screens', 'Screens') !!}
                                    <input type="number" name="Screens" class="form-control" value="$detailstbl['Screens']"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('Opens', 'Opens') !!}
                                    <input type="number" name="Opens" class="form-control" value="$detailstbl['Opens']" />
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('Flats', 'Flats') !!}
                                    <input type="number" name="Flats" class="form-control" value="$detailstbl['Flats']" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('LineNo', 'LineNo', ['class' => 'required']) !!}
                                    <input type="number" name="LineNo" class="form-control" value="$detailstbl['LineNo']" required />
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('Double', 'Double') !!}
                                    <input type="number" name="Double" class="form-control" value="$detailstbl['Double']" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('Address', 'Address') !!}
                                    {!! Form::text('Address', $detailstbl['Address'], ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('SiteTime', 'SiteTime') !!}
                                    {!! Form::text('SiteTime', date('h:i A', strtotime($detailstbl['SiteTime'])), ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('Lead', 'Lead') !!}
                                    {!! Form::text('Lead', $detailstbl['Lead'], ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('LeadEmail', 'LeadEmail') !!}
                                    {!! Form::text('LeadEmail', $detailstbl['LeadEmail'], ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('ScreensBk', 'ScreensBk') !!}
                                    <input type="number" name="ScreensBk" class="form-control" value="$detailstbl['ScreensBk']" />
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('OpensBk', 'OpensBk') !!}
                                    <input type="number" name="OpensBk" id="OpensBk" class="form-control" value="$detailstbl['OpensBk']" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('FlatsBk', 'FlatsBk') !!}
                                    <input type="number" name="FlatsBk" id="FlatsBk" class="form-control" value="$detailstbl['FlatsBk']" />
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('Date', 'Date') !!}
                                    {!! Form::text('EquipBkDate', date('Y-m-d', strtotime($detailstbl['EquipBkDate'])), ['class' => 'form-control', 'id'=>'datepicker-equip-'.$key]) !!}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('InstallNo', 'InstallNo') !!}
                                    <input type="number" name="InstallNo" class="form-control" value="$detailstbl['InstallNo']" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <?php $btnSubmitId = 'btn-order-'.$detailstbl['id']; ?>
                            {!! Form::submit('Save', ['class' => 'btn btn-submit btn-primary', 'id' => $btnSubmitId]) !!}
                            <!-- <button type="button" class="btn btn-primary" id="btn-save" onclick="showDialog(true, `order-{{ $detailstbl['id'] }}`)">Save</button> -->
                            <!-- <button type="button" class="btn btn-danger" onclick="showDialog(false, `modal-{{ $detailstbl['id'] }}`)">Cancel</button> -->
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                  @endforeach
                <div class="paging">
                    {{ $detailstbls->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<script>
  var sortOrder = 'desc';
  var pageUrl = `{{ route('dashboard') }}`;
  var queryString = getUrlVars();
  var isSubmitForm = false;
  var count = `{{count($detailstbls)}}`;
  jQuery( function($) {
    $('#datepicker1').datepicker({
      dateFormat: 'yy-mm-dd',
      showOn: "button",
      buttonImage: `{{ URL::to('/') }}/images/icon-calendar.png`,
      buttonImageOnly: true,
      buttonText: "Select date",
    });
    for(let i=0; i < count;i++){
        $('#datepicker-starttime-'+i).datepicker({
            dateFormat: 'yy-mm-dd',
            showOn: "button",
            buttonImage: `{{ URL::to('/') }}/images/icon-calendar.png`,
            buttonImageOnly: true,
            buttonText: "Select date",
        });
        $('#datepicker-sitetime-' + i).datepicker({
            dateFormat: 'yy-mm-dd',
            showOn: "button",
            buttonImage: `{{ URL::to('/') }}/images/icon-calendar.png`,
            buttonImageOnly: true,
            buttonText: "Select date",
        });
        $('#datepicker-equip-' + i).datepicker({
            dateFormat: 'yy-mm-dd',
            showOn: "button",
            buttonImage: `{{ URL::to('/') }}/images/icon-calendar.png`,
            buttonImageOnly: true,
            buttonText: "Select date",
        });
    }
    $('.table-header').click(function(){
        const columnId = $(this).attr('id');
        let sortOrder = 'desc';
        if(queryString['orderBy'] && queryString['orderBy'] === columnId && queryString['sortOrder']){
            sortOrder = queryString['sortOrder'] === 'desc' ? 'asc' : 'desc';
        }
        window.location.replace(pageUrl + '?orderBy=' + $(this).attr('id') + '&sortOrder=' + sortOrder);
    });
    const requiredFields = ['#LineNo'];
    $('.update-order').submit(function(e) {
        if(!isSubmitForm){
            e.preventDefault();
            showDialog(true, 'btn-' + $(this).attr('id'));
        }       
    });
  });
  function showDialog(isSubmit, modalId){
        $.dialog.confirm('Title', isSubmit ? 'Confirm Save' : 'Confirm Cancel', function(res){
            if(res){
                if(isSubmit){
               //     console.log('modalId', modalId);
                    isSubmitForm = true;
                    $('#' + modalId).click();
                }else{
                    $('#' + modalId).modal('toggle');
                }
            }
        })
    }
</script>
@endsection