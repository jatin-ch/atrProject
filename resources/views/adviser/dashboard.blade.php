@extends('layouts.adviser')
@section('title') Dashboard @endsection
@section('content')
 <style>
        .name {
            font-size: 16px;
            color: #525252;
        }
.mb-20{
        margin-bottom: -20px;
}
            .name span {
                font-size: 23px;
            }

        .mt30 {
            margin-top: 30px;
        }
        .mt50 {
            margin-top: 50px;
        }

        .mt10 {
            margin-top: 10px;
        }

        .mt20 {
            margin-top: 20px;
        }

        .cont-wrap {
            border: 1px solid #efefef;
            padding: 12px;
        }

        .text26 {
            font-size: 17px;
        }

        .text22 {
            font-size: 22px;
        }

        .text20 {
            font-size: 14px;
        }

        .text40 {
            font-size: 30px;
        }

        .w500 {
            font-weight: 500
        }

        .w600 {
            font-weight: 600
        }

        .w700 {
            font-weight: 700
        }

        .wrap {
            border-radius: 10px;
            margin: 0 auto;
            width: 90%;
            border: 2px solid #757575;
            padding: 20px;
        }

        .bdrlft {
            border-right: 2px solid #757575;
        }

        .q {
            font-size: 34px;
            color: #333333 !important;
        }

        .a {
            font-size: 22px;
            color: #333333 !important;
        }

        .pdr15 {
            padding-right: 15px;
        }

        .mb30 {
            margin-bottom: 30px;
        }

        .bgfooter {
            background: #ecebeb;
        }

        .capi {
            text-transform: uppercase;
        }

        .padding30 {
            padding: 30px;
        }

        /*Chart*/
        .chart {
            width: 100%;
            text-align: center;
        }


        .capital {
            text-transform: uppercase;
        }

        .bgsky {
            background: #f4f4f4;
            padding:20px;
        }

        .yellowcircule {
            border: 8px solid #ffa602;
        }

        .redcircule {
            border: 8px solid #f54337;
        }

        .greencircule {
            border: 8px solid #5cc060;
        }

        .pinkcircule {
            border: 8px solid #ed207b;
        }

        .wolitcircule {
            border: 8px solid #ae2fbe;
        }

        .bluecircule {
            border: 8px solid #3d94fe;
        }

        .circul {
    width: 84%;
    padding: 20px;
    height: 100px;
    border-radius: 50%;
    background: #f4f4f4;
    margin: 0 auto;
}

        .circul2 {
            width: 92%;
    padding: 20px;
    height: 100px;
    border-radius: 50%;
    background: #f4f4f4;
    margin: 0 auto;
        }

        .pannel_1 {
            background: #fff;
        }

        .list ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

            .list ul li {
                font-size: 20px;
                font-weight: 500;
                border-bottom: 2px dashed #000000;
                margin-bottom: 20px;
                padding: 5px 0 5px;
            }

                .list ul li span {
                 float:right;
                }
        .tabgreen {
    position: absolute;
    left: 15px;
    top: 20px;
    background: #33a853;
    color: #fff;
    /* width: 100%; */
    margin: 0 auto;
    padding: 1px 25px;
    text-align: center;
}
        .tabgreenlft {
            background: #33a853;
            color: #fff;
            width: 35%;
            padding: 5px;
            text-align: center;
            margin-left: -15px;
        }
        .bdr_right{border-right:2px dashed;} .mt_15 {
            margin-top: -15px;
        }
        .content-wrapper{
                background: white!important;
        }
        /*.padding0{padding:0;}*/


    </style>

 <!-- Content Header (Page header) -->
    <!--<section class="content-header">-->
    <!--  <h1>-->
    <!--    Dashboard-->
    <!--    <small>Admin</small>-->
    <!--  </h1>-->
    <!--  <ol class="breadcrumb">-->
    <!--    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>-->
    <!--  </ol>-->
    <!--</section>-->
<!--<hr style="border: 1px solid #00a65a;">-->
    <!-- Main content -->
     <section class="content">
      <!-- Small boxes (Stat box) -->
     <div class="container-fluid">

        <div class="row bgsky mt20">
            <h3 class="text-center w600">Consulations </h3>
            <div class="row ">
                <div class="col-md-6 mt10">
                    <div class="panel panel-default">
                     <div class="tabgreen text26">
                                Order
                            </div>
                        <div class="panel-body">
                            <div class="chart1 text-center">
                                <canvas id="canvas1" class="mt50 img-responsive" width="400" height="250"></canvas>
                                <h3 class="w600 text-center">Total No. of order</h3>
                                <p class="w500 text-center text26">1400</p>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6 mt10">
                    <div class="panel panel-default">
                     <div class="tabgreen text26">
                                Revenue
                            </div>
                        <div class="panel-body">
                            <div class="chart1 text-center">
                                <canvas id="canvas2" class="mt50 img-responsive" width="400" height="250"></canvas>
                                <h3 class="w600 text-center">Total No. of order</h3>
                                <p class="w500 text-center text26">INR 1400/-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row bgsky mt20">
            <h3 class="text-center w600">Services</h3>
            <div class="row ">
                <div class="col-md-6 mt10">
                    <div class="panel panel-default">
                     <div class="tabgreen text26">
                                Order
                            </div>
                        <div class="panel-body">
                            <div class="chart1 text-center">
                                <canvas id="canvas3" class="mt50 img-responsive" width="400" height="250"></canvas>
                                <h3 class="w600 text-center">Total No. of order</h3>
                                <p class="w500 text-center text26">1400</p>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6 mt10">
                    <div class="panel panel-default">
                     <div class="tabgreen text26">
                                Revenue
                            </div>
                        <div class="panel-body">
                            <div class="chart1 text-center">
                                <canvas id="canvas4" class="mt50 img-responsive" width="400" height="250"></canvas>
                                <h3 class="w600 text-center">Total No. of order</h3>
                                <p class="w500 text-center text26">INR 1400/-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row bgsky mt20">
            <h3 class="text-center mt10 w600 ">Order by status</h3>
            <div class="panel pannel_1 panel-default mt20">
                <div class="panel-body">
                    <div class="row mt30 mb30">
                        <div class="col-md-2">
                            <div class="yellowcircule text-center circul">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Confirmed</p>
                        </div>
                        <div class="col-md-2">
                            <div class="redcircule text-center circul">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Reschedule</p>
                        </div>
                        <div class="col-md-2">
                            <div class="pinkcircule text-center circul">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Cancelled</p>
                        </div>
                        <div class="col-md-2">
                            <div class="wolitcircule text-center circul">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">In Proceses</p>
                        </div>
                        <div class="col-md-2">
                            <div class="greencircule text-center circul">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Completed</p>
                        </div>
                        <div class="col-md-2">
                            <div class="bluecircule text-center circul">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Paid</p>
                        </div>
                    </div>
                    <p class="w500 text-center text40 mb-20">1400</p>
                    <h2 class="w600 text-center">Total Bookings</h2>
                </div>
            </div>

            <div class="panel pannel_1 panel-default mt20">
                <div class="panel-body">
                    <div class="row mt30 mb30">

                        <div class="col-md-2">
                            <div class="yellowcircule text-center circul">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Confirmed</p>
                        </div>
                        <div class="col-md-2">
                            <div class="redcircule text-center circul">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Reschedule</p>
                        </div>
                        <div class="col-md-2">
                            <div class="pinkcircule text-center circul">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Cancelled</p>
                        </div>
                        <div class="col-md-2">
                            <div class="wolitcircule text-center circul">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">In Proceses</p>
                        </div>
                        <div class="col-md-2">
                            <div class="greencircule text-center circul">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Completed</p>
                        </div>
                        <div class="col-md-2">
                            <div class="bluecircule text-center circul">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Paid</p>
                        </div>
                    </div>
                    <p class="w500 text-center mb-20 text40">1400</p>
                    <h2 class="w600 text-center">Total Bookings</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid">
        <div class="">
            <div class="row mt30 ">
                <div class="col-md-6 padding0">
                    <div class="panel bgsky panel-default mt20">
                        <div class="panel-body">

                            <div class="tabgreen text40 capital" style="left:185px">
                                Ask Us
                            </div>
                            <div class="list mt20">
                                <ul>
                                    <li>
                                        Total Question Asked <span class="num">145</span>
                                    </li>
                                    <li>
                                        Total Question Answered<span class="num">145</span>
                                    </li>
                                    <li>
                                        Total Likes  <span class="num">145</span>
                                    </li>
                                    <li>
                                        <b>  Total Question Asked</b> <span class="num w600">145</span>
                                    </li>
                                </ul>

                                <p class="mt20 text20 w300">Payout Rule :  `10/- per answer, `-4/- per dislike</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 padding0">
                    <div class="panel bgsky panel-default mt20">
                        <div class="panel-body">

                            <div class="tabgreen  text40 capital" style="left:185px">
                                Blogs
                            </div>
                            <div class="list mt20">
                                <ul>
                                    <li>
                                        Total Question Asked <span class="num">145</span>
                                    </li>
                                    <li>
                                        Total Question Answered<span class="num">145</span>
                                    </li>
                                    <li>
                                        Total Likes  <span class="num">145</span>
                                    </li>
                                    <li>
                                        <b>  Total Question Asked</b> <span class="num w600">145</span>
                                    </li>
                                </ul>

                                <p class="mt20 text20 w300">Payout Rule :  10/- per answer, -4/- per dislike</p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="row mt20">
                <div class="col-md-6 padding0">
                    <div class="panel bgsky panel-default mt20">
                        <div class="panel-body">
                            <h3 class="text-center w600 capital">Cancellation</h3>
                             <div class="tabgreen text26" style="top:40px;">
                                Consultation
                            </div>
                            <div class="list mt20">
                                <ul>
                                    <li>
                                        Orders  <span class="num">145</span>
                                    </li>
                                    <li>
                                        <b>  Value</b> <span class="num w600">145</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="tabgreen text26" style="top:242px;">
                                Service
                            </div>
                            <div class="list mt50">
                                <ul>
                                    <li>
                                        Orders  <span class="num">145</span>
                                    </li>
                                    <li>
                                        <b>  Value</b> <span class="num w600">145</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 padding0">
                    <div class="panel bgsky panel-default mt20">
                        <div class="panel-body">
                            <h3 class="text-center  w600 capital">Reschedule</h3>
                            <div class="tabgreen text26" style="top:40px;">
                                Consultation
                            </div>
                            <div class="list mt20">
                                <ul>
                                    <li>
                                        Orders  <span class="num">145</span>
                                    </li>
                                    <li>
                                        <b>  Value</b> <span class="num w600">145</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="tabgreen text26" style="top:242px;">
                                Service
                            </div>
                            <div class="list mt50">
                                <ul>
                                    <li>
                                        Orders  <span class="num">145</span>
                                    </li>
                                    <li>
                                        <b>  Value</b> <span class="num w600">145</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>


    <div class=" bgsky mt20">
        <h3 class="text-center w600 capital">Payment</h3>
        <div class="panel pannel_1 panel-default mt20">
             <div class="text26 tabgreen">
                    Consultation
                </div>
            <div class="panel-body">


                <div class="row mt20 mb30">

                    <div class="col-md-4">

                        <div class="col-md-6">
                            <div class="yellowcircule text-center circul2">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Confirmed</p>
                        </div>
                        <div class="col-md-6">
                            <div class="redcircule text-center circul2">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Reschedule</p>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="col-md-6">
                            <div class="pinkcircule text-center circul2">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Cancelled</p>
                        </div>
                        <div class="col-md-6">
                            <div class="wolitcircule text-center circul2">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">In Proceses</p>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="col-md-6">
                            <div class="greencircule text-center circul2">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Completed</p>
                        </div>
                        <div class="col-md-6">
                            <div class="bluecircule text-center circul2">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Paid</p>
                        </div>

                    </div>
                    </div>
                <p class="w500 text-center text40">1400</p>
                <h3 class="w600 text-center capital">Total Bookings</h3>
            </div>
        </div>

        <div class="panel pannel_1 panel-default mt20">
            <div class="text26 tabgreen">
                    Service
                </div>
            <div class="panel-body">


                <div class="row mt20 mb30">

                    <div class="col-md-4">

                        <div class="col-md-6">
                            <div class="yellowcircule text-center circul2">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Confirmed</p>
                        </div>
                        <div class="col-md-6">
                            <div class="redcircule text-center circul2">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Reschedule</p>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="col-md-6">
                            <div class="pinkcircule text-center circul2">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Cancelled</p>
                        </div>
                        <div class="col-md-6">
                            <div class="wolitcircule text-center circul2">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">In Proceses</p>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="col-md-6">
                            <div class="greencircule text-center circul2">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Completed</p>
                        </div>
                        <div class="col-md-6">
                            <div class="bluecircule text-center circul2">
                                <span class="text40 w500">700</span>
                            </div>
                            <p class="w500 text-center mt20 text26">Paid</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>



    <script>

        var myColor = ["#39ca74", "#e54d42", "#f0c330", "#3999d8", "#35485d"];
        var myData = [80, 23, 15, 7, 1];
        var myLabel = ["Hello", "Hi", "Howdy", "Wadup", "Yo"];

        function getTotal() {
            var myTotal = 0;
            for (var j = 0; j < myData.length; j++) {
                myTotal += (typeof myData[j] == 'number') ? myData[j] : 0;
            }
            return myTotal;
        }

        function plotData() {
            var canvas;
            var ctx;
            var lastend = 0;
            var myTotal = getTotal();
            var doc;
            canvas1 = document.getElementById("canvas1");
            var x = (canvas1.width) / 2;
            var y = (canvas1.height) / 2;
            var r = 90;

            ctx = canvas1.getContext("2d");
            ctx.clearRect(0, 0, canvas1.width, canvas1.height);

            for (var i = 0; i < myData.length; i++) {
                ctx.fillStyle = myColor[i];
                ctx.beginPath();
                ctx.moveTo(x, y);
                ctx.arc(x, y, r, lastend, lastend + (Math.PI * 2 * (myData[i] / myTotal)), false);
                ctx.lineTo(x, y);
                ctx.fill();

                // Now the pointers
                ctx.beginPath();
                var start = [];
                var end = [];
                var last = 0;
                var flip = 0;
                var textOffset = 0;
                var precentage = (myData[i] / myTotal) * 100;
                start = getPoint(x, y, r - 20, (lastend + (Math.PI * 2 * (myData[i] / myTotal)) / 2));
                end = getPoint(x, y, r + 20, (lastend + (Math.PI * 2 * (myData[i] / myTotal)) / 2));
                if (start[0] <= x) {
                    flip = -1;
                    textOffset = -110;
                }
                else {
                    flip = 1;
                    textOffset = 10;
                }
                ctx.moveTo(start[0], start[1]);
                ctx.lineTo(end[0], end[1]);
                ctx.lineTo(end[0] + 120 * flip, end[1]);
                ctx.strokeStyle = "#bdc3c7";
                ctx.lineWidth = 2;
                ctx.stroke();
                // The labels
                ctx.font = "17px Arial";
                ctx.fillText(myLabel[i] + " " + precentage.toFixed(2) + "%", end[0] + textOffset, end[1] - 4);
                // Increment Loop
                lastend += Math.PI * 2 * (myData[i] / myTotal);

            }
        }
        // Find that magical point
        function getPoint(c1, c2, radius, angle) {
            return [c1 + Math.cos(angle) * radius, c2 + Math.sin(angle) * radius];
        }
        // The drawing
        plotData();
    </script>
    <script>

        var myColor = ["#39ca74", "#e54d42", "#f0c330", "#3999d8", "#35485d"];
        var myData = [80, 23, 15, 7, 1];
        var myLabel = ["Hello", "Hi", "Howdy", "Wadup", "Yo"];

        function getTotal() {
            var myTotal = 0;
            for (var j = 0; j < myData.length; j++) {
                myTotal += (typeof myData[j] == 'number') ? myData[j] : 0;
            }
            return myTotal;
        }

        function plotData() {
            var canvas2;
            var ctx;
            var lastend = 0;
            var myTotal = getTotal();
            var doc;
            canvas2 = document.getElementById("canvas2");
            var x = (canvas2.width) / 2;
            var y = (canvas2.height) / 2;
            var r = 90;

            ctx = canvas2.getContext("2d");
            ctx.clearRect(0, 0, canvas2.width, canvas2.height);

            for (var i = 0; i < myData.length; i++) {
                ctx.fillStyle = myColor[i];
                ctx.beginPath();
                ctx.moveTo(x, y);
                ctx.arc(x, y, r, lastend, lastend + (Math.PI * 2 * (myData[i] / myTotal)), false);
                ctx.lineTo(x, y);
                ctx.fill();

                // Now the pointers
                ctx.beginPath();
                var start = [];
                var end = [];
                var last = 0;
                var flip = 0;
                var textOffset = 0;
                var precentage = (myData[i] / myTotal) * 100;
                start = getPoint(x, y, r - 20, (lastend + (Math.PI * 2 * (myData[i] / myTotal)) / 2));
                end = getPoint(x, y, r + 20, (lastend + (Math.PI * 2 * (myData[i] / myTotal)) / 2));
                if (start[0] <= x) {
                    flip = -1;
                    textOffset = -110;
                }
                else {
                    flip = 1;
                    textOffset = 10;
                }
                ctx.moveTo(start[0], start[1]);
                ctx.lineTo(end[0], end[1]);
                ctx.lineTo(end[0] + 120 * flip, end[1]);
                ctx.strokeStyle = "#bdc3c7";
                ctx.lineWidth = 2;
                ctx.stroke();
                // The labels
                ctx.font = "17px Arial";
                ctx.fillText(myLabel[i] + " " + precentage.toFixed(2) + "%", end[0] + textOffset, end[1] - 4);
                // Increment Loop
                lastend += Math.PI * 2 * (myData[i] / myTotal);

            }
        }
        // Find that magical point
        function getPoint(c1, c2, radius, angle) {
            return [c1 + Math.cos(angle) * radius, c2 + Math.sin(angle) * radius];
        }
        // The drawing
        plotData();
    </script>
    <script>

         var myColor = ["#39ca74", "#e54d42", "#f0c330", "#3999d8", "#35485d"];
         var myData = [80, 23, 15, 7, 1];
         var myLabel = ["Hello", "Hi", "Howdy", "Wadup", "Yo"];

         function getTotal() {
             var myTotal = 0;
             for (var j = 0; j < myData.length; j++) {
                 myTotal += (typeof myData[j] == 'number') ? myData[j] : 0;
             }
             return myTotal;
         }

         function plotData() {
             var canvas3;
             var ctx;
             var lastend = 0;
             var myTotal = getTotal();
             var doc;
             canvas3 = document.getElementById("canvas3");
             var x = (canvas3.width) / 2;
             var y = (canvas3.height) / 2;
             var r = 90;

             ctx = canvas3.getContext("2d");
             ctx.clearRect(0, 0, canvas3.width, canvas3.height);

             for (var i = 0; i < myData.length; i++) {
                 ctx.fillStyle = myColor[i];
                 ctx.beginPath();
                 ctx.moveTo(x, y);
                 ctx.arc(x, y, r, lastend, lastend + (Math.PI * 2 * (myData[i] / myTotal)), false);
                 ctx.lineTo(x, y);
                 ctx.fill();

                 // Now the pointers
                 ctx.beginPath();
                 var start = [];
                 var end = [];
                 var last = 0;
                 var flip = 0;
                 var textOffset = 0;
                 var precentage = (myData[i] / myTotal) * 100;
                 start = getPoint(x, y, r - 20, (lastend + (Math.PI * 2 * (myData[i] / myTotal)) / 2));
                 end = getPoint(x, y, r + 20, (lastend + (Math.PI * 2 * (myData[i] / myTotal)) / 2));
                 if (start[0] <= x) {
                     flip = -1;
                     textOffset = -110;
                 }
                 else {
                     flip = 1;
                     textOffset = 10;
                 }
                 ctx.moveTo(start[0], start[1]);
                 ctx.lineTo(end[0], end[1]);
                 ctx.lineTo(end[0] + 120 * flip, end[1]);
                 ctx.strokeStyle = "#bdc3c7";
                 ctx.lineWidth = 2;
                 ctx.stroke();
                 // The labels
                 ctx.font = "17px Arial";
                 ctx.fillText(myLabel[i] + " " + precentage.toFixed(2) + "%", end[0] + textOffset, end[1] - 4);
                 // Increment Loop
                 lastend += Math.PI * 2 * (myData[i] / myTotal);

             }
         }
         // Find that magical point
         function getPoint(c1, c2, radius, angle) {
             return [c1 + Math.cos(angle) * radius, c2 + Math.sin(angle) * radius];
         }
         // The drawing
         plotData();
    </script>
    <script>

         var myColor = ["#39ca74", "#e54d42", "#f0c330", "#3999d8", "#35485d"];
         var myData = [80, 23, 15, 7, 1];
         var myLabel = ["Hello", "Hi", "Howdy", "Wadup", "Yo"];

         function getTotal() {
             var myTotal = 0;
             for (var j = 0; j < myData.length; j++) {
                 myTotal += (typeof myData[j] == 'number') ? myData[j] : 0;
             }
             return myTotal;
         }

         function plotData() {
             var canvas4;
             var ctx;
             var lastend = 0;
             var myTotal = getTotal();
             var doc;
             canvas4 = document.getElementById("canvas4");
             var x = (canvas3.width) / 2;
             var y = (canvas3.height) / 2;
             var r = 90;

             ctx = canvas4.getContext("2d");
             ctx.clearRect(0, 0, canvas4.width, canvas4.height);

             for (var i = 0; i < myData.length; i++) {
                 ctx.fillStyle = myColor[i];
                 ctx.beginPath();
                 ctx.moveTo(x, y);
                 ctx.arc(x, y, r, lastend, lastend + (Math.PI * 2 * (myData[i] / myTotal)), false);
                 ctx.lineTo(x, y);
                 ctx.fill();

                 // Now the pointers
                 ctx.beginPath();
                 var start = [];
                 var end = [];
                 var last = 0;
                 var flip = 0;
                 var textOffset = 0;
                 var precentage = (myData[i] / myTotal) * 100;
                 start = getPoint(x, y, r - 20, (lastend + (Math.PI * 2 * (myData[i] / myTotal)) / 2));
                 end = getPoint(x, y, r + 20, (lastend + (Math.PI * 2 * (myData[i] / myTotal)) / 2));
                 if (start[0] <= x) {
                     flip = -1;
                     textOffset = -110;
                 }
                 else {
                     flip = 1;
                     textOffset = 10;
                 }
                 ctx.moveTo(start[0], start[1]);
                 ctx.lineTo(end[0], end[1]);
                 ctx.lineTo(end[0] + 120 * flip, end[1]);
                 ctx.strokeStyle = "#bdc3c7";
                 ctx.lineWidth = 2;
                 ctx.stroke();
                 // The labels
                 ctx.font = "17px Arial";
                 ctx.fillText(myLabel[i] + " " + precentage.toFixed(2) + "%", end[0] + textOffset, end[1] - 4);
                 // Increment Loop
                 lastend += Math.PI * 2 * (myData[i] / myTotal);

             }
         }
         // Find that magical point
         function getPoint(c1, c2, radius, angle) {
             return [c1 + Math.cos(angle) * radius, c2 + Math.sin(angle) * radius];
         }
         // The drawing
         plotData();
    </script>

    </section>
    <!-- /.content -->

@endsection
