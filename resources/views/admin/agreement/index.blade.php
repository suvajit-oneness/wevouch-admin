@extends('layouts.auth.master')

@section('title', 'Agreement management')

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
                            {{-- <a href="{{route('user.agreement.create')}}" class="btn btn-sm btn-primary"> <i class="fas fa-plus"></i> Create</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-hover" id="showRoleTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Fields</th>
                                    {{-- <th class="text-right">PDF</th> --}}
                                    <th>Documents</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $index => $item)
                                <tr id="tr_{{$item->id}}">
                                    <td>{{$index+1}}</td>
                                    <td>
                                        <h6 class="font-weight-bold single-line">{{$item->name}}</h6>
                                    </td>
                                    <td>
                                        <p class="small text-muted">{{words($item->description, 200)}}</p>
                                    </td>
                                    <td>
                                        <a href="{{route('user.agreement.fields', $item->id)}}" class="badge badge-dark action-button" title="Setup fields">Setup</a>
                                    </td>
                                    {{-- <td class="single-line">
                                        @if($item->html != '' || $item->html != null)
                                            <a href="{{route('user.agreement.pdf.view', $item->id)}}" class="badge badge-primary action-button" target="_blank"> <i class="fas fa-file-pdf"></i> View</a>
                                            <a href="{{route('user.agreement.pdf.download', $item->id)}}" class="badge badge-primary action-button download-agreement"> <i class="fas fa-download"></i> Download</a>
                                        @endif
                                    </td> --}}
                                    <td class="text-right">
                                        <a href="{{route('user.agreement.documents.list', $item->id)}}" class="badge badge-dark action-button" title="Setup documents">Setup</a>
                                    </td>
                                    <td class="text-right">
                                        <div class="single-line">
                                            <a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls('{{route('user.agreement.show')}}', {{$item->id}})">View</a>

                                            <a href="{{route('user.agreement.edit', $item->id)}}" class="badge badge-dark action-button" title="Edit">Edit</a>
    
                                            {{-- <a href="javascript: void(0)" class="badge badge-dark action-button" title="Delete" onclick="confirm4lert('{{route('user.agreement.destroy')}}', {{$item->id}}, 'delete')">Delete</a> --}}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr><td colspan="100%"><em>No records found</em></td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        function viewDeta1ls(route, id) {
            $.ajax({
                url : route,
                method : 'post',
                data : {'_token' : '{{csrf_token()}}', id : id},
                success : function(result) {
                    console.log(result.data);
                    let content = '';
                    if (result.error == false) {
                        let authorised_signatoryShow = '<em class="text-muted">No data</em>';
                        if (result.data.authorised_signatory.length > 0) {
                            authorised_signatoryShow = result.data.authorised_signatory;
                        }

                        let borrowerShow = '<em class="text-muted">No data</em>';
                        if (result.data.borrower.length > 0) {
                            borrowerShow = result.data.borrower;
                        }

                        let co_borrowerShow = '<em class="text-muted">No data</em>';
                        if (result.data.co_borrower.length > 0) {
                            co_borrowerShow = result.data.co_borrower;
                        }

                        content += '<h6 class="font-weight-bold mb-3">'+result.data.name+'</h6>';
                        content += '<p class="text-muted small mb-0">Description</p>';
                        content += '<p class="text-dark small">'+result.data.description+'</p>';
                        content += '<p class="text-muted small mb-0">Authorised Signatory</p>';
                        content += '<p class="text-dark small">'+authorised_signatoryShow+'</p>';
                        content += '<p class="text-muted small mb-0">Borrower</p>';
                        content += '<p class="text-dark small">'+borrowerShow+'</p>';
                        content += '<p class="text-muted small mb-0">Co-borrower</p>';
                        content += '<p class="text-dark small">'+co_borrowerShow+'</p>';

                        let route = '{{route("user.agreement.details", 'id')}}';
                        route = route.replace('id',result.data.id);
                        $('#userDetails .modal-content').append('<div class="modal-footer"><a href="'+route+'" class="btn btn-sm btn-primary">View details <i class="fa fa-chevron-right"></i> </a></div>');
                    } else {
                        content += '<p class="text-muted small mb-1">No data found. Try again</p>';
                    }
                    $('#appendContent').html(content);
                    $('#userDetailsModalLabel').text('Agreement details');
                    $('#userDetails').modal('show');
                }
            });
        }
    </script>
@endsection