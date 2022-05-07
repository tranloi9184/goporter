@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ url('/css/dncalendar-skin.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('/css/swiper-bundle.min.css') }}" />
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="{{ URL::asset('/js/dncalendar.min.js') }}"></script>
<script src="{{ URL::asset('/js/swiper-bundle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.min.js"></script>

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
    .schedule-title {
        font-size: 20px;
        text-align: center;
        font-weight: bold;
        color: #464646
    }
    .schedule-item {
        border-top: 1px solid #333333;
        padding: 10px 0;
    }
    .modal-container {
        width: 90%;
        height: 85%;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: 5%;
        background-color: #ffffff;
        padding: 0!important;
    }
    .schedule-day {
        overflow-x: hidden;
        margin-right: 25px;
    }
    .swiper {
        height: 88%;
        width: 95%;
        left: 1%;
    }
    .swiper-button-next {
        right: 0;
    }
    .swiper-button-prev {
        left: 0;
    }
    .swiper-btn {
        background-size: 40px;
        cursor: pointer;
        width: 55px;
        height: 55px;
        z-index: 100;
        background: #fff;
        border-radius: 50%;
        box-shadow: 1px 1px 10px rgb(0 0 0 / 30%);
    }
    .swiper-button-prev:after, .swiper-rtl .swiper-button-next:after, 
    .swiper-button-next:after, .swiper-rtl .swiper-button-prev:after{
        font-size: 32px;
    }
    .modal-header-left {
        position: absolute;
        font-size: 21px;
        font-weight: bold;
        color: #483D8B;
        text-decoration: underline;
        cursor: pointer;
        z-index: 100;
        left: 20px;
        top: 10px;
        display: flex;
    }
    .this-week{
        margin-right: 20px;
    }
    .nodata {
        font-size: 23px;
        font-weight: bold;
        color: #ff5722;
        margin: 2% auto
    }
    .dncalendar-header .dncalendar-links div {
        color: #ff5722;
        font-family: swiper-icons;
        font-size: 26px;
        background: none!important;
    }
    .dncalendar-header .dncalendar-links .dncalendar-next-month::after{
        content: 'next';
    }
    .dncalendar-header .dncalendar-links .dncalendar-prev-month::after{
        content: 'prev';
    }
    .ihstaff {
        color: #829CB9
    }
    .subs{
        color: #EFC833
    }
    .small-head {
        color: #BABABA
    }
    .field-date {
        color: #C43836
    }
    .field-item {
        color: #6DC38A
    }
    .swiper-wrapper {
        display: flex;
    }
    .schedule-wrapper {
        display: flex;
    }
    .modal-scroll {
        overflow-x: auto!important;
    }
    .modal-scroll .swiper-btn {
        display: none;
    }
    .modal-header{
        height: 55px
    }
    .modal-header .close {
        right: 10%;
        font-size: 35px;
        position: fixed;
        z-index: 100;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@lang('common.module.schedules')</h1>
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
                    {!! Form::open(['route' => 'dashboard.schedules', 'id' => 'schedules']) !!}
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                {!! Form::label('chooseDate', 'Date:') !!}
                                {!! Form::text('chooseDate', null, ['class' => 'form-control', 'id' => 'datepicker']) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            {!! Form::hidden('fromDate', null, ['class' => 'form-control', 'id'=>'fromDate']) !!}
                            {!! Form::hidden('toDate', null, ['class' => 'form-control', 'id'=>'toDate']) !!}
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                        <a href="#" class="btn btn-default btn-today">Today</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="row">
            @if(count($detailstbls) == 0 && isset($postSearch))
                <div class="nodata">There is not any schedule</div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-9 mx-auto mt-3 mb-3">
                @include('flash::message')
                <div id="dncalendar-container"></div>
            </div>
            @if(count($detailstbls) > 0)
            <?php 
                $className = "modal col-sm-10 mx-auto modal-container";
                if(count($detailstbls) > 1){
                    $className .= " many-days";
                }
            ?>
            <div class="<?php echo $className; ?>" id="modal-schedule">
                <div class="modal-header">
                    <div class="modal-header-left">
                        <span class="this-week">Current Week</span>
                        <div class="pdf">
                            <!-- <button id="cmd" onclick="printPdf()">generate PDF</button> -->
                            <img src="{{ URL::to('/') }}/images/print.png" width="32" onclick="printPdf()"/>
                            <div id="btn_convert">Convert Pdf</div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="card-body swiper">
                    <div class="schedule-wrapper swiper-wrapper" id="schedule-content">
                        @foreach ($detailstbls as $key=>$detailstbl)
                        <div class="schedule-day swiper-slide">
                            <p class="schedule-title">
                                {{ date('F j, Y',strtotime($key))}}
                            </p>
                            @foreach ($detailstbl as $key1=>$detail)
                            <div class="schedule-item">
                                <div class="row font-weight-bold">
                                    <span class="col-sm-2">{{$detail['Dealer']}}</span>
                                    <span class="col-sm-2">{{$detail['Customer']}}</span>
                                    <span class="col-sm-2">{{$detail['ProjectNo']}}</span>
                                    <span class="col-sm-3 field-date">{{ date('h:i A', strtotime($detail['StartTime']))}}</span>
                                    <span class="col-sm-3">{{$detail['StartWhere']}}</span>
                                </div>
                                <div class="row">
                                    <span class="col-sm-2"></span>
                                    <span class="col-sm-3">{{$detail['Address']}}</span>
                                    <span class="col-sm-2"></span>
                                    <span class="col-sm-3 field-date">{{ date('h:i A', strtotime($detail['SiteTime']))}}</span>
                                    <span class="col-sm-2"></span>
                                </div>
                                <div class="row font-weight-bold">
                                    <span class="col-sm-3 small-head">IhStaff</span>
                                    <span class="col-sm-3 small-head">Subs</span>
                                    <span class="col-sm-1 small-head">Veh</span>
                                    <span class="col-sm-1 small-head">Scr</span>
                                    <span class="col-sm-1 small-head">Dol</span>
                                    <span class="col-sm-1 small-head">Open</span>
                                    <span class="col-sm-2 small-head">Equip</span>
                                </div>
                                <div class="row">
                                    <span class="col-sm-3 ihstaff">{{ $detail['IhStaff']}}</span>
                                    <span class="col-sm-3 subs">{{ $detail['Subs']}}</span>
                                    <span class="col-sm-1 vehicles field-item">{{ $detail['Vehicles'] }}</span>
                                    <span class="col-sm-1 screens field-item">{{ $detail['Screens'] }}</span>
                                    <span class="col-sm-1 flats field-item">{{ $detail['Flats'] }}</span>
                                    <span class="col-sm-1 opens field-item">{{ $detail['Opens'] }}</span>
                                    <span class="col-sm-2 equip field-item">{{ $detail['Equip'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                        @foreach ($detailstbls as $key=>$detailstbl)
                        <div class="schedule-day swiper-slide">
                            <p class="schedule-title">
                                {{ date('F j, Y',strtotime($key))}}
                            </p>
                            @foreach ($detailstbl as $key1=>$detail)
                            <div class="schedule-item">
                                <div class="row font-weight-bold">
                                    <span class="col-sm-2">{{$detail['Dealer']}}</span>
                                    <span class="col-sm-2">{{$detail['Customer']}}</span>
                                    <span class="col-sm-2">{{$detail['ProjectNo']}}</span>
                                    <span class="col-sm-3 field-date">{{ date('h:i A', strtotime($detail['StartTime']))}}</span>
                                    <span class="col-sm-3">{{$detail['StartWhere']}}</span>
                                </div>
                                <div class="row">
                                    <span class="col-sm-2"></span>
                                    <span class="col-sm-3">{{$detail['Address']}}</span>
                                    <span class="col-sm-2"></span>
                                    <span class="col-sm-3 field-date">{{ date('h:i A', strtotime($detail['SiteTime']))}}</span>
                                    <span class="col-sm-2"></span>
                                </div>
                                <div class="row font-weight-bold">
                                    <span class="col-sm-3 small-head">IhStaff</span>
                                    <span class="col-sm-3 small-head">Subs</span>
                                    <span class="col-sm-1 small-head">Veh</span>
                                    <span class="col-sm-1 small-head">Scr</span>
                                    <span class="col-sm-1 small-head">Dol</span>
                                    <span class="col-sm-1 small-head">Open</span>
                                    <span class="col-sm-2 small-head">Equip</span>
                                </div>
                                <div class="row">
                                    <span class="col-sm-3 ihstaff">{{ $detail['IhStaff']}}</span>
                                    <span class="col-sm-3 subs">{{ $detail['Subs']}}</span>
                                    <span class="col-sm-1 vehicles field-item">{{ $detail['Vehicles'] }}</span>
                                    <span class="col-sm-1 screens field-item">{{ $detail['Screens'] }}</span>
                                    <span class="col-sm-1 flats field-item">{{ $detail['Flats'] }}</span>
                                    <span class="col-sm-1 opens field-item">{{ $detail['Opens'] }}</span>
                                    <span class="col-sm-2 equip field-item">{{ $detail['Equip'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                    <!-- <div class="swiper-pagination"></div> -->
                    <div class="swiper-button-prev swiper-btn"></div>
                    <div class="swiper-button-next swiper-btn"></div>
                    <div class="swiper-scrollbar"></div>
                </div>
            </div>
            @endif
        </div>
       <div id="previewImg"></div>
    </div>
</section>
<script>
  var sortOrder = 'desc';
  var pageUrl = `{{ route('dashboard') }}`;
  var queryString = getUrlVars();
  var count = 2;
  jQuery( function($) {
    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        showOn: "button",
        buttonImage: `{{ URL::to('/') }}/images/icon-calendar.png`,
        buttonImageOnly: true,
        buttonText: "Select date",
    });
  });

  jQuery(document).ready(function($) {
        var my_calendar = $("#dncalendar-container").dnCalendar({
            minDate: "2000-01-01",
            maxDate: "2030-12-02",
            defaultDate: $.datepicker.formatDate('yy-mm-dd', new Date()),
            monthNames: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ], 
            monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            dayNames: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        //   dayNamesShort: [ 'Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab' ],
            dataTitles: { defaultDate: 'default', today : 'hari ini' },
            // notes: [
            //         { "date": "2017-01-01", "note": ["Natal"] },
            //         { "date": "2017-05-12", "note": ["Tahun Baru"] }
            //         ],
        // showNotes: true,
            startWeek: 'monday',
            dayClick: function(date, view) {
              //  alert(date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear());
                const dateClick = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
                if(dateClick){
                    $('#datepicker').val(dateClick);
                    $('#schedules').submit();
                }
            }
        });

        // init calendar
        my_calendar.build();
        let detailstblCount = <?php echo count($detailstbls); ?>;
        if(detailstblCount > 0){
            $('#modal-schedule').modal('toggle');
            if (window.innerWidth <= 1601) {
                const swiper = new Swiper('.swiper', {
                    pagination: {
                        el: '.swiper-pagination',
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    scrollbar: {
                        el: '.swiper-scrollbar',
                    }
                });
            }else if(detailstblCount > 1){
              //  const widthElement = parseInt((window.innerWidth - 150) / 2) * detailstblCount + 'px';
                const widthElement = parseInt((0.9*window.innerWidth - 110) / 2);
                $('.card-body').removeClass('swiper');
                $('.schedule-day').removeClass('swiper-slide');
                $('.schedule-wrapper').removeClass('swiper-wrapper');
                $('.modal-container').addClass('modal-scroll');
               // $('.modal-container .card-body').width(widthElement);
                $('.schedule-day').width(widthElement + 'px');
                $('.modal-container .schedule-wrapper').width(widthElement * 4 + 'px');
                $('.modal-container .modal-header').width(widthElement * 4 + 'px');
            }
            $('.this-week').click(function(){
               // const toDate = new Date(); // get current date
                const toDate = new Date(2021,8,12); // get current date
                const toDay = parseInt(String((new Date).getDate()).padStart(2, '0')); // First day is the day of the month - the day of the week
                const firstDay = new Date(toDate.setDate(toDay - 1)).toISOString().slice(0, 10);
                const lastDay = new Date(toDate.setDate(toDay + 3)).toISOString().slice(0, 10);
                if(firstDay && lastDay){
                    $('#chooseDate').val('');
                    $('#fromDate').val(firstDay);
                    $('#toDate').val(lastDay);
                    $('#schedules').submit();
                }
            })
        }
        $('.btn-today').click(function(){
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            let yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            if(today){
                $('#datepicker').val(today);
                $('#schedules').submit();
            }
        })
    });
    $("#btn_convert").on('click', function () {
        html2canvas(document.getElementById("schedule-content"),{
            allowTaint: true,
            useCORS: true
        }).then(function (canvas) {
            var anchorTag = document.createElement("a");
            document.body.appendChild(anchorTag);
            document.getElementById("previewImg").appendChild(canvas);			anchorTag.download = "filename.jpg";
            anchorTag.href = canvas.toDataURL();
            anchorTag.target = '_blank';
            anchorTag.click();
        });
    });
    function printPdf() {
        var elementHTML = document.getElementById('schedule-content');
        html2canvas(elementHTML, {
            useCORS: true,
            onrendered: function(canvas) {
            var pdf = new jsPDF('l', 'pt', 'a4');

            var pageHeight = $('#schedule-content').height();
            var pageWidth = $('#schedule-content').width();

            for (var i = 0; i <= elementHTML.clientHeight / pageHeight; i++) {
                var srcImg = canvas;
                var sX = 0;
                var sY = pageHeight * i; // start 1 pageHeight down for every new page
                var sWidth = pageWidth;
                var sHeight = pageHeight;
                var dX = 0;
                var dY = 0;
                var dWidth = pageWidth;
                var dHeight = pageHeight;

                window.onePageCanvas = document.createElement("canvas");
                onePageCanvas.setAttribute('width', pageWidth);
                onePageCanvas.setAttribute('height', pageHeight);
                var ctx = onePageCanvas.getContext('2d');
                ctx.drawImage(srcImg, sX, sY, sWidth, sHeight, dX, dY, dWidth, dHeight);

                var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);
                var width = onePageCanvas.width;
                var height = onePageCanvas.clientHeight;

             //   if (i > 0) // if we're on anything other than the first page, add another page
             //   pdf.addPage(612, 864); // 8.5" x 12" in pts (inches*72)

            //    pdf.setPage(i + 1); // now we declare that we're working on that page
                pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width * .3), (height * .3)); // add content to the page
            }
                    
            // Save the PDF
            pdf.save('schedule-content.pdf');
            }
        });
    }
</script>
@endsection