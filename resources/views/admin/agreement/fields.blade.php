@extends('layouts.auth.master')

@section('title', 'Fields for agreement')

@section('content')

<link rel="stylesheet" href="{{asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">

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
                            <a href="{{route('user.agreement.list')}}" class="btn btn-sm btn-primary"> <i class="fas fa-chevron-left"></i> Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="font-weight-bold">{{$data->agreement->name}}</h5>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls('{{route('user.agreement.show')}}', {{$data->agreement->id}})">Quick view</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <form action="{{route('user.agreement.fields.store')}}" method="POST" class="w-100">
                                @csrf
                                    <div class="form-group">
                                        <label class="text-muted font-weight-light">Setup fields</label>
                                        <select name="field_id[]" id="field_id" class="duallistbox" multiple="multiple">
                                            @foreach($data->fields as $key => $field)
                                                <option value="{{$field->id}}" @if(in_array($field->id, $data->agreementFields)){{('selected')}} @endif>{{$field->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        @error('agreement_id') <p class="small text-danger">{{$message}}</p> @enderror
                                        @error('field_id') <p class="small text-danger">{{$message}}</p> @enderror
                                        <input type="hidden" name="agreement_id" id="agreement_id" value="{{$data->agreement->id}}">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script src="{{asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

    <script>
        function viewDeta1ls(route, id) {
            $.ajax({
                url : route,
                method : 'post',
                data : {'_token' : '{{csrf_token()}}', id : id},
                success : function(result) {
                    console.log(result.data);
                    let content = '';
                    if (result.error == false) {
                        let authorised_signatoryShow = '<em class="text-muted">No data</em>';
                        if (result.data.authorised_signatory.length > 0) {
                            authorised_signatoryShow = result.data.authorised_signatory;
                        }

                        let borrowerShow = '<em class="text-muted">No data</em>';
                        if (result.data.borrower.length > 0) {
                            borrowerShow = result.data.borrower;
                        }

                        let co_borrowerShow = '<em class="text-muted">No data</em>';
                        if (result.data.co_borrower.length > 0) {
                            co_borrowerShow = result.data.co_borrower;
                        }

                        content += '<h6 class="font-weight-bold mb-3">'+result.data.name+'</h6>';
                        content += '<p class="text-muted small mb-0">Description</p>';
                        content += '<p class="text-dark small">'+result.data.description+'</p>';
                        content += '<p class="text-muted small mb-0">Authorised Signatory</p>';
                        content += '<p class="text-dark small">'+authorised_signatoryShow+'</p>';
                        content += '<p class="text-muted small mb-0">Borrower</p>';
                        content += '<p class="text-dark small">'+borrowerShow+'</p>';
                        content += '<p class="text-muted small mb-0">Co-borrower</p>';
                        content += '<p class="text-dark small">'+co_borrowerShow+'</p>';

                        let route = '{{route("user.agreement.details", 'id')}}';
                        route = route.replace('id',result.data.id);
                        $('#userDetails .modal-content').append('<div class="modal-footer"><a href="'+route+'" class="btn btn-sm btn-primary">View details <i class="fa fa-chevron-right"></i> </a></div>');
                    } else {
                        content += '<p class="text-muted small mb-1">No data found. Try again</p>';
                    }
                    $('#appendContent').html(content);
                    $('#userDetailsModalLabel').text('Agreement details');
                    $('#userDetails').modal('show');
                }
            });
        }

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox({
            selectorMinimalHeight : 200
        });


    </script>
@endsection