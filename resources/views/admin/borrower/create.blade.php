@extends('layouts.auth.master')

@section('title', 'Create new borrower')

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
                                <a href="{{ route('user.borrower.list') }}" class="btn btn-sm btn-primary"> <i class="fas fa-chevron-left"></i> Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ route('user.borrower.store') }}" id="profile-form">
                            @csrf
                                <div class="form-group row">
                                    <label for="customer_id" class="col-sm-2 col-form-label">Customer ID<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('customer_id') {{ 'is-invalid' }} @enderror" id="customer_id" name="customer_id" placeholder="Customer ID" value="{{ old('customer_id') }}">
                                        @error('customer_id') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-1">
                                        <select class="form-control px-0" id="name_prefix" name="name_prefix">
                                            <option value="" hidden selected>Prefix</option>
                                            @foreach ($APP_data->namePrefix as $item)
                                                <option value="{{ $item }}" {{ old('name_prefix') ? (old('name_prefix') == $item ? 'selected' : '') : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control @error('first_name') {{ 'is-invalid' }} @enderror" id="first_name" name="first_name" placeholder="First name" value="{{ old('first_name') }}" autofocus>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control @error('middle_name') {{ 'is-invalid' }} @enderror" id="middle_name" name="middle_name" placeholder="Middle name" value="{{ old('middle_name') }}">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control @error('last_name') {{ 'is-invalid' }} @enderror" id="last_name" name="last_name" placeholder="Last name" value="{{ old('last_name') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 offset-sm-2">
                                        @error('name_prefix') <p class="small mb-0 text-danger">{{ $message }}</p>@enderror
                                        @error('first_name') <p class="small mb-0 text-danger">{{ $message }}</p>@enderror
                                        @error('middle_name') <p class="small mb-0 text-danger">{{ $message }}</p>@enderror
                                        @error('last_name') <p class="small mb-0 text-danger">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-2 col-form-label">Gender <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="" hidden selected>Select Gender</option>
                                            @foreach ($APP_data->genderList as $item)
                                                <option value="{{ $item }}" {{ old('gender') ? (old('gender') == $item ? 'selected' : '') : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @error('gender') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_birth" class="col-sm-2 col-form-label">Date of birth <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control @error('date_of_birth') {{ 'is-invalid' }} @enderror" id="date_of_birth" name="date_of_birth" placeholder="Date of birth" value="{{ old('date_of_birth') }}">
                                        @error('date_of_birth') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control @error('email') {{ 'is-invalid' }} @enderror" id="email" name="email" placeholder="Email ID" value="{{ old('email') }}">
                                        @error('email') <p class="small mb-0 text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-2 col-form-label">Phone number <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('mobile') {{ 'is-invalid' }} @enderror" id="mobile" name="mobile" placeholder="Phone number" value="{{ old('mobile') }}">
                                        @error('mobile') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pan_card_number" class="col-sm-2 col-form-label">PAN card number <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('pan_card_number') {{ 'is-invalid' }} @enderror" id="pan_card_number" name="pan_card_number" placeholder="Pan card number" value="{{ old('pan_card_number') }}" maxlength="10">
                                        @error('pan_card_number') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="occupation" class="col-sm-2 col-form-label">Occupation <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('occupation') {{ 'is-invalid' }} @enderror" id="occupation" name="occupation" placeholder="Occupation" value="{{ old('occupation') }}">
                                        @error('occupation') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="marital_status" class="col-sm-2 col-form-label">Marital status <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="marital_status" name="marital_status">
                                            <option value="" hidden selected>Select Marital status</option>
                                            @foreach ($APP_data->maritalStatus as $item)
                                                <option value="{{ $item }}" {{ old('marital_status') ? (old('marital_status') == $item ? 'selected' : '') : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @error('marital_status') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="street_address" class="col-sm-2 col-form-label">Permanent Address <span class="text-danger">*</span></label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('KYC_HOUSE_NO') {{ 'is-invalid' }} @enderror" id="KYC_HOUSE_NO" name="KYC_HOUSE_NO" placeholder="House number" value="{{ old('KYC_HOUSE_NO') }}">

                                        @error('KYC_HOUSE_NO') <p class="small mb-0 text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="col-sm-10 offset-sm-2 mt-2">
                                        <textarea class="form-control @error('KYC_Street') {{ 'is-invalid' }} @enderror" id="KYC_Street" name="KYC_Street" placeholder="Street">{{ old('KYC_Street') }}</textarea>
                                        @error('KYC_Street') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-sm-10 offset-sm-2 mt-2">
                                        <input type="text" class="form-control @error('KYC_LOCALITY') {{ 'is-invalid' }} @enderror" id="KYC_LOCALITY" name="KYC_LOCALITY" placeholder="Locality" value="{{ old('KYC_LOCALITY') }}">

                                        @error('KYC_LOCALITY') <p class="small mb-0 text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="col-sm-10 offset-sm-2 mt-2">
                                        <input type="text" class="form-control @error('KYC_CITY') {{ 'is-invalid' }} @enderror" id="KYC_CITY" name="KYC_CITY" placeholder="City" value="{{ old('KYC_CITY') }}">

                                        @error('KYC_CITY') <p class="small mb-0 text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="col-sm-10 offset-sm-2 mt-2">
                                        <input type="text" class="form-control @error('KYC_State') {{ 'is-invalid' }} @enderror" id="KYC_State" name="KYC_State" placeholder="State" value="{{ old('KYC_State') }}">

                                        @error('KYC_State') <p class="small mb-0 text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="col-sm-10 offset-sm-2 mt-2">
                                        <input type="text" class="form-control @error('KYC_PINCODE') {{ 'is-invalid' }} @enderror" id="KYC_PINCODE" name="KYC_PINCODE" placeholder="Pincode" value="{{ old('KYC_PINCODE') }}">

                                        @error('KYC_PINCODE') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-sm-10 offset-sm-2 mt-2">
                                        <input type="text" class="form-control @error('KYC_Country') {{ 'is-invalid' }} @enderror" id="KYC_Country" name="KYC_Country" placeholder="Country" value="{{ old('KYC_Country') }}">

                                        @error('KYC_Country') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="agreement_id" class="col-sm-2 col-form-label">Type of loan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="agreement_id" name="agreement_id">
                                            <option value="" hidden selected>Select Type of loan</option>
                                            @foreach ($data->agreement as $item)
                                                <option value="{{ $item->id }}" {{ old('agreement_id') ? (old('agreement_id') == $item->id ? 'selected' : '') : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('agreement_id') <p class="small mb-0 text-danger">{{ $message }}</p>
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
