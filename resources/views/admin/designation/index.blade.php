@extends('layouts.auth.master')

@section('title', 'Designation management')

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
                            <table class="table table-sm table-bordered table-hover" id="showDesignationTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Salary</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $index => $item)
                                        <tr id="tr_{{ $item->id }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->salary }}</td>
                                            <td class="text-right">
                                                <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                    title="View"
                                                    onclick="viewDeta1ls('{{ route('user.designation.show') }}', {{ $item->id }}, 'view')">View</a>

                                                <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                    title="Edit"
                                                    onclick="viewDeta1ls('{{ route('user.designation.show') }}', {{ $item->id }}, 'edit')">Edit</a>

                                                <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                    title="Delete"
                                                    onclick="confirm4lert('{{ route('user.designation.destroy') }}', {{ $item->id }}, 'delete')">Delete</a>
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
                '<p class="text-dark small mb-1">Name <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="name" id="nameCreate" placeholder="Designation name">';
            content +=
                '<p class="text-dark small mb-1">Salary/ month <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="salary" id="salaryCreate" placeholder="Salary">';

            $('#userDetails .modal-content').append(
                '<div class="modal-footer text-right"><a href="javascript: void(0)" class="btn btn-sm btn-success" onclick="storeDept()">Save changes <i class="fas fa-upload"></i> </a></div>'
            );
            $('#appendContent').html(content);
            $('#userDetailsModalLabel').text('Create new designation');
            $('#userDetails').modal('show');
        }

        // store
        function storeDept() {
            $('#newDeptAlert').removeClass('alert-danger alert-success').html('').hide();
            $.ajax({
                url: '{{ route('user.designation.store') }}',
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    name: $('#nameCreate').val(),
                    salary: $('#salaryCreate').val(),
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
                        newData += '<td>' + $('#salaryCreate').val() + '</td>';

                        newData +=
                            '<td class="text-right"><a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls(' +
                            result.viewRoute + ', ' + result.id + ', ' + viewVar + ')">View</a></td>';

                        $('#showDesignationTable').prepend('<tr>' + newData + '</tr>');
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
                            content += '<p class="text-muted small mb-1">Salary</p><h6>' + result.data.salary +
                                '</h6>';
                            $('#userDetailsModalLabel').text('Designation details');
                        } else {
                            content +=
                                '<div class="alert rounded-0 px-2 py-1 small" id="updateDeptAlert" style="display:none"></div>';
                            content +=
                                '<p class="text-dark small mb-1">Name <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="name" id="nameEdit" placeholder="Designation name" value="' +
                                result.data.name + '">';
                            content +=
                                '<p class="text-dark small mb-1">Salary <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="salary" id="salaryEdit" placeholder="Salary" value="' +
                                result.data.salary + '">';
                            content += '<input type="hidden" id="editId" value="' + result.data.id + '">';

                            $('#userDetails .modal-content').append(
                                '<div class="modal-footer text-right"><a href="javascript: void(0)" class="btn btn-sm btn-success" onclick="updateDept()">Update changes <i class="fas fa-upload"></i> </a></div>'
                            );

                            $('#userDetailsModalLabel').text('Edit designation');
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
                url: '{{ route('user.designation.update') }}',
                method: 'PATCH',
                dataType: 'JSON',
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: $('#editId').val(),
                    name: $('#nameEdit').val(),
                    salary: $('#salaryEdit').val(),
                },
                success: function(result) {
                    $("#userDetails .modal-body").animate({
                        scrollTop: $("#userDetails .modal-body").offset().top - 60
                    });
                    if (result.status == 200) {
                        // updating new data
                        $('#showDesignationTable #tr_' + $('#editId').val() + ' td').eq(1).html($('#nameEdit')
                            .val());
                        $('#showDesignationTable #tr_' + $('#editId').val() + ' td').eq(2).html($('#salaryEdit')
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
