@extends('layouts.auth.master')

@section('title', 'Edit Product data')

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
                                <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Bulk Create</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ route('user.product.data.update', $id) }}" id="profile-form">
                            @csrf
                                <div class="form-group row">
                                    <label for="brand_id" class="col-sm-2 col-form-label">Brand<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-control px-0" id="brand_id" name="brand_id">
                                            <option value="" hidden selected>Select brand</option>
                                            @foreach ($data as $item)
                                                <option value="{{ $item->id }}" {{ $product->brand_id ? ($product->brand_id == $item->id ? 'selected' : '') : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('brand_id') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Category<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('category') {{ 'is-invalid' }} @enderror" id="category" name="category" placeholder="Category" value="{{ $product->category }}">
                                        @error('category') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sub_category" class="col-sm-2 col-form-label">Sub-category<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('sub_category') {{ 'is-invalid' }} @enderror" id="sub_category" name="sub_category" placeholder="Sub-category" value="{{ $product->sub_category }}">
                                        @error('sub_category') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="model_name" class="col-sm-2 col-form-label">Model name<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('model_name') {{ 'is-invalid' }} @enderror" id="model_name" name="model_name" placeholder="Model name" value="{{ $product->model_name }}">
                                        @error('model_name') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="model_no" class="col-sm-2 col-form-label">Model number<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('model_no') {{ 'is-invalid' }} @enderror" id="model_no" name="model_no" placeholder="Model number" value="{{ $product->model_no }}">
                                        @error('model_no') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="service_type" class="col-sm-2 col-form-label">Service type<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="form-group mt-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="service_type" name="service_type" value="1" {{ ($product->service_type == 0) ? '' : 'checked' }}>
                                                <label class="custom-control-label" for="service_type">Service type</label>
                                            </div>
                                        </div>
                                        @error('service_type') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
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

    </script>
@endsection
