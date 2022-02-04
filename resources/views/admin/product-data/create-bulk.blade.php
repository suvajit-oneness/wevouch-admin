@extends('layouts.auth.master')

@section('title', 'Add Bulk Product data')

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
                                <a href="{{ route('user.product.data.list') }}" class="btn btn-sm btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
                                <a href="{{route('user.product.data.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Create</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ route('user.product.data.bulk.store') }}" id="profile-form">
                            @csrf
                                <table class="table table-sm table-hover table-bordered" id="bulkDataTable">
                                    <thead>
                                        <tr>
                                            <td>Brand</td>
                                            <td>Category</td>
                                            <td>Sub-category</td>
                                            <td>Model name</td>
                                            <td>Model no</td>
                                            <td>Service</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control px-0" id="brand_id" name="brand_id[]">
                                                    <option value="" hidden selected>Select...</option>
                                                    @foreach ($data as $item)
                                                        <option value="{{ $item->id }}" {{ old('brand_id') ? (old('brand_id') == $item->id ? 'selected' : '') : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('category') {{ 'is-invalid' }} @enderror" id="category" name="category[]" placeholder="Category" value="{{ old('category') }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('sub_category') {{ 'is-invalid' }} @enderror" id="sub_category" name="sub_category[]" placeholder="Sub-category" value="{{ old('sub_category') }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('model_name') {{ 'is-invalid' }} @enderror" id="model_name" name="model_name[]" placeholder="Model name" value="{{ old('model_name') }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control @error('model_no') {{ 'is-invalid' }} @enderror" id="model_no" name="model_no[]" placeholder="Model number" value="{{ old('model_no') }}">
                                            </td>
                                            <td>
                                                <select class="form-control px-0" id="service_type" name="service_type[]">
                                                    <option value="" hidden selected>Select...</option>
                                                    <option value="0">On site</option>
                                                    <option value="1">Carry in</option>
                                                </select>
                                            </td>
                                            <td class="text-center align-middle"><a class="btn btn-sm btn-success actionTimebtn addNewTime"><i class="fas fa-plus"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).on('click','.addNewTime',function(){
            var thisClickedBtn = $(this);
            thisClickedBtn.removeClass(['addNewTime','btn-success']);
            thisClickedBtn.addClass(['removeTimePrice','btn-danger']).html('<i class="fas fa-times"></i>');

            var toAppend = `
            <tr>
                <td>
                    <select class="form-control px-0" id="brand_id" name="brand_id[]">
                        <option value="" hidden selected>Select...</option>
                        @foreach ($data as $item)
                            <option value="{{ $item->id }}" {{ old('brand_id') ? (old('brand_id') == $item->id ? 'selected' : '') : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control @error('category') {{ 'is-invalid' }} @enderror" id="category" name="category[]" placeholder="Category" value="{{ old('category') }}">
                </td>
                <td>
                    <input type="text" class="form-control @error('sub_category') {{ 'is-invalid' }} @enderror" id="sub_category" name="sub_category[]" placeholder="Sub-category" value="{{ old('sub_category') }}">
                </td>
                <td>
                    <input type="text" class="form-control @error('model_name') {{ 'is-invalid' }} @enderror" id="model_name" name="model_name[]" placeholder="Model name" value="{{ old('model_name') }}">
                </td>
                <td>
                    <input type="text" class="form-control @error('model_no') {{ 'is-invalid' }} @enderror" id="model_no" name="model_no[]" placeholder="Model number" value="{{ old('model_no') }}">
                </td>
                <td>
                    <select class="form-control px-0" id="service_type" name="service_type[]">
                        <option value="" hidden selected>Select...</option>
                        <option value="0">On site</option>
                        <option value="1">Carry in</option>
                    </select>
                </td>
                <td class="text-center align-middle"><a class="btn btn-sm btn-success actionTimebtn addNewTime"><i class="fas fa-plus"></i></a></td>
            </tr>
            `;
            $('#bulkDataTable').append(toAppend);
        });

        $(document).on('click','.removeTimePrice',function(){
            var thisClickedBtn = $(this);
            thisClickedBtn.closest('tr').remove();
        });
    </script>
@endsection
