@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="{{ URL::asset('/js/jquery.validate.min.js') }}"></script>
<style type="text/css">
/* The container */
.checkboxes {
    width: 100%;
    height: 150px;
    overflow-x: hidden;
}
.cbox {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 13px;
  font-weight: normal!important;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  height: 25px;
  line-height: 25px;
  width: 33%;
  float: left
}

/* Hide the browser's default checkbox */
.cbox input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.cbox:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.cbox input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.cbox input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.cbox .checkmark:after {
  left: 7px;
  top: 4px;
  width: 6px;
  height: 9px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
.suggestion-box {
    display: none;
}
.error {
    color: #FF0000;
    font-weight: normal!important;
    font-size: 14px;
}
.form-group-content select {
    width: 30%;
}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@lang('common.module.newOrder')</p></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.cbox-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @include('flash::message')
                <div class="card">
                    {!! Form::open(['route' => 'dashboard.storeOrder', 'id'=>'form-order']) !!}
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <div class="label">
                                    {!! Form::label('Dealer', 'Dealer') !!}
                                    <span class="required"></span>
                                </div>
                                {!! Form::text('Dealer', null, ['class' => 'form-control', 'id' => 'search-box-customer']) !!}
	                            <select class="suggestion-box" id="suggestion-box-dealer"></select>
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="label">
                                    {!! Form::label('Customer', 'Customer') !!}
                                    <span class="required"></span>
                                </div>
                                {!! Form::text('Customer', null, ['class' => 'form-control', 'id' => 'search-box-customer']) !!}
                                <select class="suggestion-box" id="suggestion-box-customer"></select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                {!! Form::label('Address', 'Address') !!}
                                {!! Form::text('Address', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="label">
                                    {!! Form::label('ProjectNo', 'ProjectNo') !!}
                                    <span class="required"></span>
                                </div>
                                {!! Form::text('ProjectNo', 0, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                {!! Form::label('StartTime', 'Start Time') !!}
                                <div class="form-group-content">
                                    {!! Form::select('StartTimeHour', $times['hours'], '00', ['class' => 'form-control custom-select']); !!}
                                    {!! Form::select('StartTimeMinute', $times['minutes'], '00', ['class' => 'form-control custom-select']); !!}
                                    {!! Form::select('StartTimeFormat', $times['format'], 'AM', ['class' => 'form-control custom-select']); !!}
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('SiteTime', 'Site Time') !!}
                                <div class="form-group-content">
                                    {!! Form::select('SiteTimeHour', $times['hours'], '00', ['class' => 'form-control custom-select']); !!}
                                    {!! Form::select('SiteTimeMinute', $times['minutes'], '00', ['class' => 'form-control custom-select']); !!}
                                    {!! Form::select('SiteTimeFormat', $times['format'], 'AM', ['class' => 'form-control custom-select']); !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                {!! Form::label('IhStaff', 'IhStaff') !!}
                                <!-- {!! Form::select('IhStaff', $ihstaffs, '0', ['class' => 'form-control custom-select']); !!} -->
                                {!! Form::text('IhStaff', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="label">
                                    {!! Form::label('Subs', 'Subs') !!}
                                    <span class="required"></span>
                                </div>
                                {!! Form::text('Subs', 0, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                {!! Form::label('Misc', 'Misc') !!}
                                {!! Form::text('Misc', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('InstallNo', 'Install No') !!}
                                <input type="text" name="InstallNo" class="form-control" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <div class="label">
                                    {!! Form::label('Dolies', 'Dolies') !!}
                                    <span class="required"></span>
                                </div>
                                {!! Form::text('Dolies', 0, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="label">
                                    {!! Form::label('Opens', 'Opens') !!}
                                    <span class="required"></span>
                                </div>
                                {!! Form::text('Opens', 0, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                {!! Form::label('Vehicles', 'Vehicles') !!}
                                <!-- {!! Form::select('Vehicles', $trucks, '0', ['class' => 'form-control custom-select', 'multiple'=>'multiple','name'=>'Vehicles[]']); !!} -->
                                <div class="checkboxes">
                                    @foreach ($trucks as $key=>$truck)
                                        <label class="cbox">{{$truck}}
                                            <input type="checkbox" name="Vehicles[]" value={{$key}}>
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                {!! Form::label('Screens', 'Screens') !!}
                                {!! Form::text('Screens', 0, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input class="submit btn btn-primary" type="submit" value="Submit">
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
<script type="text/javascript">
  jQuery( function($) {
    $('.datepicker').datepicker({
      dateFormat: 'yy-mm-dd',
      showOn: "button",
      buttonImage: `{{ URL::to('/') }}/images/icon-calendar.png`,
      buttonImageOnly: true,
      buttonText: "Select date",
    });
  });
  var suggestSearchUrl = `{{ route('dashboard.suggestSearch') }}`;
  $(document).ready(function(){
	$("#search-box-dealer").on("input", function() {
        $("#suggestion-box-dealer").hide();
        $("#suggestion-box-dealer").html('');
        $("#suggestion-box-dealer").append($('<option value="">Choose an item</option>'));
		$.ajax({
            type: "POST",
            url: suggestSearchUrl,
            data: {
                'dealer': $(this).val(),
                '_token': `{{ csrf_token() }}`,
            },
            beforeSend: function(){
                $("#search-box-dealer").css("background",`#FFF url({{ URL::to('/') }}/images/loaderIcon.gif) no-repeat right center`);
            },
            success: function(response){
                $("#search-box-dealer").css("background",'#FFFFFF');
                if(response.success && response.data && response.data.length > 0){
                    response.data.forEach(function(item) {
                        const option = item['Dealer'];
                        $('#suggestion-box-dealer').append($('<option value="' + option + '">' + option + '</option>'));
                    })
                    $("#suggestion-box-dealer").show();
                }
            }
		});
	});
    $('#suggestion-box-dealer').on('change', function() {
        $("#search-box-dealer").val( this.value );
    });

    $("#search-box-customer").on("input", function() {
        $("#suggestion-box-customer").hide();
        $("#suggestion-box-customer").html('');
        $("#suggestion-box-customer").append($('<option value="">Choose an item</option>'));
		$.ajax({
            type: "POST",
            url: suggestSearchUrl,
            data: {
                'customer': $(this).val(),
                '_token': `{{ csrf_token() }}`,
            },
            beforeSend: function(){
                $("#search-box-customer").css("background",`#FFF url({{ URL::to('/') }}/images/loaderIcon.gif) no-repeat right center`);
            },
            success: function(response){
                $("#search-box-customer").css("background",'#FFFFFF');
                if(response.success && response.data && response.data.length > 0){
                    response.data.forEach(function(item) {
                        const option = item['Customer'];
                        $('#suggestion-box-customer').append($('<option value="' + option + '">' + option + '</option>'));
                    })
                    $("#suggestion-box-customer").show();
                }
            }
		});
	});
    $('#suggestion-box-customer').on('change', function() {
        $("#search-box-customer").val( this.value );
    });
    $.validator.setDefaults({
		submitHandler: function() {
            $("#form-order").submit();
		}
	});
    $(document).ready(function() {
        const requiredMessage = 'Value must be assign to this field';
        const integerMessage = 'Input not valid. Value must be an interger';
        $("#form-order").validate({
            rules: {
				Dealer: "required",
				Customer: "required",
                ProjectNo: {
					required: true,
					digits: true
				},
                Screens: {
					required: true,
					digits: true
				},
                Subs: {
					required: true,
					digits: true
				},
                Dolies: {
					required: true,
					digits: true
				},
                Opens: {
					required: true,
					digits: true
				},
			},
			messages: {
				Dealer: requiredMessage,
				Customer: requiredMessage,
				ProjectNo: {
                    required: requiredMessage,
					digits: integerMessage
                },
                Screens: {
                    required: requiredMessage,
					digits: integerMessage
                },
                Subs: {
                    required: requiredMessage,
					digits: integerMessage
                },
                Dolies: {
                    required: requiredMessage,
					digits: integerMessage
                },
                Opens: {
                    required: requiredMessage,
					digits: integerMessage
                },
			}
        });
    });
});
</script>
@endsection
