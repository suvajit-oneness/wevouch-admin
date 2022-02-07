@extends('layouts.auth.master')

@section('title', 'Product data management')

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
                                <a href="{{ route('user.product.data.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Create</a>

                                <a href="{{ route('user.product.data.create.bulk') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Bulk Create</a>

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
                                    <form action="{{ route('user.product.data.list') }}" method="GET" role="search">
                                        <div class="input-group">
                                            <input type="search" class="form-control form-control-sm" name="term" placeholder="What are you looking for..." id="term" value="{{app('request')->input('term')}}" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-info btn-sm rounded-0" type="submit" title="Search projects">
                                                        <i class="fas fa-search"></i> Search
                                                    </button>
                                                </span>
                                                <a href="{{ route('user.product.data.list') }}">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-danger btn-sm rounded-0" type="button" title="Refresh page"> Reset <i class="fas fa-sync-alt"></i></button>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <form method="POST" action="{{route('user.product.data.destroy.bulk')}}">
                            @csrf
                                <table class="table table-sm table-bordered table-hover" id="showProductIconTable">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="checkbox-head" onclick="headerCheckFunc()"></th>
                                            <th>#</th>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Sub-category</th>
                                            <th>Model name</th>
                                            <th>Model no</th>
                                            <th>Service type</th>
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
                                                <td>{{ $item->brandDetails->name }}</td>
                                                <td>{{ $item->category }}</td>
                                                <td>{{ $item->sub_category }}</td>
                                                <td>{{ $item->model_name }}</td>
                                                <td>{{ $item->model_no }}</td>
                                                <td>{{ ($item->service_type == 1) ? 'Carry in' : 'On site' }}</td>
                                                <td class="text-right">
                                                    <a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls('{{ route('user.product.data.show') }}', {{ $item->id }}, 'view')">View</a>

                                                    <a href="{{ route('user.product.data.edit', $item->id) }}" class="badge badge-dark action-button" title="Edit">Edit</a>

                                                    <a href="javascript: void(0)" class="badge badge-dark action-button" title="Delete" onclick="confirm4lert('{{ route('user.product.data.destroy') }}', {{ $item->id }}, 'delete')">Delete</a>
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
                                {{$data->appends(request()->query())->onEachSide(1)->links()}}
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
                    <form method="post" action="{{route('user.product.data.csv.store')}}" enctype="multipart/form-data" id="fileCsvUploadForm">
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
                            content += '<p class="text-muted small mb-1">Brand</p><h6>' + result.data.brand + '</h6>';
                            content += '<p class="text-muted small mb-1">Category</p><h6>' + result.data.category + '</h6>';
                            content += '<p class="text-muted small mb-1">Sub-category</p><h6>' + result.data.subcategory + '</h6>';
                            content += '<p class="text-muted small mb-1">Model name</p><h6>' + result.data.modelname + '</h6>';
                            content += '<p class="text-muted small mb-1">Model no</p><h6>' + result.data.modelno + '</h6>';
                            content += '<p class="text-muted small mb-1">Service type</p><h6>' + result.data.servicetype + '</h6>';
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
