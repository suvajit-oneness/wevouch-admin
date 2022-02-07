@extends('layouts.auth.master')

@section('title', 'Dashboard')

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
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