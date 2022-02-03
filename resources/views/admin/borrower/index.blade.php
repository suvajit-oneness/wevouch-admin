@extends('layouts.auth.master')

@section('title', 'Borrower list')

@section('content')

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
                            <a href="#csvUploadModal" data-toggle="modal" class="btn btn-sm btn-primary"> <i class="fas fa-file-csv"></i> Upload CSV</a>
                            <a href="{{route('user.borrower.create')}}" class="btn btn-sm btn-primary"> <i class="fas fa-plus"></i> Create new borrower</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ Session::get('message') }}</strong> 
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-sm-7">
                                <p class="small text-muted">Displaying {{$data->firstItem()}} to {{$data->lastItem()}} out of {{$data->total()}} entries</p>
                            </div>
                            <div class="col-sm-5 text-right">
                                <form action="{{ route('user.borrower.list') }}" method="GET" role="search">
                                    <div class="input-group">
                                        <input type="search" class="form-control form-control-sm" name="term" placeholder="What are you looking for..." id="term" value="{{app('request')->input('term')}}" autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-btn">
                                                <button class="btn btn-info btn-sm rounded-0" type="submit" title="Search projects">
                                                    <i class="fas fa-search"></i> Search
                                                </button>
                                            </span>
                                            <a href="{{ route('user.borrower.list') }}">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-danger btn-sm rounded-0" type="button" title="Refresh page"> Reset <i class="fas fa-sync-alt"></i></button>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <table class="table table-sm table-bordered table-hover" id="borrowers-table">
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
                            <tbody id="loadBorrowers">
                                @forelse ($data as $index => $item)
                                <tr id="tr_{{$item->id}}">
                                    <td>{{$item->CUSTOMER_ID}}</td>
                                    <td>
                                        <div class="user-profile-holder">
                                            {{-- <div class="flex-shrink-0">
                                                <img src="{{asset($item->image_path)}}" alt="user-image-{{ $item->id }}">
                                            </div> --}}
                                            <div class="flex-grow-1 ms-3">
                                                <p class="name">{{ucwords($item->name_prefix)}} {{$item->full_name}}</p>
                                                <p class="small text-muted mb-0">{{$item->occupation}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="small text-dark mb-1">{{$item->email}}</p>
                                        <p class="small text-dark mb-0">@php if(!empty($item->mobile)) { echo $item->mobile; } else { echo '<i class="fas fa-phone fa-rotate-90 text-danger"></i>'; } @endphp</p>
                                    </td>
                                    <td>
                                        <p class="small text-muted mb-0" title="Street address">{{$item->pan_card_number}}</p>
                                    </td>
                                    <td>
                                        <p class="small text-muted mb-0" title="Street address">{{(strtolower($item->KYC_HOUSE_NO) != 'na' && $item->KYC_HOUSE_NO != '') ? $item->KYC_HOUSE_NO.' ' : ''}} {{($item->KYC_HOUSE_NO == $item->KYC_Street) ? '' : $item->KYC_Street }}</p>
                                        <p class="small text-muted mb-0">
                                            <span title="City">{{($item->KYC_Street == $item->KYC_LOCALITY) ? '' : $item->KYC_LOCALITY }}</span>
                                            <span title="Pincode">{{$item->KYC_CITY}}</span>
                                            <span title="State">{{$item->KYC_State}}</span>
                                            <span title="State">{{$item->KYC_PINCODE}}</span>
                                            <span title="State">{{$item->KYC_Country}}</span>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="single-line">
                                            @if ($item->agreement_id == 0)
                                                <p class="small text-muted"> <em>No agreement yet</em> </p>
                                            @else
                                                <a href="{{route('user.borrower.agreement', $item->id)}}" class="badge {{ ($item->borrowerAgreementRfq) ? 'badge-primary' : 'badge-danger' }} action-button" title="Setup loan application form">{{$item->agreementDetails->name}}</a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="single-line">
                                            <a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls('{{route('user.borrower.show')}}', {{$item->id}})">View</a>

                                            <a href="{{route('user.borrower.edit', $item->id)}}" class="badge badge-dark action-button" title="Edit">Edit</a>

                                            <a href="javascript: void(0)" class="badge badge-dark action-button" title="Delete" onclick="confirm4lert('{{route('user.borrower.destroy')}}', {{$item->id}}, 'delete')">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr><td class="text-center" colspan="100%"><em>No records found</em></td></tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="pagination-view">
                            {{$data->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="csvUploadModal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Import CSV data
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('user.borrower.csv.upload')}}" enctype="multipart/form-data" id="borrowerCsvUpload">
                    @csrf
                    <input type="file" name="file" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-sm btn-primary" id="csvImportBtn">Import <i class="fas fa-upload"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#borrowerCsvUpload').on('submit', function() {
            $('#csvImportBtn').attr('disabled', true).html('Please wait...');
            $('.close').attr('disabled', true);
        });

        function viewDeta1ls(route, id) {
            $.ajax({
                url : route,
                method : 'post',
                data : {'_token' : '{{csrf_token()}}', id : id},
                success : function(result) {
                    let content = '';
                    if (result.error == false) {
                        let mobileShow = '<em class="text-muted">No data</em>';
                        if (result.data.mobile != null) {
                            mobileShow = result.data.mobile;
                        }

                        content += '<div class="w-100 user-profile-holder mb-3"><img src="'+result.data.image_path+'"></div>';
                        content += '<p class="text-muted small mb-1">Name</p><h6>'+result.data.name_prefix+' '+result.data.name+'</h6>';
                        content += '<p class="text-muted small mb-1">Email</p><h6>'+result.data.email+'</h6>';
                        content += '<p class="text-muted small mb-1">Phone number</p><h6>'+mobileShow+'</h6>';
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