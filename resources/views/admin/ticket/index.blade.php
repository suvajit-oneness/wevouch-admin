@extends('layouts.auth.master')

@section('title', 'Ticket issues management')

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
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-7">
                                    <p class="small text-muted">Displaying {{$data->firstItem()}} to {{$data->lastItem()}} out of {{$data->total()}} entries</p>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <form action="{{ route('user.ticket.list') }}" method="GET" role="search">
                                        <div class="input-group">
                                            <input type="search" class="form-control form-control-sm" name="term" placeholder="What are you looking for..." id="term" value="{{app('request')->input('term')}}" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info btn-sm rounded-0" type="submit" title="Search projects">
                                                        <i class="fas fa-search"></i> Search
                                                    </button>
                                                </span>
                                                <a href="{{ route('user.ticket.list') }}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-danger btn-sm rounded-0" type="button" title="Refresh page"> Reset <i class="fas fa-sync-alt"></i></button>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <table class="table table-sm table-bordered table-hover" id="showTrainingTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Textarea</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $index => $item)
                                        <tr id="tr_{{ $item->id }}">
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->message }}</td>
                                            <td>{{ ($item->textarea == 0) ? 'Not needed' : 'Needed' }}</td>
                                            <td class="text-right">
                                                <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                    title="View"
                                                    onclick="viewDeta1ls('{{ route('user.ticket.show') }}', {{ $item->id }}, 'view')">View</a>

                                                <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                    title="Edit"
                                                    onclick="viewDeta1ls('{{ route('user.ticket.show') }}', {{ $item->id }}, 'edit')">Edit</a>

                                                <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                    title="Delete"
                                                    onclick="confirm4lert('{{ route('user.ticket.destroy') }}', {{ $item->id }}, 'delete')">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted" colspan="100%"><em>No records found</em></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="pagination-view">
                                {{$data->appends(request()->query())->links()}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // create
        function openSidebarModal() {
            let content = '';
            content += '<div class="alert rounded-0 px-2 py-1 small" id="newDeptAlert" style="display:none"></div>';

            content += '<p class="text-dark small mb-1">Enter Title <span class="text-danger">*</span></p><textarea class="form-control form-control-sm mb-2" name="name" id="nameCreate" placeholder="Title"></textarea>';

            content += '<p class="text-dark small mb-1">Enter Message <span class="text-danger">*</span></p><textarea class="form-control form-control-sm mb-2" name="link" id="messageCreate" placeholder="Message"></textarea>';

            content += `<div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="textareaCreate" value="1">
                      <label class="custom-control-label" for="textareaCreate">Textarea</label>
                    </div>
                  </div>`;

            $('#userDetails .modal-content').append('<div class="modal-footer text-right"><a href="javascript: void(0)" class="btn btn-sm btn-success" onclick="storeDept()">Save changes <i class="fas fa-upload"></i> </a></div>');

            $('#appendContent').html(content);
            $('#userDetailsModalLabel').text('Create new Training');
            $('#userDetails').modal('show');
        }

        // store
        function storeDept() {
            $('#newDeptAlert').removeClass('alert-danger alert-success').html('').hide();
            const textareaVal = $("#textareaCreate").prop("checked") ? 1 : 0;
            $.ajax({
                url: '{{ route('user.ticket.store') }}',
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    title: $('#nameCreate').val(),
                    message: $('#messageCreate').val(),
                    textarea: textareaVal
                },
                success: function(result) {
                    $("#userDetails .modal-body").animate({
                        scrollTop: $("#userDetails .modal-body").offset().top - 60
                    });
                    if (result.status == 200) {
                        // prepending new data
                        let viewVar = "'view'";
                        let newData = '';
                        const areaValue = (textareaVal == 1) ? "Needed" : "Not needed";
                        newData += '<td>'+result.id+'</td>';
                        newData += '<td>' + $('#nameCreate').val() + '</td>';
                        newData += '<td>' + $('#messageCreate').val() + '</td>';
                        // console.log(textareaVal);
                        newData += '<td>' + areaValue + '</td>';

                        newData += '<td class="text-right"><a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls('+result.viewRoute + ', ' + result.id + ', ' + viewVar + ')">View</a></td>';

                        $('#showTrainingTable').append('<tr>' + newData + '</tr>');
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

                            content += '<p class="text-muted small mb-1">Title</p><h6>' + result.data.name + '</h6>';
                            content += '<p class="text-muted small mb-1">Message</p><h6>' + result.data.message + '</h6>';
                            content += '<p class="text-muted small mb-1">Textarea</p><h6>' + result.data.textarea + '</h6>';
                            $('#userDetailsModalLabel').text('Training details');
                        } else {
                            const areaValue = (result.data.textarea === "Needed") ? "checked" : "";

                            content += '<div class="alert rounded-0 px-2 py-1 small" id="updateDeptAlert" style="display:none"></div>';

                            content += '<p class="text-dark small mb-1">Title <span class="text-danger">*</span></p><textarea class="form-control form-control-sm mb-2" name="name" id="nameEdit" placeholder="Training title">'+result.data.name+'</textarea>';

                            content += '<p class="text-dark small mb-1">Message <span class="text-danger">*</span></p><textarea class="form-control form-control-sm mb-2" name="name" id="messageEdit" placeholder="Training message">'+result.data.message+'</textarea>';

                            content += `<div class="form-group">
                                <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="textareaEdit" value="1" ${areaValue}>
                                <label class="custom-control-label" for="textareaEdit">Textarea</label>
                                </div>
                            </div>`;

                            content += '<input type="hidden" id="editId" value="' + result.data.id + '">';

                            $('#userDetails .modal-content').append('<div class="modal-footer text-right"><a href="javascript: void(0)" class="btn btn-sm btn-success" onclick="updateDept()">Update changes <i class="fas fa-upload"></i> </a></div>');

                            $('#userDetailsModalLabel').text('Edit Training');
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
            const textareaVal = $("#textareaEdit").prop("checked") ? 1 : 0;
            $.ajax({
                url: '{{ route('user.ticket.update') }}',
                method: 'PATCH',
                dataType: 'JSON',
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: $('#editId').val(),
                    name: $('#nameEdit').val(),
                    message: $('#messageEdit').val(),
                    textarea: textareaVal
                },
                success: function(result) {
                    $("#userDetails .modal-body").animate({
                        scrollTop: $("#userDetails .modal-body").offset().top - 60
                    });
                    if (result.status == 200) {
                        const areaValue = (textareaVal === 1) ? "Needed" : "Not needed";

                        // updating new data
                        $('#showTrainingTable #tr_' + $('#editId').val() + ' td').eq(1).html($('#nameEdit').val());
                        $('#showTrainingTable #tr_' + $('#editId').val() + ' td').eq(2).html($('#messageEdit').val());
                        $('#showTrainingTable #tr_' + $('#editId').val() + ' td').eq(3).text(areaValue);
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
