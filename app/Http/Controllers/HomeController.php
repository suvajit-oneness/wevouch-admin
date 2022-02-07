<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\User;
use App\Models\MailLog;
use App\Models\Notification;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = (object)[];
        // $data->agreement = Agreement::count();
        $data->employee = User::count();
        $data->office = Office::count();

        return view('admin.dashboard', compact('data'));
        // return view('home');
    }

    public function profile(Request $request)
    {
        return view('admin.profile');
    }

    public function profileUpdate(Request $request)
    {
        $rules = [
            'name' => 'required|min:1|max:200',
            'mobile' => 'nullable|numeric|min:1'
        ];

        $validate = validator()->make($request->all(), $rules);

        if (!$validate->fails()) {
            $user = Auth::user();

            if ($user->name != $request->name || $user->mobile != $request->mobile) {
                $user->name = $request->name;
                $user->mobile = $request->mobile;
                $user->save();

                return response()->json(['error' => false, 'message' => 'Profile updated', 'type' => 'success']);
            } else {
                return response()->json(['error' => false, 'message' => 'No changes made', 'type' => 'info']);
            }
        }

        return response()->json(['error' => true, 'message' => $validate->errors()->first()]);
    }

    public function passwordUpdate(Request $request)
    {
        $rules = [
            'oldPassword' => 'required|string',
            'password' => 'required|string|min:4|max:50|confirmed'
        ];

        $rulesMessage = [
            'password.required' => 'The new password field is required',
            'password.confirmed' => 'New password does not match',
        ];

        $validate = validator()->make($request->all(), $rules, $rulesMessage);
        if (!$validate->fails()) {
            $user = Auth::user();

            if (Hash::check($request->oldPassword, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json(['error' => false, 'message' => 'Password updated']);
            }
            return response()->json(['error' => true, 'message' => 'Old password missmatched']);
        }

        return response()->json(['error' => true, 'message' => $validate->errors()->first()]);
    }

    public function imageUpdate(Request $request)
    {
        $save_location = 'admin/uploads/profile-picture/';
        $data = $request->image;
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $imageName = time() . '.png';

        if (file_put_contents($save_location.$imageName, $data)) {
            $user = Auth::user();
            $user->image_path = $save_location.$imageName;
            $user->save();
            return response()->json(['error' => false, 'message' => 'Image updated', 'image' => asset($save_location.$imageName)]);
        } else {
            return response()->json(['error' => true, 'message' => 'Something went wrong']);
        }
    }

    public function notificationRead(Request $request)
    {
        $noti = Notification::findOrFail($request->id);
        $noti->read_flag = 1;
        $noti->save();
    }

    // public function notificationAllIndex(Request $request)
    // {
    //     $user = Auth::user();
    //     $data = Notification::where('receiver_id', $user->id)->latest()->paginate(25);
    //     return view('admin.notification', compact('data'));
    // }

    // public function notificationReadAll(Request $request)
    // {
    //     $user = Auth::user();
    //     $noti = Notification::where('receiver_id', '=', $user->id)->where('read_flag', '=', '0')->update(['read_flag' => 1]);
    // }
}
