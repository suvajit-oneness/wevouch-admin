@extends('layouts.auth.master')

@section('title', 'Dashboard')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <a href="{{route('user.borrower.list')}}" class="d-flex"><span class="info-box-icon text-info elevation-1"><i class="fas fa-users-cog"></i></span></a>
                    <div class="info-box-content">
                        <span class="info-box-text">Total borrower listing</span>
                        <span class="info-box-number">
                            {{$data->borrower}}
                            {{-- <small>%</small> --}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <a href="{{route('user.employee.list')}}" class="d-flex"><span class="info-box-icon text-success elevation-1"><i class="fas fa-users"></i></span></a>
                    <div class="info-box-content">
                        <span class="info-box-text">Employee</span>
                        <span class="info-box-number">{{$data->employee}}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <a href="{{route('user.office.list')}}" class="d-flex"><span class="info-box-icon text-warning elevation-1"><i class="fas fa-building"></i></span></a>
                    <div class="info-box-content">
                        <span class="info-box-text">Office</span>
                        <span class="info-box-number">{{$data->office}}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Members</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                <i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            <li>
                                <img src="{{ asset('admin/dist/img/user1-128x128.jpg') }}" alt="User Image">
                                <a class="users-list-name" href="#">Alexander Pierce</a>
                                <span class="users-list-date">Today</span>
                            </li>
                            <li>
                                <img src="{{ asset('admin/dist/img/user8-128x128.jpg') }}" alt="User Image">
                                <a class="users-list-name" href="#">Norman</a>
                                <span class="users-list-date">Yesterday</span>
                            </li>
                            <li>
                                <img src="{{ asset('admin/dist/img/user7-128x128.jpg') }}" alt="User Image">
                                <a class="users-list-name" href="#">Jane</a>
                                <span class="users-list-date">12 Jan</span>
                            </li>
                            <li>
                                <img src="{{ asset('admin/dist/img/user6-128x128.jpg') }}" alt="User Image">
                                <a class="users-list-name" href="#">John</a>
                                <span class="users-list-date">12 Jan</span>
                            </li>
                            <li>
                                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" alt="User Image">
                                <a class="users-list-name" href="#">Alexander</a>
                                <span class="users-list-date">13 Jan</span>
                            </li>
                            <li>
                                <img src="{{ asset('admin/dist/img/user5-128x128.jpg') }}" alt="User Image">
                                <a class="users-list-name" href="#">Sarah</a>
                                <span class="users-list-date">14 Jan</span>
                            </li>
                            <li>
                                <img src="{{ asset('admin/dist/img/user4-128x128.jpg') }}" alt="User Image">
                                <a class="users-list-name" href="#">Nora</a>
                                <span class="users-list-date">15 Jan</span>
                            </li>
                            <li>
                                <img src="{{ asset('admin/dist/img/user3-128x128.jpg') }}" alt="User Image">
                                <a class="users-list-name" href="#">Nadia</a>
                                <span class="users-list-date">15 Jan</span>
                            </li>
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <div class="card-footer text-center">
                        <a href="javascript:">View All Users</a>
                    </div>
                </div>
            </div> --}}

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Recent borrowers</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                <i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm m-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th class="text-right">Loan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data->recentBorrowers as $recentBorrower)
                                    <tr>
                                        <td>
                                            <p class="small text-muted">{{$recentBorrower->id}}</p>
                                        </td>
                                        <td>
                                            <p class="small text-muted">{{$recentBorrower->name_prefix.' '.$recentBorrower->full_name}}</p>
                                        </td>
                                        <td>
                                            <p class="small text-muted">{{$recentBorrower->mobile}}</p>
                                        </td>
                                        <td class="text-right">
                                            <div class="single-line">
                                                @if ($recentBorrower->agreement_id == 0)
                                                    <p class="small text-muted"> <em>No agreement yet</em> </p>
                                                @else
                                                    <a href="{{route('user.borrower.agreement', $recentBorrower->id)}}" class="badge badge-primary action-button" title="Setup loan application form">{{$recentBorrower->agreementDetails->name}}</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr><td class="text-center text-muted" colspan="100%"><em>No data found</em></td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <a href="{{route('user.borrower.create')}}" class="btn btn-sm btn-info float-left">Create new borrower</a>
                        <a href="{{route('user.borrower.list')}}" class="btn btn-sm btn-secondary float-right">View Borrowers' list</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header {{($notification->unreadCount > 0) ? 'bg-tomato' : ''}}">
                        <h5 class="m-0 {{($notification->unreadCount > 0) ? 'text-light' : ''}}">{{($notification->unreadCount > 0) ? ($notification->unreadCount > 1) ? $notification->unreadCount.' unread notifications' : $notification->unreadCount.' unread notification' : 'No new notification'}}</h5>
                    </div>
                    <div class="card-body">
                        @forelse ($notification as $index => $noti)
                            @if ($noti->read_flag == 0)
                            <a href="javascript: void(0)" onclick="readNotification('{{$noti->id}}', '{{($noti->route ? route($noti->route) : '')}}')">
                                <h6 class="small text-dark mb-0">{{$noti->title}}</h6>
                                <p class="small text-muted">{{$noti->message}}</p>
                            </a>
                            @endif
                        @empty
                            <p class="small text-muted"><em>Everything looks good</em></p>
                        @endforelse
                        <a href="{{route('user.logs.notification')}}" class="btn btn-sm btn-primary">View all notifications</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection