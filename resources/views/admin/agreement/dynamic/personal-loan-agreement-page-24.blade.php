<!DOCTYPE html>
<html>
<head>
    <title>{{ $data->fileName }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        @page { margin: 0px; }
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html {
            font-family: "Arial", sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }
        .page-break {
            page-break-after: always;
            margin-top:30px;
            margin-bottom:30px;
        }
        #cover-page table{
            border: 6px groove #000000;
            border-collapse: separate;
            height: 100%;
            margin: 0;
        }
        #cover-page h1{
            font-size: 35px;
            text-align: center;
            line-height: 70px;
        }
        #cover-page span{
            line-height: 25px;
        }
        #cover-page span a{
            color: rgba(52, 106, 160, 1);
            font-weight: 500;
        }
        #cover-page .logo-img{
            width: 180px;
            margin: 30px auto;
        }
        .cover-meta p{
            font-size: 18px;
        }
        #outer_content {
            width: 100%;
        }
        /*#DivIdToPrint {*/
        /*    width: 80%;   */
        /*    margin: 0 auto; */
        /*}*/
        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            cursor: pointer;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        body {
            margin-top: 0px;margin-left: 0px;
            background-color: #323639;
            font-size: 14px;
            font-family: 'Segoe UI', sans-serif;
        }
        .pdf-header{
            max-width: 100%;
            padding: 15px 30px;
            background-color: #323639;
            box-shadow: 1px 1px 10px 1px #000000;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
        }
        .pdf-header h1{
            color: #ffffff;
            font-size: 16px;
        }
        .pdf-header .btn-primary {
            position: relative;
            top: 0;
            color: #fff;
            padding: 10px 30px;
            background-color: rgb(100 104 118);
            box-shadow: none;
            box-shadow:  0px 1px 5px #2b2b2b;
            transition: all 0.1s ease-in-out;
            font-size: 16px;
            letter-spacing: 1px;
            box-shadow: 0 3px 0 #2b2b2b, 0 2px 15px -4px #2b2b2b;
        }
        .pdf-header .btn-primary:hover, .pdf-header .btn-primary:focus {
        opacity: 0.9;
        outline: 0;
        }
        .pdf-header .btn-primary:active {
        box-shadow: none;
        top: 3px;
        }
        .page{
            margin: unset !important;
            margin: 0 auto !important;
            background-color: #fff;
            padding: 30px !important;
            width: 100%;
            max-width: 1000px;
            height: 1115px !important;
            overflow:hidden;
            position: relative;
        }
        .page ol{
            padding-left: 30px;
        }
        .page p{
            margin-bottom: 8px;
            font-weight: 500;
            letter-spacing: 0.35px;
            font-size: 13px;
            line-height: 20px;
        }
        .page h3{
            text-align: center;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            padding: 0 30px;
        }
        .page h5{
            font-size: 15px;
            font-weight: 600;
            text-align: center;
        }
        .page-no{
            position: absolute;
            text-align: center;
            bottom: 5px;
            left: 0;
            right: 0;
        }
        .sign-table{
            border: 0 !important;
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
        }
        .sign-table td{
            width: 33.33%;
            border: 0;
            text-align: center;
        }
        .sign-line{
            width: 80%;
            margin: 0 auto;
            height: 1px;
            border-top: 1px solid #32363996;
            margin-bottom: 8px;
        }
        .page table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            font-size: 14px;
            margin: 20px 0;
        }
        table td, table th  {
            padding: 5px;
            border: 1px solid #000;
        }
        .empty-table td{
            padding: 12px;
        }
        .text-center {
            text-align: center
        }
        .border0, .table_30 tr td, .sign-table tr{
            border: 0 !important;
        }

        .cps{
            text-align:left !important;
            padding-left: 40px !important;
        }
        .cps span{
            display:inline-block;
            width:30%;
        }
    </style>
</head>
<body>
    <header class="pdf-header">
        <div style="width:100%; max-width: 1000px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between;">
            <h1>
                {{$data->fileName}}.pdf
            </h1>
            <button id='print-btn' onclick='printDiv();' class="btn btn-sm btn-primary">Print <i class="fas fa-print"></i> </button>
        </div>
    </header>

    @php
        $coBorrowerDetails = '';
        if ( !empty($data->prefixofthecoborrower) && !empty($data->nameofthecoborrower) ) {
            $coBorrowerDetails = 'and Co-Borrower '.$data->prefixofthecoborrower.' '.$data->nameofthecoborrower;
        }

        $coBorrower2Details = '';
        if ( !empty($data->prefixofthecoborrower2) && !empty($data->nameofthecoborrower2) ) {
            $coBorrower2Details = 'Co-Borrower '.$data->prefixofthecoborrower2.' '.$data->nameofthecoborrower2;
        }

        $guarantorDetails = '';
        if ( !empty($data->prefixoftheguarantor) && !empty($data->nameoftheguarantor) ) {
            $guarantorDetails = 'Guarantor '.$data->prefixoftheguarantor.' '.$data->nameoftheguarantor;
        }
    @endphp

    <div class="page" style="margin-top: 100px;" id="DivIdToPrint">
        <br><br><br><br><br><br>

        <div style="width:100%;height:300px"></div>

        <table class="border0">
            <tr>
                <td  class="border0">
                    <p>
                        This non judicial stamp paper of Rs 10/- (Rupees Ten) is part & parcel of the Continuing Security Letter dated {{$data->dateofagreement}} executed by the Borrower {{$data->prefixoftheborrower}} {{$data->nameoftheborrower}} {{$coBorrowerDetails}} {{$coBorrower2Details}} in respect of Loan Account No. {{$data->loanaccountnumber}}.
                    </p>
                </td>
            </tr>
        </table>

        <table cellpadding=0 cellspacing=0 class="sign-table">
            <tr>
                <td>
                    <div class="sign-line"></div>
                    <b>Borrower</b>
                </td>
                <td>
                    <div class="sign-line"></div>
                    <b>Co-Borrower</b>
                </td>
            </tr>
        </table>
    </div>
</body>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://jasonday.github.io/printThis/printThis.js"></script>

<script>
    function printDiv() {
        $('#DivIdToPrint').printThis({
            importCSS: true,
            importStyle: true,
        });
    }

    $(document).ready(function () {
        @if (request() -> status == 'download')
            printDiv();
        @endif
    });
</script>

</html>