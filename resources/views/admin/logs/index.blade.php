@extends('layouts.auth.master')

@section('title', 'Activity & logs')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$data->mail_log}}</h3>
                        <p>Email logs</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-mail-bulk"></i>
                    </div>
                    <a href="{{route('user.logs.mail')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box {{($notification->unreadCount == 0 ? 'bg-success' : 'bg-danger')}}">
                    <div class="inner">
                        <h3>{{$notification->unreadCount}}<sup style="font-size: 13px;font-weight: 400;margin-left: 6px;">unread</sup></h3>

                        <p>{{$notification->unreadCount > 1 ? 'Notifications' : 'Notification'}}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-bullhorn {{($notification->unreadCount > 0 ? 'pulse-grow-animation' : '')}}"></i>
                    </div>
                    <a href="{{route('user.logs.notification')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Watch</h3>
                        <p>Activities</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <a href="{{route('user.logs.activity')}}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            {{-- <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44<sup style="font-size: 20px">%</sup></h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div> --}}
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>

    </script>
@endsection