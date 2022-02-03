@extends('layouts.auth.master')

@section('title', 'Borrower list')

@section('content')
{{-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.11.3/features/searchHighlight/dataTables.searchHighlight.css">
{{-- buttons --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css">
{{-- responsiveness --}}
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                <i class="fas fa-expand"></i>
                            </button>
                            <a href="{{route('user.borrower.create')}}" class="btn btn-sm btn-primary"> <i class="fas fa-plus"></i> Create new borrower</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-hover" id="borrowers-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>PAN card</th>
                                    <th>Address</th>
                                    <th>Loan details</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    {{-- buttons --}}
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
    {{-- responsiveness --}}
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    <script>
        $borrowersTable = $('#borrowers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('user.borrower.list') }}',
            columns: [
                {
                    data: 'id', name: 'id'
                    // , render: function(data, type, full, meta) {
                    //     console.log(full);
                    //     return full.length;
                    // }
                },
                {
                    data: 'full_name', name: 'full_name',
                    render: function(data, type, full, meta) {
                        return '<div class="user-profile-holder"><div class="flex-shrink-0"><img src="{!! asset("'+full.image_path+'") !!}" alt="user-image-'+full.id+'"></div><div class="flex-grow-1 ms-3"><p class="name"> <span class="text-capitalize">'+full.name_prefix+'</span> '+full.full_name+'</p><p class="small text-muted mb-0">'+full.occupation+'</p></div></div>';
                    }
                },
                {
                    data: 'gender', name: 'gender',
                    render: function(data, type, full, meta) {
                        return '<p class="single-line small text-dark mb-1"><i class="fas fa-envelope mr-2"></i> '+full.email+'</p><p class="small text-dark mb-1"><i class="fas fa-phone fa-rotate-90 mr-2"></i> '+full.mobile+'</p>';
                    }
                },
                {
                    data: 'mobile', name: 'mobile',
                    render: function(data, type, full, meta) {
                        return '<div class="borrower-address-holder"><p class="small text-muted mb-0" title="Street address">'+full.pan_card_number+'</p></div>';
                    }
                },
                {
                    data: 'mobile', name: 'mobile',
                    render: function(data, type, full, meta) {
                        return '<div class="borrower-address-holder"><p class="small text-muted mb-0" title="Street address">'+full.street_address+'</p><p class="small text-muted mb-0"><span title="City">'+full.city+'</span>, <span title="Pincode">'+full.pincode+'</span>, <span title="State">'+full.state+'</span></p></div>';
                    }
                },
                {
                    data: 'id', name: 'id',
                    render: function(data, type, full, meta) {
                        // console.log(full);
                        if (full.agreement_id == 0) {
                            return '<div class="single-line"><p class="small text-muted"> <em>No agreement yet</em> </p></div>';
                        } else {
                            let route = '{{route("user.borrower.agreement", 'id')}}';
                            route = route.replace('id', full.id);

                            if (full.borrower_agreement_rfq == null || full.borrower_agreement_rfq.lebgth < 1) {
                                return '<h5 class="text-dark small mb-0">'+full.agreement_details.name+'</h5><div class="single-line"><a href="'+route+'" class="badge badge-danger action-button" title="Setup loan application form"> Incomplete loan agreement </a></div>';
                            } else {
                                return '<h5 class="text-dark small mb-0">'+full.agreement_details.name+'</h5><div class="single-line"><a href="'+route+'" class="badge badge-success action-button" title="Setup loan application form"> complete loan agreement</a></div>';
                            }
                        }
                    }
                },
                {
                    data: 'id', name: 'id', orderable: false, searchable: false,
                    render: function( data, type, full, meta ) {
                        let editRoute = '{{route("user.borrower.edit", 'id')}}';
                        editRoute = editRoute.replace('id', full.id);

                        let deleteRoute = "'{{route("user.borrower.destroy")}}'";
                        let deleteText = "'delete'";
                        let deletetype = "'yajraDelete'";

                        $view = '<a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls('+full.id+')">View</a> ';

                        $edit = '<a href="'+editRoute+'" class="badge badge-dark action-button" title="Edit">Edit</a> ';

                        $destroy = '<a href="javascript: void(0)" class="badge badge-dark action-button" title="Delete" onclick="confirm4lert('+deleteRoute+', '+full.id+', '+deleteText+', '+deletetype+')">Delete</a>';

                        return '<div class="single-line">'+$view+$edit+$destroy+'</div>';
                    }
                },
            ]
            // fixedHeader: true,
            // responsive: {
            //     details: {
            //         display: $.fn.dataTable.Responsive.display.modal( {
            //             header: function ( row ) {
            //                 var data = row.data();
            //                 return 'Details for '+data[0]+' '+data[1];
            //             }
            //         } ),
            //         renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
            //             tableClass: 'table'
            //         } )
            //     }
            // },

            // dom: 'Blfrtip',
            // buttons: [
            //     {
            //         extend: 'copyHtml5',
            //         exportOptions: {
            //             columns: [ 0, ':visible' ]
            //         },
            //         text: '<i class="fas fa-copy"></i>',
            //         className: 'btn-sm',
            //         titleAttr: 'Copy'
            //     },
            //     {
            //         extend: 'excelHtml5',
            //         exportOptions: {
            //             columns: ':visible'
            //         },
            //         text: '<i class="fas fa-file-excel"></i>',
            //         className: 'btn-sm',
            //         titleAttr: 'Excel'
            //     },
            //     {
            //         extend: 'pdfHtml5',
            //         exportOptions: {
            //             columns: [0, 1, 2, 3, 4]
            //         },
            //         text: '<i class="fas fa-file-pdf"></i>',
            //         className: 'btn-sm',
            //         titleAttr: 'PDF'
            //     },
            //     {
            //         extend: 'csvHtml5',
            //         exportOptions: {
            //             columns: [0, 1, 2, 3, 4]
            //         },
            //         text: '<i class="fas fa-file-csv"></i>',
            //         className: 'btn-sm',
            //         titleAttr: 'CSV'
            //     },
            //     {
            //         extend: 'print',
            //         exportOptions: {
            //             columns: [0, 1, 2, 3, 4]
            //         },
            //         text: '<i class="fas fa-print"></i>',
            //         className: 'btn-sm',
            //         titleAttr: 'Print'
            //     },
            // ],

            // lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        });

        function viewDeta1ls(id) {
            $.ajax({
                url : "{{route('user.borrower.show')}}",
                method : 'post',
                data : {'_token' : '{{csrf_token()}}', id : id},
                success : function(result) {
                    let content = '';
                    if (result.error == false) {
                        let mobileShow = '<em class="text-muted">No data</em>';
                        if (result.data.mobile != null) {
                            mobileShow = result.data.mobile;
                        }
                        let panCardShow = '<em class="text-muted">No data</em>';
                        if (result.data.pan_card_number != null) {
                            panCardShow = result.data.pan_card_number;
                        }

                        content += '<div class="w-100 user-profile-holder mb-3"><img src="'+result.data.image_path+'"></div>';
                        content += '<p class="text-muted small mb-1">Name</p><h6>'+result.data.name_prefix+' '+result.data.name+'</h6>';
                        content += '<p class="text-muted small mb-1">Email</p><h6>'+result.data.email+'</h6>';
                        content += '<p class="text-muted small mb-1">Phone number</p><h6>'+mobileShow+'</h6>';
                        content += '<p class="text-muted small mb-1">PAN Card number</p><h6>'+panCardShow+'</h6>';
                        content += '<p class="text-muted small mb-1">Address</p><h6>'+result.data.street_address+'</h6>';
                        content += '<h6>'+result.data.city+', '+result.data.pincode+', '+result.data.state+'</h6>';

                        let route = '{{route("user.borrower.details", 'id')}}';
                        route = route.replace('id',result.data.user_id);
                        $('#userDetails .modal-content').append('<div class="modal-footer"><a href="'+route+'" class="btn btn-sm btn-primary">View details <i class="fa fa-chevron-right"></i> </a></div>');
                    } else {
                        content += '<p class="text-muted small mb-1">No data found. Try again</p>';
                    }
                    $('#appendContent').html(content);
                    $('#userDetailsModalLabel').text('Borrower details');
                    $('#userDetails').modal('show');
                }
            });
        }
    </script>
@endsection