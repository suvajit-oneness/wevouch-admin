@extends('layouts.auth.master')

@section('title', 'User role')

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
                                {{-- <a href="javascript: void(0)" class="btn btn-sm btn-primary" onclick="openSidebarModal()"> <i class="fas fa-plus"></i> Create</a> --}}
                                <a href="{{ route('user.employee.list') }}" class="btn btn-sm btn-primary"> <i class="fas fa-chevron-left"></i> Back to users</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-hover" id="showRoleTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $index => $item)
                                        <tr id="tr_{{ $item->id }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <span class="badge bg-{{ $item->color }} rounded-0 text-uppercase">{{ $item->name }}</span>
                                            </td>
                                            <td class="text-right">
                                                <a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls('{{ route('user.role.show') }}', {{ $item->id }})">View</a>
                                                @if ($item->id != 1)
                                                    <a href="javascript: void(0)" class="badge badge-dark action-button" title="Edit" onclick="editRole({{ $item->id }}, '{{ $item->name }}', '{{ $item->color }}')">Edit</a>
                                                    {{-- <a href="javascript: void(0)" class="badge badge-dark action-button" title="Edit" onclick="viewDeta1ls('{{route('user.role.show')}}', {{$item->id}})">Edit</a> --}}

                                                    <a href="javascript: void(0)" class="badge badge-dark action-button" title="Delete" onclick="confirm4lert('{{ route('user.role.destroy') }}', {{ $item->id }}, 'delete')">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%"><em>No records found</em></td>
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

    <div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="createRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRoleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="roleContent">
                        <form class="form-horizontal" method="POST" action="" id="roleForm">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-12 col-form-label">Name <span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="User role name" value="">
                                </div>
                            </div>
                            <div class="form-group row"><label for="color" class="col-12 col-form-label">Color <span
                                        class="text-danger">*</span></label>
                                <div class="col-12" id="roles-holder">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-select-color btn-sm bg-indigo"><input type="radio" name="color" value="indigo" autocomplete="off"></label>
                                        <label class="btn btn-select-color btn-sm bg-primary"><input type="radio" name="color" value="primary" autocomplete="off"></label>
                                        <label class="btn btn-select-color btn-sm bg-olive"><input type="radio" name="color" value="olive" autocomplete="off"></label>
                                        <label class="btn btn-select-color btn-sm bg-success"><input type="radio" name="color" value="success" autocomplete="off"></label>
                                        <label class="btn btn-select-color btn-sm bg-warning"><input type="radio" name="color" value="warning" autocomplete="off"></label>
                                        <label class="btn btn-select-color btn-sm bg-orange"><input type="radio" name="color" value="orange" autocomplete="off"></label>
                                        <label class="btn btn-select-color btn-sm bg-danger"><input type="radio" name="color" value="danger" autocomplete="off"></label>
                                        <label class="btn btn-select-color btn-sm bg-secondary"><input type="radio" name="color" value="secondary" autocomplete="off"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <p class="small mb-0 text-danger" id="reviewErrors"></p>
                                    <p class="small mb-0 text-success" id="reviewSuccess"></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="hidden" name="id" id="roleModalId">
                                    <input type="hidden" name="type" id="roleModalType">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // create
        function openSidebarModal() {
            $('#createRoleModalLabel').text('Create new role');
            $('#roleContent #name').val('');
            $('input[name="color"]:checked').prop('checked', false);
            $('input[name="color"]').parent().removeClass('active');
            $('#roleModalId').val(0);
            $('#roleModalType').val('create');
            $('#createRoleModal').modal('show');
        }

        // edit
        function editRole(id, name, color) {
            $('#createRoleModalLabel').text('Edit role');
            $('#roleContent #name').val(name);
            $(':radio').each(function() {
                if ($(this).val() === color) {
                    $(this).prop('checked', true);
                    $(this).parent().addClass('active');
                }
            });
            $('#roleModalId').val(id);
            $('#roleModalType').val('edit');
            $('#createRoleModal').modal('show');
        }

        function viewDeta1ls(route, id) {
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
                        console.log(result.data);
                        content += '<div class="w-100 mb-3 text-uppercase"><div class="badge badge-' + result
                            .data.color + ' rounded-0">' + result.data.name + '</div></div>';
                    } else {
                        content += '<p class="text-muted small mb-1">No data found. Try again</p>';
                    }
                    $('#appendContent').html(content);
                    $('#userDetailsModalLabel').text('Role details');
                    $('#userDetails').modal('show');
                }
            });
        }

        $('#roleForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('user.role.store') }}',
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    name: $('input[name="name"]').val(),
                    color: $('input[name="color"]:checked').val(),
                    id: $('#roleModalId').val(),
                    type: $('#roleModalType').val(),
                },
                success: function(response) {
                    if (response.status == 200) {
                        let count = parseInt($('#showRoleTable tbody tr').length) + 1;
                        $('#reviewErrors').text('');
                        $('#reviewSuccess').text(response.message);

                        setTimeout(() => {
                            window.location = "{{ route('user.role.list') }}";
                            // $('input[name="color"]:checked').prop('checked', false);
                            // $('input[name="name"]').val('');
                            // $('#showRoleTable tbody').append('<tr id="tr_'+response.data.id+'"><td>'+count+'</td><td><span class="badge bg-'+response.data.color+' rounded-0 text-uppercase">'+response.data.name+'</span></td><td class="text-right"><a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls("{{ route('user.role.show') }}", '+response.data.id+')">View</a></td></tr>');
                            // $('#createRoleModal').modal('hide');
                        }, 2000);
                    } else {
                        $('#reviewSuccess').text('');
                        $('#reviewErrors').text(response.message);
                    }
                    $('#reviewSubmitBtn').prop('disabled', false);
                }
            });
        });
    </script>
@endsection
