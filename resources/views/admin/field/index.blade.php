@extends('layouts.auth.master')

@section('title', 'Field management')

@section('content')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

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
                            {{-- <a href="{{ route('user.field.create') }}" class="btn btn-sm btn-primary"> <i class="fas fa-plus"></i> Create</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-hover table-striped" id="showRoleTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data->parentFields as $index => $parent)
                                    <tr>
                                        <td colspan="4" class="field-heading">{{$parent->name}}</td>
                                    </tr>
                                    <tr>
                                        @foreach ($parent->childRelation as $index => $item)
                                        {{-- {{$item->childField}} --}}
                                        <tr id="tr_{{ $item->childField->id }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td class="fields_col-1">
                                                <label class="font-weight-bold">{!! $item->childField->name !!} {!! $item->childField->required == 1 ? '<span class="text-danger" title="This field is required">*</span>' : '' !!}
                                                </label>
                                            </td>
                                            <td class="fields_col-2">
                                                {!! form3lements($item->childField->id, $item->childField->name, $item->childField->inputType->name, $item->childField->value, $item->childField->key_name) !!}
                                            </td>
                                            <td class="text-right">
                                                <div class="single-line">
                                                    <a href="{{route('user.field.edit', $item->childField->id)}}" class="badge badge-dark action-button" title="Edit">Edit</a>

                                                    {{-- <a href="javascript: void(0)" class="badge badge-dark action-button" title="Delete" onclick="confirm4lert('{{route('user.field.destroy')}}', {{$item->childField->id}}, 'delete')">Delete</a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%"><em>No records found</em></td>
                                    </tr>
                                @endforelse

                                {{-- @forelse ($data->childFields as $index => $item)
                                    <tr id="tr_{{ $item->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td class="fields_col-1">
                                            <label class="font-weight-bold">{!! $item->name !!} {!! $item->required == 1 ? '<span class="text-danger" title="This field is required">*</span>' : '' !!}
                                            </label>
                                        </td>
                                        <td class="fields_col-2">
                                            {!! form3lements($item->id, $item->name, $item->inputType->name, $item->value, $item->key_name) !!}
                                        </td>
                                        <td class="text-right">
                                            <div class="single-line">
                                                <a href="{{route('user.field.edit', $item->id)}}" class="badge badge-dark action-button" title="Edit">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%"><em>No records found</em></td>
                                    </tr>
                                @endforelse --}}
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
    <!-- Select2 -->
    <script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    $('select').select2();
    </script>
@endsection
