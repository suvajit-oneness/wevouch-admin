@extends('layouts.auth.master')

@section('title', 'Create new agreement')

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
                            <a href="{{route('user.agreement.list')}}" class="btn btn-sm btn-primary"> <i class="fas fa-chevron-left"></i> Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('user.agreement.store') }}" id="profile-form">
                        @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') {{'is-invalid'}} @enderror" id="name" name="name" placeholder="Agreement name" value="{{old('name')}}" autofocus>
                                    @error('name') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Description <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control @error('description') {{'is-invalid'}} @enderror" id="description" placeholder="Agreement description" style="min-height: 100px;max-height: 200px">{{old('description')}}</textarea>
                                    @error('description') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="authorised_signatory" class="col-sm-2 col-form-label">Authorised signatory</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('authorised_signatory') {{'is-invalid'}} @enderror" id="authorised_signatory" name="authorised_signatory" placeholder="Authorised signatory" value="{{old('authorised_signatory')}}">
                                    @error('authorised_signatory') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="borrower" class="col-sm-2 col-form-label">Borrower</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('borrower') {{'is-invalid'}} @enderror" id="borrower" name="borrower" placeholder="Borrower" value="{{old('borrower')}}">
                                    @error('borrower') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="co_borrower" class="col-sm-2 col-form-label">Co-borrower</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('co_borrower') {{'is-invalid'}} @enderror" id="co_borrower" name="co_borrower" placeholder="Co-borrower" value="{{old('co_borrower')}}">
                                    @error('co_borrower') <p class="small mb-0 text-danger">{{$message}}</p> @enderror
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