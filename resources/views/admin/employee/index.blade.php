@extends('layouts.auth.master')

@section('title', 'Employee list')

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
                                <a href="{{ route('user.employee.create') }}" class="btn btn-sm btn-primary"> <i class="fas fa-plus"></i> Create new employee</a>
                                <a href="{{ route('user.role.list') }}" class="btn btn-sm btn-danger"> <i class="fas fa-shield-alt"></i> ROLE</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Parent</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $index => $item)
                                        <tr id="tr_{{ $item->id }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="user-profile-holder">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{ asset($item->image_path) }}"
                                                            alt="user-image-{{ $item->id }}">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <p class="name">{{ $item->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="small text-dark mb-1"><i class="fas fa-envelope mr-2"></i>
                                                    {{ $item->email }}</p>
                                                <p class="small text-dark mb-0">@php
                                                    if (!empty($item->mobile)) {
                                                        echo '<i class="fas fa-phone fa-rotate-90 mr-2"></i> ' . $item->mobile;
                                                    } else {
                                                        echo '<i class="fas fa-phone fa-rotate-90 text-danger"></i>';
                                                    }
                                                @endphp</p>
                                            </td>
                                            <td>
                                                {{ $item->parent_id == 0 ? 'NA' : $item->parent->name }}
                                            </td>
                                            <td class="text-right">
                                                <div class="single-line">
                                                    <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                        title="View"
                                                        onclick="viewDeta1ls('{{ route('user.employee.show') }}', {{ $item->id }})">View</a>
                                                    @if ($item->user_type != 1)
                                                        @if ($item->block == 0)
                                                            <a href="javascript: void(0)"
                                                                class="badge badge-dark action-button block-button"
                                                                title="Block"
                                                                onclick="confirm4lert('{{ route('user.employee.block') }}', {{ $item->id }}, 'block')">Active</a>
                                                        @else
                                                            <a href="javascript: void(0)"
                                                                class="badge badge-danger action-button block-button"
                                                                title="Block"
                                                                onclick="confirm4lert('{{ route('user.employee.block') }}', {{ $item->id }}, 'activate')">Blocked</a>
                                                        @endif

                                                        <a href="{{ route('user.employee.edit', $item->id) }}"
                                                            class="badge badge-dark action-button" title="Edit">Edit</a>

                                                        <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                            title="Delete"
                                                            onclick="confirm4lert('{{ route('user.employee.destroy') }}', {{ $item->id }}, 'delete')">Delete</a>
                                                    @endif
                                                </div>
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
@endsection

@section('script')
    <script>
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
                        let mobileShow = parentShow = officeShow = '<em class="text-muted">No data</em>';
                        if (result.data.mobile != null) {
                            mobileShow = result.data.mobile;
                        }

                        if (result.data.user_parent != null) {
                            parentShow = result.data.user_parent;
                        }

                        if (result.data.office != null) {
                            officeShow = result.data.office;
                        }

                        content += '<div class="w-100 mb-3 text-uppercase"><div class="badge badge-' + result.data.user_type_color + ' rounded-0">' + result.data.user_type + '</div></div>';
                        content += '<div class="w-100 user-profile-holder mb-3"><img src="' + result.data.image_path + '"></div>';
                        content += '<p class="text-muted small mb-1">Name</p><h6>' + result.data.name + '</h6>';
                        content += '<p class="text-muted small mb-1">Employee ID</p><h6>' + result.data.emp_id +'</h6>';
                        content += '<p class="text-muted small mb-1">Email</p><h6>' + result.data.email +'</h6>';
                        content += '<p class="text-muted small mb-1">Phone number</p><h6>' + mobileShow +'</h6>';
                        content += '<p class="text-muted small mb-1">Parent</p><h6>' + parentShow + '</h6>';
                        content += '<p class="text-muted small mb-1">Office</p><h6>' + officeShow + '</h6>';
                    } else {
                        content += '<p class="text-muted small mb-1">No data found. Try again</p>';
                    }
                    $('#appendContent').html(content);
                    $('#userDetailsModalLabel').text('Employee details');
                    $('#userDetails').modal('show');
                }
            });
        }
    </script>
@endsection
