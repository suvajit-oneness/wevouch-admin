@extends('layouts.auth.master')

@section('title', 'Documents for '.$data->agreement->name)

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
                                <a href="javascript: void(0)" class="btn btn-sm btn-primary" onclick="openSidebarModal()"><i class="fas fa-plus"></i> Create</a>
                                <a href="{{route('user.agreement.list')}}" class="btn btn-sm btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="agreement_id" id="agreement_id" value="{{request()->id}}">
                            <table class="table table-sm table-bordered table-hover" id="showOfficeTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Documents</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data->documents as $index => $item)
                                        <tr id="tr_{{ $item->id }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <ul>
                                                @foreach ($item->siblingsDocuments as $subItem)
                                                    <li>{{$subItem->name}}</li>
                                                @endforeach
                                                </ul>
                                            </td>
                                            <td class="text-right">
                                                <a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls('{{ route('user.agreement.documents.show') }}', {{ $item->id }}, 'view')">View</a>

                                                {{-- <a href="javascript: void(0)" class="badge badge-dark action-button" title="Edit" onclick="viewDeta1ls('{{ route('user.agreement.documents.show') }}', {{ $item->id }}, 'edit')">Edit</a> --}}

                                                <a href="javascript: void(0)" class="badge badge-dark action-button" title="Delete" onclick="confirm4lert('{{ route('user.agreement.documents.destroy') }}', {{ $item->id }}, 'delete')">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted" colspan="100%"><em>No records found</em></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // create
        function openSidebarModal() {
            let content = '';
            let docData = '<option value="" selected hidden>Select parent</option>';
            docData += '<option value="">NO parent</option>';
            @foreach ($data->documents as $index => $item)
                docData += '<option value="{{$item->id}}">{{$item->name}}</option>';
            @endforeach

            content += '<div class="alert rounded-0 px-2 py-1 small" id="newOfficeAlert" style="display:none"></div>';

            content += '<p class="text-dark small mb-1">Name <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="name" id="nameCreate" placeholder="Document name">';

            content += '<p class="text-dark small mb-1">Parent <span class="text-danger">*</span></p><select class="form-control form-control-sm mb-2" name="parent" id="parentCreate">'+docData+'</select>';

            $('#userDetails .modal-content').append('<div class="modal-footer text-right"><a href="javascript: void(0)" class="btn btn-sm btn-success" onclick="storeDocument()">Save changes <i class="fas fa-upload"></i> </a></div>'
            );
            $('#appendContent').html(content);
            $('#userDetailsModalLabel').text('Add new document');
            $('#userDetails').modal('show');
        }

        // store
        function storeDocument() {
            $('#newOfficeAlert').removeClass('alert-danger alert-success').html('').hide();
            $.ajax({
                url: '{{ route('user.agreement.documents.store') }}',
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    agreement_id: $('#agreement_id').val(),
                    name: $('#nameCreate').val(),
                    parent: $('#parentCreate').val(),
                },
                success: function(result) {
                    $("#userDetails .modal-body").animate({scrollTop: $("#userDetails .modal-body").offset().top - 60});
                    if (result.status == 200) {
                        $('#newOfficeAlert').addClass('alert-success').html(result.message).show();

                        if ($('#parentCreate').val().length == 0) {
                            let viewVar = "'view'";
                            let newData = '';
                            newData += '<td>1</td>';
                            newData += '<td>' + $('#nameCreate').val() + '</td><td></td>';

                            newData +='<td class="text-right"><a href="javascript: void(0)" class="badge badge-dark action-button" title="View" onclick="viewDeta1ls(' + result.viewRoute + ', ' + result.id + ', ' + viewVar + ')">View</a></td>';

                            $('#showOfficeTable').prepend('<tr>' + newData + '</tr>');
                        }
                        setTimeout(() => {
                            window.location = "{{route('user.agreement.documents.list', request()->id)}}";
                        }, 2000);
                    } else {
                        $('#newOfficeAlert').addClass('alert-danger').html(result.message).show();
                    }
                }
            });
        }

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
                            content += '<p class="text-muted small mb-1">Name</p><h6>' + result.data.name + '</h6>';
                            content += '<hr>';
                            content += '<p class="text-muted small mb-1">Comes under</p>';
                            content += '<table class="table table-sm table-bordered table-hover table-striped">';
                            $.each(result.data.children, function(key, value) {
                                let deleteRouteShow = "'{{route("user.agreement.documents.destroy")}}'";
                                let deleteShow = "'delete'";
                                let subShow = "'sub'";

                                content += '<tr id="tr_sub_'+value.id+'"><td>'+value.name+'</td><td class="text-right"><a href="javascript: void(0)" class="badge badge-danger rounded-0" title="Delete" onclick="confirm4lert('+deleteRouteShow+', '+value.id+', '+deleteShow+', '+subShow+')"><i class="fas fa-trash"></i></a></td></tr>';
                            });
                            content += '</table>';
                            $('#userDetailsModalLabel').text('Document details');
                        } else {
                            content += '<div class="alert rounded-0 px-2 py-1 small" id="updateOfficeAlert" style="display:none"></div>';
                            content += '<p class="text-dark small mb-1">Name <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="name" id="nameEdit" placeholder="Office name" value="'+result.data.name+'">';
                            content += '<p class="text-dark small mb-1">Code <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="code" id="codeEdit" placeholder="Office code" value="'+result.data.code+'">';
                            content += '<p class="text-dark small mb-1">Email <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="email" id="emailEdit" placeholder="Office email" value="'+result.data.email+'">';
                            content += '<p class="text-dark small mb-1">Phone number <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="mobile" id="mobileEdit" placeholder="Office phone number" value="'+result.data.mobile+'">';
                            content += '<p class="text-dark small mb-1">Address <span class="text-danger">*</span></p><input type="text" class="form-control form-control-sm mb-2" name="street_address" id="street_addressEdit" placeholder="Street address" value="'+result.data.street_address+'">';
                            content += '<input type="text" class="form-control form-control-sm mb-2" name="pincode" id="pincodeEdit" placeholder="Pincode" value="'+result.data.pincode+'">';
                            content += '<input type="text" class="form-control form-control-sm mb-2" name="city" id="cityEdit" placeholder="City" value="'+result.data.city+'">';
                            content += '<input type="text" class="form-control form-control-sm mb-2" name="state" id="stateEdit" placeholder="State" value="'+result.data.state+'">';
                            content += '<p class="text-dark small mb-1">Comment</p><textarea class="form-control form-control-sm mb-2" name="street_address" id="commentEdit" placeholder="Comment" style="min-height:90px;max-height:200px">'+result.data.comment+'</textarea>';
                            content += '<input type="hidden" id="editId" value="'+result.data.id+'">';

                            $('#userDetails .modal-content').append('<div class="modal-footer text-right"><a href="javascript: void(0)" class="btn btn-sm btn-success" onclick="updateOffice()">Update changes <i class="fas fa-upload"></i> </a></div>'
                            );

                            $('#userDetailsModalLabel').text('Edit office');
                        }
                    } else {
                        content += '<p class="text-muted small mb-1">No data found. Try again</p>';
                    }
                    $('#appendContent').html(content);
                    $('#userDetails').modal('show');
                }
            });
        }

        // update
        function updateOffice() {
            $('#updateOfficeAlert').removeClass('alert-danger alert-success').html('').hide();
            $.ajax({
                url: '{{ route('user.office.update') }}',
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: $('#editId').val(),
                    name: $('#nameEdit').val(),
                    code: $('#codeEdit').val(),
                    email: $('#emailEdit').val(),
                    mobile: $('#mobileEdit').val(),
                    streetAddress: $('#street_addressEdit').val(),
                    pincode: $('#pincodeEdit').val(),
                    city: $('#cityEdit').val(),
                    state: $('#stateEdit').val(),
                    comment: $('#commentEdit').val(),
                },
                success: function(result) {
                    $("#userDetails .modal-body").animate({scrollTop: $("#userDetails .modal-body").offset().top - 60});
                    if (result.status == 200) {
                        // updating new data
                        $('#showOfficeTable #tr_'+$('#editId').val()+' td').eq(1).html($('#nameEdit').val());
                        $('#showOfficeTable #tr_'+$('#editId').val()+' td').eq(2).html($('#codeEdit').val());
                        $('#showOfficeTable #tr_'+$('#editId').val()+' td').eq(3).html('<p class="small text-dark mb-1"><i class="fas fa-envelope mr-2"></i> '+$('#emailEdit').val()+'</p><p class="small text-dark mb-1"><i class="fas fa-phone fa-rotate-90 mr-2"></i> '+$('#mobileEdit').val()+'</p>');
                        $('#showOfficeTable #tr_'+$('#editId').val()+' td').eq(4).html($('#cityEdit').val()+', '+$('#pincodeEdit').val());
                        $('#updateOfficeAlert').addClass('alert-success').html(result.message).show();

                        setTimeout(() => {
                            $('#userDetails').modal('hide');
                        }, 3500);
                    } else {
                        $('#updateOfficeAlert').addClass('alert-danger').html(result.message).show();
                    }
                }
            });
        }
    </script>
@endsection
