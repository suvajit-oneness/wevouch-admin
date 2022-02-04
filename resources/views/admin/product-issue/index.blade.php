@extends('layouts.auth.master')

@section('title', 'Product issue management')

@section('content')
    <style>
        textarea {
            height: 80px;
            min-height: 80px;
            max-height: 250px;
        }
    </style>

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
                                <a href="javascript: void(0)" class="btn btn-sm btn-primary" onclick="openSidebarModal()"><i class="fas fa-plus"></i> Create</a>
                                <a href="#csvUploadModal" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> CSV Upload</a>
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
                                    <form action="{{ route('user.product.issue.list') }}" method="GET" role="search">
                                        <div class="input-group">
                                            <input type="search" class="form-control form-control-sm" name="term" placeholder="What are you looking for..." id="term" value="{{app('request')->input('term')}}" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info btn-sm rounded-0" type="submit" title="Search projects">
                                                        <i class="fas fa-search"></i> Search
                                                    </button>
                                                </span>
                                                <a href="{{ route('user.product.issue.list') }}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-danger btn-sm rounded-0" type="button" title="Refresh page"> Reset <i class="fas fa-sync-alt"></i></button>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <form method="POST" action="{{route('user.product.issue.destroy.bulk')}}">
                            @csrf
                                <table class="table table-sm table-bordered table-hover" id="showProductIssueTable">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkbox-head" onclick="headerCheckFunc()"></th>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Function</th>
                                            <th>Issue</th>
                                            <th class="text-right">
                                                Action
                                                <div id="delete-box">
                                                    <button type="submit" class="btn btn-sm btn-danger disabled">Remove</button>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $index => $item)
                                            <tr id="tr_{{ $item->id }}">
                                                <td>
                                                    <input name="delete_check[]" class="tap-to-delete" type="checkbox" onclick="clickToRemove()" value="{{$item->id}}">
                                                </td>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->category }}</td>
                                                <td>{{ $item->function }}</td>
                                                <td>{{ $item->issue }}</td>
                                                <td class="text-right">
                                                    <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                        title="View"
                                                        onclick="viewDeta1ls('{{ route('user.product.issue.show') }}', {{ $item->id }}, 'view')">View</a>

                                                    <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                        title="Edit"
                                                        onclick="viewDeta1ls('{{ route('user.product.issue.show') }}', {{ $item->id }}, 'edit')">Edit</a>

                                                    <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                        title="Delete"
                                                        onclick="confirm4lert('{{ route('user.product.issue.destroy') }}', {{ $item->id }}, 'delete')">Delete</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center text-muted" colspan="100%"><em>No records found</em></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </form>

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
                    <form method="post" action="{{route('user.product.issue.csv.store')}}" enctype="multipart/form-data" id="fileCsvUploadForm">
                        @csrf
                        <input type="file" name="file" class="form-control" accept=".csv">
                        <br>
                        <p class="small">Please select csv file</p>
                        <button type="submit" class="btn btn-sm btn-primary" id="csvImportBtn">Import <i class="fas fa-upload"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // create
        function openSidebarModal() {
            let content = '';
            content += '<div class="alert rounded-0 px-2 py-1 small" id="newDeptAlert" style="display:none"></div>';

            content += '<p class="text-dark small mb-1">Enter category <span class="text-danger">*</span></p><textarea class="form-control form-control-sm mb-2" name="name" id="categoryCreate" placeholder="Category"></textarea>';

            content += '<p class="text-dark small mb-1">Enter Function <span class="text-danger">*</span></p><textarea class="form-control form-control-sm mb-2" name="link" id="functionCreate" placeholder="Function"></textarea>';

            content += '<p class="text-dark small mb-1">Enter Issue <span class="text-danger">*</span></p><textarea class="form-control form-control-sm mb-2" name="link" id="issueCreate" placeholder="Issue"></textarea>';

            $('#userDetails .modal-content').append('<div class="modal-footer text-right"><a href="javascript: void(0)" class="btn btn-sm btn-success" onclick="storeDept()">Save changes <i class="fas fa-upload"></i> </a></div>');

            $('#appendContent').html(content);
            $('#userDetailsModalLabel').text('Create new Product Issue');
            $('#userDetails').modal('show');
        }

        // store
        function storeDept() {
            $('#newDeptAlert').removeClass('alert-danger alert-success').html('').hide();
            $.ajax({
                url: '{{ route('user.product.issue.store') }}',
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    category: $('#categoryCreate').val(),
                    function: $('#functionCreate').val(),
                    issue: $('#issueCreate').val(),
                },
                success: function(result) {
                    $("#userDetails .modal-body").animate({
                        scrollTop: $("#userDetails .modal-body").offset().top - 60
                    });
                    if (result.status == 200) {
                        // prepending new data
                        let viewVar = "'view'";
                        let newData = '';
                        newData += '<td></td>';
                        newData += '<td>'+result.id+'</td>';
                        newData += '<td>' + $('#categoryCreate').val() + '</td>';
                        newData += '<td>' + $('#functionCreate').val() + '</td>';
                        newData += '<td>' + $('#issueCreate').val() + '</td>';

                        newData += '<td class="text-right"><a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls('+result.viewRoute + ', ' + result.id + ', ' + viewVar + ')">View</a></td>';

                        $('#showProductIssueTable').prepend('<tr>' + newData + '</tr>');
                        $('#newDeptAlert').addClass('alert-success').html(result.message).show();

                        setTimeout(() => {
                            $('#userDetails').modal('hide');
                        }, 3500);
                    } else {
                        $('#newDeptAlert').addClass('alert-danger').html(result.message).show();
                    }
                }
            });
        }

        // view & edit details
        function viewDeta1ls(route, id, type) {
            $.ajax({
                url: route,
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id
                },
                success: function(result) {
                    let content = '';
                    if (result.error == false) {
                        if (type == 'view') {
                            let mobileShow = '<em class="text-muted">No data</em>';
                            if (result.data.mobile != null) {
                                mobileShow = result.data.mobile;
                            }

                            content += '<p class="text-muted small mb-1">Category</p><h6>' + result.data.category + '</h6>';
                            content += '<p class="text-muted small mb-1">Function</p><h6>' + result.data.function + '</h6>';
                            content += '<p class="text-muted small mb-1">Issue</p><h6>' + result.data.issue + '</h6>';
                            $('#userDetailsModalLabel').text('Product Issue details');
                        } else {
                            content += '<div class="alert rounded-0 px-2 py-1 small" id="updateDeptAlert" style="display:none"></div>';

                            content += '<p class="text-dark small mb-1">Category <span class="text-danger">*</span></p><textarea class="form-control form-control-sm mb-2" name="name" id="categoryEdit" placeholder="Product Issue Category">'+result.data.category+'</textarea>';

                            content += '<p class="text-dark small mb-1">Function <span class="text-danger">*</span></p><textarea class="form-control form-control-sm mb-2" name="name" id="functionEdit" placeholder="Product Issue Function">'+result.data.function+'</textarea>';

                            content += '<p class="text-dark small mb-1">Issue <span class="text-danger">*</span></p><textarea class="form-control form-control-sm mb-2" name="name" id="issueEdit" placeholder="Product Issue">'+result.data.issue+'</textarea>';

                            content += '<input type="hidden" id="editId" value="' + result.data.id + '">';

                            $('#userDetails .modal-content').append('<div class="modal-footer text-right"><a href="javascript: void(0)" class="btn btn-sm btn-success" onclick="updateDept()">Update changes <i class="fas fa-upload"></i> </a></div>');

                            $('#userDetailsModalLabel').text('Edit Product Issue');
                        }
                    } else {
                        content += '<p class="text-muted small mb-1">No data found. Try again</p>';
                    }
                    $('#appendContent').html(content);
                    $('#userDetails').modal('show');
                }
            });
        }

        // update
        function updateDept() {
            $('#updateDeptAlert').removeClass('alert-danger alert-success').html('').hide();
            $.ajax({
                url: '{{ route('user.product.issue.update') }}',
                method: 'PATCH',
                dataType: 'JSON',
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: $('#editId').val(),
                    category: $('#categoryEdit').val(),
                    function: $('#functionEdit').val(),
                    issue: $('#issueEdit').val(),
                },
                success: function(result) {
                    $("#userDetails .modal-body").animate({
                        scrollTop: $("#userDetails .modal-body").offset().top - 60
                    });
                    if (result.status == 200) {
                        // updating new data
                        $('#showProductIssueTable #tr_' + $('#editId').val() + ' td').eq(1).html($('#categoryEdit').val());
                        $('#showProductIssueTable #tr_' + $('#editId').val() + ' td').eq(2).html($('#functionEdit').val());
                        $('#showProductIssueTable #tr_' + $('#editId').val() + ' td').eq(3).html($('#issueEdit').val());
                        $('#updateDeptAlert').addClass('alert-success').html(result.message).show();

                        setTimeout(() => {
                            $('#userDetails').modal('hide');
                        }, 3500);
                    } else {
                        $('#updateDeptAlert').addClass('alert-danger').html(result.message).show();
                    }
                }
            });
        }
    </script>
@endsection
