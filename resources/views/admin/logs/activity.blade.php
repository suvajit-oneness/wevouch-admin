@extends('layouts.auth.master')

@section('title', 'User activity')

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
                            <a href="{{route('user.logs')}}" class="btn btn-sm btn-primary"> <i class="fas fa-chevron-left"></i> Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-hover" id="showRoleTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    @if (auth()->user()->id == 1)
                                    <th>User</th>
                                    @endif
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Timing</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $index => $item)
                                <tr id="tr_{{$item->id}}">
                                    <td>{{$index+1}}</td>
                                    @if (auth()->user()->id == 1)
                                    <td>
                                        <p class="small text-muted mb-1">{{$item->userDetails->name}}</p>
                                    </td>
                                    @endif
                                    <td>
                                        <p class="small text-muted mb-1">{{$item->title}}</p>
                                    </td>
                                    <td>
                                        <p class="small text-muted mb-1">{{$item->description}}</p>
                                    </td>
                                    <td>
                                        <p class="small text-muted mb-1" title="{{$item->created_at}}">{{\carbon\carbon::parse($item->created_at)->diffForHumans()}}</p>
                                    </td>
                                </tr>
                                @empty
                                    <tr><td class="text-center text-muted" colspan="100%"><em>No records found</em></td></tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="pagination-view">
                            {{$data->links();}}
                        </div>
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