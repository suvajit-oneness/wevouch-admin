@extends('layouts.auth.master')

@section('title', 'Edit field')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                <i class="fas fa-expand"></i>
                            </button>
                            <a href="{{route('user.field.list')}}" class="btn btn-sm btn-primary"> <i class="fas fa-chevron-left"></i> Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('user.field.update', $data->id) }}" id="profile-form">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') {{'is-invalid'}} @enderror" id="name" name="name" placeholder="Field name" value="{{old('name') ? old('name') : $data->name}}">
                                    @error('name') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-sm-2 col-form-label">Type <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    {{-- <input type="text" class="form-control @error('type') {{'is-invalid'}} @enderror" id="type" name="type" placeholder="Field type" value="{{old('type') ? old('type') : $data->type}}"> --}}
                                    <div class="inputs-holder">
                                        @foreach ($data->input_types as $input_type)
                                            <div class="custom-radio-box">
                                                <input type="radio" name="type" id="typeId_{{$input_type->id}}" value="{{$input_type->id}}" {{($data->type == $input_type->id ? 'checked' : '')}}>
                                                <label for="typeId_{{$input_type->id}}">
                                                    <div class="input-demo">
                                                        {!!$input_type->demo!!}
                                                    </div>
                                                    <div class="input-name">
                                                        {{$input_type->name}}
                                                    </div>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('type') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="value" class="col-sm-2 col-form-label">Value</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('value') {{'is-invalid'}} @enderror" id="value" name="value" placeholder="Comma separated values" value="{{old('value') ? old('value') : $data->value}}">
                                    @error('value') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="required" class="col-sm-2 col-form-label">Required <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn bg-olive">
                                            <input type="radio" name="required" value="1" autocomplete="off" {{($data->required == 1 ? 'checked' : '' )}}> YES
                                        </label>
                                        <label class="btn bg-olive active">
                                            <input type="radio" name="required" value="0" autocomplete="off" {{($data->required == 0 ? 'checked' : '' )}}> NO
                                        </label>
                                    </div>
                                    @error('required') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
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