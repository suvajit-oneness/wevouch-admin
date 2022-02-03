<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

use App\Models\MailLog;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function logsIndex(Request $request)
    {
        $data = (object)[];
        $data->mail_log = MailLog::count();
        return view('admin.logs.index', compact('data'));
    }

    public function logsMail(Request $request)
    {
        $data = MailLog::latest()->paginate(25);
        return view('admin.logs.mail', compact('data'));
    }

    public function logsNotification(Request $request)
    {
        $user = Auth::user();
        $data = Notification::where('receiver_id', $user->id)->latest()->paginate(25);
        return view('admin.notification', compact('data'));
    }

    public function notificationReadAll(Request $request)
    {
        $user = Auth::user();
        $noti = Notification::where('receiver_id', '=', $user->id)->where('read_flag', '=', '0')->update(['read_flag' => 1]);
    }

    public function activityIndex(Request $request)
    {
        if (auth()->user()->id == 1) {
            $data = Activity::latest()->paginate(25);
        } else {
            $data = Activity::where('user_id', auth()->user()->id)->latest()->paginate(25);
        }

        return view('admin.logs.activity', compact('data'));
    }
}
