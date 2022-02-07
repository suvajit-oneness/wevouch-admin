@extends('layouts.auth.master')

@section('title', 'Brand management')

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
                                <a href="javascript: void(0)" class="btn btn-sm btn-primary" onclick="openSidebarModal()"><i class="fas fa-plus"></i> Create</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-sm-7">
                                    <p class="small text-muted">Displaying {{$data->firstItem()}} to {{$data->lastItem()}} out of {{$data->total()}} entries</p>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <form action="{{ route('user.brand.list') }}" method="GET" role="search">
                                        <div class="input-group">
                                            <input type="search" class="form-control form-control-sm" name="term" placeholder="What are you looking for..." id="term" value="{{app('request')->input('term')}}" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info btn-sm rounded-0" type="submit" title="Search projects">
                                                        <i class="fas fa-search"></i> Search
                                                    </button>
                                                </span>
                                                <a href="{{ route('user.brand.list') }}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-danger btn-sm rounded-0" type="button" title="Refresh page"> Reset <i class="fas fa-sync-alt"></i></button>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <form method="POST" action="{{route('user.brand.destroy.bulk')}}">
                            @csrf
                                <table class="table table-sm table-bordered table-hover" id="showBrandTable">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkbox-head" onclick="headerCheckFunc()"></th>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone no</th>
                                            <th>Whatsapp no</th>
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
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->phone_no }}</td>
                                                <td>{{ $item->whatsapp_no }}</td>
                                                <td class="text-right">
                                                    <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                        title="View"
                                                        onclick="viewDeta1ls('{{ route('user.brand.show') }}', {{ $item->id }}, 'view')">View</a>

                                                    <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                        title="Edit"
                                                        onclick="viewDeta1ls('{{ route('user.brand.show') }}', {{ $item->id }}, 'edit')">Edit</a>

                                                    <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                        title="Delete"
                                                        onclick="confirm4lert('{{ route('user.brand.destroy') }}', {{ $item->id }}, 'delete')">Delete</a>
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
            content += '<p class="text-dark small mb-1">Name <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="name" id="nameCreate" placeholder="Brand name">';

            content += '<p class="text-dark small mb-1">Phone no <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="phone_no" id="phone_noCreate" placeholder="Brand Phone no">';

            content += '<p class="text-dark small mb-1">Whatsapp no <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="whatsapp_no" id="whatsapp_noCreate" placeholder="Brand Whatsapp no">';

            $('#userDetails .modal-content').append('<div class="modal-footer text-right"><a href="javascript: void(0)" class="btn btn-sm btn-success" onclick="storeDept()">Save changes <i class="fas fa-upload"></i> </a></div>');

            $('#appendContent').html(content);
            $('#userDetailsModalLabel').text('Create new Brand');
            $('#userDetails').modal('show');
        }

        // store
        function storeDept() {
            $('#newDeptAlert').removeClass('alert-danger alert-success').html('').hide();
            $.ajax({
                url: '{{ route('user.brand.store') }}',
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    name: $('#nameCreate').val(),
                    phone_no: $('#phone_noCreate').val(),
                    whatsapp_no: $('#whatsapp_noCreate').val(),
                },
                success: function(result) {
                    $("#userDetails .modal-body").animate({
                        scrollTop: $("#userDetails .modal-body").offset().top - 60
                    });
                    if (result.status == 200) {
                        // prepending new data
                        let viewVar = "'view'";
                        let newData = '';
                        newData += '<td>'+result.id+'</td>';
                        newData += '<td>' + $('#nameCreate').val() + '</td>';
                        newData += '<td>' + $('#phone_noCreate').val() + '</td>';
                        newData += '<td>' + $('#whatsapp_noCreate').val() + '</td>';

                        newData += '<td class="text-right"><a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls('+result.viewRoute + ', ' + result.id + ', ' + viewVar + ')">View</a></td>';

                        $('#showBrandTable').prepend('<tr>' + newData + '</tr>');
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

                            content += '<p class="text-muted small mb-1">Name</p><h6>' + result.data.name + '</h6>';
                            content += '<p class="text-muted small mb-1">Phone number</p><h6>' + result.data.phone_no + '</h6>';
                            content += '<p class="text-muted small mb-1">Whatsapp number</p><h6>' + result.data.whatsapp_no + '</h6>';
                            $('#userDetailsModalLabel').text('Brand details');
                        } else {
                            content += '<div class="alert rounded-0 px-2 py-1 small" id="updateDeptAlert" style="display:none"></div>';

                            content += '<p class="text-dark small mb-1">Name <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="name" id="nameEdit" placeholder="Brand name" value="'+result.data.name+'">';

                            content += '<p class="text-dark small mb-1">Phone no <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="phone_no" id="phone_noEdit" placeholder="Brand name" value="'+result.data.phone_no+'">';

                            content += '<p class="text-dark small mb-1">Whatsapp no <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="whatsapp_no" id="whatsapp_noEdit" placeholder="Brand name" value="'+result.data.whatsapp_no+'">';

                            content += '<input type="hidden" id="editId" value="' + result.data.id + '">';

                            $('#userDetails .modal-content').append('<div class="modal-footer text-right"><a href="javascript: void(0)" class="btn btn-sm btn-success" onclick="updateDept()">Update changes <i class="fas fa-upload"></i> </a></div>');

                            $('#userDetailsModalLabel').text('Edit Brand');
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
                url: '{{ route('user.brand.update') }}',
                method: 'PATCH',
                dataType: 'JSON',
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: $('#editId').val(),
                    name: $('#nameEdit').val(),
                    phone_no: $('#phone_noEdit').val(),
                    whatsapp_no: $('#whatsapp_noEdit').val(),
                },
                success: function(result) {
                    $("#userDetails .modal-body").animate({
                        scrollTop: $("#userDetails .modal-body").offset().top - 60
                    });
                    if (result.status == 200) {
                        // updating new data
                        $('#showBrandTable #tr_' + $('#editId').val() + ' td').eq(1).html($('#nameEdit').val());
                        $('#showBrandTable #tr_' + $('#editId').val() + ' td').eq(2).html($('#phone_noEdit').val());
                        $('#showBrandTable #tr_' + $('#editId').val() + ' td').eq(3).html($('#whatsapp_noEdit').val());
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
