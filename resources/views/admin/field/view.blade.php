@extends('layouts.auth.master')

@section('title', 'View agreement details')

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
                                <a href="{{ route('user.agreement.list') }}" class="btn btn-sm btn-primary"> <i
                                        class="fas fa-chevron-left"></i> Back</a>

                                <a href="{{ route('user.agreement.edit', $data->id) }}" class="btn btn-sm btn-success"
                                    title="Edit agreement"><i class="fas fa-edit"></i> Edit</a>

                                <a href="javascript: void(0)" class="btn btn-sm btn-danger" title="Delete agreement"
                                    onclick="confirm4lert('{{ route('user.agreement.destroy') }}', {{ $data->id }}, 'delete')"><i
                                        class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="font-weight-bold mb-3">{{ $data->name }}</h6>

                            <p class="text-muted small mb-0">Description</p>
                            <p class="text-dark small mb-0">{{ $data->description }}</p>

                            <hr>

                            <p class="text-muted small mb-0">Authorised Signatory</p>
                            <p class="text-dark small">{{ $data->authorised_signatory }}</p>
                            <p class="text-muted small mb-0">Borrower</p>
                            <p class="text-dark small">{{ $data->borrower }}</p>
                            <p class="text-muted small mb-0">Co-borrower</p>
                            <p class="text-dark small">{{ $data->co_borrower }}</p>
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
