@extends('layouts.auth.master')

@section('title', 'Create new employee')

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
                            <a href="{{route('user.employee.list')}}" class="btn btn-sm btn-primary"> <i class="fas fa-chevron-left"></i> Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                       </ul> --}}
                        <form class="form-horizontal" method="POST" action="{{ route('user.employee.store') }}" id="profile-form">
                        @csrf
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') {{'is-invalid'}} @enderror" id="name" name="name" placeholder="Full name" value="{{old('name')}}" autofocus>
                                    @error('name') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="employee_id" class="col-form-label">Employee id <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('employee_id') {{'is-invalid'}} @enderror" id="employee_id" name="employee_id" placeholder="Employee id" value="{{old('employee_id')}}">
                                    @error('employee_id') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') {{'is-invalid'}} @enderror" id="email" name="email" placeholder="Email ID" value="{{old('email')}}">
                                    @error('email') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="phone_number" class="col-form-label">Phone number</label>
                                    <input type="text" class="form-control @error('phone_number') {{'is-invalid'}} @enderror" id="phone_number" name="phone_number" placeholder="Phone number" value="{{old('phone_number')}}">
                                    @error('phone_number') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="department" class="col-form-label">Department <span class="text-danger">*</span></label>
                                    <select name="department" id="department" class="form-control @error('department') {{'is-invalid'}} @enderror">
                                        <option value="" hidden selected>Select department</option>
                                        @foreach ($data->departments as $item)
                                            <option value="{{$item->id}}" {{(old('department') == $item->id) ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('department') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="designation" class="col-form-label">Designation <span class="text-danger">*</span></label>
                                    <select name="designation" id="designation" class="form-control @error('designation') {{'is-invalid'}} @enderror">
                                        <option value="" hidden selected>Select designation</option>
                                        @foreach ($data->designations as $item)
                                            <option value="{{$item->id}}" {{(old('designation') == $item->id) ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('designation') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="parent_id" class="col-form-label">Parent</label>
                                    <select name="parent_id" id="parent_id" class="form-control @error('parent_id') {{'is-invalid'}} @enderror">
                                        <option value="" hidden selected>Select reporting person</option>
                                        @foreach ($data->users as $item)
                                            <option value="{{$item->id}}" {{(old('parent_id') == $item->id) ? 'selected' : '' }}>{{$item->name.' - '.$item->type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="user_type" class="col-form-label">Role <span class="text-danger">*</span></label>
                                    <select name="user_type" id="user_type" class="form-control @error('user_type') {{'is-invalid'}} @enderror">
                                        <option value="" hidden selected>Select role</option>
                                        @foreach ($data->user_type as $item)
                                            <option value="{{$item->id}}" {{(old('user_type') == $item->id) ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_type') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="office" class="col-form-label">Office <span class="text-danger">*</span></label>
                                    <select name="office" id="office" class="form-control @error('office') {{'is-invalid'}} @enderror">
                                        <option value="" hidden selected>Select office</option>
                                        @foreach ($data->offices as $item)
                                            <option value="{{$item->id}}" {{(old('office') == $item->id) ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('office') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="password" class="col-form-label">Password <span class="text-danger">*</span></label>
                                    <div class="custom-control custom-switch mt-2 mb-2">
                                        <input type="checkbox" class="custom-control-input" id="sendPassword" name="sendPassword" onclick="mailSendChk()" {{(old('sendPassword') == 'on' ? 'checked' : '')}}>
                                        <label class="custom-control-label" for="sendPassword">Send password via mail</label>
                                    </div>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Type manual password" value="" {!!(old('sendPassword') == 'on' ? 'style="display: none"' : '')!!}>
                                    <p class="small mb-0 text-danger"></p>
                                    @error('password') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
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
        function mailSendChk() {
            if ($('#sendPassword').is(':checked')) {
                $('#password').hide();
            } else {
                $('#password').show().focus();
            }
        }
    </script>
@endsection