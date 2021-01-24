<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            *{
                padding: 0;
                margin: 0;
            }
            body, html{
                height: 100%;
            }
            .container{
                background-color: #c6c8ca;
                padding: 5px;
                min-height: 100%;
                box-sizing: border-box;
            }
            .report-container{
                background-color: white;
                margin: auto;
                width: 40%;
                padding: 10px;
                text-align: center;
            }
            .align-center{
                text-align: center;
            }
            .purple-text{
                color: #6574cd;
            }
            .font{
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";;
            }
            .mb-25{
                margin-bottom: 25px;
            }
            .mt-25{
                margin-top: 25px;
            }
            .margin{
                margin: 20px;
            }
            .bold-text{
                font-weight: bold;
            }
            .font-30{
                font-size: 20px;
            }
            .font-40{
                font-size: 30px;
            }
            .font-15{
                font-size: 15px;
            }
            .rounded{
                border-radius: 10px;
            }
            table{
                width: 100%;
                border-collapse: collapse;
            }
            .first-left{
                text-align: left;
            }
            .last-right{
                text-align: right;
            }

            .even td{
                padding-bottom: 25px;
            }
            .odd td{
                padding-bottom: 25px;
                padding-top: 25px;
            }
            .border-bottom {
                border-bottom: 1px solid #c6c8ca;
            }
            .border-top {
                border-top: 1px solid #c6c8ca;
            }
            .text-success{
                color: #28a745;
            }
            .text-danger{
                color: #dc3545;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="align-center font font-40 bold-text margin">
                PFT
            </div>
            <div class="report-container font rounded font-15">
                <div class="margin">
                    <h2 class="mb-25 purple-text">Monthly Report {{$month}}</h2>
                    <div class="mb-25 bold-text font-30"> @if($total_balance > 0) + @endif{{\App\Helpers\Helpers::NumberFormat($total_balance, 2)}} {{$currency}} </div>
                    <table>
                        <tr class="border-top odd">
                            <td class="first-left">Balance at the start of month</td>
                            <td class="last-right">
                                <span class="@if($start_balance >= 0) text-success bold-text @else text-danger bold-text @endif">
                                    {{\App\Helpers\Helpers::NumberFormat($start_balance, 2)}}
                                </span>
                                &nbsp;&nbsp;&nbsp;{{$currency}}
                            </td>
                        </tr>
                        <tr class="border-bottom even">
                            <td class="first-left">Balance at the end of month</td>
                            <td class="last-right">
                                <span class="@if($end_balance >= 0) text-success bold-text @else text-danger bold-text @endif">
                                    {{\App\Helpers\Helpers::NumberFormat($end_balance, 2)}}
                                </span>
                                &nbsp;&nbsp;&nbsp;{{$currency}}
                            </td>
                        </tr>
                        <tr class="odd">
                            <td class="first-left">Income</td>
                            <td class="last-right">
                                <span class="@if($income >= 0) text-success bold-text @else text-danger bold-text @endif">
                                    {{\App\Helpers\Helpers::NumberFormat($income, 2)}}
                                </span>
                                &nbsp;&nbsp;&nbsp;{{$currency}}
                            </td>
                        </tr>
                        <tr class="border-bottom even">
                            <td class="first-left">Expense</td>
                            <td class="last-right">
                                <span class="@if($expense >= 0) text-success bold-text @else text-danger bold-text @endif">
                                    {{\App\Helpers\Helpers::NumberFormat($expense, 2)}}
                                </span>
                                &nbsp;&nbsp;&nbsp;{{$currency}}
                            </td>
                        </tr>
                        <tr class="border-bottom odd">
                            <td class="first-left">Transactions</td>
                            <td class="bold-text purple-text last-right"> {{$transactions}} </td>
                        </tr>
                        <tr class="odd">
                            <td colspan="2" class="align-center purple-text bold-text font-30">Prognosis</td>
                        </tr>
                        @if(empty($avg_per_month))
                            <tr>
                                <td colspan="2" class="font">Sorry, for prognosis, there must be transactions for at least 3 months.</td>
                            </tr>
                        @else
                            @foreach($avg_per_month as $key => $value)
                                <tr class="even">
                                    <td class="first-left">{{$key}}</td>
                                    <td class="last-right">
                                    <span class="bold-text">
                                    {{\App\Helpers\Helpers::NumberFormat($value, 2)}}
                                    </span>
                                        &nbsp;&nbsp;&nbsp;{{$currency}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
            <div class="align-center mt-25 font">
                &copy; 2020-{{date("Y")}} PFT Lubov Langleben
            </div>
        </div>
    </body>
</html>
