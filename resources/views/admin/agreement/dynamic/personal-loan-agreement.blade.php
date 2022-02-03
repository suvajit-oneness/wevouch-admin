<!DOCTYPE html>
<html>
<head>
    <title>{{ $data->fileName }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .table_17 td:first-child{
            width: 200px;
        }
        .table_18 td:first-child, .table_19 td:first-child{
            width: 40%;
        }
        .table_18 td:last-child, .table_19 td:last-child{
            width: 60%;
        }
        .table_1 td:first-child{
            width:30%;
        }
        .table_1 td:last-child{
            width:70%;
        }
        .table-22-td1{
            width:15%;
        }
        .table-22-td3{
            width:20%;
        }
        .table_23 .stamp-tr td:first-child, .table-22-td2{
            width:65%;
        }
        .table_23 .stamp-tr td:last-child{
            width:35%;
        }
        .table_18 td{
            padding: 20px 15px;
        }
        .table_19 td, .table_22 td{
            padding: 15px;
        }
        .table_19 td p, .table_19 td, .table_18 td p, .table_17 td p, .table_17 td{
            margin: 0 !important;
            font-size: 12px;
        }
        .stamp {
            border: 1px solid #000;
            margin-top: 20px;
            padding: 2px;
            display: inline-block;
            position: absolute;
            top: 20px;
            left: 40px;
        }
        #page_16 *{
            margin: 0;
            padding: 0;
        }
        #page_16 table{
            margin-top: 30px;
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
    <br><br><br><br>
    <div id="outer_content">
        <div id="DivIdToPrint">

            <div class="page" id="cover-page">

                <table>
                    <tr>
                        <td style="text-align: center;">
                            <h1>
                                PERSONAL <br>
                                LOAN <br>
                                FACILITY <br>
                                AGREEMENT
                            </h1>
                            <h3><b>Peerless Financial Services Limited </b></h3>
                            
                            <p>Registered & Head Office </p>

                            <p><b>Peerless Bhavan, 3 Esplanade East Kolkata 700069</b></p>
                            <span>
                                <b>Phone</b> : <a href="tel:033-40622525">033-40622525 </a>
                                || 
                                <b>Email</b> : <a href="mailto:pfs@peerlessfinance.in">pfs@peerlessfinance.in</a> 
                                <br>
                                <b>Website</b> : <a href="https://www.peerlessfinance.in">www.peerlessfinance.in</a>
                            </span>
                            <div class="logo-img">
                                <img style="width:100%;" src="https://www.peerlessfinance.in/assets/images/logo.png" alt="">
                            </div>
                            <p>
                                <b>CIN: U65993WB1988PLC044077</b>
                            </p>

                            <div class="cover-meta" style="margin: 50px 0;">
                                <p>
                                    <b>Customer ID </b> &nbsp; &nbsp;
                                    <b>{{$data->customerid}}</b>
                                    {{-- <b style="border-bottom: 1px solid #000000; padding-bottom: 5px; width: 280px; min-height: 1px; display: inline-block;"></b> --}}
                                </p>
                                
                                <p>
                                    <b>Loan Account No  </b> &nbsp; &nbsp;
                                    <b>{{$data->loanaccountnumber}}</b>
                                    {{-- <b style="border-bottom: 1px solid #000000; padding-bottom: 5px; width: 280px; min-height: 1px; display: inline-block;"></b> --}}
                                </p>
                            </div>
                        </td>
                        
                    </tr>
                </table>

            </div>
            <div class="page-break"></div>

            <div class="page" id="page_1">
                <img src="{{asset('admin/static-required/stamp.jpg')}}" alt="" style="width: 650px; height:320px;object-fit:scale-down;display:block;margin:0 auto;">

                <h3 style="margin-bottom: 60px">AGREEMENT</h3>
                <p>General Instructions :</P>
                <p>All applications to be filled in <b>English</b> in CAPITAL LETTERS using
                    Ballpoint pen only.</P>
                <p>Any amendments / overwriting / erasures/cuttings / hand written information in the blank
                    space on any page should be countersigned.</P>
                <p>The signature of the Borrower / <NOBR>Co-Borrower /</NOBR> Guarantor should be the same on
                    the Loan Agreement & Loan Application Form.</P>
                <p>All photocopies provided, to be <NOBR>self-attested /</NOBR> authenticated.</P>
                <p>All pages of Schedules, Loan Agreement and Annexures to be mandatorily signed by the
                    Borrower / Co Borrower and Guarantor, as may be specifically mentioned.</P>
                <p>Deeds / agreements, as per format of PFSL, to be additionally executed with the
                    Borrower(s) / Guarantor(s) as may be required under the terms of the Sanction Letter and
                    appended to the
                    Personal Loan Facility Agreement</P>


                <table style="margin-top: 20px;" class="table_1">
                    <tr>
                        <th colspan="2">For Office Use Only</th>
                    </tr>
                    <tr>
                        <td>Customer ID:</td>
                        <td>
                            {{$data->customerid}}
                        </td>
                    </tr>
                    <tr>
                        <td>Name of the Borrower:</td>
                        <td>
                            {{$data->nameoftheborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>Name of the Co-Borrower:</td>
                        <td>
                            {{$data->nameofthecoborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>Name of the Guarantor:</td>
                        <td>
                            {{$data->nameoftheguarantor}}
                        </td>
                    </tr>
                    <tr>
                        <td>Loan Application Number:</td>
                        <td>
                            {{$data->loanapplicationnumber}}
                        </td>
                    </tr>
                    <tr>
                        <td>Loan Account Number:</td>
                        <td>
                            {{$data->loanaccountnumber}}
                        </td>
                    </tr>
                </table>
                <p class="page-no">1</p>
            </div>
            <div class="page-break"></div>

            <div class="page" id="page_2">

                <h3 class="text-center">INDEX OF LEGAL DOCUMENTS FOR PERSONAL LOAN</h3>

                <table cellpadding=0 cellspacing=0>
                    <tr>
                        <td></td>
                        <th class="text-center" colspan="2">NAME OF DOCUMENT</th>
                        <td>Page No.</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td colspan="2">
                            <b>LOAN AGREEMENT</b>
                        </td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td colspan="2">
                            <b>SCHEDULE OF AGREEMENT</b>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(i) Schedule - I</td>
                        <td>Details of Borrower(s), Guarantor with date and place of execution</td>
                        <td>17</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(ii) Schedule - II</td>
                        <td>Key Facts of Loan Agreement</td>
                        <td>18</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(iii) Schedule - III</td>
                        <td>Other Terms and Conditions of Sanction of Personal Loan</td>
                        <td>20</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(iv) Schedule - IV</td>
                        <td>Documents to be attached with Application for loan</td>
                        <td>21</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(v) Schedule - V</td>
                        <td>Facility Specific Documents to be attached with the Loan Agreement</td>
                        <td>22</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td colspan="2">
                            <b>ANNEXURES OF OTHER LEGAL INSTRUMENTS EXECUTED BY BORROWER (S)
                                IN CONNECTION WITH LOAN AGREEMENT</b>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(v) Annexure - I</td>
                        <td>Demand Promissory Note</td>
                        <td>23</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(vi) Annexure - II</td>
                        <td>Letter of Continuity to secure recovery of loan amount until completely paid off</td>
                        <td>24</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(vii) Annexure - III</td>
                        <td>Undertaking Cum Indemnity</td>
                        <td>25</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(viii) Annexure - IV</td>
                        <td>Request for disbursement</td>
                        <td>27</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(ix) Annexure - V</td>
                        <td>Borrower's request to employer for EMI deduction from salary</td>
                        <td>28</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(x) Annexure - I</td>
                        <td>NACH Declaration</td>
                        <td>30</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(x) Annexure - VII</td>
                        <td>PDC LETTER CUM UNDERTAKING</td>
                        <td>31</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td colspan="2">
                            <b>VERNACULAR DECLARATION BY BORROWER-APPLICANT(S)
                                VERNACULAR CERTIFICATE BY VERBAL TRANSLATOR AND
                                INTERPRETER(IN ENGLISH)</b>
                        </td>
                        <td>33</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td colspan="2">
                            <b>MISCELLANEOUS DOCUMENTS</b>
                        </td>
                        <td>34</td>
                    </tr>
                </table>
                <p class="page-no">2</p>

            </div>
            <div class="page-break"></div>

            <div class="page" id="page_3">
                
                <P class="stamp">100/-Non Judicial Stamp to be affixed</P>
                
                <h3>PERSONAL LOAN FACILITY AGREEMENT</h3>
                <h5>This Personal Loan Agreement is made and executed at the place and date stated in the <br>
                    Schedule-I hereunder written
                </h5>
                <p class="text-center"><b>Between</b></p>
                <P><b>PEERLESS FINANCIAL SERVICES LTD</b>., a Public Limited
                    Company
                    incorporated under Companies Act, 1956 (2013)</P>
                <P>and having its Registered Office at Peerless Bhavan, 3 Esplanade East, Kolkata -
                    700069
                    (West Bengal). (CIN:</P>
                <P>U65993WB1988PLC044077) here inafter referred to as <b>“PFSL” /
                        “LENDER</b>” (which expression shall unless the context</P>
                <P>otherwise requires, include its successors and assigns) of the
                    <b>FIRST PART</b>.
                </P>
                <p class="text-center"><b>AND</b></p>
                <P>The Borrower and Co-Borrower, Indian inhabitants, whose names and
                    addresses
                    are stated in the <b>Schedule-I</b>hereto and
                    hereinafter referred to as “Borrower” and “Co-borrower” (which expression shall
                    unless the
                    context otherwise requires, include his/her/their heir(s), successor(s), executor(s),
                    administrator(s)
                    and permitted assigns of the <b>SECOND PART</b>.</P>
                <P>he Borrower(s), and the Lender shall hereinafter be referred to individually
                    as<b>“Party” </b>or collectively as <b>“Parties”</b>.</P>
                <P><b>WHEREAS </b>PFSL, being a Non-Banking Financial
                    Company, registered with RBI, is engaged in the business of lending</P>
                <P>in India.</P>
                <P><b>WHEREAS </b>the Borrower(s) has/have approached the Lender
                    to
                    provide a loan as per terms specified in <b>Schedule II</b>, where in the
                    Guarantor
                    agrees to extend his /her /their guarantee for the due performance and observance of the Terms
                    and
                    Conditions of the Agreement disclosed in <b>Schedule II & Schedule III
                    </b>here of by
                    the Borrowers(s).The Borrower(s) has /have completed, signed and for warded to the Lender the
                    Personal
                    Application Formduly filled-in (which is the basis of this Agreement) attaching the
                    documents mentioned in <b>Schedule-IV</b><b>
                    </b>of the
                    Personal Loan Facility Agreement.</P>
                <b>NOW THEREFORE THIS AGREEMENT WITNESSETH AND THE PARTIES HERETO AGREE AS FOLLOWS:-</b>
                <P><b>1 Definitions and Interpretations</b></P>
                <P>1.1 In this Agreement, the following capitalized words shall have the following
                    meanings:
                </P>
                <P><b>“BORROWER” </b>Borrower being an individual, includes his /
                    her/their heirs, administrators, executors and legal</P>
                <P>representative(s);</P>
                <P><b>“EQUATED MONTHLY INSTALLMENT”</b>or“EMI”shall mean the
                    amount
                    payable every month on such date / s specified</P>
                <P>in the Schedule-II for the term of the Loan by the Borrower(s) to
                    PFSL to
                    amortize the Loan comprising interest and</P>
                <P>principal, or as the case maybe, only principal or interest;</P>
                <P><b>“GUARANTOR</b>” means the individual or legal entity that
                    provides
                    guarantee on behalf of the Borrower(s) towards</P>
                <P>repayment of Outstanding Amount under the facility;</P>
                <P><b>“INTEREST RATE” </b>means the rate at which PFSL shall
                    compute and
                    apply interest on the Loan, as stated in the</P>
                <P>
                    <b>Schedule-II</b><b> </b>or as maybe amended
                    from time
                    to time by PFSL in accordance with agreement;
                </P>
                <P><b>“DEFAULT INTEREST RATE” </b>means the rate as stated in the

                    <b>Schedule-II</b>
                    <b> </b>or as maybe amended by PFSL
                    from time
                </P>
                <P>to time at which PFSL shall compute and apply interest on all amounts not paid
                    when due
                    for payment and /or</P>
                <P>reimbursement by the Borrower(s) to PFSL.</P>

                <br><br><br><br><br><br>

                <table class="sign-table" cellpadding="0" cellspacing="0" style="border: 0">
                    <tr style="border: 0">
                        <td>
                            {{-- <img src="{{asset($data->signatureoftheauthorisedsignatory)}}" alt=""
                                style="height: 50px"> --}}
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
                        <td>
                            {{-- <img src="{{asset($data->signatureoftheborrower)}}" alt="" style="height: 50px">
                            --}}
                            <div class="sign-line"></div>
                            <b>Borrower</b>
                        </td>
                        <td>
                            {{-- <img src="{{asset($data->signatureofthecoborrower)}}" alt="" style="height: 50px">
                            --}}
                            <div class="sign-line"></div>
                            <b>Co-Borrower</b>
                        </td>
                    </tr>
                </table>
                <p class="page-no">3</p>
            </div>
            <div class="page-break"></div>

            <div class="page" id="page_4">
                <P><b>“LOAN” </b>means the principal
                    amount of
                    Loan sanctioned and disbursed by PFSL to the Borrower(s) (as specified in the</P>
                <P>
                    <b>Schedule-II</b>in terms of this
                    Agreement
                    and shall include dues outstanding thereunder including interests, costs, charges, expenses and
                    all
                    other amounts due in accordance with this Agreement if the context so requires.
                </P>
                <P><b>“PREPAYMENT” </b>means premature repayment of the Loan in
                    part or in full by the Borrower(s) ahead of the repayment tenor specified in the
                    <b>Schedule-II.</b>
                </P>
                <P><b>“PREPAYMENT CHARGES” </b>means charges levied by PFSL for
                    prepayment
                    as specified in the <NOBR><b>Schedule-II.</b></NOBR>
                </P>
                <P>
                    <b>“PURPOSE OF LOAN” </b>means that the Loan has been availed
                    by the
                    Borrower(s) for the purpose as stated in the <NOBR><b>Schedule-II</b></NOBR>
                    <b> </b>hereto.
                </P>
                <P>
                    <b>“REPAYMENT” </b>means the repayment of the principal amount of loan, interest thereon and/or any
                    charges,
                    premiums, expenses, fees or other dues payable in terms of this Agreement.
                </P>
                <P><b>“SALARY” </b>shall mean annual accumulated sum made by the
                    present
                    or future employer to the Borrower(s) and shall also include fee, commission, perquisite,
                    advance,
                    annual accretion credited to the balance, excluding bonus, gratuity, annuity, if any.</P>
                <P><b>“SECURITY” </b>shall mean a pledge / mortgage created in
                    favour of
                    PFSL on such Secured Assets of the Borrower(s) (whether moveable or immoveable), from time to
                    time, for
                    securing the Borrower's Dues as per terms of Sanction Letter and / or as stipulated under
                    Schedule II.
                </P>
                <P><b>“SCHEDULE” </b>means the Schedules to this Agreement which
                    is/are
                    part and parcel of the agreement;</P>
                <P><b>“LOAN DOCUMENTS”/ “ LOAN AGREEMENTS” </b>mean and include,
                    but not restricted to,(i) Loan Application Form (ii) Facility Sanction Letter or the Letter Of
                    Intent
                    (LOI) issued by the Lender (iii) Personal Loan Facility Agreement together with its
                    <b>Schedules I - V</b>, (iv) Demand Promissory Note
                    <b>(Annexure I)</b>,(v) Continuing Security Letter <b>(Annexure II)</b>, (vi) Undertaking
                    regarding payment of differential stamp duty applicable on all documents
                    <b>(Annexure III) </b>, (vii) Request for Disbursement <b>( Annexure IV)</b>,
                    (viii)
                    Borrower's request to employer for EMI deduction from salary <b>( Annexure V)</b>
                </P>
                <P>NACH Declaration <b>( Annexure VI) </b>(ix) Facility Specific
                    Agreements together with its Schedules and Annexures as may be required under the Personal Loan
                    Facility
                    Agreement from the list Provided in <b>Schedule V </b>and any other documents, correspondences,
                    agreement including all correspondences by way of email or otherwise exchanged between the Parties.
                </P>
                <P><b>1. &nbsp; &nbsp; "MARGIN SHORTFALL" </b>means where the
                    accumulated salary / professional income is inadequate to meet Margin Requirement as mentioned
                    in <NOBR><b>Schedule-II</b></NOBR> and is computed as Margin
                    Requirement less value of accumulated salary Margin.</P>
                <!-- <P>1.1 &nbsp;&nbsp; In this Agreement, singular shall include plural and the masculine gender,
                    shall include the feminine or neuter gender.</P>
                <P>1.2 &nbsp; &nbsp; Any expressions not defined herein,if defined within the General Clauses Act,1897,
                    shall carry the same meaning as assigned to it under the said Act</P>
                <P>1.3 &nbsp; &nbsp; In this Agreement, headings are for convenience only and shall not affect
                    interpretation except to the extent that the context otherwise requires.</P>
                <P>1.4 &nbsp; &nbsp; Any reference to Article, Clause or Schedule shall be deemed to be a reference to
                    an Article,
                    Clause or Schedule of this Agreement.</P>
                <P>1.5 &nbsp; &nbsp; Any reference to any enactment or statutory provision is a reference to it as it
                    may have been,
                    or may from time to time be amended, modified, consolidated or
                    <NOBR>re-enacted.</NOBR>
                </P>
                <P>1.6 &nbsp; &nbsp; The arrangement of Clauses in this Agreement shall have no bearing on their
                    interpretation.</P> -->


                    <ol type="i">
                        <li>
                            <P> In this Agreement, singular shall include plural and the masculine gender,
                                shall include the feminine or neuter gender.</P>
                        </li>
                        <li>
                            <P> Any expressions not defined herein,if defined within the General Clauses Act,1897,
                                shall carry the same meaning as assigned to it under the said Act</P>
                        </li>
                        <li>
                            <P> In this Agreement, headings are for convenience only and shall not affect
                                interpretation except to the extent that the context otherwise requires.</P>
                        </li>
                        <li>
                            <P> Any reference to Article, Clause or Schedule shall be deemed to be a reference to
                                an Article,
                                Clause or Schedule of this Agreement.</P>
                        </li>
                        <li>
                            <P> Any reference to any enactment or statutory provision is a reference to it as it
                                may have been,
                                or may from time to time be amended, modified, consolidated or
                                <NOBR>re-enacted.</NOBR>
                            </P>
                        </li>
                        <li>
                            <P> The arrangement of Clauses in this Agreement shall have no bearing on their
                                interpretation.</P>
                        </li>
                    </ol>


                    <br><br><br><br><br><br>
                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            {{-- <img src="{{asset($data->signatureoftheauthorisedsignatory)}}" alt=""
                                style="height: 50px"> --}}
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
                        <td>
                            {{-- <img src="{{asset($data->signatureoftheborrower)}}" alt="" style="height: 50px">
                            --}}
                            <div class="sign-line"></div>
                            <b>Borrower</b>
                        </td>
                        <td>
                            {{-- <img src="{{asset($data->signatureofthecoborrower)}}" alt="" style="height: 50px">
                            --}}
                            <div class="sign-line"></div>
                            <b>Co-Borrower</b>
                        </td>
                    </tr>
                </table>
                <p class="page-no">4</p>
            </div>
            <div class="page-break"></div>

            <div class="page" id="page_5">
                <P><b>2. &nbsp; &nbsp; PFSL's Agreement to lend and Borrowers' Agreement to borrow </b></P>
                <P> <b>2.1</b> &nbsp; &nbsp; PFSL agrees, based on the Borrowers'
                    request, representations, warranties, covenants, and undertakings as contained herein and in the
                    application for Loan, to lend to the Borrower(s) and the Borrower(s) agree(s) to borrow from PFSL,
                    the Loan on the terms and conditions as fully set out in this Agreement and Schedule here to.
                </P>
                <P><b>2.2</b> &nbsp; &nbsp;  The relationship between PFSL and the Borrower(s) as lender and Borrower(s) shall commence from
                    the Application Form received from the Borrower(s) for grant of loan and issuance of Sanction
                    Letter/ Letter of Intent by PFSL and shall subsist until all monies due and payable</P>
                <P><b>3. &nbsp; &nbsp;Mode of Disbursement</b> </P>
                <P><b>3.1</b> &nbsp; &nbsp; PFSL shall disburse the Loan in
                    the manner
                    given in Schedule II hereto. PFSL shall credit the Loan
                    amount to
                    the designated Bank Account, details provided in the <NOBR>
                        <b>Schedule-II,</b>
                    </NOBR>
                    by the Borrower(s).</P>
                <P><b>4. &nbsp; &nbsp;Interests, Fees and Costs</b> </P>
                <P><b>4.1</b> &nbsp; &nbsp; The Borrower (s) shall be jointly and
                    severally liable to pay interest on the loan at the rate specified in <b>Schedule- II.</b></P>
                <P><b>4.2</b> &nbsp; &nbsp; Interest, which is part of EMI,
                    if not paid on due date, then interest shall be and added to the principal and shall be treated as
                    an advance to the Borrower(s) and PFSL may be entitled to charge interest at the aforesaid rate
                    on the account of the debit balance inclusive of interest not paid by the Borrower(s) and hence
                    capitalized as aforesaid.</P>
                <P><b>4.3</b> &nbsp; &nbsp; PFSL shall be entitled to change
                    the rate
                    of interest and/ or rests and/ or penal interest, as per policy of PFSL,</P>
                <P><b>4.4</b> &nbsp; &nbsp; The interest on the Loan shall
                    accrue
                    from the date of the PFSL's disbursement of the Loan to the Borrower and shall be
                    computed:
                </P>
                <P><b>4.4.1</b> &nbsp; &nbsp; Taking the basis of 365 days in
                    a year/
                    366 days for a leap year and calculated at monthly rests;</P>
                <P><b>4.4.2</b> &nbsp; &nbsp; At the Interest Rate as state
                    din the

                    <NOBR>Schedule-II</NOBR> or as may be
                    specified/
                    amended by PFSL from time to time.
                </P>
                <P><b>4.5</b> &nbsp; &nbsp; The Borrower(s) agree(s) and
                    acknowledge(s) that the Loan shall bear Documentation Charges, Processing Fees and other
                    fees,
                    charges including but not limited to Interest Tax, Stamp Duty, late payment charges, cheque
                    return
                    charges, administrative charges, Insurance costs and such other charges as mentioned in the

                    <NOBR>Schedule-II,</NOBR> which the Borrower(s) shall reimburse to
                    PFSL in
                    addition to the Loan and the interest accrued thereon.
                </P>
                <P><b>4.6</b> &nbsp; &nbsp; The Borrower(s) shall also bear
                    and
                    reimburse separately to PFSL the costs and expenses involved or incurred by PFSL in the
                    recovery of
                    the Loan, if the Loan or any part thereof, when due is not paid by the Borrower(s).
                </P>
                <P><b>4.7 </b>&nbsp; &nbsp; All amounts in default for payment
                    (i.e.
                    not paid by the Borrower(s) when due to PFSL) including arrears of EMI,</P>
                <P>interests, fees, charges, taxes and costs will attract Default Interest at the
                    rate/
                    amount(s) specified in the</P>
                <P>Schedule II.</P>
                <P><b>4.8</b> &nbsp; &nbsp; The Borrower(s) is/are aware that
                    the
                    list of charges in Schedule II hereto is not exhaustive and can be changed and fresh/new
                    charges can
                    be added to, anytime and from time to time prospectively, at the sole and absolute
                    discretion of
                    PFSL and such charges shall be binding on the Borrower(s).</P>
                <P><b>5. &nbsp; &nbsp; Conditions Precedent to Disbursement of Loan</b></P>
                <P><b>5.1</b> &nbsp; &nbsp; PFSL shall not disburse any
                    amount under
                    the Loan unless the following conditions are complied with to the complete satisfaction of
                    PFSL:</P>
                <P><b>5.1.1</b> &nbsp; &nbsp; The Loan Agreement is duly
                    executed and
                    delivered to PFSL by the Borrower(s);</P>
                

                    

                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
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
                <p class="page-no">5</p>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_6">
                
                <P><b>5.1.2</b> &nbsp; &nbsp; The Borrower(s) procure(s) in
                    favour of
                    PFSL, a irrevocable and unconditional Guarantee as maybe required by PFSL at its sole
                    discretion, of
                    such person as maybe approved by PFSL, for guaranteeing repayment of the Loan with interest
                    and all
                    other amounts payable in respect there of</P>

                <P> <b>5.1.3 </b>&nbsp; &nbsp; The Borrower(s) submit(s) to the
                    satisfaction of PFSL, a certificate of employment from his/ her/ their employer and
                    his/her/their Financial Statements, in the case of Borrower(s) being a salaried
                    person; </P>
                <P> <b>5.1.4</b> &nbsp; &nbsp; Any other document or
                    undertaking as PFSL may require at its sole discretion. </P>
                <P> <b>5.1.5</b> &nbsp; &nbsp; Paid Documentation Charges and
                    Processing Fees for processing and sanction of Loan </P>
                <P> <b>5.2</b> &nbsp; &nbsp; PFSL may not, having disbursed
                    any amount, disburse any further amount under the Loan Agreement, unless the following
                    conditions are complied with, in the sole discretion of PFSL, before such further </P>
                <P>disbursement:</P>
                <P> <b>5.2.1</b> &nbsp; &nbsp; No event of default as specified
                    in Clause 9 hereinafter shall have occurred;</P>
                <P> <b>5.2.2</b> &nbsp; &nbsp; The Borrower(s) shall have
                    produced evidence of the utilization of prior disbursements and also in respect of proposed
                    disbursements; </P>
                <P> <b>5.2.3</b> &nbsp; &nbsp; The Borrower(s) shall have
                    produced his/her /their periodic financial statements; and </P>
                <P> <b>5.2.4</b> &nbsp; &nbsp; The Borrower(s) shall have
                    produced all other documents or writings as required by PFSL at its sole </P>
                <P>discretion.</P>
                <b>6.i. &nbsp; &nbsp; Repayment / Prepayment in case of Salaried Individuals of Preferred
                    Corporates.</b>
                <P> <b>6.i.1</b> &nbsp; &nbsp; In consideration of the Lender extending the“Loan”,the Borrower(s) and the
                    Guarantor shall jointly and severally repay the Loan along with Interest in accordance with the
                    Repayment Schedule set out in Schedule II of this Agreement. The
                    Borrowers' Employer(s) shall deduct the EMI amount from the Borrowers' salary and credit the EMI
                    amount directly into the Lender's Bank Account specified in Schedule II
                    hereof (here in after referred to a “the Lender's Bank Account”) every month. In the
                    event of cessation of the Borrowers' service with the Borrowers' employer(s) by way of
                    resignation, voluntary retirement, termination of service or any other way whatsoever before the
                    loan is repaid in full in terms of Schedule II hereof, the Agreement
                    will at the discretion of the Lender stand terminated and the Borrowers' employer(s) will,
                    without any reference to or consent to the Borrower(s),deduct from the final settlement amount
                    of the Borrower(s) the maximum possible amount towards recovery of the amount payable on the
                    loan on the date of cessation of service including outstanding loan amount, interest, penal
                    interest, costs, charges, expenses, tax, fees, levies, duties, cess etc. and credit the amount
                    so deducted directly into the Lender's bank account towards repayment of the loan. No further
                    notice, intimation or reminder shall be issued to the Borrower(s) or the Borrowers' employer(s)
                    regarding its obligation to credit the EMI amount into the Lender's bank account. The
                    Borrower(s) agree(s) and undertake(s) that it will be the responsibility and obligation of the
                    Borrower(s) to pay EMI on the loan on due date and other amounts due and payable to the Lender,
                    and any default of the Borrowers' employer(s) in paying EMI will be a default of the Borrower in
                    performing his obligations hereunder;</P>
                <P> <b>6.i.2</b> &nbsp; &nbsp; Not with standing anything contrary or conflicting herein or in any other
                    facility document the Lender shall have the right to review the loan account and revise the
                    terms thereof anytime on its own or upon the request of the Borrower(s) in such manner as deemed
                    fit by the Lender whereupon the repayment of the outstanding loan will be subject to the revised
                    terms & conditions;</P>

                <br><br><br><br><br><br>

                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
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

                <p class="page-no">6</p>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_7">
                <P> <b>6.i.3</b> &nbsp; &nbsp; The Borrower(s) and/or Guarantor agree(s) and undertake(s) that in the
                    event of the Borrowers' employer(s) committing default or delay in payment of EMI on the loan or
                    payment of the outstanding amount in the event of cessation of service of the Borrower(s) with
                    the Borrowers' employer(s) for any reason whatsoever, the Lender will be entitled to : (i)
                    demand payment of the overdue EMI/EMI in default or the outstanding amount, as the case may be,
                    from the Borrower(s) and the Borrower(s) will forthwith pay the EMI amount or such outstanding
                    amount to the Lender; (ii) to charge Penal Interest / Delayed Payment Charge on the overdue EMI
                    / EMI in default at the rate specified in Schedule II herein below, or
                    at a rate as may be determined by the Lender from time to time, for the period of delay or
                    default, and the Borrower(s) will separately pay the penal interest to the Lender. The Penal
                    Interest / Delayed Payment Charge shall be compounded on monthly basis. The payment of Penal
                    interest / Delayed Payment Charges shall not absolve the Borrower(s) of any other obligation of
                    the Borrower(s) hereunder or affect any other right & remedy of the Lender. Further, the
                    Borrower(s) shall be liable for all costs, charges and expenses which the Lender may pay or
                    incur in any way resulting from the above stated default or delay;</P>
                <P> <b>6.i.4</b> &nbsp; &nbsp; All payments to be made by the Borrower(s) to the Lender under the
                    Agreement, shall be made free and clear of and without any deduction for or on account of any
                    tax. If the Borrower(s) is/are required to make such deduction, then the sum payable to the
                    Lender shall be increased so that, after making such deductions, the Lender receives and retains
                    (without any liability for such deduction) a sum equal to the sum which it would have received
                    had such deductions not been made.</P>
                <P> <b>6.i.5</b> &nbsp; &nbsp; The Borrower(s) agree(s), declare(s) and confirm(s) that notwithstanding
                    any provisions of The Indian Contract Act1872 or any other Law or any terms & conditions hereof
                    and /or of any other facility document, any payment</P>
                <P> (s) made by the Borrower(s) under the
                    loan account shall be appropriated in the manner & order as may be decided by the Lender in
                    its sole and absolute discretion.</P>
                <P><b> 6. &nbsp; &nbsp; ii- Repayment / Prepayment in case of Others:</b></P>
                <P> <b>6.ii.1.</b> &nbsp; &nbsp; The Borrower(s) shall pay promptly, in full, the Pre EMIs (if
                    applicable), EMIs and all other amounts payable under this Agreement without any demur, protest
                    or default and without claiming any <NOBR>set-off</NOBR> or counter claim, on the respective Due
                    Dates on which the same are due.</P>
                <P> <b>6.ii.2.</b> &nbsp; &nbsp; The Borrower(s) shall, prior to the first Date of Disbursement provide
                    to PFSL, such of the following payment instruments as directed by PFSL (“Payment Instruments”):
                </P>
                
                <ol type="a">
                    <li>
                        <P>PDCs and UDCs issued by the
                            Borrower(s) (if required by PFSL), which may be deposited by PFSL with a view to receiving
                            payments on the Due Dates, as provided for in the terms of Repayment in <b>Schedule II;</b>
                        </P>
                    </li>
                    <li>
                        <P>A certified copy of the Standing
                            Instructions issued by the Borrower(s), to PFSL / designated bank, of the Borrower(s) to
                            transfer to the Lender on the Due Dates, the amounts which are required to be paid by the
                            Borrower(s), as specified in terms of Repayment in Schedule
                            II; A certified copy of the written ECS/ ACH mandate/other relevant mandate by the
                            Borrower(s) to its designated bank requiring the designated bank to make payment to PFSL on the
                            Due Dates as specified in the terms of Repayment in Schedule II
                            through the ECS scheme/any other platform or mechanism duly authorized in this regard
                            including without limitation the National Electronic Clearing Service and duly acknowledged and
                            accepted by the designated bank; or
                        </P>
                    </li>
                </ol>



                <p>
                    The borrower can also repay using other modes of payments, which may include,
                    Immediate Money Payment System (“IMPS”), Real Time Gross System (“RTGS”), National Electronic
                    Fund Transfer
                </p>

                <P>The borrower can also repay using other modes of payments, which may include,
                    Immediate Money Payment System (“IMPS”), Real Time Gross System (“RTGS”), National Electronic
                    Fund Transfer</P>
                <P>(“NEFT”), United Payment Interface ( “ UPI” ) eg BHIM, Pay TM, Gpay, direct
                    cash deposit in the Lender's bank account, as may be acceptable or required by PFSL, from time
                    to time.</P>
                

                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
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

                <p class="page-no">7</p>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_8">
                
                <P> <b>6.ii.3.</b> &nbsp; &nbsp;  The Borrower(s) hereby irrevocably and unconditionally undertake(s)
                    that the Borrower(s) shall not issue instructions for PFSL not to encash any of the Payment
                    Instruments and shall not issue any instruction to stop payment in respect of such Payment
                    Instruments to the relevant bank or institution. If the Borrower(s) do(es) issue any such
                    instructions, the same shall be considered null and void and such act shall be construed as
                    breach of this Agreement. In the event of any dishonour of a Payment Instrument, without
                    prejudice to the other rights of PFSL, the Borrower(s) shall be liable to pay to the Lender
                    additional interest /charges at the rate mentioned in this Agreement or such other amount as may
                    be stipulated by the Lender from time to time in accordance with its policy and guidelines. The
                    Borrower(s) hereby confirm(s) that the Borrower(s) shall always ensure that sufficient funds are
                    available in the account to which the said PDCs/ UDCs/ ECS/ ACH relate to enable the Lender to
                    present the same for encashment. The Borrower(s) is/are aware of the fact that the dishonour of
                    the PDC(s)/ UDC(s)/ ECS/ ACH so issued by the Borrower(s) and presented by PFSL for payment
                    would constitute an offence under Section 138 of the Negotiable Instruments Act,1881 and the
                    Lender may take such action against the Borrower(s) as may be advised upon such dishonour
                    including (without limitation) levy of such dishonour charges as may be specified by the Lender.
                </P>
                <P> <b>6.ii.4.</b> &nbsp; &nbsp;  The Borrower(s) acknowledge(s) that the Payment Instruments submitted
                    in terms of Clauses mentioned above (Mode of Payment, Time, Place etc), shall be delivered to
                    the Lender for the discharge of the Outstanding Balance (or part thereof). It is however
                    clarified, that the mere hand over of the Payment Instruments will not discharge the Borrower(s)
                    from its primary obligation of ensuring that the amounts due to the Lender on a particular Due
                    Date are paid to the Lender on such Due Date. The Borrower(s) shall also be entitled to make
                    payments of the amount due to the Lender on the respective Due Dates in the form of pay orders/
                    demand drafts on any debit instructions, provided that payments are made subject to compliance
                    with the requirements (including without limitation the submission of any forms and documents),
                    if any, imposed by the Lender in this regard.</P>
                <P> <b>6.ii.5.</b> &nbsp; &nbsp;  In the event that the Borrower(s) is/are required by the Lender to
                    deposit PDCs/ UDC(s)/ ECS/ ACH and inchoate cheques for fulfilling the Borrowers' payment
                    obligations in relation to the Loan, any PDCs/ UDC(s)/ ECS/ ACH and inchoate cheques so
                    deposited, shall be compliant with applicable regulatory requirement sunder applicable laws.</P>
                <P> <b>6.ii.6.</b>  &nbsp; &nbsp; The Borrower(s) hereby irrevocably and unconditionally nominate(s),
                    constitute(s), appoint(s) and authorise(s) the Lender acting through any of its officers, agents
                    as the Borrowers' true and lawful attorney to act on the Borrowers' behalf and at the
                    Borrower(s)' cost and risk to do, execute and perform all or any of the following acts, deeds,
                    matters and things that is to say:</P>


                    <ol type="I">
                        <li>
                            <p>
                                To fill up the dates (and/or the
                                amounts of the cheque(s) and/or such other details as may be necessary in the cheques
                                submitted to the Lender by the Borrower(s) from time to time, so as to pay the Outstanding
                                Balance(s) from time to time to the Lender and to deposit the same towards repayment of the
                                Borrowers' dues towards the said Loan, without notices to the Borrower(s) in this
                                regard.
                            </p>
                        </li>
                        <li>
                            <p>
                                To appoint or engage any agent,
                                courier agencies, correspondent banks for ensuring safe holding of PDCs/ inchoate cheques
                                /UDCs and having the same picked up, processed and cleared at the Borrower's risks and
                                costs.
                            </p>
                        </li>
                        <li>
                            <p>To do all such other acts,
                                deeds and things necessary to ensure payment of the Outstanding Balance(s) from time to time
                                to the Lender. The Borrower(s) here by further agree(s) to ratify and confirm all and
                                whatsoever that the Lender shall do or cause to be done in or about the premises by virtue
                                of the powers herein given. The Borrower(s) confirm(s) that the authority and powers hereby
                                given to the Lender are for consideration and are irrevocable under Section 202 of the
                                Contract Act,1872 and such authority /power shall survive the Borrowers' death.</p>
                        </li>
                    </ol>

                    

                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
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

                <p class="page-no">8</p>

            </div>


            <div class="page-break"></div>

            <div class="page" id="page_9">


                <div id="id9_1">
                    
                    <P class="p109 ft33"> <b>6.ii.7.</b> The Borrower(s) hereby agree(s), acknowledge(s) and confirm(s) that the
                        authority given by the Borrower(s) to the Lender above to fill in the requisite details in the
                        cheques deposited by the Borrower with the Lender is as permitted under the provisions of
                        Section 20 of the Negotiable Instruments Act, 1881 and the same does not amount to an alteration
                        of the cheques given by the Borrower(s) to the Lender. The Borrower(s) however, agrees and
                        confirms that in the event the acts of the Lender in filling the cheques as aforesaid are
                        construed by any court, tribunal, authority or other person or forum, judicial, <NOBR>
                            quasi-judicial,</NOBR>
                        <NOBR>non-judicial,</NOBR> governmental, semi- governmental or <NOBR>non-governmental</NOBR> to
                        be an alteration:-
                    </P>

                    <ol type="I">
                        <li>
                            <p>the Borrower (s) hereby
                            expressly provide(s) his/ her/ their consent for such alteration and here by confirm (s)
                            that by reason of such alteration, the cheques shall/ should not be construedto</p>
                        </li>
                        <li>
                            <p>
                                be void or otherwise unenforceable and the Borrower(s) hereby unconditionally agree(s) to honour
                            </p>
                        </li>
                    </ol>

                   
                    <P class="p112 ft1">such cheques when presented for payment; and</P>
                    <P class="p113 ft1"><SPAN class="ft1">(ii)</SPAN><SPAN class="ft65">the Borrower (s) hereby
                            confirm(s) that such alteration is made to record the common intention</SPAN></P>
                    <P class="p114 ft30">of the Lender and the Borrower(s), where common intention is to fill in the
                        cheques / instruments with the amounts that may be due by the Borrower(s) to the Lender from
                        time to time.</P>
                    <P class="p115 ft52"> <b>6.ii.8.</b> The Borrower(s) hereby confirm(s) that the Borrower(s) shall always
                        ensure that sufficient funds are available in the account to which the cheques /other mandates
                        relate, so that the cheques /other mandates when presented by PFSL are honoured by the Bank .
                        The Borrower(s) is/are aware of the fact that the dishonour of any of the cheques / other
                        mandates so issued by the Borrower(s) and presented by Lender for paymentwould constitute an
                        offence under ( Section 138 of the Negotiable Instruments Act, 1881 , Section 25 of the Payments
                        & Settlement Act, 2007), (Indian Penal Code) or any other relevant Act of the land and the
                        Lender may take such action against the Borrower(s) as may be advised upon such dishonour
                        including (without limitation) levy of such charges as may be specified by the Lender in this
                        regard. All the provisions set out in this <SPAN class="ft66">Clause 6 </SPAN>shall apply
                        mutatis mutandis to any form of cheques that may be issued by the Borrower(s) in favour of the
                        Lender in discharge of debt owed by the Borrower(s) to the Lender. It is also further agreed and
                        understood that <NOBR>non-presentation</NOBR> of the Cheque/ ACH mandate or any of them on part
                        of the Lender for any reason whatsoever, shall not in any manner affect the liability of the
                        Borrowers in respect of the loan.</P>

                <P> <b>6.ii.9.</b> &nbsp; &nbsp;  The Borrower(s) shall not without the prior written consent of the Lender
                    (a) issue any stop payment instructions or</P>
                <P><SPAN>(b)</SPAN><SPAN>change/close the bank account
                        from which the PDCs /UDC (s)/ inchoate cheques were issued or(c) change the authorised
                        signatory of the Borrowers' account(s) from which the PDC(s) /UDC(s) /inchoate cheques were
                        issued. The Borrower(s) further agree(s) and understand(s) that in the event the PDC(s)
                        /UDC(s) / inchoate cheques are lost in transit / misplaced, or for any reason the Lender is
                        not able to put any cheque(s) in clearing, the Borrower(s) shall forthwith give replacement
                        PDC(s) / UDC(s) / inchoate cheques to the Lender upon its written request.</SPAN></P>
                <P> <b>6.ii.10.</b> &nbsp; &nbsp;  The Borrower(s) hereby agree(s) and undertake(s) that the obligation
                    of the Borrower, to make payment of the EMIs and the PEMIs is unconditional and absolute, and
                    shall not be affected or prejudiced by any reason including without limitation as a result of
                    any <NOBR>non-payment</NOBR> or short payment resulting on <NOBR>en-cashing</NOBR> any of the
                    Payment Instruments.</P>
                <P> <b>6.ii.11.</b> &nbsp; &nbsp;  Upon repayment of the Outstanding Balances in full, the Lender shall
                    not deposit any PDCs, inchoate cheques and/or UDCs which remain in its possession.</P>


                    <table cellpadding=0 cellspacing=0 class="sign-table">
                        <tr>
                            <td>
                                <div class="sign-line"></div>
                                <b>Authorised Signatories For PFSL</b>
                            </td>
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

                    <p class="page-no">9</p>

                </div>

            </div>

            <div class="page-break"></div>

            <div class="page" id="page_10">

                <P> <b>6.ii.12.</b> &nbsp; &nbsp;  On any of the respective Due Dates, the Lender shall be entitled to
                    encash or require the transfer of the amounts due to the Lender under this Agreement, by
                    utilising any of the Payment Instruments which are deposited by the Borrower(s), as mentioned in
                    <SPAN>Clause 6.ii.2 </SPAN>(Mode of Payment, Time, Place) above, without any
                    requirement of intimating or sending a notice to the Borrower(s) of its encashing of the
                    relevant Payment Instrument. The Borrower(s) here by agree (s) and undertake (s) that the
                    Borrower(s) shall ensure that adequate sums are present in the bank account (s) of the
                    Borrower(s) which are linked to the Payment Instruments provided by the Borrower(s) to the
                    Lender to enable the Lender to encash the Payment Instruments for receipt of the payments due
                    from the Borrower (s) on each of the Due Dates of its <NOBR>en-cashing</NOBR> of the relevant
                    Payment Instrument.
                </P>
                <P> <b>6.ii.13.</b> &nbsp; &nbsp;  Only on realisation of the amounts due by any mode as above, the
                    Lender shall credit the account of the Borrower(s).</P>
                <P> <b>6.ii.14.</b> &nbsp; &nbsp;  If any payment under this Agreement is required to be made on a day
                    which is not a Business Day or within a period which ends on a day which is not a Business Day
                    then the Borrower (s) shall be required to make the payment on the immediately succeeding
                    Business Day.
                </P>


                <p><b>7. Lender's Rights</b></P>
                <P>The Lender being PFSL</P>


                <ol type="i">
                    <li>
                        <p>in the event it is unwilling to
                            continue the Loan on account of regulatory or other reasons, have the sole right at anytime
                            during the tenor of this Agreement to recall the entire or part of the Loan without
                            assigning any reason there of and shall be payable in full by the Borrower to PFSL forthwith
                            upon a demand in this regard by PFSL.
                        </p>
                    </li>
                    <li>
                        <p>have the sole right to amend at
                            any time and from time to time any of the terms & conditions of this Agreement including but
                            not limited to revising/rescheduling the repayment terms / amount of EMI or any other
                            amounts outstanding thereunder, revision of Interest Rate (including the Default Interest
                            Rate), any other charges or fees, periodicity of compounding of interest, method of
                            effecting credit of the repayments, without assigning any reason and notify such change/
                            revision/ amendment to the Borrower(s). The Borrower(s) will be bound by such change/
                            revision and the Borrower(s) agree(s) that such revision/ change/ amendment shall become
                            applicable from date of such revision in the records of PFSL;
                        </p>
                    </li>
                    <li>
                        <p>have the right to inspect books of accounts and other records maintained by the Borrower (s); and</p>
                    </li>
                    <li>
                        <p>be entitled to disclose any
                            information about the Borrower(s), his/ her/ their account relationship with PFSL and/ or
                            any default committed by him/ her/ them in repayment of amounts (whether such in formation
                            is provided by the Borrower(s) or obtained by PFSL itself and whether in form of repayment
                            conduct, rating or defaults) to its head office, other branch offices, affiliated entities,
                            Reserve Bank of India, or such other Credit Information Bureaus like CIBIL etc , its
                            Auditors, as PFSL may, in its sole and exclusive discretion, deem fit and proper. PFSL shall
                            also be entitled to seek and receive any information as it deems fit in connection with the
                            Loan and/or the Borrower(s) from any third party; and
                        </p>
                    </li>
                    <li>
                        <p>be entitled to require the Borrower (s), in the event of the Borrower(s) opting to 
                            resign or retire from his/ her /their current employment prior to the age of superannuation or is /are
                            discharged or removed from service before such date for any reason whatsoever, to instruct his
                            /her /their employer(s) to remit the entire dues or termination benefits (including
                            compensation) in the liability account maintained with PFSL
                        </p>
                    </li>
                    
                    <li>
                        <p>have the right to store financial data of the Borrower(s). This includes data 
                            which is not kept within accounts of PFSL
                        </p>
                    </li>
                    <li>
                        <p>have a right to apply and/ or appropriate and/ or set-off any credit balance of the Borrower(s) or any monies/ assets
                            (including but not limited to property, assets, securities, shares, stocks, and the like) belonging to the Borrower(s)
                            coming in the hands of PFSL towards the repayment of Loan upon occurrence of Event of Default. However, PFSL shall
                            not be obliged to exercise any right given to it herein.</p>
                    </li>
                </ol>


                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
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
                <p class="page-no">10</p>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_11">

                <div id="id11_1">

                    <!--<ol start="7" type="i">-->

                        
                    <!--</ol>-->



                    <P> <b>8. Borrowers' Representations, Warranties, Covenants, Indemnification and Undertakings</b> </P>
                    <P><b>8.1</b> &nbsp; &nbsp;
                         The Borrower(s) here by represent (s)/ warrant(s) to covenants/ undertake (s) throughout the subsistence of this Agreement, with PFSL That
                        </P>
                    <P><b> 8.1.1</b>  &nbsp; &nbsp;  the information provided in the
                            application for the Loan and as contained herein is complete and true in all
                            respects; </P>
                    <P> <b>8.1.2  </b>&nbsp; &nbsp; there are no threatened or
                            pending claims, demands, litigation or liquidation proceedings against the Borrower
                            (s); </P>
                    <P> <b>8.1.3</b>&nbsp; &nbsp;  the Borrower (s) shall utilize
                            the Loan for the purpose for which it is granted and for no other purpose whatsoever; 
                    </P>
                    <P> <b>8.1.4</b> &nbsp; &nbsp; the Borrower(s) shall repay
                            to PFSL the Loan in accordance with the Repayment Terms as mentioned in
                            <b>Schedule II</b>  herein.</P>
                    <P> <b>8.1.5</b> &nbsp; &nbsp; the Borrower(s) shall at all
                            times maintain sufficient balance in the Loan Repayment Account to ensure payment of each
                            EMI; </P>
                    <P> <b>8.1.6</b> &nbsp; &nbsp; any dispute about interest
                            computation shall not entitle the Borrower(s) to withhold payment of an EMI; </P>
                    <P> <b>8.1.7</b> &nbsp; &nbsp; the Borrower(s) shall provide
                            to PFSL its financial statement and other information and documents concerning his
                            employment, profession, business or utilization of Loan as PFSL may require from time to
                            time; </P>
                    <P> <b>8.1.8</b> &nbsp; &nbsp; the Borrower(s) shall, within
                            7 (seven) days of the event, inform PFSL of any likely change in his/ her employment and/ or
                            residential /office address; </P>
                    <P> <b>8.1.9</b> &nbsp; &nbsp; the Borrower(s) shall not,
                            during the tenure of this Agreement, avail of or obtain any further loan or facility for the
                            same purpose without the prior written consent of PFSL; </P>
                    <P> <b>8.1.10</b> &nbsp; &nbsp; the Borrower(s) shall ensure
                            that none of the Payment Instrument, returned  
                        <NOBR>dis-honoured</NOBR> for any reason whatsoever and is aware that in such an event cheque/
                        instrument <NOBR>dis-honour</NOBR> charges will be payable by him/ her/ them to PFSL as
                        specified in  Schedule II 
                    </P>
                    <P> <b>8.1.11</b> &nbsp; &nbsp; the Electronic Debit
                            Instructions given to PFSL by the Borrower(s) pursuant to this Agreement: </P>

                    <P> <b>8.1.11.1</b> &nbsp; &nbsp; shall not be changed,
                            modified or countermanded without prior written permission of PFSL;</SPAN></P>
                    <P> <b>8.1.11.2</b> &nbsp; &nbsp;  if not acted upon by PFSL
                            in which the account is maintained for whatever reason, then without prejudice to the rights
                            of PFSL to recall the entire amount outstanding under the Loan, the Borrower(s) shall issue
                            such revised instructions as maybe necessary to ensure payment to PFSL in terms of this
                            Agreement and/or to issue and deliver PDCs for the balance outstanding under the Loan as per
                            Schedule.</SPAN></P>
                    <P> <b>8.1.12</b>  &nbsp; &nbsp; shall not stand surety or as
                            guarantor for any third party liability or obligation till full repayment of the
                            loan;</SPAN></P>
                    <P> <b>8.1.13</b> &nbsp; &nbsp;  shall not leave India for
                            employment or business or long stay or permanently, without first fully repaying the
                            Personal Loan then outstanding, with interest and other dues, including prepayment charges,
                            if any and shall keep himself aware of all the rules of PFSL, as pertaining to the Loan, and
                            in force from time to time;</SPAN></P>
                    <P> <b>8.1.14</b> &nbsp; &nbsp;  the Borrower(s) shall
                            maintain, operate and fund the Loan Account, if any, till the whole of the Loan Amount,
                            together with interest and charges thereon, is received in full by PFSL</SPAN></P>
                            
                    
                    <P> <b>8.1.15</b>  &nbsp; &nbsp; The Borrower(s) undertake(s)
                        that, if there is a breach of any of the representations or warranties provided hereunder,
                        then, the Borrower(s) shall indemnify PFSL in respect of any reasonable costs and expenses
                        suffered or incurred by PFSL which arises from the event or circumstance giving rise to any
                        claim for breach of representation or warranty or any representation given by the
                        Borrower(s) to PFSL in the Application for the Loan.</SPAN></P>

                    <table cellpadding=0 cellspacing=0 class="sign-table">
                        <tr>
                            <td>
                                <div class="sign-line"></div>
                                <b>Authorised Signatories For PFSL</b>
                            </td>
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
                    <p class="page-no">11</p>
                </div>

            </div>

            <div class="page-break"></div>

            <div class="page" id="page_12">

                <P> <b>8.1.16</b> &nbsp; &nbsp;  Repay the Loan and pay
                        interest thereon, in the event of the Borrowers' employers committing delay or default in
                        payment of EMI on the loan on due date or in payment of dues & outstanding amount on the
                        loan in the event of cessation of the Borrower's service v</SPAN>
                    for any reason whatsoever and directly pay to or reimburse the Lender with all other monies
                    including penal interest, governmental charges, taxes, penalties, cess, duties, levies owing to
                    the Lender according to the terms here of;</P>
                <P> <b>8.2</b>  &nbsp; &nbsp; The Borrower(s) confirm(s) that
                        as per terms of Sanction Letter and / or that of  Schedule II,
                    </SPAN>it tender(s), in favour of PFSL, an irrevocable and unconditional guarantee by a
                    Guarantor for the payment and discharge by the Borrower(s) to PFSL, of the sums, interest, all
                    costs, charges and expenses and other monies due and payable by the Borrower(s) to PFSL under or
                    in respect of the Facilities through execution of <SPAN class="ft27">Deed Of Guarantee </SPAN>as
                    detailed in <SPAN class="ft27">Schedule V </SPAN>and annexed herein and as such the said
                    Guarantor acknowledges and agrees to the terms of this Personal Loan Facility Agreement executed
                    between the Parties<SPAN class="ft86">.</SPAN></P>
                <P> <b> 9. Events of Default</b> </P>
                <P> <b>9.1</b> &nbsp; &nbsp;  PFSL may, by a written notice to
                        the Borrower(s) and/or Guarantor, declare the Loan to have become due and payable forthwith
                        upon occurrence (in the sole decision of PFSL) of any one or more of the following
                        events:</SPAN></P>
                <P> <b>9.1.1</b> &nbsp; &nbsp;  The Borrower(s) and/ or
                        Guarantor fail(s) to pay to PFSL any amount on or before due date and payable under this
                        Agreement (including an EMI) or furnish the PDCs or any other document /agreement as may be
                        required by PFSL from time to time.</SPAN></P>
                <P> <b>9.1.2</b> &nbsp; &nbsp;  The Borrower(s) and/or
                        Guarantor fails to pay to any person other than PFSL any amount on or before due date and
                        payable or any person other than PFSL may demand repayment of the loan or dues or liability
                        of the Borrower to such person ahead of its repayment terms as previously agreed between
                        such person and the Borrower</SPAN></P>
                        

                <P><b>9.1.3  &nbsp; &nbsp;  </b><SPAN class="ft91">The Borrower(s) and /or
                        Guarantor defaults in performing any of his/ her obligations under this Agreement or
                        breaches any of the terms and conditions of this Agreement;</SPAN></P>
                <P><b>9.1.4  &nbsp; &nbsp;  </b><SPAN class="ft92">The Borrower(s) resign(s),
                        retire(s) or is/are discharged or removed from the employment he/she/them was/were engaged
                        in on the date of this Agreement;</SPAN></P>
                <P><b>9.1.5  &nbsp; &nbsp;  </b><SPAN class="ft91">Any of the information
                        provided by the Borrower (s) to avail the Loan or any of the Representations and Warranties
                        contained herein being found to be or becoming incorrect or untrue or false ;</SPAN></P>
                <P><b>9.1.6  &nbsp; &nbsp;  </b><SPAN class="ft92">If there is reasonable
                        apprehension that the Borrower(s) and/or Guarantor is /are unable to pay his/her/their debts
                        or any person other than PFSL commencing proceedings to declare the Borrower(s) insolvent or
                        if the Borrower(s) become(s) bankrupt or insolvent or commit act of insolvency;</SPAN></P>
                <P class="p63 ft1"><b>9.1.7  &nbsp; &nbsp;  </b><SPAN class="ft93">If any distrain or attachment of
                        any assets of the Borrower(s) is effected ; and</SPAN></P>
                <P><b>9.1.8  &nbsp; &nbsp;  </b><SPAN class="ft92">PFSL, for any regulatory or
                        other reasons, being unable or unwilling to continue the Loan, recalls by written notice the
                        Loan and the Borrower (s) fail (s) to repay in accordance with the said notice.</SPAN></P>
                <P><b>9.1.9  &nbsp; &nbsp;  </b><SPAN class="ft92">Any </SPAN>
                    <NOBR>non-compliance</NOBR> by the Borrower(s) and/or the Guarantor of the terms & conditions of
                    this Agreement or any other agreement entered into in respect of this Loan or any other
                    financial assistance availed of by the Borrower from the Lender;
                </P>
                <P class="p63 ft1"><b>9.1.10  &nbsp; &nbsp;  </b><SPAN class="ft40">Any concealment of any material
                        document or event by the Borrower(s) /Guarantor;</SPAN></P>
                <P><b>9.1.11  &nbsp; &nbsp;  </b><SPAN class="ft70">Submission of any forged
                        document by the Borrower(s) /Guarantor;</SPAN></P>


                <P><b>9.1.12  &nbsp; &nbsp;  </b><SPAN class="ft94">Failure by
                        Borrower(s)/Guarantor to provide their KYC Documents and to do such other thing as may be
                        required from time to time with respect to KYC/ AML directions of the Reserve Bank of India
                        /Central / State Government.</SPAN></P>
                <P><b>9.1.13  &nbsp; &nbsp;  </b><SPAN class="ft95">If at any time the value of
                        the accumulated salary / professional income falls so as to create a shortfall in the
                        Margin, PFSL reserves its right to forthwith, without giving any notice whatsoever to the
                        Borrower(s)/Guarantor invoke to recall the loan.</SPAN></P>
                <p class="page-no">12</p>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_13">


                <P><b>9.2  &nbsp; &nbsp;  </b><SPAN class="ft96">It is clarified that upon
                        occurrence of an Event of Default, PFSL shall be entitled to adopt civil and/ or criminal
                        proceedings against the Borrower(s) and/ or Guarantor including for dishonour of cheques
                        under Section 138 of Negotiable Instruments Act 1881 or for rejection of ECS /ACH debit
                        instruction under section 25 of Payments and Settlement Systems Act 2007.</SPAN></P>
                <P><b>10. Assignment and Transfer</b></P>

                <ol type="i">
                    <li>
                        <p>PFSL shall have an absolute
                            right to sell or transfer (by way of assignment, securitization or otherwise) the whole or
                            part of the Loan in such manner and on such terms and conditions as PFSL may decide at its
                            sole discretion.
                        </p>
                    </li>
                    <li>
                        <p>The Borrower(s) expressly
                            agree(s), in the event of sale or transfer as aforesaid, to accept such person to whom the
                            Loan is sold or transferred as his/her lender and make the repayment of the Loan to such
                            person in the manner directed by PFSL.
                        </p>
                    </li>
                    <li>
                        <p>The Borrower (s) shall not be
                            entitled to transfer or assign any of his /her / their rights under this Agreement.
                        </p>
                    </li>
                </ol>
                <P><b>11. Security</b></P>
                <P  style="padding-left: 35px;">The Borrower(s) confirm(s) that as per terms of Sanction Letter and that of
                    <b>Schedule II</b>, Security is being tendered in favour of PFSL to secure
                    due repayment, discharge and redemption of the Facility so advanced by PFSL to the Borrower ,
                    and necessary Facility Specific Documents as stipulated in <b>Schedule V
                    </b>are executed by the Borrower(s) and annexed herein.
                </P>
                


                <P> <b>12. Indemnification</b></P>
                <P style="padding-left: 35px;">The Borrower (s) and the Guarantor shall indemnify and hold the Lender and its
                    directors, officers, employees, agents and advisers harmless against losses, claims,
                    liabilities, or damages which are sustained as a result of any acts, errors, or omissions of the
                    Borrower(s) and/or the Guarantor, their / its respective employees, agents, or assignees, or for
                    improper performance or <NOBR>non-performance</NOBR> relating to this Agreement or any other
                    document executed thereof in pursuance to this Agreement.</P>

                <P><b>13. Term and Termination</b></P>
            
                <ol type="a">
                    <li>
                        <p>This Agreement shall become effective on execution.</p>
                    </li>
                    <li>
                        <p>The Agreement shall stand terminated on the date the Borrower(s) has/have repaid the Loan Amount in full
                            along with Interest, overdue interest, penal interest and other fees and charges as mentioned in this Agreement,
                            and fulfilled all other obligations under the Agreement to the satisfaction of the Lender.</p>
                    </li>
                    <li>
                        <p>The Borrower(s) do(es) not have the right to terminate this Agreement in any situation except with the written
                            consent of the Lender, by repaying the entire amounts due to the Lender under this Agreement.
                            </p>
                    </li>
                    <li>
                        <p>Notwithstanding anything contrary contained herein the Lender may anytime at its sole and absolute discretion
                            terminate, cancel or withdraw the loan or any part thereof without any liability and without having to provide any
                            reason whereupon the outstanding amount including outstanding loan, interest accrued, penal interest and all
                            other costs, charges, </p>
                    </li>
                    <li>
                        <p>expenses, taxes, duties, levies, whatsoever incurred or suffered by the Lender in respect of the loan, and all
                            other amounts payable on the loan shall be paid by the Borrower within a notice period of 30 daysfailing which
                            the Lender shall be entitled to exercise all its rights and remedies acquired hereby including rights accrued
                            pursuant to the occurrence of an Event of Default as specified under Clause 9here inabove.</p>
                    </li>
                </ol>
                


                <P><b>14. Severability</b></P>
                <P style="padding-left: 35px;">If any provision in this Agreement shall be found or be held to be invalid or
                    unenforceable, then the meaning of said provision shall be construed, to the extent feasible, so
                    as to render the provision enforceable, and, if no feasible interpretation would save such
                    provision, it shall be severed from the remainder of this
                    Agreementandinsuchanevent,thePartiesshallusebesteffortstonegotiate,ingoodfaith,asubstitute,valid
                    and enforceable provision or agreement, which most nearly reflects the Parties' intent in
                    entering into this Agreement.
                </P>


                <p class="page-no">13</p>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_14">



                <P><b>15. Miscellaneous</b></P>

                <ol type="i">
                    <li>
                        <p>The Parties agree that in any legal action or proceeding arising out of or in connection with this Agreement,
                            entries made in the Books of Accounts maintained by PFSL shall be prima facie evidence of debt and of all
                            amounts payable, as therein recorded, by Borrower(s) to PFSL;
                        </p>
                    </li>
                    <li>
                        <p>If at any time any provision
                            hereof is or becomes illegal, invalid or unenforceable in law, neither the legality,
                            validity nor enforce- ability of the remaining provision hereof, nor the legality, validity
                            or enforce ability of other provisions shall in anyway by affected or impaired there
                            by.
                        </p>
                    </li>
                    <li>
                        <p>The Parties agree that any
                            delay or omission by PFSL in exercising any of its right, powers or remedies as the Lender
                            of the Loan under this Agreement and other documents pursuant here to shall not impair the
                            right, power or remedy or be construed as its waiver or acquiescence by PFSL.
                        </p>
                    </li>
                    <li>
                        <p>The Parties confirm that this
                            Agreement and its Schedule and any other documents executed pursuant to this Agreement shall
                            represent one single Agreement between the Parties.
                        </p>
                    </li>
                    <li>
                        <p>Any notice under this Agreement
                            shall be in writing and sent to the address stated in the
                            <b>Schedule-I.</b> The Borrower(s) and Guarantor shall forthwith
                            inform PFSL of any change in his/ her address.
                    </p>
                    </li>
                    <li>
                        <p>Arbitration and Jurisdiction:
                            This Agreement shall be subject to Indian law and subject to the jurisdiction of courts
                            having jurisdiction where the Registered Office of PFSL is situated.
                        </p>
                    </li>

                    <li>
                        <p>All disputes, differences and /or claim arising out of signing upon this Agreement whether during its subsistence
                            or thereafter shall be settled by arbitration in accordance with the provisions of the <b>Arbitration and
                            Conciliation Act, 1996</b>, or any statutory amendments thereof and shall be referred to the sole Arbitration of an
                            Arbitrator to be nominated by PFSL. The award given by such an Arbitrator shall be final and binding on all the
                            Parties to this Agreement. In the event of demise of such an Arbitrator to whom the matter has been originally
                            referred or the Arbitrator recuses himself for being unable to act for any reason, the Lender, on being informed at
                            the time of such demise of the Arbitrator or of his inability to act as Arbitrator, shall appoint another person to act
                            as Arbitrator. Such a person shall be entitled to proceed with the reference from the stage at which it was left by
                            his predecessor.
                            </p>
                    </li>
                    <li>
                        <p>Dispute for the purpose of Arbitration includes default committed by the Borrower(s) as per <b>Clause 9</b> of this
                            Agreement. It is a term of this Agreement that the venue of Arbitration proceedings shall be at <b>KOLKATA</b> and the
                            language shall be in <b>English.</b></p>
                    </li>
                    <li>
                        <p>All notices and other communications on PFSLand the Borrower(s) and Guarantor shall be as mentioned in </p>
                    </li>
                    <li>
                        <p>
                            <b>Schedule-I.</b> Authority to Share Information: Borrower(s) and Guarantor further authorize PFSL and/ orits
                            Associates /Subsidiaries / Authorized Representatives /Agent/ Affiliates to verify any information / conduct
                            survey at his/her/their office/ residence and/ or contact him/ her/ their family members, employer/ banker or
                            Credit Information Bureau like CIBILand also to conduct checks for all documents or other information including
                            e KYC and PAN verification as required under policies of PFSLand Reserve Bank of India guidelines from time
                            to time.
                        </p>
                    </li>
                    <li>
                        <p>Borrower (s) and Guarantor also have no objection if his/ her/ their personal information are shared/ uploaded
                            with / to CIBIL/ CERSAI or any other law enforcement agencies as may be required from time to time and also
                            consent to receiving information from Central KYC Registry through SMS / email on the registered mobile
                            number and email address as provided.
                        </p>
                    </li>
                                        
                    <li>
                        <p>Borrower(s) and Guarantor confirm his/her/their understanding that the Documentation Charges and
                            Processing Fees paid by him/her/them is non-refundable under any circumstances whatsoever including but
                            not limited to decline/part disbursement of the Loan.
                        </p>
                    </li>
                    <li>
                        <p>Borrower(s) and Guarantor expressly agree and authorize PFSLto communicate to him/ her/ them from time to
                            time various features of products/ promotional offers, which offer significant benefits to its customer, and also
                            transaction related alerts and may use the services of third party agencies for such communication.
                        </p>
                    </li>
                </ol>

                <p class="page-no">14</p>
            </div>
            <div class="page-break"></div>

            <div class="page" id="page_15">



                <ol type="i" start="14">

                    <li>
                        <p>The Borrower(s) and the Guarantor hereby declare that they are not tax resident in any other country other than India.</p>
                    </li>
                    <li>
                        <p>The Borrower(s) and the Guarantor have read the entire Agreement, constituting the above clauses including
                            the Loan details and the terms of repayment, the fees and charges payable as clearly enumerated in the
                            Schedule to this Agreement. The Borrower(s) and the Guarantor further confirm that the entire Agreement is
                            filled in their presence and that the contents provided herein is explained in the language understood by the
                            Borrower and the Guarantor(s). The Borrower and the Guarantor further confirm having executed the
                            Agreement, received a copy of the same and agree to remit the dues in terms of the <b> Schedule II </b> hereunder</p>
                    </li>
                </ol>


                <P class="p174 ft55"><SPAN class="ft1">15.7</SPAN><SPAN class="ft106">All disputes, differences and
                        /or claim arising out of signing upon this Agreement whether during its subsistence or
                        thereafter shall be settled by arbitration in accordance with the provisions of the
                    </SPAN><SPAN class="ft54">Arbitration and Conciliation Act, 1996, </SPAN>or any statutory
                    amendments thereof and shall be referred to the sole Arbitration of an Arbitrator to be
                    nominated by PFSL. The award given by such an Arbitrator shall be final and binding on all the
                    Parties to this Agreement. In the event of demise of such an Arbitrator to whom the matter has
                    been originally referred or the Arbitrator recuses himself for being unable to act for any
                    reason, the Lender, on being informed at the time of such demise of the Arbitrator or of his
                    inability to act as Arbitrator, shall appoint another person to act as Arbitrator. Such a person
                    shall be entitled to proceed with the reference from the stage at which it was left by his
                    predecessor.</P>
                <P class="p175 ft55"><SPAN class="ft1">15.8</SPAN><SPAN class="ft106">Dispute for the purpose of
                        Arbitration includes default committed by the Borrower(s) as per </SPAN><SPAN
                        class="ft54">Clause 9 </SPAN>of this Agreement. It is a term of this Agreement that the
                    venue of Arbitration proceedings shall be at <SPAN class="ft54">KOLKATA </SPAN>and the language
                    shall be in <SPAN class="ft54">English.</SPAN></P>
                <P class="p49 ft1"><SPAN class="ft1">15.9</SPAN><SPAN class="ft107">All notices and other
                        communications on PFSL and the Borrower(s) and Guarantor shall be as mentioned in</SPAN></P>
                <P class="p176 ft55"><SPAN class="ft1">15.10</SPAN>
                    <NOBR><SPAN class="ft108">Schedule-I</SPAN>.</NOBR> Authority to Share Information: Borrower(s)
                    and Guarantor further authorize PFSL and/ orits Associates /Subsidiaries / Authorized
                    Representatives /Agent/ Affiliates to verify any information / conduct survey at his/her/their
                    office/ residence and/ or contact him/ her/ their family members, employer/ banker or Credit
                    Information Bureau like CIBIL and also to conduct checks for all documents or other information
                    including e KYC and PAN verification as required under policies of PFSL and Reserve Bank of
                    India guidelines from time to time.
                </P>
                <P class="p177 ft55"><SPAN class="ft1">15.11</SPAN><SPAN class="ft74">Borrower (s) and Guarantor
                        also have no objection if his/ her/ their personal information are shared/ uploaded with /
                        to CIBIL / CERSAI or any other law enforcement agencies as may be required from time to time
                        and also consent to receiving information from Central KYC Registry through SMS / email on
                        the registered mobile number and email address as provided.</SPAN></P>
                <P class="p177 ft55"><SPAN class="ft1">15.12</SPAN><SPAN class="ft95">Borrower(s) and Guarantor
                        confirm his/her/their understanding that the Documentation Charges and Processing Fees paid
                        by him/her/them is </SPAN>
                    <NOBR>non-refundable</NOBR> under any circumstances whatsoever including but not limited to
                    decline/part disbursement of the Loan.
                </P>
                <P class="p178 ft55"><SPAN class="ft1">15.13</SPAN><SPAN class="ft95">Borrower(s) and Guarantor
                        expressly agree and authorize PFSL to communicate to him/ her/ them from time to time
                        various features of products/ promotional offers, which offer significant benefits to its
                        customer, and also transaction related alerts and may use the services of third party
                        agencies for such communication.</SPAN></P>
                <P class="p179 ft3"><SPAN class="ft1">15.14</SPAN><SPAN class="ft109">The Borrower(s) and the
                        Guarantor hereby declare that they are not tax resident in any other country other than
                        India.</SPAN></P>
                <P class="p180 ft3"><SPAN class="ft1">15.15</SPAN><SPAN class="ft109">The Borrower(s) and the
                        Guarantor have read the entire Agreement, constituting the above clauses including the Loan
                        details and the terms of repayment, the fees and charges payable as clearly enumerated in
                        the Schedule to this Agreement. The Borrower(s) and the Guarantor further confirm that the
                        entire Agreement is filled in their presence and that the contents provided herein is
                        explained in the language understood by the Borrower and the Guarantor(s). The Borrower and
                        the Guarantor further confirm having executed the Agreement, received a copy of the same and
                        agree to remit the dues in terms of the </SPAN><SPAN class="ft26">Schedule II
                    </SPAN>hereunder.</P>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
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

                <p class="page-no">15</p>

            </div>
            <div class="page-break"></div>

            <div class="page" id="page_16">

                <h5 style="padding: 0 30px;">IN WITNESS WHEREOF the Parties hereto have executed / caused to be executed
                    these presents
                    the day and year first here in above written in the manner herein after appearing:
                </h5>
                <table class="border0">
                    <tr>
                        <td class="border0" colspan="4">
                            <p class="ft0" style="text-decoration: none; font-family:sans-serif;"><b>For Borrower(s)</b>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0" colspan="1">
                            <p>Signed and
                                Delivered by the
                                Borrower(s)</p>
                        </td>
                        <td class="border0" colspan="2">
                            
                            <p style="text-align: center ">
                                {{$data->prefixoftheborrower}}
                                <span>{{$data->nameoftheborrower}}</span>
                            </p>

                        </td>
                        <td class="border0" colspan="1">
                            <p style="text-align: center;"> </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0">
                            <P class="p15 ft9">&nbsp;</P>
                        </td>
                        <td class="border0" style="margin: 0; padding:0; line-height:0;text-align:center;" colspan="2">
                            <P style="border-top:1px solid #000; padding-top: 5px; margin: 0;margin-bottom:20px;">(Name of the Borrower)</P>
                        </td>
                        <td class="border0" style="margin: 0; padding:0; line-height:0;text-align:center;">
                            <P style="border-top:1px solid #000; padding-top: 5px; display:inline-block;margin: 0;"margin-bottom:20px;>(Signature)
                            </P>
                        </td>

                    </tr>

                    <tr>
                        <td class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="2">
                            
                            <p class="ft1" style="text-align: center">{{$data->prefixofthecoborrower}} <span>
                                    {{$data->nameofthecoborrower}}
                                </span> </p>

                        </td>
                        <td colspan="2" class="border0">
                            <p style="text-align:center;"> </p>
                        </td>
                    </tr>
                    <TR>
                        <TD class="border0">
                            <P>&nbsp;</P>
                        </TD>
                        <TD class="tr27 td27 border0" style="margin: 0; padding:0; line-height:0;text-align:center;"
                            colspan="2">
                            <P class=" ft1" style="border-top:1px solid #000; padding-top: 5px;margin:0;margin-bottom:20px;">
                                (Name of the CO
                                Borrower)</P>

                        </TD>
                        <TD class="tr27 td28 border0" style="margin: 0; padding:0; line-height:0;text-align:center;">
                            <P class=" ft1" style="border-top:1px solid #000; padding-top: 5px; display:inline-block;margin: 0;margin-bottom:20px;">
                                (Signature)</P>

                        </TD>
                    </TR>
                    <tr>
                        <td class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="2">
                            
                            <p class="ft1" style="text-align: center">{{$data->prefixofthecoborrower}} <span>
                                    {{$data->nameofthecoborrower}} </span> </p>

                        </td>
                        <td colspan="2" class="border0">
                            <p style="text-align:center;"> </p>
                        </td>
                    </tr>
                    <TR>
                        <TD class="tr27 td26 border0">
                            <P class="p15 ft9">&nbsp;</P>
                        </TD>

                        <TD class="tr27 td27 border0" style="margin: 0; padding:0; line-height:0;text-align:center;"
                            colspan="2">
                            <P class=" ft1" style="border-top:1px solid #000; padding-top: 5px;margin: 0;margin-bottom:20px;">
                                (Name of the CO
                                Borrower)</P>

                        </TD>
                        <TD class="tr27 td28 border0" style="margin: 0; padding:0; line-height:0;text-align:center;">
                            <P class=" ft1" style="border-top:1px solid #000; padding-top: 5px; display:inline-block;margin: 0;margin-bottom:20px;">
                                (Signature)</P>

                        </TD>
                    </TR>
                </table>

                

                <table class="border0">
                    <tr>
                        <td class="border0" colspan="8">
                            <p class="ft0" style="text-decoration: none; font-family:sans-serif;"><b>For Lender</b></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0" colspan="2">
                            <p>Signed and <br>
                                Delivered by <br>
                                Peerless Financial <br>
                                Services Ltd. <br>
                                by the hand of its Authorised signatory</p>
                        </td>
                        <td class="border0" style="margin: 0; padding:0; line-height:0;">
                            
                            <p class="ft1" style="text-align: center">Mr./Ms. <span>
                                    {{$data->nameoftheauthorisedsignatory}} </span> </p>

                        </td>

                    </tr>
                    <TR>
                        <TD class="border0" colspan="2">
                            <P class="p15 ft9">&nbsp;</P>
                        </TD>
                        <TD class="tr27 td27 border0" style="margin: 0; padding:0; line-height:0; text-align:center;">
                            <P class="p185 ft1"
                                style="border-top:1px solid #000; padding-top: 15px; display:inline-block;margin: 0;">
                                (Name of the
                                authorised signatory)</P>
                        </TD>
                        <TD class="tr27 td28 border0" style="margin: 0; padding:0; line-height:0; text-align:center;">
                            <P class="p186 ft1"
                                style="border-top:1px solid #000; padding-top: 15px; display:inline-block;margin: 0;">
                                (Stamp/Signature)</P>
                        </TD>
                    </TR>
                </table>

                

                {{-- witness 1 --}}
                <table class="border0">
                    <tr>
                        <td class="border0" colspan="8">
                            <p class="ft0" style="text-decoration: none; font-family:sans-serif; margin-bottom: 12px;"><b>For Witness</b></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="7" style="margin: 0; padding:0; line-height:0;">
                            
                            <p class="cps">Name : {{$data->witness1fullname}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="7" style="margin: 0; padding:0; line-height:0;">
                            
                            <p class="cps">Address : {{$data->witness1streetaddress}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="7" style="margin: 0; padding:0; line-height:0;">
                            
                            <p class="cps">
                                <span>City : {{$data->witness1city}} </span>
                                <span>Pin code{{$data->witness1pincode}}</span> 
                                <span>State{{$data->witness1state}}</span>
                            </p>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="7" style="margin: 0; padding:0; line-height:0;">
                            <p>&nbsp;</p>

                            <p class="ft1" style="text-align:left; margin-top: 12px;">
                                <b>Signed By Witness</b> : __________________________________________
                            </p>

                        </td>
                    </tr>
                </table>

                

                {{-- witness 2 --}}
                <table class="border0">
                    <tr>
                        <td class="border0" colspan="8">
                            <p class="ft0" style="text-decoration: none; font-family:sans-serif; margin-bottom: 12px;"><b>For Witness</b></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="7" style="margin: 0; padding:0; line-height:0;">
                            
                            <p class="cps">Name : {{$data->witness2fullname}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="7" style="margin: 0; padding:0; line-height:0;">
                            
                            <p class="cps">Address : {{$data->witness2streetaddress}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="7" style="margin: 0; padding:0; line-height:0;">
                            
                            <p class="cps">
                                <span>City :  {{$data->witness2city}}</span>
                                <span>Pin code :  {{$data->witness2pincode}}</span>
                                <span>State :  {{$data->witness2state}}</span>
                            </p>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="7" style="margin: 0; padding:0; line-height:0;">
                            

                            <p class="ft1" style="text-align:left; margin-top: 12px;">
                                <b>Signed By Witness</b> : __________________________________________
                            </p>

                        </td>
                    </tr>
                </table>

                

                <table class="border0">
                    <tr>
                        <td class="border0" colspan="8">
                            <p class="ft0" style="text-decoration: none; font-family:sans-serif; margin-bottom: 12px;">
                                <b>Read, understood & acknowledged by the Guarantor</b>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="7" style="margin: 0; padding:0; line-height:0;">
                            
                            <p class="cps">Name : {{$data->prefixoftheguarantor}}
                                {{$data->nameoftheguarantor}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="7" style="margin: 0; padding:0; line-height:0;">
                            
                            <p class="cps">Address : {{$data->streetaddressoftheguarantor}}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1" class="border0">
                            <p>&nbsp;</p>
                        </td>
                        <td class="border0" colspan="7" style="margin: 0; padding:0; line-height:0;">
                            
                            <p class="cps">
                                <span>City : {{$data->cityoftheguarantor}} </span>
                                <span>Pin code :  {{$data->pincodeoftheguarantor}}</span>
                                <span>State :  {{$data->stateoftheguarantor}}</span>
                            </p>
                            <p class="ft1" style="text-align:left; margin-top: 12px;">
                                <b>Signed By Witness :</b> __________________________________________
                            </p>
                        </td>
                    </tr>
                </table>

                <p class="page-no">16</p>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_17">
                <h3>
                    <b class="p202 ft5">SCHEDULE I</b>
                    <br>
                    <b class="p13 ft5">DETAILS OF PARTIES TO THE AGREEMENT</b>
                </h3>
                <br>
                <table class="table_17" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <b class="p203 ">Name of the Borrower</b>
                        </td>
                        <td>
                            {{$data->nameoftheborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Permanent Address</b>
                        </td>
                        <td>
                            {{$data->streetaddressoftheborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p205">PAN</b>
                        </td>
                        <td>
                            {{$data->pancardnumberoftheborrower}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="p204">Officially Valid Documents</b>
                        </td>
                        <td>
                            {{$data->officiallyvaliddocumentsoftheborrower}}

                            @if ($data->officiallyvaliddocumentsoftheborrower == "Aadhar card")
                            ({{$data->aadharcardnumberoftheborrower}})
                            @elseif ($data->officiallyvaliddocumentsoftheborrower == "Voter card")
                            ({{$data->votercardnumberoftheborrower}})
                            @elseif ($data->officiallyvaliddocumentsoftheborrower == "Bank statement")
                            ({{$data->bankaccountnumberoftheborrower}})
                            @elseif ($data->officiallyvaliddocumentsoftheborrower == "Driving license")
                            ({{$data->drivinglicensenumberoftheborrower}})
                            @elseif ($data->officiallyvaliddocumentsoftheborrower == "Electricity bill")
                            ({{$data->electricitybillnumberoftheborrower}})
                            @elseif ($data->officiallyvaliddocumentsoftheborrower == "Passport")
                            ({{$data->passportnumberoftheborrower}})
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Occupation</b>
                        </td>
                        <td>
                            {{$data->occupationoftheborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Resident Status</b>
                        </td>
                        <td>
                            {{$data->residentstatusoftheborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p205">Date of birth</b>
                        </td>
                        <td>
                            {{$data->dateofbirthoftheborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Marital Status</b>
                        </td>
                        <td>
                            {{$data->maritalstatusoftheborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p205">Highest Education</b>
                        </td>
                        <td>
                            {{$data->highesteducationoftheborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Tel no / Email ID</b>
                        </td>
                        <td>
                            {{$data->mobilenumberoftheborrower}} {{($data->emailidoftheborrower != null) ? '/
                            '.$data->emailidoftheborrower : ''}}
                        </td>
                    </tr>
                </table>
                <table class="table_17">
                    <tr>
                        <td>
                            <b class="p203 ">Name of the Co Borrower</b>
                        </td>
                        <td>
                            {{$data->nameofthecoborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Permanent Address</b>
                        </td>
                        <td>
                            {{$data->streetaddressofthecoborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p205">PAN</b>
                        </td>
                        <td>
                            {{$data->pancardnumberofthecoborrower}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="p204">Officially Valid Documents</b>
                        </td>
                        <td>
                            {{$data->officiallyvaliddocumentsofthecoborrower}}

                            @if ($data->officiallyvaliddocumentsofthecoborrower == "Aadhar card")
                            ({{$data->aadharcardnumberofthecoborrower}})
                            @elseif ($data->officiallyvaliddocumentsofthecoborrower == "Voter card")
                            ({{$data->votercardnumberofthecoborrower}})
                            @elseif ($data->officiallyvaliddocumentsofthecoborrower == "Bank statement")
                            ({{$data->bankaccountnumberofthecoborrower}})
                            @elseif ($data->officiallyvaliddocumentsofthecoborrower == "Driving license")
                            ({{$data->drivinglicensenumberofthecoborrower}})
                            @elseif ($data->officiallyvaliddocumentsofthecoborrower == "Electricity bill")
                            ({{$data->electricitybillnumberofthecoborrower}})
                            @elseif ($data->officiallyvaliddocumentsofthecoborrower == "Passport")
                            ({{$data->passportnumberofthecoborrower}})
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Occupation</b>
                        </td>
                        <td>
                            {{$data->occupationofthecoborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Resident Status</b>
                        </td>
                        <td>
                            {{$data->residentstatusofthecoborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p205">Date of birth</b>
                        </td>
                        <td>
                            {{$data->dateofbirthofthecoborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Marital Status</b>
                        </td>
                        <td>
                            {{$data->maritalstatusofthecoborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p205">Highest Education</b>
                        </td>
                        <td>
                            {{$data->highesteducationofthecoborrower}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Tel no / Email ID</b>
                        </td>
                        <td>
                            {{$data->mobilenumberofthecoborrower}} {{($data->emailidofthecoborrower != null) ? '/
                            '.$data->emailidofthecoborrower : ''}}
                        </td>
                    </tr>
                </table>
                <table class="table_17">
                    <tr>
                        <td>
                            <b class="p203 ">Name of the Co Borrower</b>
                        </td>
                        <td>
                            {{$data->nameofthecoborrower2}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Permanent Address</b>
                        </td>
                        <td>
                            {{$data->streetaddressofthecoborrower2}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p205">PAN</b>
                        </td>
                        <td>
                            {{$data->pancardnumberofthecoborrower2}}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="p204">Officially Valid Documents</b>
                        </td>
                        <td>
                            {{$data->officiallyvaliddocumentsofthecoborrower2}}

                            @if ($data->officiallyvaliddocumentsofthecoborrower2 == "Aadhar card")
                            ({{$data->aadharcardnumberofthecoborrower2}})
                            @elseif ($data->officiallyvaliddocumentsofthecoborrower2 == "Voter card")
                            ({{$data->votercardnumberofthecoborrower2}})
                            @elseif ($data->officiallyvaliddocumentsofthecoborrower2 == "Bank statement")
                            ({{$data->bankaccountnumberofthecoborrower2}})
                            @elseif ($data->officiallyvaliddocumentsofthecoborrower2 == "Driving license")
                            ({{$data->drivinglicensenumberofthecoborrower2}})
                            @elseif ($data->officiallyvaliddocumentsofthecoborrower2 == "Electricity bill")
                            ({{$data->electricitybillnumberofthecoborrower2}})
                            @elseif ($data->officiallyvaliddocumentsofthecoborrower2 == "Passport")
                            ({{$data->passportnumberofthecoborrower2}})
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Occupation</b>
                        </td>
                        <td>
                            {{$data->occupationofthecoborrower2}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Resident Status</b>
                        </td>
                        <td>
                            {{$data->residentstatusofthecoborrower2}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p205">Date of birth</b>
                        </td>
                        <td>
                            {{$data->dateofbirthofthecoborrower2}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Marital Status</b>
                        </td>
                        <td>
                            {{$data->maritalstatusofthecoborrower2}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p205">Highest Education</b>
                        </td>
                        <td>
                            {{$data->highesteducationofthecoborrower2}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Tel no / Email ID</b>
                        </td>
                        <td>
                            {{$data->mobilenumberofthecoborrower2}} {{($data->emailidofthecoborrower2 != null) ? '/
                            '.$data->emailidofthecoborrower2 : ''}}
                        </td>
                    </tr>
                </table>
                <table class="table_17">
                    <tr>
                        <td>
                            <b class="p203 ">Place of agreement</b>
                        </td>
                        <td>
                            {{$data->placeofagreement}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b class="p204">Date of agreement</b>
                        </td>
                        <td>
                            {{$data->dateofagreement}}
                        </td>
                    </tr>
                </table>

                <br><br><br><br><br><br>

                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
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

                <p class="page-no">17</p>

            </div>

            <div class="page-break"></div>


            <div class="page" id="page_18">
                <h3>
                    <b class=" ft5">SCHEDULE II</b>
                    <br>
                    <b class=" ft5">KEY FACTS OF THE LOAN</b>
                </h3>

                <br>
                <br>

                <table class="border0 table_18">
                    <tr>
                        <td>i. Nature of Loan</td>
                        <td>
                            {{$data->natureofloan}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ii. Sanctioned Loan Amount Sanction
                            letter / Letter of intent reference
                        </td>
                        <td>
                            <p>
                                Rs. {{$data->loanamountindigits}} (Rupees {{$data->loanamountindigitsinwords}}) only
                                Reference no {{$data->loanreferencenumber}} dated {{$data->dateofagreement}}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>iii. Purpose of loan</td>
                        <td>
                            <p>
                                {{$data->purposeofloan}}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>iv. Repayment tenure</td>
                        <td>
                            <p>
                                {{$data->repaymenttenureinmonths}} from the date of disbursement
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>v. Rate of Interest</td>
                        <td>
                            <p>
                                {{$data->rateofinterest}} % per annum (fixed)
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>vi. Processing fee <br> Documentation charges</td>
                        <td>
                            <p>
                                {{$data->processingchargeinpercentage}}%
                                <br>
                                {{$data->documentationfee}}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>vii. (a) Security& Margin</td>
                        <td>
                            <p>
                                {{$data->securitymargin}}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>(b) Guarantee</td>
                        <td>
                            <p>
                                {{$data->guarantee}}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>viii. Repayment of principal and payment
                            of interest</td>
                        <td>
                            <p>
                                Repayable in ({{$data->monthlyinstalmentsnumber}}) Equated Monthly
                                Instalments (EMIs) of Rs.{{$data->monthlyemiindigits}}/-
                                (Rupees {{$data->monthlyemiinwords}}) only
                                each, to be {{$data->paymentdeductionfrom}}
                            </p>
                            {{-- <input type="checkbox">deducted from the Borrower's salary by the Borrower's employer
                            on monthly basis and credited into the Lender's bank Account <br>
                            <input type="checkbox">directly debited from the Borrower's bank a/c and credited into
                            lender's bank a/c as detailed in item no ( IX) here in below --}}
                        </td>
                    </tr>
                </table>

                <br><br><br><br><br><br>

                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
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
                <p class="page-no">18</p>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_19">
                <table class="border0 table_19">
                    <tr>
                        <td>
                            ix.
                            Details of Lender's bank
                            account for credit of EMI
                        </td>
                        <td>
                            <p>
                                Current Account No: <b>00080350003328</b><br>
                                Beneficiary: <b>Peerless Financial Services Limited</b><br>
                                Name of bank & branch: <b> HDFC Bank, Stephen House Branch </b><br>
                                IFSC Code: <b>HDFC0000008</b><br>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            x.
                            Date of credit of EMI into Lender&apos;s Bank Account
                        </td>
                        <td>
                            <p>
                                {{ ($data->dateofcreditofemiintolendersbankaccount == 'Others') ? '' :
                                $data->dateofcreditofemiintolendersbankaccount }}
                                {{$data->otherdateofemicredit ? $data->otherdateofemicredit.' of every month' : ''}}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            xi. Penal Interest/ Liquidation damages
                        </td>
                        <td>
                            <p>
                                Chargeable @ {{$data->penalinterestpercentage}} % per annum over and above the
                                applicable interest rate. Penal interest will be charged for the
                                period of default i.e. from the due date of Payment of EMI or
                                interest or any amount due to the date of actual payment.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            xii. Mode of Disbursement
                        </td>
                        <td>
                            <p>
                                Online payment to bank account as detailed against item (xiii)
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            xiii. Details of Borrower's bank account
                            for loan disbursal
                        </td>
                        <td>
                            <p>
                                Savings / Current Account No : {{$data->savingsaccountnumberofborrower}} <br>
                                Beneficiary : {{$data->beneficiarynameofborrowersbank}} <br>
                                Name of bank & Branch : {{$data->banknameofborrower}} / {{$data->branchnameofborrower}}
                                <br>
                                Bank address : {{$data->bankaddressofborrower}} <br>
                                IFSC Code : {{$data->ifscodeofborrower}} <br>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            xiv. Insurance
                        </td>
                        <td>
                            <p>
                                {{$data->insuranceofborrower}}
                            </p>
                        </td>
                    </tr>
                </table>


                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
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
                <p class="page-no">19</p>

            </div>

            <div class="page-break"></div>

            <div class="page" id="page_20">

                <div id="id20_1">
                    <h3>
                        <b>SCHEDULE III</b>
                        <br>
                        <b>OTHER TERMS AND CONDITIONS</b>
                    </h3>

                    <ol type="I">
                        <li>
                            <p>
                                Borrower(s) and the Guarantor shall jointly and severally repay the Loan along with Interest as set out in <b>Schedule-II;</b>
                            </p>
                        </li>
                        <li>
                            <p>
                                In the event of cessation of the Borrowers' service with the Borrowers' employer(s) before the loan is repaid in full it will
                                be the responsibility and obligation of the Borrower(s) to pay and in the event of the Borrowers' employer(s)
                                committing default or delay in payment of EMI on the loan or payment of the outstanding amount in the event of
                                cessation of service of the Borrower (s) with the Borrowers' employer(s) for any reason whatsoever, the Lender will be
                                entitled to demand payment of the overdue EMI/EMI in default or the outstanding amount, as the case may be, from
                                the Borrower(s) and the Borrower(s) will forthwith pay the EMI amount or such outstanding amount to the Lender. 
                            </p>
                        </li>
                        <li>
                            <p>
                                Lender shall have the right to review the loan account and revise the terms thereof anytime on its own or upon the
                                request of the Borrower(s) and the repayment of the outstanding loan will be subject to the revised terms & conditions;
                            </p>
                        </li>
                        <li>
                            <p>
                                Any amount to the Lender under the Agreement by the borrower(s), shall be made free and clear of and with out any
                                deduction for or on account of any tax.;
                            </p>
                        </li>
                        <li>
                            <p>
                                Any post-dated cheques (PDC) and undated chequez s (UDC) issued by the Borrower (s) (if required by PFSL), which
                                as being authorised to fill up with date may be deposited by PFSLwith a view to receiving payments on the Due Dates,
                                as provided for in the terms of Repayment in Schedule II;
                            </p>
                        </li>
                        <li>
                            <p>
                                Borrower(s) shall always ensure that sufficient funds are available in the account to which the said PDCs/ UDCs/ ECS/
                                ACH relate to enable the Lender to present the same for encashment. In the event of any dishonour of a Payment
                                Instrument, without prejudice to the other rights of PFSL, the Borrower(s) shall be liable to pay to the Lender additional
                                Interest/charges;
                                
                            </p>
                        </li>
                        <li>
                            <p>
                                In the event the Lender is unwilling to continue the Loan on account of regulatory or other reasons and/ or if any event
                                of default occurs, the Lender shall have the sole right during tenor of this Agreement to recall the entire or part of the
                                loan without assigning any reason <br>
                                Whatsoever;
                            </p>
                        </li>
                        <li>
                            <p>
                                The Borrower(s) shall not leave India for employment or business or long stay or Permanently, without first fully
                                repaying the personal loan then outstanding with interest and other dues including any other charges as pertaining to
                                the Loan;
                                
                            </p>
                        </li>
                        <li>
                            <p>
                                Liability of the Guarantor shall be co-terminus with that of the Borrower(s) and Acknowledgement of Liability by the
                                Borrower is binding on the Guarantor till such time the liability is discharged to the full satisfaction of the Lender;                                
                            </p>
                        </li>
                        <li>
                            <p>
                                Any other obligations, warranties, guarantee expressed by Borrower(s) or Guarantor in any clauses and/orSchedules
                                of the Personal Loan Facility Agreement;
                                
                            </p>
                        </li>
                    </ol>


                    <br><br><br><br><br><br><br><br>

                    <table cellpadding=0 cellspacing=0 class="sign-table">
                        <tr>
                            <td>
                                <div class="sign-line"></div>
                                <b>Authorised Signatories For PFSL</b>
                            </td>
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
                    <p class="page-no">20</p>
                </div>

            </div>

            <div class="page-break"></div>

            <div class="page" id="page_21">

                <div id="id21_1">
                    <h3>
                        <b>SCHEDULE IV</b>
                        <br>
                        <b>DOCUMENTS TO BE ATTACHED WITH APPLICATION FOR LOAN</b>
                    </h3>
                    <P class="p241 ft8">Please ( ) Tick Whichever Applicable</P>

                    @php
                    $originalData = [
                    'Salary Certificate from current Employer',
                    'Proof of identity',
                    'Proof of current residential & official address',
                    'Latest three months&apos Bank Statement (where salary / income is credited or accumulated)',
                    'Salary slips for last three months preceding application date',
                    'Two passport size photographs',
                    'Certified copy of standing Instructions/ Signed ECS / ACH mandate/other relevant mandate to
                    designated bank, of the Borrower(s) to transfer to the Lender on the Due Dates, the amounts which
                    are required to be paid by the Borrower(s), as specified in terms of Repayment in Schedule II',
                    'Copies of last 2 years&apos; ITR',
                    'Signature Verification by banker (as per PFSL format)',
                    'Proof of other income',
                    'Proof of assets (copy of registered deed of house property / statement of accounts of mutual fund /
                    insurance policy / statement of demat account)',
                    'Guarantor&apos;s net worth certificate (as per PFSL format)',
                    ];
                    $commaSeperatedSelectedData = $data->documentstobeattachedwithapplicationforloan;

                    if(!empty($commaSeperatedSelectedData)) {
                    $selectedData = explode(',', $commaSeperatedSelectedData);

                    echo '<ol type="i">';
                        foreach($originalData as $item) {
                        $show = '';
                        if(in_array($item, $selectedData)) {
                        $show = '<i class="fas fa-check"></i>';
                        }
                        echo '<li>'.$show.$item.'</li>';
                        }
                        echo '<li>
                            Others (please specify)<br>
                            '.$data->otherdocumentstobeattachedwithapplicationforloan.'
                        </li>';
                        echo '</ol>';
                    }
                    @endphp

                    {{-- <P><SPAN class="ft1">(I)</SPAN><SPAN class="ft133">Salary Certificate from
                            current Employer;</SPAN></P>
                    <P><SPAN class="ft1">(ii)</SPAN><SPAN class="ft134">Proof of identity;</SPAN></P>
                    <P><SPAN class="ft1">(iii)</SPAN><SPAN class="ft135">Proof of current residential &
                            official address;</SPAN></P>
                    <P><SPAN class="ft1">(iv)</SPAN><SPAN class="ft136">Latest three months' Bank
                            Statement (where salary / income is credited or accumulated);</SPAN></P>
                    <P><SPAN class="ft1">(v)</SPAN><SPAN class="ft99">Salary slips for last three
                            months preceding application date;</SPAN></P>
                    <P><SPAN class="ft1">(vi)</SPAN><SPAN class="ft136">Two passport size photographs
                            ;</SPAN></P>
                    <P class="p245 ft131"><SPAN class="ft69">(vii)</SPAN><SPAN class="ft137">Certified copy of standing
                            Instructions/ Signed ECS / ACH mandate/other relevant mandate to designated bank, of the
                            Borrower(s) to transfer to the Lender on the Due Dates, the amounts which are required to be
                            paid by the Borrower(s), as specified in terms of Repayment in Schedule II;</SPAN></P>
                    <P><SPAN class="ft1">(viii)</SPAN><SPAN class="ft116">Copies of last 2 years' ITR
                            ;</SPAN></P>
                    <P><SPAN class="ft1">(ix)</SPAN><SPAN class="ft138">Signature Verification by
                            banker (as per PFSL format)</SPAN></P>
                    <P><SPAN class="ft1">(x)</SPAN><SPAN class="ft139">Proof of other income</SPAN></P>
                    <P><SPAN class="ft1">(xi)</SPAN><SPAN class="ft138">Proof of assets (copy of
                            registered deed of house property / statement of accounts of</SPAN></P>
                    <P>mutual fund / insurance policy / statement of demat account)</P>
                    <P><SPAN class="ft1">(xii)</SPAN><SPAN class="ft107">Guarantor's net worth
                            certificate (as per PFSL format)</SPAN></P> --}}


                    {{-- <P class="p251 ft1"><SPAN class="ft69">(xiii)</SPAN><SPAN class="ft116">Others (please specify)
                            {{$data->otherdocumentstobeattachedwithapplicationforloan}} </SPAN></P> --}}


                    <br><br><br><br>
                    <br><br><br><br>



                    <table cellpadding=0 cellspacing=0 class="sign-table">
                        <tr>
                            <td>
                                <div class="sign-line"></div>
                                <b>Authorised Signatories For PFSL</b>
                            </td>
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
                    <p class="page-no">21</p>

                </div>

            </div>

            <div class="page-break"></div>

            <div class="page" id="page_22">

                <div id="id22_1">
                    <h3>SCHEDULE V</h3>
                    <h5 style="text-align: left;"><b>FACILITY SPECIFIC DOCUMENTS EXECUTED BY BORROWER(S) / GUARANTOR (S) TO BE <br>
                        CONSIDERED PART & PARCEL OF THE <br>
                        PERSONAL LOAN FACILITY AGREEMENT DATED {{$data->dateofagreement}} </b></h5>
                </div>
                
                <b>Please ( tick )</b>
                
                <table class="table_22">
                    <tr>
                        <td class="table-22-td1">Sr No. </td>
                        <td class="table-22-td2">Deed / Document Name</td>
                        <td class="table-22-td3">Dated</td>
                    </tr>

                    <tr>
                        <td class="table-22-td1"> 1. </td>
                        <td class="table-22-td2">
                            Deed of Personal Guarantee
                        </td>
                        <td class="table-22-td3">
                            {{$data->deedofpersonalguaranteedate}}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-22-td1"> 2. </td>
                        <td class="table-22-td2">
                            Deed of Pledge of Moveable Properties <br>
                            (Shares , Bonds , Debentures , Mutual Funds)
                        </td>
                        <td class="table-22-td3">
                            {{$data->deedofpledgeofmoveablepropertiessharesbondsdebenturesmutualfundsdate}}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-22-td1"> 3. </td>
                        <td class="table-22-td2">
                            Deed of Mortgage of Inmoveable Properties <br>
                            (Land , House , Warehouse)
                        </td>
                        <td class="table-22-td3">
                            {{$data->deedofmortgageofinmoveablepropertieslandhousewarehousedate}}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-22-td1"> 4. </td>
                        <td class="table-22-td2">
                            Power of Attorney
                        </td>
                        <td class="table-22-td3">
                            {{$data->powerofattorneydate}}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-22-td1"> 5. </td>
                        <td class="table-22-td2">
                            Deed of Assignment <br>
                            (Insurance Policy , Fixed Deposit)
                        </td>
                        <td class="table-22-td3">
                            {{$data->deedofassignmentinsurancepolicyfixeddepositdate}}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-22-td1"></td>
                        <td class="table-22-td2">

                        </td>
                        <td class="table-22-td3"></td>
                    </tr>
                    <tr>
                        <td class="table-22-td1"></td>
                        <td class="table-22-td2">

                        </td>
                        <td class="table-22-td3"></td>
                    </tr>
                    <tr>
                        <td class="table-22-td1"></td>
                        <td class="table-22-td2">

                        </td>
                        <td class="table-22-td3"></td>
                    </tr>
                    <tr>
                        <td class="table-22-td1"></td>
                        <td class="table-22-td2">

                        </td>
                        <td class="table-22-td3"></td>
                    </tr>
                    <tr>
                        <td class="table-22-td1"></td>
                        <td class="table-22-td2">

                        </td>
                        <td class="table-22-td3"></td>
                    </tr>
                    <tr>
                        <td class="table-22-td1"></td>
                        <td class="table-22-td2">

                        </td>
                        <td class="table-22-td3"></td>
                    </tr>

                </table>


                <br><br><br><br><br>

                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
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
                <p class="page-no">22</p>


            </div>

            <div class="page-break"></div>

            <div class="page" id="page_23">

                <div id="id22_1" style="text-align:center;">
                    <h3>ANNEXURE I</h3>
                    <h5><b>DEMAND PROMISSORY NOTE</b></h5>
                </div>

                <br>

                <table class="table_23 border0" style="width:100%; margin:0 auto;">
                    <tr>
                        <td style="text-align:right;" class="border0" colspan="2">
                            <p class="ft131">Place : {{$data->demandpromissorynoteforborrowerplace}}</p>
                            <p class="ft131">Dated : {{$data->demandpromissorynoteforborrowerdate}}</p>
                            <p class="ft131">Rs. {{$data->demandpromissorynoteforborroweramount}}/-</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0" colspan="2">
                            <p class="ft131">
                                ON DEMAND, I / We {{$data->nameoftheborrower}}, unconditionally and irrevocably promise
                                to pay
                                Peerless Financial Services Limited (PFSL), having their Registered Office at Peerless
                                Bhavan, 3, Esplanade East,
                                Kolkata - 700 069, or order for value received the sum of Rs.
                                {{$data->loanamountindigits}} (Rupees {{$data->loanamountindigitsinwords}}) only with
                                interest there on at the rate of DEMAND PROMISSORY NOTE {{$data->rateofinterest}} %
                                Per annum with rests along with all costs, charges, expenses, taxes,
                                cess, levies, duties and penalty (ies) or at such rate as PFS may from time to time fix
                                or at a rate which may from time to
                                time be as signed by PFSL for value received. I/ We also agree that this note may be
                                assigned/ pledged/ hypo the cated to
                                any one as required by PFSL, the lender, without notice tome / us.
                                Presentment for payment and requirement of prior notice and protest of this Note are
                                hereby unconditionally and
                                irrevocably waived.
                                <br><br>
                            </p>

                        </td>
                    </tr>



                    <tr class="stamp-tr">
                        <td class="border0">
                            <p style="display:inline-block; border-top:1px solid #000;">
                                Signature of Borrower
                            </p>
                        </td>
                        <td class="border0">
                            <span style="
                                display:block;
                                width:80px;
                                height:100px;
                                border:1px solid #000;
                                margin: 0 auto;
                            "></span>
                        </td>
                    </tr>

                    <tr class="stamp-tr">
                        <td class="border0">
                            <p style="display:inline-block; border-top:1px solid #000;">
                                Signature of Co Borrower
                            </p>
                        </td>
                        <td class="border0">
                            <p
                                style="display:block; width:80%; margin:0 auto; text-align: center; border-top:1px solid #000;">
                                Cross signature on <br>
                                Revenue Stamp of Re.1/-
                            </p>
                        </td>
                    </tr>

                </table>

                <br><br>

                <div id="id22_1" style="text-align:center;">
                    <h5><b>DEMAND PROMISSORY NOTE</b></h5>
                </div>

                <br><br>

                <table class="table_23 border0" style="width:100%; margin:0 auto;">
                    <tr>
                        <td style="text-align:right;" class="border0" colspan="2">
                            <p class="ft131">Place : {{$data->demandpromissorynoteforborrowerplace}}</p>
                            <p class="ft131">Dated :
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            <p class="ft131">Rs. {{$data->demandpromissorynoteforborroweramount}}/-</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0" colspan="2">

                            <p class="ft131">
                                ON DE MAND, I / We, {{$data->nameofthecoborrower}} unconditionally and irrevocably
                                promise to pay Peerless Financial Services Limited (PFSL), having their Registered
                                Office at Peerless Bhavan, 3, Esplanade East, Kolkata - 700 069, or order for value
                                received the sum of Rs {{$data->loanamountindigits}} (Rupees
                                {{$data->loanamountindigitsinwords}}) only with interest there on at the rate of
                                {{$data->rateofinterest}} % Perannum with rests along with all costs, charges, expenses,
                                taxes, cess, levies,
                                duties and penalty (ies) or at such rate as PFSL may from time to time fix or at a rate
                                which may from time to time be
                                Assigned by PFSL for value received. I / We also agree that this note may be assigned
                                /pledged/ hypo the cated to any one
                                as required by PFSL, the lender, without notice tome / us.
                                Presentment for payment and requirement of prior notice and protest of this Note are
                                hereby unconditionally and
                                irrevocably waived.
                                <br><br>
                            </p>

                        </td>
                    </tr>



                    <tr class="stamp-tr">
                        <td class="border0">
                            <p style="display:inline-block; border-top:1px solid #000;">
                                Signature of Borrower
                            </p>
                        </td>
                        <td class="border0">
                            <span style="
                                display:block;
                                width:80px;
                                height:100px;
                                border:1px solid #000;
                                margin: 0 auto;
                            "></span>
                        </td>
                    </tr>

                    <tr class="stamp-tr">
                        <td class="border0">
                            <p style="display:inline-block; border-top:1px solid #000;">
                                Signature of Co Borrower
                            </p>
                        </td>
                        <td class="border0">
                            <p
                                style="display:block; width:80%; margin:0 auto; text-align: center; border-top:1px solid #000;">
                                Cross signature on <br>
                                Revenue Stamp of Re.1/-
                            </p>
                        </td>
                    </tr>

                </table>

                <p class="page-no">23</p>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_24">

                <div style="text-align:center;">
                    <P class="stamp" style="border: 1px solid #000;margin-top: 20px;padding: 2px; display: inline-block;">
                        100/- Non Judicial Stamp to be affixed
                    </P>

                    <h3>ANNEXURE II</h3>
                    <h5><b>CONTINUING SECURITY LETTER</b></h5>
                    <p><b>(This Continuing Security Letter executed at the place and date stated in the
                        Schedule I therein under written)</b></P>
                    <br><br><br>
                </div>

                <table class="table_24 border0">
                    <tr>
                        <td class="border0">
                            <p>
                                Peerless Financial Services Limited <br>
                                Peerless Bhavan, <br>
                                3, Esplanade East <br>
                                Kolkata - 700 069 <br>
                                <br><br>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <p>Dear Sir,</p><br><br>
                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <p>
                                I / We {{$data->nameoftheborrower}}, enclose Demand Promissory Note dated
                                {{$data->continuingsecurityletterdate1}} for Rs. {{$data->loanamountindigits}} /-
                                (Rupees {{$data->loanamountindigitsinwords}}) Only payable and dated
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; for
                                Rs.{{$data->loanamountindigits}}/- (Rupees {{$data->loanamountindigitsinwords}}) Only on
                                demand, which is given by me / us as Security for repayment of the loan Granted to me/
                                us by PFSL, the Lender, by execution of Personal Loan Agreement dated
                                {{$data->dateofagreement}}, together with interest and other amounts due there
                                under and which may here after become due and payable by me / us to PFSL.
                                Not with standing the fact that the out standing loan amount may be reduced from time to
                                time or extinguished, the Promise to pay shall be a continuing Promise till the payment
                                of the entire outstanding amount by me / us to the satisfaction of the Lender.
                                <br><br>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <p>
                                Thanking You <br><br>
                                Yours Faithfully,<br><br><br><br><br>
                            </p>
                        </td>
                    </tr>

                </table>

                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
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
                <p class="page-no">24</p>

            </div>

            <div class="page-break"></div>

            <div class="page" id="page_25">

                <div style="text-align:center;">
                    <P class="stamp">100/- Non Judicial Stamp to be affixed</P>

                    <h3>ANNEXURE III</h3>
                    <h5>UNDERTAKING-CUM-INDEMNITY</h5>
                    <P><b>(This Undertaking Cum Indemnity executed at the place and date stated in the Schedule
                        I therein under written )</b> </P>
                    <br><br><br>
                </div>


                <table class="table_24 border0">
                    <tr>
                        <td class="border0">
                            <p>
                                Peerless Financial Services Limited <br>
                                Peerless Bhavan, <br>
                                3, Esplanade East <br>
                                Kolkata - 700 069 <br>
                                <br><br>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <p>Dear Sir,</p><br><br>
                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <p class="ft1">
                                <span class="ft2"> Re: Loan Account No</span> {{$data->loanaccountnumber}} <span
                                    class="ft2">Personal Loan Rs.</span> {{$data->loanamountindigits}} <br>
                                <span class="ft2"> (Rupees {{$data->loanamountindigitsinwords}}) Only</span>
                                I/ We ,{{$data->nameoftheborrower}}( <span class="ft2">'the Borrower'</span> ) and
                                {{$data->nameofthecoborrower}}( <span class="ft2">“the Co borrower”</span> ) refer to
                                the Personal Loan Facility Agreement dated {{$data->dateofagreement}} executed by me/ us
                                in favour of Peerless Financial Services Limited pursuant to the sanction of Loan of
                                <span class="ft2"> Rs. {{$data->loanamountindigits}} /- (Rupees {{$data->loanamountindigitsinwords}})</span> Only by PFSL vide Letter of Intent No.
                                {{$data->letterofintentnumber}} dated {{$data->undertakingcumindemnitydate}}.
                                In consideration of PFSL agreeing at my/our request to rely on the said Personal Loan
                                Facility Agreement, I/we do
                                here by irrevocably and unconditionally agree and undertake as follows :
                                <br><br>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <p>
                                Thanking You <br><br>
                                Yours Faithfully,
                            </p>
                        </td>
                    </tr>

                </table>



                <P class="p53 ft3">
                    <SPAN class="ft1">
                        1
                    </SPAN>
                    <SPAN class="ft142">
                        If at any time hereafter any stamp authority or other appropriate authority shall levy or
                        require payment of any
                        stamp duty/ differential stamp duty, interest or penalty or any other amount in the nature of
                        stamp duty on the
                        said Personal Loan Facility Agreement, I/ we shall forthwith upon receiving a demand from such
                        authority or
                        from you, pay to such authority or deposit with you the amount of stamp duty/ differential stamp
                        duty/ interest/
                        penalty or any other amount in the nature of stamp duty so claimed in respect of the said
                        Personal Loan Facility
                        Agreement;
                    </SPAN>
                </P>


                <P class="p53 ft3">
                    <SPAN class="ft1">
                        2
                    </SPAN>
                    <SPAN class="ft142">
                        I / we shall make such payment/deposit irrespective of whether any proceeding by way of appeal,
                        review,
                        revision or representation challenging the levy or demand of any such stamp duty or differential
                        stamp duty or
                        penalty or otherwise may have been filed by me or any other person or that may be otherwise
                        pending before
                        any Court, Tribunal or other authority whatsoever;
                    </SPAN>
                </P>

                <P class="p53 ft3">
                    <SPAN class="ft1">
                        3
                    </SPAN>
                    <SPAN class="ft142">
                        I / we hereby confirm that a certificate by an authorized official of PFSL as to the amount
                        levied or payable or to
                        be deposited as aforesaid shall be binding upon me/ us and shall be conclusive evidence of the
                        amount of my/
                        our liability;
                    </SPAN>
                </P>

                <P class="p53 ft3">
                    <SPAN class="ft1">
                        4
                    </SPAN>
                    <SPAN class="ft142">
                        I/ we hereby unconditionally agree to indemnify PFSL and keep PFSL, its officers and employees
                        indemnified
                        at all times in respect of any additional / differential stamp duty, interest and penalty and
                        off, from and against any
                        loss, damage, liabilities, costs, charges and expenses, whatsoever, which PFSL may incur or
                        suffer or be put to
                        in any manner whatsoever by reason of PFSL having agreed at my / our request to rely on the said
                        Personal
                        Loan Facility Agreement;
                    </SPAN>
                </P>

                <P class="p53 ft3">
                    <SPAN class="ft1">
                        5
                    </SPAN>
                    <SPAN class="ft142">
                        I / we hereby confirm that I / we have been duly authorized and empowered in all respects to
                        execute this
                        Letter of Undertaking-cum-Indemnity and I /we am/ are fully aware that on the basis thereof PFSL
                        has
                        agreed to execute the said Personal Loan Facility Agreement against my / our salary.
                    </SPAN>
                </P>
                
                <br><br>

                <p class="page-no">25</p>

            </div>

            <div class="page-break"></div>

            <div class="page" id="page_26">
                <div id="id26_1">
                    <P class="p304 ft28">This Letter of Undertaking- <NOBR>cum-Indemnity</NOBR> shall remain in force
                        till the entire principal amount of the Loan together with interest and all other moneys payable
                        in respect thereof shall be paid off to PFSL in full.</P>
                    <P class="p305 ft1">Yours faithfully,</P>
                    <br><br><br><br><br><br>
                    <table cellpadding=0 cellspacing=0 class="sign-table" style="position: relative;">
                        <tr>
                            <td>
                                <div class="sign-line"></div>
                                <b>Signature of Borrower</b>
                            </td>
                            <td>
                                <div class="sign-line"></div>
                                <b>Signature of Co-Borrower</b>
                            </td>
                        </tr>
                    </table>
                    <p class="page-no">26</p>
                </div>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_27">
                <div style="text-align:center;">
                    <h3>ANNEXURE IV</h3>
                    <h5>REQUEST FOR DISBURSEMENT</h5>
                    <P style="font-size: 12px; text-align: center;">
                        <b>(This Request for Disbursement executed at the place and date stated in the Schedule I therein under written)</b>
                    </P>
                    <br><br><br>
                </div>

                <table class="table_24 border0">
                    <tr>
                        <td class="border0">
                            <p>
                                Peerless Financial Services Limited <br>
                                Peerless Bhavan, <br>
                                3, Esplanade East <br>
                                Kolkata - 700 069 <br>
                                <br><br>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <p>Dear Sir,</p><br><br>
                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <p class="ft1">
                                Re: Loan Account No {{$data->loanaccountnumber}} Request for disbursement of
                                sanctioned loan of Rs. {{$data->loanamountindigits}}/- (Rupees
                                {{$data->loanamountindigitsinwords}}) only<br>
                                This is with reference to your Letter Of Intent No. {{$data->letterofintentnumber}}
                                dated {{$data->dateofagreement}} conveying sanction of the
                                subject facility. I / We have since completed all the formalities regarding
                                documentation of the facility in terms of the
                                Personal Loan Facility Agreement dated {{$data->dateofagreement}} executed between you
                                and me/ us . I / us now request you to
                                disburse the loan after deduction of Processing fees, Documentation charges etc. as
                                stipulated in the Letter of ln tent
                                under the sanctioned facility. You may also adjust the disbursal amount with the
                                Insurance Premium amount for onward
                                payment to the Insurer . <br><br>

                                The bank details for remittance of funds are as under
                                <br><br>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <p>
                                Bank Account Name : {{$data->beneficiarynameofborrowersbank}}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0">
                            <p>
                                Account Number: {{$data->savingsaccountnumberofborrower}} (Saving Bank Account)
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0">
                            <p>
                                Bank Name /Branch : {{$data->banknameofborrower}} / {{$data->branchnameofborrower}}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0">
                            <p>
                                Address : {{$data->bankaddressofborrower}}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0">
                            <p>
                                IFS Code : {{$data->ifscodeofborrower}}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0">
                            <p>
                                Thanking You, <br><br><br>
                                Yours Faithfully
                            </p>
                        </td>
                    </tr>

                </table>
                <br><br><br>

                <table cellpadding=0 cellspacing=0 class="sign-table" style="position: relative;">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Signature of Borrower</b>
                        </td>
                        <td>
                            <div class="sign-line"></div>
                            <b>Signature of Co-Borrower</b>
                        </td>
                    </tr>
                </table>
                <p class="page-no">27</p>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_28">
                <div style="text-align:center;">
                    <h3>ANNEXURE V</h3>
                    <h5>BORROWER'S REQUEST TO EMPLOYER FOR EMI DEDUCTION FROM SALARY</h5>
                    <P>
                        <b>Original document to be affixed with signature of the Borrower(s) and authorization of Employer</b>
                    </P>
                </div>
                <p class="page-no">28</p>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_29">
                <div style="text-align:center;">
                    <h3>ANNEXURE V</h3>
                    <h5>BORROWER'S REQUEST TO EMPLOYER FOR EMI DEDUCTION FROM SALARY</h5>
                    <P>
                        <b> Original document to be affixed with signature of the Borrower(s) and authorization of Employer</b>
                    </P>
                    <br><br><br>
                </div>
                <p class="page-no">29</p>
            </div>

            <div class="page-break"></div>

            <div class="page" id="page_30">


                <P class="stamp">
                    To be signed by all holders of bank account, <br>
                    if mode of operation of Bank Account is 'Joint'
                </P>
                <br><br><br><br>

                <h3>ANNEXURE VI</h3>
                <h5>NACH DECLARATION</h5>
                <P style="font-size: 12px; text-align: center;">
                    <b>(This NACH Declaration is executed at the place and date stated in the Schedule I therein under written )</b>
                </P>

                <br>

                <P class="p323 ft61">I /We hereby authorise Peerless Financial Services Limited to debit my / our bank
                    account, based on the instructions as agreed and signed by me / us . I/ we also authorize Peerless
                    Financial Services Limited to recover the deferred instalments/ EMIs / interests / charges etc. in
                    future through NACH in as many EMIs / instalments as may be required, in case of restructuring /
                    deferment / reschedulement / moratorium etc. of the credit facility granted to me/ us. I /we have
                    understood that transaction charges may change due to changes in applicable transaction charges /
                    statutory levies and I/we am/are authorized to cancel/ amend the mandate by appropriately
                    communicating the cancellation / amendment request to Peerless Financial Services Limited or the
                    bank where I / we have authorized the debit.</P>
                <P class="p324 ft1">For and on be half of {{$data->nachdeclarationforandonbehalfof}}</P>
                <TABLE cellpadding=0 cellspacing=0 class="t31 table_30 border0">
                    <TR class="border0">
                        <TD class="tr28 td45">
                            <P class="p15 ft1">Signature</P>
                        </TD>
                        <TD class="tr28 td75">
                            <P class="p214 ft1">Signature</P>
                        </TD>
                    </TR>
                    <TR class="border0">
                        <TD class="tr45 td45">
                            <P class="p15 ft1">Name {{$data->nachdeclarationname1}}</P>
                        </TD>
                        <TD class="tr45 td75">
                            <P class="p15 ft1">Name {{$data->nachdeclarationname2}}</P>
                        </TD>
                    </TR>
                    <tr>
                        <td>
                            <p>
                                <br><br><br>
                            </p>
                        </td>
                    </tr>
                    <TR class="border0">
                        <TD class="tr28 td76">
                            <P class="p15 ft1">Signature</P>
                        </TD>
                        <TD class="tr28 td75">
                            <P class="p15 ft1">Signature</P>
                        </TD>
                    </TR>
                    <TR class="border0">
                        <TD class="tr45 td76">
                            <P class="p15 ft1">Name {{$data->nachdeclarationname3}}</P>
                        </TD>
                        <TD class="tr45 td75">
                            <P class="p15 ft1">Name {{$data->nachdeclarationname4}}</P>
                        </TD>
                    </TR>
                </TABLE>
                <p class="page-no">30</p>

            </div>

            <div class="page-break"></div>

            <div class="page" id="page_31">

                <P class="stamp">
                    Rs 10/- Non Judicial Stamp to be affixed
                </P>

                <h3>ANNEXURE VII</h3>
                <h5>
                    PDC LETTER CUM UNDERTAKING <br>
                </h5>
                <p style="font-size: 12px; text-align: center;">
                    <b>(This PDC Letter cum Undertaking executed at the place and date stated in the Schedule I therein under written)</b>
                </p>


                <table class="border0">
                    <tr>
                        <td class="border0">

                            <b>Peerless Financial Services Limited</b> <br>
                            <b>Peerless Bhavan,</b> <br>
                            <b>3, Esplanade East</b> <br>
                            <b>Kolkata - 700 069</b> 

                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <b>Dear Sir,</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0">
                            <b>Re: Loan Account no. __________________________ of for Rs.________________/-</b>
                            <br>
                            <p>I/ We refer to the disbursement of secured loan which you have agreed to make to me / us in accordance
                                with abovementioned agreement. I / We hereby enclose the following post-dated cheques in your favour
                                towards payment of interest dues and repayment of the loan amount in accordance with the agreement:
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0">
                            <b>Details of Post-dated cheques</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0" style="padding-top: 0; text-align: center;">
                            <table class="border0 empty-table">
                                <tr>
                                    <th>
                                        <b>Sr. No</b>
                                    </th>
                                    <th>
                                        <b>Description</b>
                                    </th>
                                    <th>
                                        <b>Cheque No.</b>
                                    </th>
                                    <th>
                                        <b>Date</b>
                                    </th>
                                    <th>
                                        <b>Amount
                                            <br>
                                            (INR)
                                        </b>
                                    </th>
                                </tr>
                                <tr>
                                    <td>1.</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0">
                            <p>With reference to the above cheques issued to you, we hereby confirm and undertake as under:</p>

                            <ol>
                                <li>
                                    <p>
                                        I/ We shall not issue any stop payment instruction to the drawee bank with reference to the above
                                        cheques issued in your favour during the currency of the loan.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        I/ We shall not close our <b> Savings / Current Account No. ___________________ with
                                        _____________________(bank name) , ____________________________( branch name)
                                        ,_______________________ ___________________________ ( address) </b> on which the aforesaid
                                        cheques are drawn until such time the cheques issued to you are honoured by the drawee bank.
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        I / We shall not change the authorized signatories and/or authority given to the signatories of the
                                        aforesaid cheque to operate upon the above said bank account till such time the cheques are duly
                                        cleared by the drawee bank.
                                    </p>
                                </li>
                            </ol>
                        </td>
                    </tr>
                </table>



                <p class="page-no">31</p>

            </div>

            <div class="page-break"></div>

            <div class="page" id="page_32">


                <br><br><br><br>

                <ol start="4">
                    <li>
                        <p>
                            I / We shall not give any advice to the bank not to encash the cheque or to 
                            withhold encashing of cheque in any manner.
                        </p>
                    </li>
                    <li>
                        <p>
                            I / We shall not take any action or do any act, whatsoever, which shall come in the way of encashing our
                            above-mentioned cheques. It is clearly understood that you have given me / us the loan on the basis of
                            above representations.
                        </p>
                    </li>
                    <li>
                        <p>
                            I / We acknowledge that breach of/non-compliance with any of the above undertakings shall be treated as
                            an event of default, which shall entitle you to take appropriate legal action against me/ us as may be
                            deemed fit in your sole and absolute discretion. 
                        </p>

                        <br><br>

                        <p>Thanking You. <br>
                            Yours faithfully</p>
                    </li>
                </ol>

                <br><br><br><br><br>

                <table cellpadding=0 cellspacing=0 class="sign-table" style="position: relative;">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Signature of Borrower</b>
                        </td>
                        <td>
                            <div class="sign-line"></div>
                            <b>Signature of Co-Borrower</b>
                        </td>
                    </tr>
                </table>

                <p class="page-no">32</p>

            </div>

            <div class="page-break"></div>

            <div class="page" id="page_33">

                <div style="text-align:center;">
                    <h3>VERNACULAR DECLARATION</h3>
                    <br><br><br><br><br><br>
                </div>


                <table class="border0" style="width:100%;">
                    <tr>
                        <td class="border0">
                            <p>
                                I,……………………………………………………… S/o/ W/o
                                ........................................................................ residing at
                                ……………………………………………………………………………………………… do here by state and declare
                                on solemn affirmation as under :
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <p>
                                <span class="ft1">
                                    1(a)
                                </span>
                                <span>
                                    That the Borrower Mr./ Mrs./ Miss
                                    .....................................................................................................
                                    S /o / D/o /w/o
                                    …………………………………………… is my …..……….…………………………......................... and I know
                                    him/her for the last ……………. yrs/monthsand he/she signs in the vernacular language,
                                    I. e. in
                                    (name of language in which borrowers have signed) and the same has/ have been
                                    understood by him/ her. I have
                                    seen him signing during the normal course of business/ transactions.
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0">
                            <p>
                                <span class="ft1">
                                    1 (b)
                                </span>
                                <span>
                                    That the Co Borrower / Gurantor Mr./ Mrs./ Miss
                                    ……………………………………………………............................
                                    S/o/ D/o/ w/o …………………………………………… is my
                                    ......................................................................... and I know
                                    him/her for the last ……………. yrs/months and he /she signs in the vernacular language,
                                    i.e. in
                                    (name of language in which borrower have signed) and the same have been understood
                                    by him / her. I have seen him
                                    signing during the normal course of business/ transactions.
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0">
                            <p>
                                <span class="ft1">
                                    2.
                                </span>
                                <span>
                                    That I have read out and explained in vernacular, the contents and nature of the
                                    Application form, Loan Agreement
                                    along with the Schedules and all other documents signed by him/her for obtaining
                                    loan from PFSL. He/she is
                                    acknowledging the same.
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="border0">
                            <p>
                                <span class="ft1">
                                    3.
                                </span>
                                <span>
                                    That he/she signing in the vernacular all the document sand the Agreements after
                                    understanding the same. His/
                                    her signature is dully attested by me here in under:-
                                </span>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <p>
                                Solemnly affirmed at …………………………… on this day of…………………., 20 .
                            </p>
                        </td>
                    </tr>
                </table>

                <br><br><br><br>


                <table cellpadding=0 cellspacing=0 class="sign-table" style="position: relative;">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Signature of Borrower</b>
                        </td>
                        <td>
                            <div class="sign-line"></div>
                            <b>Co Borrower</b>
                        </td>
                        <td>
                            <div class="sign-line"></div>
                            <b>Guarantor Signature of the Executant</b>
                        </td>
                    </tr>
                </table>
                

                <br><br><br><br>

                <table class="border0">

                    <tr>
                        <td class="border0">
                            <p>
                                <b>Attested</b> ____________________

                                <br><br><br><br>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td class="border0">
                            <p>
                                <b>Signature of the Executant Date</b>  :________________________________
                            </p>
                        </td>
                    </tr>
                </table>
                <p class="page-no">33</p>

            </div>

            <div class="page-break"></div>

            <div class="page" id="page_34">

                <h3>MISCELLANEOUS DOCUMENTS</h3>

                <table cellpadding=0 cellspacing=0 class="sign-table">
                    <tr>
                        <td>
                            <div class="sign-line"></div>
                            <b>Authorised Signatories For PFSL</b>
                        </td>
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
                <p class="page-no">34</p>

            </div>
        </div>
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