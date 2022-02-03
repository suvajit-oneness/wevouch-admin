@extends('layouts.auth.master')

@section('title', 'Edit Borrower')

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
                            <form class="form-horizontal" method="POST"
                                action="{{ route('user.borrower.update', $data->user->id) }}" id="profile-form">
                                @csrf
                                <div class="form-group row">
                                    <label for="customer_id" class="col-sm-2 col-form-label">Customer ID<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('customer_id') {{ 'is-invalid' }} @enderror" id="customer_id" name="customer_id" placeholder="Customer ID" value="{{ old('customer_id') ? old('customer_id') : $data->user->CUSTOMER_ID }}">

                                        @error('customer_id') <p class="small mb-0 text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-1">
                                        <select class="form-control px-0" id="name_prefix" name="name_prefix">
                                            <option value="" hidden selected>Select Prefix</option>
                                            @foreach ($APP_data->namePrefix as $item)
                                                <option value="{{ $item }}"
                                                    {{ $data->user->name_prefix == $item ? 'selected' : '' }}>
                                                    {{ ucwords($item) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text"
                                            class="form-control @error('first_name') {{ 'is-invalid' }} @enderror"
                                            id="first_name" name="first_name" placeholder="First name"
                                            value="{{ old('first_name') ? old('first_name') : $data->user->first_name }}"
                                            autofocus>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text"
                                            class="form-control @error('middle_name') {{ 'is-invalid' }} @enderror"
                                            id="middle_name" name="middle_name" placeholder="Middle name"
                                            value="{{ old('middle_name') ? old('middle_name') : $data->user->middle_name }}"
                                            autofocus>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text"
                                            class="form-control @error('last_name') {{ 'is-invalid' }} @enderror"
                                            id="last_name" name="last_name" placeholder="Last name"
                                            value="{{ old('last_name') ? old('last_name') : $data->user->last_name }}"
                                            autofocus>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 offset-sm-2">
                                        @error('name_prefix') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                        @error('full_name') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-2 col-form-label">Gender <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="" hidden selected>Select Gender</option>
                                            @foreach ($APP_data->genderList as $item)
                                                <option value="{{ $item }}"
                                                    {{ $data->user->gender == $item ? 'selected' : '' }}>
                                                    {{ ucwords($item) }}</option>
                                            @endforeach
                                        </select>
                                        @error('gender') <p class="small mb-0 text-danger">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_of_birth" class="col-sm-2 col-form-label">Date of birth <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        @php
                                            $date_of_birth = date('Y-m-d', strtotime($data->user->date_of_birth));
                                        @endphp
                                        <input type="date"
                                            class="form-control @error('date_of_birth') {{ 'is-invalid' }} @enderror"
                                            id="date_of_birth" name="date_of_birth" placeholder="Date of birth"
                                            value="{{ old('date_of_birth') ? old('date_of_birth') : $date_of_birth }}">
                                        @error('date_of_birth') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="email"
                                            class="form-control @error('email') {{ 'is-invalid' }} @enderror" id="email"
                                            name="email" placeholder="Email ID"
                                            value="{{ old('email') ? old('email') : $data->user->email }}">
                                        @error('email') <p class="small mb-0 text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile" class="col-sm-2 col-form-label">Phone number <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('mobile') {{ 'is-invalid' }} @enderror"
                                            id="mobile" name="mobile" placeholder="Phone number"
                                            value="{{ old('mobile') ? old('mobile') : $data->user->mobile }}">
                                        @error('mobile') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pan_card_number" class="col-sm-2 col-form-label">PAN card number <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('pan_card_number') {{ 'is-invalid' }} @enderror"
                                            id="pan_card_number" name="pan_card_number" placeholder="Pan card number"
                                            value="{{ old('pan_card_number') ? old('pan_card_number') : $data->user->pan_card_number }}">
                                        @error('pan_card_number') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="occupation" class="col-sm-2 col-form-label">Occupation <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('occupation') {{ 'is-invalid' }} @enderror"
                                            id="occupation" name="occupation" placeholder="Occupation"
                                            value="{{ old('occupation') ? old('occupation') : $data->user->occupation }}">
                                        @error('occupation') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="marital_status" class="col-sm-2 col-form-label">Marital status <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="marital_status" name="marital_status">
                                            <option value="" hidden selected>Select Marital status</option>
                                            @foreach ($APP_data->maritalStatus as $item)
                                                <option value="{{ $item }}"
                                                    {{ $data->user->marital_status == $item ? 'selected' : '' }}>
                                                    {{ ucwords($item) }}</option>
                                            @endforeach
                                        </select>
                                        @error('marital_status') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="KYC_Care_of" class="col-sm-2 col-form-label">KYC Care of
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_Care_of') {{ 'is-invalid' }} @enderror"
                                            id="KYC_Care_of" name="KYC_Care_of" placeholder="KYC Care of"
                                            value="{{ old('KYC_Care_of') ? old('KYC_Care_of') : $data->user->KYC_Care_of }}">
                                        @error('KYC_Care_of') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="KYC_HOUSE_NO" class="col-sm-2 col-form-label">KYC HOUSE NO
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_HOUSE_NO') {{ 'is-invalid' }} @enderror"
                                            id="KYC_HOUSE_NO" name="KYC_HOUSE_NO" placeholder="KYC House No"
                                            value="{{ old('KYC_HOUSE_NO') ? old('KYC_HOUSE_NO') : $data->user->KYC_HOUSE_NO }}">
                                        @error('KYC_HOUSE_NO') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="KYC_LANDMARK" class="col-sm-2 col-form-label">KYC Landmark
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_LANDMARK') {{ 'is-invalid' }} @enderror"
                                            id="KYC_LANDMARK" name="KYC_LANDMARK" placeholder="KYC Landmark"
                                            value="{{ old('KYC_LANDMARK') ? old('KYC_LANDMARK') : $data->user->KYC_LANDMARK }}">
                                        @error('KYC_LANDMARK') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="KYC_LOCALITY" class="col-sm-2 col-form-label">KYC Locality
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_LOCALITY') {{ 'is-invalid' }} @enderror"
                                            id="KYC_LOCALITY" name="KYC_LOCALITY" placeholder="KYC Street"
                                            value="{{ old('KYC_LOCALITY') ? old('KYC_LOCALITY') : $data->user->KYC_Street }}">
                                        @error('KYC_LOCALITY') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="KYC_Street" class="col-sm-2 col-form-label">KYC Street
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_Street') {{ 'is-invalid' }} @enderror"
                                            id="KYC_Street" name="KYC_Street" placeholder="KYC Street"
                                            value="{{ old('KYC_Street') ? old('KYC_Street') : $data->user->KYC_Street }}">
                                        @error('KYC_Street') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="KYC_PINCODE" class="col-sm-2 col-form-label">KYC Pincode
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_PINCODE') {{ 'is-invalid' }} @enderror"
                                            id="KYC_PINCODE" name="KYC_PINCODE" placeholder="KYC Pincode"
                                            value="{{ old('KYC_PINCODE') ? old('KYC_PINCODE') : $data->user->KYC_PINCODE }}">
                                        @error('KYC_PINCODE') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <label for="KYC_Country" class="col-sm-2 col-form-label">KYC Country
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_Country') {{ 'is-invalid' }} @enderror"
                                            id="KYC_Country" name="KYC_Country" placeholder="KYC Country"
                                            value="{{ old('KYC_Country') ? old('KYC_Country') : $data->user->KYC_Country }}">
                                        @error('KYC_Country') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="KYC_State" class="col-sm-2 col-form-label">KYC State
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_State') {{ 'is-invalid' }} @enderror"
                                            id="KYC_State" name="KYC_State" placeholder="KYC State"
                                            value="{{ old('KYC_State') ? old('KYC_State') : $data->user->KYC_State }}">
                                        @error('KYC_State') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="KYC_District" class="col-sm-2 col-form-label">KYC District
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_District') {{ 'is-invalid' }} @enderror"
                                            id="KYC_District" name="KYC_District" placeholder="KYC District"
                                            value="{{ old('KYC_District') ? old('KYC_District') : $data->user->KYC_District }}">
                                        @error('KYC_District') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="KYC_POST_OFFICE" class="col-sm-2 col-form-label">KYC Post Office
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_POST_OFFICE') {{ 'is-invalid' }} @enderror"
                                            id="KYC_POST_OFFICE" name="KYC_POST_OFFICE" placeholder="KYC Post Office"
                                            value="{{ old('KYC_POST_OFFICE') ? old('KYC_POST_OFFICE') : $data->user->KYC_POST_OFFICE }}">
                                        @error('KYC_POST_OFFICE') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="KYC_CITY" class="col-sm-2 col-form-label">KYC City
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_CITY') {{ 'is-invalid' }} @enderror"
                                            id="KYC_CITY" name="KYC_CITY" placeholder="KYC City"
                                            value="{{ old('KYC_CITY') ? old('KYC_CITY') : $data->user->KYC_CITY }}">
                                        @error('KYC_CITY') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="KYC_Taluka" class="col-sm-2 col-form-label">KYC Taluka
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_Taluka') {{ 'is-invalid' }} @enderror"
                                            id="KYC_Taluka" name="KYC_Taluka" placeholder="KYC Taluka"
                                            value="{{ old('KYC_Taluka') ? old('KYC_Taluka') : $data->user->KYC_Taluka }}">
                                        @error('KYC_Taluka') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="KYC_Population_Group" class="col-sm-2 col-form-label">KYC Population Group
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('KYC_Population_Group') {{ 'is-invalid' }} @enderror"
                                            id="KYC_Population_Group" name="KYC_Population_Group"
                                            placeholder="KYC_Population_Group"
                                            value="{{ old('KYC_Population_Group') ? old('KYC_Population_Group') : $data->user->KYC_Population_Group }}">
                                        @error('KYC_Population_Group') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>




                                <!-- <div class="form-group row">
                                    <label for="street_address" class="col-sm-2 col-form-label">Address <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea
                                            class="form-control @error('street_address') {{ 'is-invalid' }} @enderror"
                                            id="street_address" name="street_address"
                                            placeholder="Street address">{{ old('street_address') ? old('street_address') : $data->user->street_address }}</textarea>
                                        @error('street_address') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-sm-10 offset-sm-2 mt-2">
                                        <input type="text"
                                            class="form-control @error('city') {{ 'is-invalid' }} @enderror" id="city"
                                            name="city" placeholder="City"
                                            value="{{ old('city') ? old('city') : $data->user->city }}">

                                        @error('city') <p class="small mb-0 text-danger">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="col-sm-10 offset-sm-2 mt-2">
                                        <input type="text"
                                            class="form-control @error('pincode') {{ 'is-invalid' }} @enderror"
                                            id="pincode" name="pincode" placeholder="Pincode"
                                            value="{{ old('pincode') ? old('pincode') : $data->user->pincode }}">

                                        @error('pincode') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-sm-10 offset-sm-2 mt-2">
                                        <input type="text"
                                            class="form-control @error('state') {{ 'is-invalid' }} @enderror" id="state"
                                            name="state" placeholder="State"
                                            value="{{ old('state') ? old('state') : $data->user->state }}">

                                        @error('state') <p class="small mb-0 text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div> -->


                                <div class="form-group row">
                                    <label for="agreement_id" class="col-sm-2 col-form-label">Type of loan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="agreement_id" name="agreement_id">
                                            <option value="" hidden selected>Select Type of loan</option>
                                            @foreach ($data->agreement as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('agreement_id') ? (old('agreement_id') == $item->id ? 'selected' : '') : ($data->user->agreement_id == $item->id ? 'selected' : '') }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('agreement_id') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <label for="Customer_Type" class="col-sm-2 col-form-label">Customer Type</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Customer_Type') {{ 'is-invalid' }} @enderror"
                                            id="Customer_Type" name="Customer_Type" placeholder="Customer_Type"
                                            value="{{ old('Customer_Type') ? old('Customer_Type') : $data->user->Customer_Type }}">
                                        @error('Customer_Type') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Resident_Status" class="col-sm-2 col-form-label">Resident Status </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Resident_Status') {{ 'is-invalid' }} @enderror"
                                            id="Resident_Status" name="Resident_Status" placeholder="Resident_Status"
                                            value="{{ old('Resident_Status') ? old('Resident_Status') : $data->user->Resident_Status }}">
                                        @error('Resident_Status') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Aadhar_Number" class="col-sm-2 col-form-label">Aadhar Number </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Aadhar_Number') {{ 'is-invalid' }} @enderror"
                                            id="Aadhar_Number" name="Aadhar_Number" placeholder="Aadhar Number"
                                            value="{{ old('Aadhar_Number') ? old('Aadhar_Number') : $data->user->Aadhar_Number }}">
                                        @error('Aadhar_Number') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Main_Constitution" class="col-sm-2 col-form-label">Main Constitution
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Main_Constitution') {{ 'is-invalid' }} @enderror"
                                            id="Main_Constitution" name="Main_Constitution" placeholder="Main Constitution"
                                            value="{{ old('Main_Constitution') ? old('Main_Constitution') : $data->user->Main_Constitution }}">
                                        @error('Main_Constitution') <p class="small mb-0 text-danger">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Sub_Constitution" class="col-sm-2 col-form-label">Sub Constitution </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Sub_Constitution') {{ 'is-invalid' }} @enderror"
                                            id="Sub_Constitution" name="Sub_Constitution" placeholder="Sub Constitution"
                                            value="{{ old('Sub_Constitution') ? old('Sub_Constitution') : $data->user->Sub_Constitution }}">
                                        @error('Sub_Constitution') <p class="small mb-0 text-danger">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="KYC_Date" class="col-sm-2 col-form-label">KYC Date </label>
                                    <div class="col-sm-10">
                                        @php
                                            $KYC_Date = date('Y-m-d', strtotime($data->user->KYC_Date));
                                        @endphp
                                        <input type="Date"
                                            class="form-control @error('KYC_Date') {{ 'is-invalid' }} @enderror"
                                            id="KYC_Date" name="KYC_Date" placeholder="KYC Date"
                                            value="{{ old('KYC_Date') ? old('KYC_Date') : $KYC_Date }}">
                                        @error('KYC_Date') <p class="small mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Re_KYC_Due_Date" class="col-sm-2 col-form-label">Re KYC Due Date </label>
                                    <div class="col-sm-10">
                                        @php
                                            $Re_KYC_Due_Date = date('Y-m-d', strtotime($data->user->date_of_birth));
                                        @endphp
                                        <input type="Date"
                                            class="form-control @error('Re_KYC_Due_Date') {{ 'is-invalid' }} @enderror"
                                            id="Re_KYC_Due_Date" name="Re_KYC_Due_Date" placeholder="Re KYC Due Date"
                                            value="{{ old('Re_KYC_Due_Date') ? old('Re_KYC_Due_Date') : $Re_KYC_Due_Date }}">
                                        @error('Re_KYC_Due_Date') <p class="small mb-0 text-danger">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Minor" class="col-sm-2 col-form-label">Minor </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Minor') {{ 'is-invalid' }} @enderror" id="Minor"
                                            name="Minor" placeholder="Minor"
                                            value="{{ old('Minor') ? old('Minor') : $data->user->Minor }}">
                                        @error('Minor') <p class="small mb-0 text-danger">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Customer Category" class="col-sm-2 col-form-label">Customer Category
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Customer_Category') {{ 'is-invalid' }} @enderror"
                                            id="Customer_Category" name="Customer_Category" placeholder="Customer Category"
                                            value="{{ old('Customer_Category') ? old('Customer_Category') : $data->user->Customer_Category }}">
                                        @error('Customer_Category') <p class="small mb-0 text-danger">{{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Alternate_Mobile_No" class="col-sm-2 col-form-label">Alternate Mobile No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Alternate_Mobile_No') {{ 'is-invalid' }} @enderror"
                                            id="Alternate_Mobile_No" name="Alternate_Mobile_No"
                                            placeholder="Alternate Mobile No"
                                            value="{{ old('Alternate_Mobile_No') ? old('Alternate_Mobile_No') : $data->user->Alternate_Mobile_No }}">
                                        @error('Alternate_Mobile_No') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="Telephone_No" class="col-sm-2 col-form-label">Telephone No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Telephone_No') {{ 'is-invalid' }} @enderror"
                                            id="Telephone_No" name="Telephone_No" placeholder="Telephone No"
                                            value="{{ old('Telephone_No') ? old('Telephone_No') : $data->user->Telephone_No }}">
                                        @error('Telephone_No') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Office_Telephone_No" class="col-sm-2 col-form-label">Office Telephone No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Office_Telephone_No') {{ 'is-invalid' }} @enderror"
                                            id="Office_Telephone_No" name="Office_Telephone_No"
                                            placeholder="Office Telephone No"
                                            value="{{ old('Office_Telephone_No') ? old('Office_Telephone_No') : $data->user->Office_Telephone_No }}">
                                        @error('Office_Telephone_No') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="FAX_No" class="col-sm-2 col-form-label">FAX_No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('FAX_No') {{ 'is-invalid' }} @enderror"
                                            id="FAX_No" name="FAX_No" placeholder="FAX No"
                                            value="{{ old('FAX_No') ? old('FAX_No') : $data->user->FAX_No }}">
                                        @error('FAX_No') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Preferred_Language" class="col-sm-2 col-form-label">Preferred Language
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Preferred_Language') {{ 'is-invalid' }} @enderror"
                                            id="Preferred_Language" name="Preferred_Language"
                                            placeholder="Preferred Language"
                                            value="{{ old('Preferred_Language') ? old('Preferred_Language') : $data->user->Preferred_Language }}">
                                        @error('Preferred_Language') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="REMARKS" class="col-sm-2 col-form-label">REMARKS
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('REMARKS') {{ 'is-invalid' }} @enderror"
                                            id="REMARKS" name="REMARKS" placeholder="REMARKS"
                                            value="{{ old('REMARKS') ? old('REMARKS') : $data->user->REMARKS }}">
                                        @error('REMARKS') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>








                                <div class="form-group row">
                                    <label for="COMM_Care_of" class="col-sm-2 col-form-label">Communication Care of
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_Care_of') {{ 'is-invalid' }} @enderror"
                                            id="COMM_Care_of" name="COMM_Care_of" placeholder="Communication Care of"
                                            value="{{ old('COMM_Care_of') ? old('COMM_Care_of') : $data->user->COMM_Care_of }}">
                                        @error('COMM_Care_of') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="COMM_HOUSE_NO" class="col-sm-2 col-form-label">Communicaton House No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_HOUSE_NO') {{ 'is-invalid' }} @enderror"
                                            id="COMM_HOUSE_NO" name="COMM_HOUSE_NO" placeholder="Communicaton House No"
                                            value="{{ old('COMM_HOUSE_NO') ? old('COMM_HOUSE_NO') : $data->user->COMM_HOUSE_NO }}">
                                        @error('COMM_HOUSE_NO') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="COMM_LANDMARK" class="col-sm-2 col-form-label">Communication Land Mark
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_LANDMARK') {{ 'is-invalid' }} @enderror"
                                            id="COMM_LANDMARK" name="COMM_LANDMARK" placeholder="Communication Land Mark"
                                            value="{{ old('COMM_LANDMARK') ? old('COMM_LANDMARK') : $data->user->COMM_LANDMARK }}">
                                        @error('COMM_LANDMARK') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="COMM_Street" class="col-sm-2 col-form-label">Communication Street
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_Street') {{ 'is-invalid' }} @enderror"
                                            id="COMM_Street" name="COMM_Street" placeholder="Communication Street"
                                            value="{{ old('COMM_Street') ? old('COMM_Street') : $data->user->COMM_Street }}">
                                        @error('COMM_Street') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="COMM_LOCALITY" class="col-sm-2 col-form-label">Communication Locality
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_LOCALITY') {{ 'is-invalid' }} @enderror"
                                            id="COMM_LOCALITY" name="COMM_LOCALITY" placeholder="Communication Locality"
                                            value="{{ old('COMM_LOCALITY') ? old('COMM_LOCALITY') : $data->user->COMM_LOCALITY }}">
                                        @error('COMM_LOCALITY') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="COMM_PINCODE" class="col-sm-2 col-form-label">Communication Pincode
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_PINCODE') {{ 'is-invalid' }} @enderror"
                                            id="COMM_PINCODE" name="COMM_PINCODE" placeholder="Communication Pincode"
                                            value="{{ old('COMM_PINCODE') ? old('COMM_PINCODE') : $data->user->COMM_PINCODE }}">
                                        @error('COMM_PINCODE') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="COMM_Country" class="col-sm-2 col-form-label">Communication Country
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_Country') {{ 'is-invalid' }} @enderror"
                                            id="COMM_Country" name="COMM_Country" placeholder="Communication Country"
                                            value="{{ old('COMM_Country') ? old('COMM_Country') : $data->user->COMM_Country }}">
                                        @error('COMM_Country') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="COMM_State" class="col-sm-2 col-form-label">Communication State
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_State') {{ 'is-invalid' }} @enderror"
                                            id="COMM_State" name="COMM_State" placeholder="Communication State"
                                            value="{{ old('COMM_State') ? old('COMM_State') : $data->user->COMM_State }}">
                                        @error('COMM_State') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="COMM_District" class="col-sm-2 col-form-label">Communication District
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_District') {{ 'is-invalid' }} @enderror"
                                            id="COMM_District" name="COMM_District" placeholder="Communication District"
                                            value="{{ old('COMM_District') ? old('COMM_District') : $data->user->COMM_District }}">
                                        @error('COMM_District') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="COMM_POST_OFFICE" class="col-sm-2 col-form-label">Communication Post Office
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_POST_OFFICE') {{ 'is-invalid' }} @enderror"
                                            id="COMM_POST_OFFICE" name="COMM_POST_OFFICE" placeholder="Communication Post Office"
                                            value="{{ old('COMM_POST_OFFICE') ? old('COMM_POST_OFFICE') : $data->user->COMM_POST_OFFICE }}">
                                        @error('COMM_POST_OFFICE') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="COMM_CITY" class="col-sm-2 col-form-label">Communiation City
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_CITY') {{ 'is-invalid' }} @enderror"
                                            id="COMM_CITY" name="COMM_CITY" placeholder="Communiation City"
                                            value="{{ old('COMM_CITY') ? old('COMM_CITY') : $data->user->COMM_CITY }}">
                                        @error('COMM_CITY') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="COMM_Taluka" class="col-sm-2 col-form-label">Communication Taluka
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_Taluka') {{ 'is-invalid' }} @enderror"
                                            id="COMM_Taluka" name="COMM_Taluka" placeholder="Communication Taluka"
                                            value="{{ old('COMM_Taluka') ? old('COMM_Taluka') : $data->user->COMM_Taluka }}">
                                        @error('COMM_Taluka') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="COMM_Population_Group" class="col-sm-2 col-form-label">Communication Population Group
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('COMM_Population_Group') {{ 'is-invalid' }} @enderror"
                                            id="COMM_Population_Group" name="COMM_Population_Group" placeholder="Communication Population Group"
                                            value="{{ old('COMM_Population_Group') ? old('COMM_Population_Group') : $data->user->COMM_Population_Group }}">
                                        @error('COMM_Population_Group') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Social_Media" class="col-sm-2 col-form-label">Social Media
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Social_Media') {{ 'is-invalid' }} @enderror"
                                            id="Social_Media" name="Social_Media" placeholder="Social Media"
                                            value="{{ old('Social_Media') ? old('Social_Media') : $data->user->Social_Media }}">
                                        @error('Social_Media') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="Social_Media_ID" class="col-sm-2 col-form-label">Social Media ID
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Social_Media_ID') {{ 'is-invalid' }} @enderror"
                                            id="Social_Media_ID" name="Social_Media_ID" placeholder="Social Media ID"
                                            value="{{ old('Social_Media_ID') ? old('Social_Media_ID') : $data->user->Social_Media_ID }}">
                                        @error('Social_Media_ID') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="PROFESSION" class="col-sm-2 col-form-label">Profession
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('PROFESSION') {{ 'is-invalid' }} @enderror"
                                            id="PROFESSION" name="PROFESSION" placeholder="Profession"
                                            value="{{ old('PROFESSION') ? old('PROFESSION') : $data->user->PROFESSION }}">
                                        @error('PROFESSION') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="EDUCATION" class="col-sm-2 col-form-label">Education
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('EDUCATION') {{ 'is-invalid' }} @enderror"
                                            id="EDUCATION" name="EDUCATION" placeholder="Education"
                                            value="{{ old('EDUCATION') ? old('EDUCATION') : $data->user->EDUCATION }}">
                                        @error('EDUCATION') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ORGANISATION_NAME	" class="col-sm-2 col-form-label">Organisation Name	
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('ORGANISATION_NAME') {{ 'is-invalid' }} @enderror"
                                            id="ORGANISATION_NAME" name="ORGANISATION_NAME" placeholder="Organigation Name"
                                            value="{{ old('ORGANISATION_NAME') ? old('ORGANISATION_NAME') : $data->user->ORGANISATION_NAME}}">
                                        @error('ORGANISATION_NAME') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="NET_INCOME" class="col-sm-2 col-form-label">Net Income
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('NET_INCOME') {{ 'is-invalid' }} @enderror"
                                            id="NET_INCOME" name="NET_INCOME" placeholder="Net Income"
                                            value="{{ old('NET_INCOME') ? old('NET_INCOME') : $data->user->NET_INCOME }}">
                                        @error('NET_INCOME') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="NET_EXPENSE" class="col-sm-2 col-form-label">Net Expense
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('NET_EXPENSE') {{ 'is-invalid' }} @enderror"
                                            id="NET_EXPENSE" name="NET_EXPENSE" placeholder="Net Expense"
                                            value="{{ old('NET_EXPENSE') ? old('NET_EXPENSE') : $data->user->NET_EXPENSE }}">
                                        @error('NET_EXPENSE') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="NET_SAVINGS" class="col-sm-2 col-form-label">Net Savings
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('NET_SAVINGS') {{ 'is-invalid' }} @enderror"
                                            id="NET_SAVINGS" name="NET_SAVINGS" placeholder="Net Savings"
                                            value="{{ old('NET_SAVINGS') ? old('NET_SAVINGS') : $data->user->NET_SAVINGS }}">
                                        @error('NET_SAVINGS') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Years_in_Organization" class="col-sm-2 col-form-label">Years in Organization
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Years_in_Organization') {{ 'is-invalid' }} @enderror"
                                            id="Years_in_Organization" name="Years_in_Organization" placeholder="Years in Organization"
                                            value="{{ old('Years_in_Organization') ? old('Years_in_Organization') : $data->user->Years_in_Organization }}">
                                        @error('Years_in_Organization') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="CIBIL_SCORE" class="col-sm-2 col-form-label">Cibil Score
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('CIBIL_SCORE') {{ 'is-invalid' }} @enderror"
                                            id="CIBIL_SCORE" name="CIBIL_SCORE" placeholder="Cibil Score"
                                            value="{{ old('CIBIL_SCORE') ? old('CIBIL_SCORE') : $data->user->CIBIL_SCORE }}">
                                        @error('CIBIL_SCORE') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="PERSONAL_LOAN_SCORE" class="col-sm-2 col-form-label">Personal Loan Score
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('PERSONAL_LOAN_SCORE') {{ 'is-invalid' }} @enderror"
                                            id="PERSONAL_LOAN_SCORE" name="PERSONAL_LOAN_SCORE" placeholder="Personal Loan Score"
                                            value="{{ old('PERSONAL_LOAN_SCORE') ? old('PERSONAL_LOAN_SCORE') : $data->user->PERSONAL_LOAN_SCORE }}">
                                        @error('PERSONAL_LOAN_SCORE') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="GST_EXEMPTED" class="col-sm-2 col-form-label">GST EXEMPTED
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('GST_EXEMPTED') {{ 'is-invalid' }} @enderror"
                                            id="GST_EXEMPTED" name="GST_EXEMPTED" placeholder="GST EXEMPTED"
                                            value="{{ old('GST_EXEMPTED') ? old('GST_EXEMPTED') : $data->user->GST_EXEMPTED }}">
                                        @error('GST_EXEMPTED') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="RM_EMP_ID" class="col-sm-2 col-form-label">RM EMP ID
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('RM_EMP_ID') {{ 'is-invalid' }} @enderror"
                                            id="RM_EMP_ID" name="RM_EMP_ID" placeholder="RM EMP ID"
                                            value="{{ old('RM_EMP_ID') ? old('RM_EMP_ID') : $data->user->RM_EMP_ID }}">
                                        @error('RM_EMP_ID') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="RM_Designation" class="col-sm-2 col-form-label">RM Designation
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('RM_Designation') {{ 'is-invalid' }} @enderror"
                                            id="RM_Designation" name="RM_Designation" placeholder="RM Designation"
                                            value="{{ old('RM_Designation') ? old('RM_Designation') : $data->user->RM_Designation }}">
                                        @error('RM_Designation') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="RM_TITLE" class="col-sm-2 col-form-label">RM Title
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('RM_TITLE') {{ 'is-invalid' }} @enderror"
                                            id="RM_TITLE" name="RM_TITLE" placeholder="RM Title"
                                            value="{{ old('RM_TITLE') ? old('RM_TITLE') : $data->user->RM_TITLE }}">
                                        @error('RM_TITLE') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="RM_NAME" class="col-sm-2 col-form-label">RM Name
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('RM_NAME') {{ 'is-invalid' }} @enderror"
                                            id="RM_NAME" name="RM_NAME" placeholder="RM Name"
                                            value="{{ old('RM_NAME') ? old('RM_NAME') : $data->user->RM_NAME }}">
                                        @error('RM_NAME') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="RM_Landline_No" class="col-sm-2 col-form-label">RM Landline No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('RM_Landline_No') {{ 'is-invalid' }} @enderror"
                                            id="RM_Landline_No" name="RM_Landline_No" placeholder="RM Landline No"
                                            value="{{ old('RM_Landline_No') ? old('RM_Landline_No') : $data->user->RM_Landline_No }}">
                                        @error('RM_Landline_No') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="RM_MOBILE_NO" class="col-sm-2 col-form-label">RM Mobile No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('RM_MOBILE_NO') {{ 'is-invalid' }} @enderror"
                                            id="RM_MOBILE_NO" name="RM_MOBILE_NO" placeholder="RM Mobile No"
                                            value="{{ old('RM_MOBILE_NO') ? old('RM_MOBILE_NO') : $data->user->RM_MOBILE_NO }}">
                                        @error('RM_MOBILE_NO') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="RM_EMAIL_ID" class="col-sm-2 col-form-label">RM Email Id
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('RM_EMAIL_ID') {{ 'is-invalid' }} @enderror"
                                            id="RM_EMAIL_ID" name="RM_EMAIL_ID" placeholder="RM Email Id"
                                            value="{{ old('RM_EMAIL_ID') ? old('RM_EMAIL_ID') : $data->user->RM_EMAIL_ID }}">
                                        @error('RM_EMAIL_ID') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="DSA_ID" class="col-sm-2 col-form-label">DSA ID
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('DSA_ID') {{ 'is-invalid' }} @enderror"
                                            id="DSA_ID" name="DSA_ID" placeholder="DSA ID"
                                            value="{{ old('DSA_ID') ? old('DSA_ID') : $data->user->DSA_ID }}">
                                        @error('DSA_ID') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="DSA_NAME" class="col-sm-2 col-form-label">DSA Name
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('DSA_NAME') {{ 'is-invalid' }} @enderror"
                                            id="DSA_NAME" name="DSA_NAME" placeholder="DSA Name"
                                            value="{{ old('DSA_NAME') ? old('DSA_NAME') : $data->user->DSA_NAME }}">
                                        @error('DSA_NAME') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 



                                <div class="form-group row">
                                    <label for="DSA_LANDLINE_NO" class="col-sm-2 col-form-label">DSA Landline No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('DSA_LANDLINE_NO') {{ 'is-invalid' }} @enderror"
                                            id="DSA_LANDLINE_NO" name="DSA_LANDLINE_NO" placeholder="DSA Landline No"
                                            value="{{ old('DSA_LANDLINE_NO') ? old('DSA_LANDLINE_NO') : $data->user->DSA_LANDLINE_NO }}">
                                        @error('DSA_LANDLINE_NO') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="DSA_MOBILE_NO" class="col-sm-2 col-form-label">DSA Mobile No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('DSA_MOBILE_NO') {{ 'is-invalid' }} @enderror"
                                            id="DSA_MOBILE_NO" name="DSA_MOBILE_NO" placeholder="DSA Mobie No"
                                            value="{{ old('DSA_MOBILE_NO') ? old('DSA_MOBILE_NO') : $data->user->DSA_MOBILE_NO }}">
                                        @error('DSA_MOBILE_NO') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="DSA_EMAIL_ID" class="col-sm-2 col-form-label">DSA Email Id
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('DSA_EMAIL_ID') {{ 'is-invalid' }} @enderror"
                                            id="DSA_EMAIL_ID" name="DSA_EMAIL_ID" placeholder="DSA Email Id"
                                            value="{{ old('DSA_EMAIL_ID') ? old('DSA_EMAIL_ID') : $data->user->DSA_EMAIL_ID }}">
                                        @error('DSA_EMAIL_ID') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="GIR_NO" class="col-sm-2 col-form-label">GIR No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('GIR_NO') {{ 'is-invalid' }} @enderror"
                                            id="GIR_NO" name="GIR_NO" placeholder="GIR No"
                                            value="{{ old('GIR_NO') ? old('GIR_NO') : $data->user->GIR_NO }}">
                                        @error('GIR_NO') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="RATION_CARD_NO" class="col-sm-2 col-form-label">Ration Card No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('RATION_CARD_NO') {{ 'is-invalid' }} @enderror"
                                            id="RATION_CARD_NO" name="RATION_CARD_NO" placeholder="Ration Card No"
                                            value="{{ old('RATION_CARD_NO') ? old('RATION_CARD_NO') : $data->user->RATION_CARD_NO }}">
                                        @error('RATION_CARD_NO') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 


                                <div class="form-group row">
                                    <label for="DRIVING_LINC" class="col-sm-2 col-form-label">Driving License
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('DRIVING_LINC') {{ 'is-invalid' }} @enderror"
                                            id="DRIVING_LINC" name="DRIVING_LINC" placeholder="Driving License"
                                            value="{{ old('DRIVING_LINC') ? old('DRIVING_LINC') : $data->user->DRIVING_LINC }}">
                                        @error('DRIVING_LINC') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="NPR_NO" class="col-sm-2 col-form-label">NPR No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('NPR_NO') {{ 'is-invalid' }} @enderror"
                                            id="NPR_NO" name="NPR_NO" placeholder="NPR No"
                                            value="{{ old('NPR_NO') ? old('NPR_NO') : $data->user->NPR_NO }}">
                                        @error('NPR_NO') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="PASSPORT_NO" class="col-sm-2 col-form-label">Passport No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('PASSPORT_NO') {{ 'is-invalid' }} @enderror"
                                            id="PASSPORT_NO" name="PASSPORT_NO" placeholder="Passport No"
                                            value="{{ old('PASSPORT_NO') ? old('PASSPORT_NO') : $data->user->PASSPORT_NO }}">
                                        @error('PASSPORT_NO') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="EXPORTER_CODE" class="col-sm-2 col-form-label">Exporter Code
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('EXPORTER_CODE') {{ 'is-invalid' }} @enderror"
                                            id="EXPORTER_CODE" name="EXPORTER_CODE" placeholder="Exporter Code"
                                            value="{{ old('EXPORTER_CODE') ? old('EXPORTER_CODE') : $data->user->EXPORTER_CODE }}">
                                        @error('EXPORTER_CODE') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="GST_NO" class="col-sm-2 col-form-label">GST No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('GST_NO') {{ 'is-invalid' }} @enderror"
                                            id="GST_NO" name="GST_NO" placeholder="GST No"
                                            value="{{ old('GST_NO') ? old('GST_NO') : $data->user->GST_NO }}">
                                        @error('GST_NO') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="Voter_ID	" class="col-sm-2 col-form-label">Voter Id
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Voter_ID') {{ 'is-invalid' }} @enderror"
                                            id="Voter_ID" name="Voter_ID" placeholder="Voter Id"
                                            value="{{ old('Voter_ID') ? old('Voter_ID') : $data->user->Voter_ID }}">
                                        @error('Voter_ID') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 


                                <div class="form-group row">
                                    <label for="CUSTM_2" class="col-sm-2 col-form-label">CUSTM 2
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('CUSTM_2') {{ 'is-invalid' }} @enderror"
                                            id="CUSTM_2" name="CUSTM_2" placeholder="CUSTM 2"
                                            value="{{ old('CUSTM_2') ? old('CUSTM_2') : $data->user->CUSTM_2 }}">
                                        @error('CUSTM_2') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="CATEGORY" class="col-sm-2 col-form-label">Category
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('CATEGORY') {{ 'is-invalid' }} @enderror"
                                            id="CATEGORY" name="CATEGORY" placeholder="Category"
                                            value="{{ old('CATEGORY') ? old('CATEGORY') : $data->user->CATEGORY }}">
                                        @error('CATEGORY') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="RELIGION" class="col-sm-2 col-form-label">religion
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('RELIGION') {{ 'is-invalid' }} @enderror"
                                            id="RELIGION" name="RELIGION" placeholder="Religion"
                                            value="{{ old('RELIGION') ? old('RELIGION') : $data->user->RELIGION }}">
                                        @error('RELIGION') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="MINORITY_STATUS" class="col-sm-2 col-form-label">Minority Status
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('MINORITY_STATUS') {{ 'is-invalid' }} @enderror"
                                            id="MINORITY_STATUS" name="MINORITY_STATUS" placeholder="Minority status"
                                            value="{{ old('MINORITY_STATUS') ? old('MINORITY_STATUS') : $data->user->MINORITY_STATUS }}">
                                        @error('MINORITY_STATUS') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="CASTE" class="col-sm-2 col-form-label">Cast
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('CASTE') {{ 'is-invalid' }} @enderror"
                                            id="CASTE" name="CASTE" placeholder="Cast"
                                            value="{{ old('CASTE') ? old('CASTE') : $data->user->CASTE }}">
                                        @error('CASTE') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 


                                <div class="form-group row">
                                    <label for="SUB_CAST" class="col-sm-2 col-form-label">Sub Cast
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('SUB_CAST') {{ 'is-invalid' }} @enderror"
                                            id="SUB_CAST" name="SUB_CAST" placeholder="Sub Cast"
                                            value="{{ old('SUB_CAST') ? old('SUB_CAST') : $data->user->SUB_CAST }}">
                                        @error('SUB_CAST') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="RESERVATION_TYP" class="col-sm-2 col-form-label">Rservation Type
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('RESERVATION_TYP') {{ 'is-invalid' }} @enderror"
                                            id="RESERVATION_TYP" name="RESERVATION_TYP" placeholder="Reservation Type"
                                            value="{{ old('RESERVATION_TYP') ? old('RESERVATION_TYP') : $data->user->RESERVATION_TYP }}">
                                        @error('RESERVATION_TYP') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="Physically_Challenged" class="col-sm-2 col-form-label">Physically Challenged
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Physically_Challenged') {{ 'is-invalid' }} @enderror"
                                            id="Physically_Challenged" name="Physically Challenged" placeholder="Physically_Challenged"
                                            value="{{ old('Physically_Challenged') ? old('Physically_Challenged') : $data->user->Physically_Challenged }}">
                                        @error('Physically_Challenged') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="Weaker_Section" class="col-sm-2 col-form-label">Weaker Section
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Weaker_Section') {{ 'is-invalid' }} @enderror"
                                            id="Weaker_Section" name="Weaker_Section" placeholder="Weaker Section"
                                            value="{{ old('Weaker_Section') ? old('Weaker_Section') : $data->user->Weaker_Section }}">
                                        @error('Weaker_Section') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="Valued_Customer" class="col-sm-2 col-form-label">Valued Customer
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Valued_Customer') {{ 'is-invalid' }} @enderror"
                                            id="Valued_Customer" name="Valued_Customer" placeholder="Valued Customer"
                                            value="{{ old('Valued_Customer') ? old('Valued_Customer') : $data->user->Valued_Customer }}">
                                        @error('Valued_Customer') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div> 


                                <div class="form-group row">
                                    <label for="Special_Category_1" class="col-sm-2 col-form-label">Special Category 1
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Special_Category_1') {{ 'is-invalid' }} @enderror"
                                            id="Special_Category_1" name="Special Category 1" placeholder="Special_Category_1"
                                            value="{{ old('Special_Category_1') ? old('Special_Category_1') : $data->user->Special_Category_1 }}">
                                        @error('Special_Category_1') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Vip_Category" class="col-sm-2 col-form-label">Vip Category
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Vip_Category') {{ 'is-invalid' }} @enderror"
                                            id="Vip_Category" name="Vip_Category" placeholder="Vip Category"
                                            value="{{ old('Vip_Category') ? old('Vip_Category') : $data->user->Vip_Category }}">
                                        @error('Vip_Category') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Special_Category_2" class="col-sm-2 col-form-label">Special Category 2
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Special_Category_2') {{ 'is-invalid' }} @enderror"
                                            id="Special_Category_2" name="Special_Category_2" placeholder="Special Category 2"
                                            value="{{ old('Special_Category_2') ? old('Special_Category_2') : $data->user->Special_Category_2 }}">
                                        @error('Special_Category_2') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Senior_Citizen" class="col-sm-2 col-form-label">Senior Citizen
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Senior_Citizen') {{ 'is-invalid' }} @enderror"
                                            id="Senior_Citizen" name="Senior_Citizen" placeholder="Senior Citizen"
                                            value="{{ old('Senior_Citizen') ? old('Senior_Citizen') : $data->user->Senior_Citizen }}">
                                        @error('Senior_Citizen') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Senior_Citizen_From" class="col-sm-2 col-form-label">Senior Citizen From
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Senior_Citizen_From') {{ 'is-invalid' }} @enderror"
                                            id="Senior_Citizen_From" name="Senior_Citizen_From" placeholder="Senior Citizen From"
                                            value="{{ old('Senior_Citizen_From') ? old('Senior_Citizen_From') : $data->user->Senior_Citizen_From }}">
                                        @error('Senior_Citizen_From') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="NO_OF_DEPEND" class="col-sm-2 col-form-label">No Of Depend
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('NO_OF_DEPEND') {{ 'is-invalid' }} @enderror"
                                            id="NO_OF_DEPEND" name="NO_OF_DEPEND" placeholder="No Of Depend"
                                            value="{{ old('NO_OF_DEPEND') ? old('NO_OF_DEPEND') : $data->user->NO_OF_DEPEND }}">
                                        @error('NO_OF_DEPEND') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="SPOUSE" class="col-sm-2 col-form-label">Spouse
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('SPOUSE') {{ 'is-invalid' }} @enderror"
                                            id="SPOUSE" name="SPOUSE" placeholder="Spouse"
                                            value="{{ old('SPOUSE') ? old('SPOUSE') : $data->user->SPOUSE }}">
                                        @error('SPOUSE') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="CHILDREN" class="col-sm-2 col-form-label">Children
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('CHILDREN') {{ 'is-invalid' }} @enderror"
                                            id="CHILDREN" name="CHILDREN" placeholder="Children"
                                            value="{{ old('CHILDREN') ? old('CHILDREN') : $data->user->CHILDREN }}">
                                        @error('CHILDREN') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="PARENTS" class="col-sm-2 col-form-label">Parents
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('PARENTS') {{ 'is-invalid' }} @enderror"
                                            id="PARENTS" name="PARENTS" placeholder="Parents"
                                            value="{{ old('PARENTS') ? old('PARENTS') : $data->user->PARENTS }}">
                                        @error('PARENTS') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Employee_Staus" class="col-sm-2 col-form-label">Employee_Staus
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Employee_Staus') {{ 'is-invalid' }} @enderror"
                                            id="Employee_Staus" name="Employee_Staus" placeholder="Employee_Staus"
                                            value="{{ old('Employee_Staus') ? old('Employee_Staus') : $data->user->Employee_Staus }}">
                                        @error('Employee_Staus') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Employee_No" class="col-sm-2 col-form-label">Employee No
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Employee_No') {{ 'is-invalid' }} @enderror"
                                            id="Employee_No" name="Employee_No" placeholder="Employee No"
                                            value="{{ old('Employee_No') ? old('Employee_No') : $data->user->Employee_No }}">
                                        @error('Employee_No') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="EMP_Date" class="col-sm-2 col-form-label">EMP Date
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('EMP_Date') {{ 'is-invalid' }} @enderror"
                                            id="EMP_Date" name="EMP_Date" placeholder="EMP Date"
                                            value="{{ old('EMP_Date') ? old('EMP_Date') : $data->user->EMP_Date }}">
                                        @error('EMP_Date') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Nature_of_Occupation" class="col-sm-2 col-form-label">Nature of Occupation
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Nature_of_Occupation') {{ 'is-invalid' }} @enderror"
                                            id="Nature_of_Occupation" name="Nature_of_Occupation" placeholder="Nature of Occupation"
                                            value="{{ old('Nature_of_Occupation') ? old('Nature_of_Occupation') : $data->user->Nature_of_Occupation }}">
                                        @error('Valued_Customer') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="EMPLYEER_NAME" class="col-sm-2 col-form-label">Employer Name
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('EMPLYEER_NAME') {{ 'is-invalid' }} @enderror"
                                            id="EMPLYEER_NAME" name="EMPLYEER_NAME" placeholder="Employer Name"
                                            value="{{ old('EMPLYEER_NAME') ? old('EMPLYEER_NAME') : $data->user->EMPLYEER_NAME }}">
                                        @error('EMPLYEER_NAME') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Role" class="col-sm-2 col-form-label">Role
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Role') {{ 'is-invalid' }} @enderror"
                                            id="Role" name="Role" placeholder="Role"
                                            value="{{ old('Role') ? old('Role') : $data->user->Role }}">
                                        @error('Role') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="SPECIALIZATION" class="col-sm-2 col-form-label">Specialization
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('SPECIALIZATION') {{ 'is-invalid' }} @enderror"
                                            id="SPECIALIZATION" name="SPECIALIZATION" placeholder="Specialization"
                                            value="{{ old('SPECIALIZATION') ? old('SPECIALIZATION') : $data->user->SPECIALIZATION }}">
                                        @error('SPECIALIZATION') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="EMP_GRADE" class="col-sm-2 col-form-label">EMP Grade
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('EMP_GRADE') {{ 'is-invalid' }} @enderror"
                                            id="EMP_GRADE" name="EMP_GRADE" placeholder="EMP Grade"
                                            value="{{ old('EMP_GRADE') ? old('EMP_GRADE') : $data->user->EMP_GRADE }}">
                                        @error('EMP_GRADE') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="DESIGNATION" class="col-sm-2 col-form-label">Designation
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('DESIGNATION') {{ 'is-invalid' }} @enderror"
                                            id="DESIGNATION" name="DESIGNATION" placeholder="DESIGNATION"
                                            value="{{ old('DESIGNATION') ? old('DESIGNATION') : $data->user->DESIGNATION }}">
                                        @error('DESIGNATION') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Office_Address" class="col-sm-2 col-form-label">Office Address
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Office_Address') {{ 'is-invalid' }} @enderror"
                                            id="Office_Address" name="Office_Address" placeholder="Office Address"
                                            value="{{ old('Office_Address') ? old('Office_Address') : $data->user->Office_Address }}">
                                        @error('Office_Address') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Office_Phone" class="col-sm-2 col-form-label">Office Phone
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Office_Phone') {{ 'is-invalid' }} @enderror"
                                            id="Office_Phone" name="Office_Phone" placeholder="Office Phone"
                                            value="{{ old('Office_Phone') ? old('Office_Phone') : $data->user->Office_Phone }}">
                                        @error('Office_Phone') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Office_EXTENSION" class="col-sm-2 col-form-label">Office 
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('Office_EXTENSION') {{ 'is-invalid' }} @enderror"
                                            id="Office_EXTENSION" name="Office_EXTENSION" placeholder="Office_EXTENSION"
                                            value="{{ old('Office_EXTENSION') ? old('Office_EXTENSION') : $data->user->Office_EXTENSION }}">
                                        @error('Office_EXTENSION') <p class="small mb-0 text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                

                                <div class="form-group row" style="position: sticky;bottom: -1px;z-index: 99;background-color: #e9e9e9;text-align: right;padding: 5px 0;">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-sm btn-primary">Update changes <i class="fas fa-edit"></i></button>
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
