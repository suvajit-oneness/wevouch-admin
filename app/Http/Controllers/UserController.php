<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Department;
use App\Models\Office;
use App\Models\User;
use App\Models\UserType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::latest()->get();
        return view('admin.employee.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = (object)[];
        $data->users = User::select('id', 'name', 'user_type')->orderBy('name')->get();
        $data->departments = Department::select('id', 'name')->orderBy('name')->get();
        $data->designations = Designation::select('id', 'name')->orderBy('name')->get();
        $data->offices = Office::select('id', 'name')->orderBy('name')->get();
        $data->user_type = UserType::all();
        return view('admin.employee.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'employee_id' => 'required|string|min:1|max:255',
            'email' => 'required|string|email|unique:users',
            'phone_number' => 'nullable|integer|digits:10',
            'department' => 'required|integer|min:1',
            'designation' => 'required|integer|min:1',
            'parent_id' => 'nullable|numeric|min:1',
            'user_type' => 'required|numeric|min:1',
            'office' => 'required|numeric|min:1',
            'sendPassword' => 'nullable',
            'password' => 'nullable',
        ], [
            'phone_number.*' => 'Please enter a valid 10 digit phone number'
        ]);

        if ((empty($request->sendPassword) || !isset($request->sendPassword)) && (empty($request->password) || !isset($request->password))) {
            $error['password'] = 'Enter manual password or send password via mail';
            return redirect()->route('user.employee.create')->withErrors($error)->withInput($request->all());
        } else {
            if (!empty($request->password)) {
                $password = $request->password;
            } else {
                $password = generateUniqueAlphaNumeric(8);
            }

            DB::beginTransaction();

            try {
                $user = new User;
                $user->name = $request->name;
                $user->emp_id = $request->employee_id;
                $user->email = $request->email;
                $user->mobile = $request->phone_number;
                $user->department_id = $request->department;
                $user->designation_id = $request->designation;
                $user->parent_id = $request->parent_id ? $request->parent_id : 0;
                $user->user_type = $request->user_type;
                $user->office_id = $request->office;
                $user->password = Hash::make($password);
                $user->save();

                if (empty($request->password) || ($request->password == null)) {
                    $email_data = [
                        'name' => $request->name,
                        'subject' => 'New registration notification',
                        'email' => $request->email,
                        'password' => $password,
                        'blade_file' => 'user-registration',
                    ];

                    SendMail($email_data);
                }

                // notification params -> $sender, $receiver, $type
                createNotification(1, $user->id, 'user_registration');

                // activity log
                $logData = [
                    'type' => 'new_employee',
                    'title' => 'New employee created',
                    'desc' => 'New employee, '.$request->name.' ('.$request->employee_id.') created by '.auth()->user()->emp_id
                ];
                activityLog($logData);

                DB::commit();
                return redirect()->route('user.employee.list')->with('success', 'User created');
            } catch(Exception $e) {
                DB::rollback();
                $error['email'] = 'Something went wrong. Try using manual password';
                return redirect(route('user.employee.create'))->withErrors($error)->withInput($request->all());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = User::with(['type', 'department', 'designation'])->where('id', $request->id)->first();

        // dd($data);
        $user_parent = $data->parent_id ? $data->parent->name : null;
        $user_department = $data->department_id != 0 ? $data->department->name : null;
        $user_designation = $data->designation_id != 0 ? $data->designation->name : null;
        $user_office = $data->office_id ? $data->office->name : null;

        return response()->json(['error' => false, 'data' => ['name' => $data->name, 'email' => $data->email, 'mobile' => $data->mobile, 'image_path' => asset($data->image_path), 'user_type' => $data->type->name, 'user_type_color' => $data->type->color, 'user_parent' => $user_parent, 'emp_id' => $data->emp_id, 'department' => $user_department, 'designation' => $user_designation, 'office' => $user_office]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = (object)[];
        $data->user = User::findOrFail($id);
        $data->users = User::select('id', 'name', 'user_type')->where('id', '!=', $id)->orderBy('name')->get();
        $data->departments = Department::select('id', 'name')->orderBy('name')->get();
        $data->designations = Designation::select('id', 'name')->orderBy('name')->get();
        $data->offices = Office::select('id', 'name')->orderBy('name')->get();
        $data->user_type = UserType::all();
        return view('admin.employee.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'employee_id' => 'required|string|min:1|max:255',
            'phone_number' => 'nullable|integer|digits:10',
            'department' => 'required|integer|min:1',
            'designation' => 'required|integer|min:1',
            'parent_id' => 'nullable|numeric|min:1',
            'user_type' => 'required|numeric|min:1',
            'office' => 'required|numeric|min:1',
        ], [
            'phone_number.*' => 'Please enter a valid 10 digit phone number'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->emp_id = $request->employee_id;
        $user->mobile = $request->phone_number;
        $user->department_id = $request->department;
        $user->designation_id = $request->designation;
        $user->parent_id = $request->parent_id ? $request->parent_id : 0;
        $user->user_type = $request->user_type;
        $user->office_id = $request->office;
        $user->save();

        return redirect()->route('user.employee.list')->with('success', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $request->validate(['id' => 'required|numeric|min:1']);
        User::where('id', $request->id)->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }

    public function block(Request $request)
    {
        $user = User::findOrFail($request->id);
        if ($user->block == 0) {
            $user->block = 1;
            $title = 'Blocked';
            $message = 'User is blocked';
        } else {
            $user->block = 0;
            $title = 'Active';
            $message = 'User is active';
        }
        $user->save();

        return response()->json(['error' => false, 'title' => $title, 'message' => $message, 'type' => 'success']);
    }
}
