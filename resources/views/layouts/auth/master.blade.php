<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $APP_data->APP__name }} | @yield('title')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/croppie/croppie.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/custom.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        @php
                            if ($notification->unreadCount > 0) {
                                echo '<span class="badge badge-danger navbar-badge">' . $notification->unreadCount . '</span>';
                            } elseif ($notification->unreadCount > 99) {
                                echo '<span class="badge badge-danger navbar-badge">99+</span>';
                            } else {
                                echo '';
                            }
                        @endphp
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="max-height: calc(100vh - 68px);overflow: hidden">
                        @if (count($notification) > 0)
                            <span class="dropdown-header">{{ $notification->unreadCount }} unread
                                {{ $notification->unreadCount == 1 ? 'notification' : 'notifications' }}</span>
                            <div class="dropdown-divider"></div>
                        @endif

                        <div class="dropdown-holder" style="overflow: hidden scroll;max-height: calc(100vh - 146px);">
                            @forelse ($notification as $index => $noti)
                                <a href="javascript:void(0)"
                                    class="dropdown-item {{ $noti->read_flag == 0 ? 'unread' : 'read' }}"
                                    onclick="readNotification('{{ $noti->id }}', '{{ $noti->route ? route($noti->route) : '' }}')">
                                    <h6 class="noti-title">{{ $noti->title }}</h6>
                                    <p class="noti-desc">{{ $noti->message }}</p>
                                    <p class="noti-timing"> <i class="fas fa-history"></i> {{ \carbon\carbon::parse($noti->created_at)->diffForHumans() }}</p>
                                </a>
                                <div class="dropdown-divider"></div>
                                @if ($index == 15)
                                @break;
                            @endif
                            @empty
                                <a href="javascript: void(0)" class="dropdown-item py-4">
                                    <p class="small text-muted text-center">No notifications yet</p>
                                </a>
                                @endforelse
                            </div>

                            @if (count($notification) > 0)
                                <a href="{{ route('user.logs.notification') }}" class="dropdown-item dropdown-footer">See
                                    All Notifications</a>
                            @endif
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Fullscreen">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link" data-widget="control-sidebar"
                            data-slide="true" role="button" title="Sign out"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt text-danger"></i>
                        </a>
                    </li>
                </ul>
            </nav>

            <aside class="main-sidebar sidebar-dark-primary elevation-4 side-gradient">
                <a href="{{ route('home') }}" class="brand-link d-flex flex-column align-items-center">
                    <img src="{{ asset('admin/dist/img/WeVouch_Logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    {{-- <span class="brand-text ">{{ env('APP_NAME') }}</span> --}}
                    {{-- <p class="p-text">{{ $APP_data->APP__name }}</p> --}}
                </a>

                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset(Auth::user()->image_path) }}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="{{ route('user.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ route('home') }}"
                                    class="nav-link {{ request()->is('home*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-header">MANAGEMENT</li>
                            <li class="nav-item">
                                <a href="{{ route('user.brand.list') }}"
                                    class="nav-link {{ request()->is('user/brand*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Brand</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.training.list') }}"
                                    class="nav-link {{ request()->is('user/training*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Training videos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.ticket.list') }}"
                                    class="nav-link {{ request()->is('user/ticket*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Ticket issue</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.product.data.list') }}"
                                    class="nav-link {{ request()->is('user/product/data*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Product data</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.product.issue.list') }}"
                                    class="nav-link {{ request()->is('user/product/issue*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Product issue</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.product.icon.list') }}"
                                    class="nav-link {{ request()->is('user/product/icon*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Product icon</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('user.field.list') }}"
                                    class="nav-link {{ request()->is('user/field*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>Field</p>
                                </a>
                            </li> --}}
                            <li class="nav-header">SETTINGS</li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('user.employee.list') }}"
                                    class="nav-link {{ request()->is('user/employee*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Employee management</p>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('user.office.list') }}"
                                    class="nav-link {{ request()->is('user/office*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>Office management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.profile') }}"
                                    class="nav-link {{ request()->is('user/profile*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-circle"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                            <li class="nav-item" style="margin-bottom: 60px;">
                                <a href="{{ route('user.logs') }}"
                                    class="nav-link {{ request()->is('user/logs*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>Activity &amp; Logs</p>
                                </a>
                            </li>
                            <li class="nav-item sidebar-logout">
                                <a href="{{ route('logout') }}" class="nav-link mb-0"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>Logout</p>
                                </a>
                            </li>

                            {{-- <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Starter Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Active Page</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inactive Page</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}

                        </ul>
                    </nav>
                </div>
            </aside>

            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">@yield('title')</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active">@yield('title')</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                @yield('content')

            </div>

            {{-- profile page image change modal --}}
            @include('admin.modal.image-change-crop')
            {{-- user details modal --}}
            @include('admin.modal.user-details')

            <footer class="main-footer">
                <div class="">
                    Copyright &copy; {{ date('Y') }}
                </div>
            </footer>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>

        <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/croppie/croppie.js') }}"></script>
        <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    </body>

    </html>

    <script>
        // toast fires | type = success, info, danger, warning
        function toastFire(type = 'success', title, body = '') {
            $icon = 'check';
            if (type == 'info') {
                $icon = 'info-circle';
            } else if (type == 'danger') {
                $icon = 'times';
            } else if (type == 'warning') {
                $icon = 'exclamation';
            }

            $(document).Toasts('create', {
                class: 'bg-' + type,
                title: title,
                autohide: true,
                delay: 3000,
                icon: 'fas fa-' + $icon + ' fa-lg',
                // body: body
            });
        }

        // on session toast fires
        @if (Session::has('success'))
            toastFire('success', '{{ Session::get('success') }}');
        @elseif (Session::has('error'))
            toastFire('danger', '{{ Session::get('error') }}');
        @endif

        // sweetalert delete alert
        function confirm4lert(path, id, type, sub = null) {
            var ext = '';
            if (type == 'block') {
                var ext = '. Blocked users cannot login';
            } else if (type == 'activate') {
                var ext = '. User can login again';
            }
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to ' + type + ' the record' + ext,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f44336',
                cancelButtonColor: '#8b8787',
                customClass: {
                    confirmButton: 'box-shadow-danger',
                },
                confirmButtonText: 'Yes, ' + type + ' it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: path,
                        method: 'post',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(response) {
                            if (type == 'delete') {
                                $('#tr_' + id).remove();

                                if (sub == 'sub') {
                                    $('#tr_sub_' + id + '').remove();
                                }

                                Swal.fire(response.title, response.message, 'success')
                            } else if (type == 'block' || type == 'activate') {
                                if (response.title == 'Blocked') {
                                    $('#tr_' + id + ' .block-button').removeClass('badge-dark')
                                        .addClass('badge-danger').text('Blocked');
                                } else {
                                    $('#tr_' + id + ' .block-button').removeClass('badge-danger')
                                        .addClass('badge-dark').text('Active');
                                }

                                Swal.fire(response.title + '!', response.message, 'success')
                            }
                        }
                    });
                }
            });
        }

        // clear modal footer on hide
        $('#userDetails').on('hidden.bs.modal', function(event) {
            $('#userDetails .modal-content .modal-footer').remove();
        });

        // click to read notification
        function readNotification(id, route) {
            $.ajax({
                url: '{{ route('user.notification.read') }}',
                method: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: id
                },
                success: function(result) {
                    // console.log('{{ url()->current() }}',route);
                    // if (route != '' && '{{ url()->current() }}' != route) {
                    window.location = route;
                    // }
                }
            });
        }

        // mark all notification as read
        function markAllNotificationRead() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to mark all notifications as read. You might lose some data.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f44336',
                cancelButtonColor: '#8b8787',
                confirmButtonText: 'Yes, mark all as read!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('user.logs.notification.readall') }}',
                        method: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        beforeSend: function() {
                            $('#notifications-timeline .mark-all-read-btn').prop('disabled', true).html(
                                '<i class="fas fa-sync-alt"></i> Please wait');
                        },
                        success: function(result) {
                            $('#notifications-timeline .notification-single .callout').removeClass(
                                'callout-dark');
                            $('#notifications-timeline .unread-noti-count').text('');
                            $('#notifications-timeline .mark-all-read-btn').removeClass(
                                'btn-outline-danger').addClass('btn-success').html(
                                '<i class="fas fa-check"></i> All notifications marked as read');
                        }
                    });
                }
            });
        }

        // indian digits to words
        var onesDigit = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
        var twosDigit = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
        function digitInW0rd(num) {
            if ((num = num.toString()).length > 9) return 'overflow';
            n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
            if (!n) return;
            var str = '';
            str += (n[1] != 0) ? (onesDigit[Number(n[1])] || twosDigit[n[1][0]] + ' ' + onesDigit[n[1][1]]) + 'crore ' : '';
            str += (n[2] != 0) ? (onesDigit[Number(n[2])] || twosDigit[n[2][0]] + ' ' + onesDigit[n[2][1]]) + 'lakh ' : '';
            str += (n[3] != 0) ? (onesDigit[Number(n[3])] || twosDigit[n[3][0]] + ' ' + onesDigit[n[3][1]]) + 'thousand ' : '';
            str += (n[4] != 0) ? (onesDigit[Number(n[4])] || twosDigit[n[4][0]] + ' ' + onesDigit[n[4][1]]) + 'hundred ' : '';
            str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (onesDigit[Number(n[5])] || twosDigit[n[5][0]] + ' ' + onesDigit[n[5][1]]) : '';
            return str;
        }

        // check if input is number
        function isNumberKey(evt){
            console.log(evt.charCode);
            if(evt.charCode >= 48 && evt.charCode <= 57 || evt.charCode <= 43) {
                return true;
            }
            return false;
        }

        $('input[name="field_name[loanamountindigits]"]').attr("onkeyup", "isNumberKey(event)");

        // $(document).ready(function() {
        //     $('input[name="field_name[loanamountindigits]"]').attr("oninput", "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1')");
        //     $('input[name="field_name[loanamountindigits]"]').attr('maxlength', "9");
        // });

        // loan amopunt in digit to word
        $('input[name="field_name[loanamountindigits]"]').on('keyup', function(e) {
            $('input[name="field_name[loanamountindigitsinwords]"]').val(digitInW0rd($(this).val()));
        });

        // monthly EMI in digit to word
        $('input[name="field_name[monthlyemiindigits]"]').on('keyup', function() {
            $('input[name="field_name[monthlyemiinwords]"]').val(digitInW0rd($(this).val()));
        });

        // pan card number
        $('#pan_card_number').on('keyup', function() {
            $(this).val($(this).val().toUpperCase());
        });

        // accept interger only and one decimal point
        // $('.numberField').on('keyup', function(event) {
        $(".numberField").keydown(function (event) {
            // console.log(event.keyCode);
            if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) || 
                (event.keyCode >= 96 && event.keyCode <= 105) || 
                event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
                event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110) {

            } else {
                event.preventDefault();
            }

            if($(this).val().indexOf('.') !== -1 && event.keyCode == 110)
                event.preventDefault();
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();
        });

        // multiple checkbox click to activate remove button
        function clickToRemove() {
            if ($('.tap-to-delete').is(':checked')) {
                $('#delete-box button').removeClass('disabled');
            } else {
                $('#delete-box button').addClass('disabled');
            }
        }

        // click to select all checkbox
        function headerCheckFunc() {
            if ($('#checkbox-head').is(':checked')) {
                $('.tap-to-delete').prop('checked', true);
                clickToRemove();
            } else {
                $('.tap-to-delete').prop('checked', false);
                clickToRemove();
            }
        }

        // csv upload form button loading
        $('#fileCsvUploadForm').on('submit', function() {
            $('#fileCsvUploadForm button[type="submit"]').attr('disabled', true).html('Please wait...');
            $('.close').attr('disabled', true);
        });
    </script>

    @yield('script')
