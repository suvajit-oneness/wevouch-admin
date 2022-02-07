@extends('layouts.auth.master')

@section('title', 'Product icon management')

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
                                <a href="javascript: void(0)" class="btn btn-sm btn-primary" onclick="openCreateIconModal()"><i class="fas fa-plus"></i> Create</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-7">
                                    <p class="small text-muted">Displaying {{$data->firstItem()}} to {{$data->lastItem()}} out of {{$data->total()}} entries</p>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <form action="{{ route('user.product.icon.list') }}" method="GET" role="search">
                                        <div class="input-group">
                                            <input type="search" class="form-control form-control-sm" name="term" placeholder="What are you looking for..." id="term" value="{{app('request')->input('term')}}" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info btn-sm rounded-0" type="submit" title="Search projects">
                                                        <i class="fas fa-search"></i> Search
                                                    </button>
                                                </span>
                                                <a href="{{ route('user.product.icon.list') }}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-danger btn-sm rounded-0" type="button" title="Refresh page"> Reset <i class="fas fa-sync-alt"></i></button>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <form method="POST" action="{{route('user.product.icon.destroy.bulk')}}">
                            @csrf
                                <table class="table table-sm table-bordered table-hover" id="showProductIconTable">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkbox-head" onclick="headerCheckFunc()"></th>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Icon</th>
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
                                                <td><img src="{{ asset($item->icon) }}" style="height:50px;cursor:pointer" onclick="viewDeta1ls('{{ route('user.product.icon.show') }}', {{ $item->id }}, 'view')"></td>
                                                <td class="text-right">
                                                    <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                        title="View"
                                                        onclick="viewDeta1ls('{{ route('user.product.icon.show') }}', {{ $item->id }}, 'view')">View</a>

                                                    <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                        title="Edit"
                                                        onclick="viewDeta1ls('{{ route('user.product.icon.show') }}', {{ $item->id }}, 'edit')">Edit</a>

                                                    <a href="javascript: void(0)" class="badge badge-dark action-button"
                                                        title="Delete"
                                                        onclick="confirm4lert('{{ route('user.product.icon.destroy') }}', {{ $item->id }}, 'delete')">Delete</a>
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

    <div class="modal fade pr-0" id="createProductIconModal" tabindex="-1" role="dialog" aria-labelledby="createProductIconModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProductIconModalLabel">Create new Product Icon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="createProductIconContent">
                        <form action="{{ route("user.product.icon.store") }}" method="post" enctype="multipart/form-data">
                        @csrf
                            {{-- <div class="alert rounded-0 px-2 py-1 small" id="newDeptAlert" style="display:none"></div> --}}

                            <p class="text-dark small mb-1">Enter category <span class="text-danger">*</span></p>
                            <textarea class="form-control form-control-sm mb-2" name="category" id="categoryCreate" placeholder="Category"></textarea>

                            <p class="text-dark small mb-1">Browse icon <span class="text-danger">*</span></p><input type="file" class="form-control form-control-sm" id="icon" name="icon">

                            <button class="btn btn-sm btn-success mt-5" type="submit">Upload changes <i class="fas fa-upload"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade pr-0" id="editProductIconModal" tabindex="-1" role="dialog" aria-labelledby="editProductIconModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductIconModalLabel">Create new Product Icon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="editProductIconContent">
                        <form action="{{ route("user.product.icon.update") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            {{-- <div class="alert rounded-0 px-2 py-1 small" id="newDeptAlert" style="display:none"></div> --}}

                            <p class="text-dark small mb-1">Enter category <span class="text-danger">*</span></p>
                            <textarea class="form-control form-control-sm mb-2" name="category" id="categoryEdit" placeholder="Category"></textarea>

                            <img src="" class="img-thumbnail" style="height: 80px" id="editCatIconSrc">

                            <p class="text-dark small mb-1">Browse icon <span class="text-danger">*</span></p><input type="file" class="form-control form-control-sm" id="iconEdit" name="icon">

                            <input type="hidden" name="editId" id="editId" value="">

                            <button class="btn btn-sm btn-success mt-5" type="submit">Update changes <i class="fas fa-edit"></i></button>
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
        function openCreateIconModal() {
            $('#createProductIconModal').modal('show');
        }

        // edit
        function openEditIconModal() {
            $('#editProductIconModal').modal('show');
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
                            content += '<p class="text-muted small mb-1">Icon</p> <img src="'+result.data.icon+'" class="w-100 img-thumbnail">';
                            $('#userDetailsModalLabel').text('Product Icon details');

                            $('#appendContent').html(content);
                            $('#userDetails').modal('show');
                        } else {
                            $('#categoryEdit').text(result.data.category);
                            $('#editCatIconSrc').attr('src', result.data.icon);
                            $('#editId').val(result.data.id);
                            openEditIconModal();
                        }
                    } else {
                        content += '<p class="text-muted small mb-1">No data found. Try again</p>';
                    }
                    
                }
            });
        }
    </script>
@endsection
