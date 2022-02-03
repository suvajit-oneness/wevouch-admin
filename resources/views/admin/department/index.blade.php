@extends('layouts.auth.master')

@section('title', 'Department management')

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
                                <a href="javascript: void(0)" class="btn btn-sm btn-primary" onclick="openSidebarModal()"><i
                                        class="fas fa-plus"></i> Create</a>
                                <a href="{{ route('user.employee.list') }}" class="btn btn-sm btn-primary"> <i
                                        class="fas fa-chevron-left"></i> Back to users</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-hover" id="showDepartmentTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $index => $item)
                                        <tr id="tr_{{ $item->id }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->code }}</td>
                                            <td class="text-right">
                                                <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                    title="View"
                                                    onclick="viewDeta1ls('{{ route('user.department.show') }}', {{ $item->id }}, 'view')">View</a>

                                                <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                    title="Edit"
                                                    onclick="viewDeta1ls('{{ route('user.department.show') }}', {{ $item->id }}, 'edit')">Edit</a>

                                                <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                    title="Delete"
                                                    onclick="confirm4lert('{{ route('user.department.destroy') }}', {{ $item->id }}, 'delete')">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted" colspan="100%"><em>No records found</em></td>
                                        </tr>
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
        // create
        function openSidebarModal() {
            let content = '';
            content += '<div class="alert rounded-0 px-2 py-1 small" id="newDeptAlert" style="display:none"></div>';
            content +=
                '<p class="text-dark small mb-1">Name <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="name" id="nameCreate" placeholder="Department name">';
            content +=
                '<p class="text-dark small mb-1">Code <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="code" id="codeCreate" placeholder="Department code">';

            $('#userDetails .modal-content').append(
                '<div class="modal-footer text-right"><a href="javascript: void(0)" class="btn btn-sm btn-success" onclick="storeDept()">Save changes <i class="fas fa-upload"></i> </a></div>'
            );
            $('#appendContent').html(content);
            $('#userDetailsModalLabel').text('Create new department');
            $('#userDetails').modal('show');
        }

        // store
        function storeDept() {
            $('#newDeptAlert').removeClass('alert-danger alert-success').html('').hide();
            $.ajax({
                url: '{{ route('user.department.store') }}',
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    name: $('#nameCreate').val(),
                    code: $('#codeCreate').val(),
                },
                success: function(result) {
                    $("#userDetails .modal-body").animate({
                        scrollTop: $("#userDetails .modal-body").offset().top - 60
                    });
                    if (result.status == 200) {
                        // prepending new data
                        let viewVar = "'view'";
                        let newData = '';
                        newData += '<td>1</td>';
                        newData += '<td>' + $('#nameCreate').val() + '</td>';
                        newData += '<td>' + $('#codeCreate').val() + '</td>';

                        newData +=
                            '<td class="text-right"><a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls(' +
                            result.viewRoute + ', ' + result.id + ', ' + viewVar + ')">View</a></td>';

                        $('#showDepartmentTable').prepend('<tr>' + newData + '</tr>');
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

                            content += '<p class="text-muted small mb-1">Name</p><h6>' + result.data.name +
                                '</h6>';
                            content += '<p class="text-muted small mb-1">Code</p><h6>' + result.data.code +
                                '</h6>';
                            $('#userDetailsModalLabel').text('Department details');
                        } else {
                            content +=
                                '<div class="alert rounded-0 px-2 py-1 small" id="updateDeptAlert" style="display:none"></div>';
                            content +=
                                '<p class="text-dark small mb-1">Name <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="name" id="nameEdit" placeholder="Department name" value="' +
                                result.data.name + '">';
                            content +=
                                '<p class="text-dark small mb-1">Code <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="code" id="codeEdit" placeholder="Department code" value="' +
                                result.data.code + '">';
                            content += '<input type="hidden" id="editId" value="' + result.data.id + '">';

                            $('#userDetails .modal-content').append(
                                '<div class="modal-footer text-right"><a href="javascript: void(0)" class="btn btn-sm btn-success" onclick="updateDept()">Update changes <i class="fas fa-upload"></i> </a></div>'
                            );

                            $('#userDetailsModalLabel').text('Edit department');
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
            // $('.text-danger').remove();
            // $('modasId input,select,texarea').each(function(key,value){
            //     var thisInput =  $('#'+key);
            //     if(thisInput.attr('required',true)){
            //         if(thisInput.val() == ''){
            //         thisInput.afetr('');
            //         this
            //     }
            //     }
            // });
            // var name = $('#nameEdit'),
            //     code = $('#codeEdit');
            // if (name.val() == '') {
            //     name.after('<span class="text-danger">Please Enter the Name</span>');
            //     name.focus();
            // }
            // if (code.val() == '') {
            //     code.after('<span class="text-danger">Please Enter the Name</span>');
            //     code.focus();
            // }

            $('#updateDeptAlert').removeClass('alert-danger alert-success').html('').hide();
            $.ajax({
                url: '{{ route('user.department.update') }}',
                method: 'PATCH',
                dataType: 'JSON',
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: $('#editId').val(),
                    name: $('#nameEdit').val(),
                    code: $('#codeEdit').val(),
                },
                success: function(result) {
                    $("#userDetails .modal-body").animate({
                        scrollTop: $("#userDetails .modal-body").offset().top - 60
                    });
                    if (result.status == 200) {
                        // updating new data
                        $('#showDepartmentTable #tr_' + $('#editId').val() + ' td').eq(1).html($('#nameEdit')
                            .val());
                        $('#showDepartmentTable #tr_' + $('#editId').val() + ' td').eq(2).html($('#codeEdit')
                            .val());
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
