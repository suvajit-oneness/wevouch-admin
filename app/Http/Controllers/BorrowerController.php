<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\AgreementData;
use App\Models\AgreementDocument;
use App\Models\AgreementDocumentUpload;
use App\Models\AgreementField;
use App\Models\AgreementRfq;
use App\Models\Borrower;
use App\Models\FieldParent;
use App\Models\UserType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return view('admin.borrower.index');

        $data = Borrower::where([
            [function ($query) use ($request) {
                if ($term = $request->term) {
                    $query
                        ->orWhere('name_prefix', 'LIKE', '%' . $term . '%')
                        ->orWhere('full_name', 'LIKE', '%' . $term . '%')
                        ->orWhere('email', 'LIKE', '%' . $term . '%')
                        ->orWhere('mobile', 'LIKE', '%' . $term . '%')
                        ->orWhere('pan_card_number', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])->with(['agreementDetails', 'borrowerAgreementRfq'])->latest('CUSTOMER_ID')->paginate(20);

        // $data = Borrower::with('agreementDetails')->latest('id')->paginate(5);
        return view('admin.borrower.index', compact('data'));
    }

    public function indexLoad(Request $request)
    {
        if (!empty($request->search)) {
            $search = $request->search;
            $data = Borrower::where('full_name', 'LIKE', '%' . $search . '%')->latest('id')->get();
        } else {
            $data = Borrower::latest('id')->get();
        }

        if ($data) {
            return response()->json(['resp_code' => 200, 'message' => 'Data found', 'data' => $data]);
        } else {
            return response()->json(['resp_code' => 400, 'message' => 'No data found']);
        }
    }

    public function indexOld(Request $request)
    {
        if ($request->ajax()) {
            $borrowers = Borrower::select('*')->with(['agreementDetails', 'borrowerAgreementRfq'])->latest('id');

            return Datatables::of($borrowers)->make(true);
        }
        return view('admin.borrower.index-old');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = (object)[];
        $data->agreement = Agreement::orderBy('name')->get();
        return view('admin.borrower.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // manual entry customer id
            'customer_id' => 'required|integer|min:1|digits_between:1,20',
            'name_prefix' => 'required|string|min:1|max:50',
            'first_name' => 'required|string|min:1|max:200',
            'middle_name' => 'nullable|string|min:1|max:200',
            'last_name' => 'required|string|min:1|max:200',
            'gender' => 'required|string|min:1|max:30',
            'date_of_birth' => 'required',
            'email' => 'required|string|email',
            'mobile' => 'required|integer|digits:10',
            'pan_card_number' => 'required|string|min:10|max:10',
            'occupation' => 'required|string|min:1|max:200',
            'marital_status' => 'required|string|min:1|max:30',

            'KYC_HOUSE_NO' => 'nullable|string|min:1|max:200',
            'KYC_Street' => 'required|string|min:1|max:200',
            'KYC_LOCALITY' => 'required|string|min:1|max:200',
            'KYC_CITY' => 'required|string|min:1|max:200',
            'KYC_State' => 'required|string|min:1|max:200',
            'KYC_PINCODE' => 'required|string|min:1|max:200',
            'KYC_Country' => 'required|string|min:1|max:200',

            // 'street_address' => 'required|string|min:1|max:200',
            // 'city' => 'required|string|min:1|max:200',
            // 'pincode' => 'required|integer|digits:6',
            // 'state' => 'required|string|min:1|max:200',

            'agreement_id' => 'nullable|numeric|min:1'
        ]);

        DB::beginTransaction();

        try {
            // old data for latest CUSTOMER ID
            // $past_data = Borrower::select('CUSTOMER_ID')->latest('CUSTOMER_ID')->first();

            $user = new Borrower;
            // $user->CUSTOMER_ID = ($past_data == null) ? 1 : (int)$past_data->CUSTOMER_ID + 1;
            $user->CUSTOMER_ID = $request->customer_id;
            $user->name_prefix = $request->name_prefix;
            $user->first_name = $request->first_name;
            $user->middle_name = $request->middle_name;
            $user->last_name = $request->last_name;
            $user->full_name = $request->first_name . ($request->middle_name ? ' ' . $request->middle_name : null) . ' ' . $request->last_name;
            $user->gender = $request->gender;
            $user->date_of_birth = $request->date_of_birth;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->pan_card_number = $request->pan_card_number;
            $user->occupation = $request->occupation;
            $user->marital_status = $request->marital_status;

            $user->KYC_HOUSE_NO = $request->KYC_HOUSE_NO;
            $user->KYC_Street = $request->KYC_Street;
            $user->KYC_LOCALITY = $request->KYC_LOCALITY;
            $user->KYC_CITY = $request->KYC_CITY;
            $user->KYC_State = $request->KYC_State;
            $user->KYC_PINCODE = $request->KYC_PINCODE;
            $user->KYC_Country = $request->KYC_Country;

            $user->street_address = $request->street_address;
            $user->city = $request->city;
            $user->pincode = $request->pincode;
            $user->state = $request->state;

            $user->agreement_id = $request->agreement_id ? $request->agreement_id : 0;
            $user->uploaded_by = auth()->user()->id;
            $user->save();

            // notification fire
            createNotification(auth()->user()->id, 1, 'new_borrower', 'New borrower, ' . $request->name_prefix . ' ' . $request->full_name . ' added by ' . auth()->user()->emp_id);

            // activity log
            $logData = [
                'type' => 'new_borrower',
                'title' => 'New borrower created',
                'desc' => 'New borrower, ' . $request->full_name . ' created by ' . auth()->user()->emp_id
            ];
            activityLog($logData);

            DB::commit();
            return redirect()->route('user.borrower.list')->with('success', 'Borrower created');
        } catch (Exception $e) {
            DB::rollback();
            $error['email'] = 'Something went wrong';
            return redirect(route('user.borrower.create'))->withErrors($error)->withInput($request->all());
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
        $data = Borrower::findOrFail($request->id);

        $userid = $data->id;
        $username_prefix = ucwords($data->name_prefix);
        $userfull_name = $data->full_name;
        $usergender = $data->gender;
        $userdate_of_birth = $data->date_of_birth;
        $useremail = $data->email;
        $usermobile = $data->mobile;
        $userpan_card_number = $data->pan_card_number;
        $userimage_path = asset($data->image_path);
        $useroccupation = $data->occupation;
        $usermarital_status = $data->marital_status;
        $userstreet_address = $data->street_address;
        $usercity = $data->city;
        $userpincode = $data->pincode;
        $userstate = $data->state;

        return response()->json(['error' => false, 'data' => ['user_id' => $userid, 'name_prefix' => $username_prefix, 'name' => $userfull_name, 'gender' => $usergender, 'dateofbirth' => $userdate_of_birth, 'email' => $useremail, 'mobile' => $usermobile, 'pan_card_number' => $userpan_card_number, 'image_path' => $userimage_path, 'occupation' => $useroccupation, 'marital_status' => $usermarital_status, 'street_address' => $userstreet_address, 'city' => $usercity, 'pincode' => $userpincode, 'state' => $userstate]]);
    }

    public function details(Request $request)
    {
        $data = Borrower::findOrFail($request->id);
        return view('admin.borrower.view', compact('data'));
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
        $data->user = Borrower::findOrFail($id);
        $data->agreement = Agreement::orderBy('name')->get();
        return view('admin.borrower.edit', compact('data'));
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
            'customer_id' => 'required|integer|min:1|digits_between:1,20',
            'name_prefix' => 'required|string|min:1|max:50',
            'first_name' => 'required|string|min:1|max:200',
            'middle_name' => 'nullable|string|min:1|max:200',
            'last_name' => 'required|string|min:1|max:200',
            'gender' => 'required|string|min:1|max:30',
            'date_of_birth' => 'required',
            'email' => 'required|string|email',
            'mobile' => 'required|numeric|min:1',
            'pan_card_number' => 'required|string|min:10|max:10',
            'occupation' => 'required|string|min:1|max:200',
            'marital_status' => 'required|string|min:1|max:30',

            'KYC_HOUSE_NO' => 'nullable|string|min:1|max:200',
            'KYC_Street' => 'required|string|min:1|max:200',
            'KYC_LOCALITY' => 'required|string|min:1|max:200',
            'KYC_CITY' => 'required|string|min:1|max:200',
            'KYC_State' => 'required|string|min:1|max:200',
            'KYC_PINCODE' => 'required|string|min:1|max:200',
            'KYC_Country' => 'required|string|min:1|max:200',

            // 'street_address' => 'required|string|min:1|max:200',
            // 'city' => 'required|string|min:1|max:200',
            // 'pincode' => 'required|integer|digits:6',
            // 'state' => 'required|string|min:1|max:200',

            'agreement_id' => 'nullable|numeric|min:1'
        ]);

        $user = Borrower::findOrFail($id);
        $user->CUSTOMER_ID = $request->customer_id;
        $user->name_prefix = $request->name_prefix;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->full_name = $request->first_name . ($request->middle_name ? ' ' . $request->middle_name : null) . ' ' . $request->last_name;
        $user->gender = $request->gender;
        $user->date_of_birth = $request->date_of_birth;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->pan_card_number = $request->pan_card_number;
        $user->occupation = $request->occupation;
        $user->marital_status = $request->marital_status;

        $user->KYC_HOUSE_NO = $request->KYC_HOUSE_NO;
        $user->KYC_Street = $request->KYC_Street;
        $user->KYC_LOCALITY = $request->KYC_LOCALITY;
        $user->KYC_CITY = $request->KYC_CITY;
        $user->KYC_State = $request->KYC_State;
        $user->KYC_PINCODE = $request->KYC_PINCODE;
        $user->KYC_Country = $request->KYC_Country;

        $user->street_address = $request->street_address;
        $user->city = $request->city;
        $user->pincode = $request->pincode;
        $user->state = $request->state;

        $user->agreement_id = $request->agreement_id ? $request->agreement_id : 0;
        $user->Customer_Type = $request->Customer_Type;
        $user->Resident_Status = $request->Resident_Status;
        $user->Aadhar_Number = $request->Aadhar_Number;
        $user->Main_Constitution = $request->Main_Constitution;
        $user->Sub_Constitution = $request->Sub_Constitution;
        $user->KYC_Date = $request->KYC_Date;
        $user->Re_KYC_Due_Date = $request->Re_KYC_Due_Date;
        $user->Minor = $request->Minor;
        $user->Customer_Category = $request->Customer_Category;
        $user->Alternate_Mobile_No = $request->Alternate_Mobile_No;
        $user->Telephone_No = $request->Telephone_No;
        $user->Office_Telephone_No = $request->Office_Telephone_No;
        $user->FAX_No = $request->FAX_No;
        $user->Preferred_Language = $request->Preferred_Language;
        $user->REMARKS = $request->REMARKS;
        $user->KYC_Care_of = $request->KYC_Care_of;
        $user->KYC_HOUSE_NO = $request->KYC_HOUSE_NO;
        $user->KYC_LANDMARK = $request->KYC_LANDMARK;
        $user->KYC_Street = $request->KYC_Street;
        $user->KYC_LOCALITY = $request->KYC_LOCALITY;
        $user->KYC_PINCODE = $request->KYC_PINCODE;

        $user->KYC_Country = $request->KYC_Country;
        $user->KYC_State = $request->KYC_State;
        $user->KYC_District = $request->KYC_District;
        $user->KYC_POST_OFFICE = $request->KYC_POST_OFFICE;
        $user->KYC_CITY = $request->KYC_CITY;
        $user->KYC_Taluka = $request->KYC_Taluka;
        $user->KYC_Population_Group = $request->KYC_Population_Group;
        $user->COMM_Care_of = $request->COMM_Care_of;
        $user->COMM_HOUSE_NO = $request->COMM_HOUSE_NO;
        $user->COMM_LANDMARK = $request->COMM_LANDMARK;
        $user->COMM_Street = $request->COMM_Street;
        $user->COMM_LOCALITY = $request->COMM_LOCALITY;
        $user->COMM_PINCODE = $request->COMM_PINCODE;
        $user->COMM_Country = $request->COMM_Country;
        $user->COMM_State = $request->COMM_State;
        $user->COMM_District = $request->COMM_District;
        $user->COMM_POST_OFFICE = $request->COMM_POST_OFFICE;
        $user->COMM_CITY = $request->COMM_CITY;
        $user->COMM_Taluka = $request->COMM_Taluka;
        $user->COMM_Population_Group = $request->COMM_Population_Group;
        $user->Social_Media = $request->Social_Media;
        $user->Social_Media_ID = $request->Social_Media_ID;
        $user->PROFESSION = $request->PROFESSION;
        $user->EDUCATION = $request->EDUCATION;
        $user->ORGANISATION_NAME = $request->ORGANISATION_NAME;
        $user->NET_INCOME = $request->NET_INCOME;
        $user->NET_EXPENSE = $request->NET_EXPENSE;
        $user->NET_SAVINGS    = $request->NET_SAVINGS;
        $user->Years_in_Organization = $request->Years_in_Organization;
        $user->CIBIL_SCORE = $request->CIBIL_SCORE;
        $user->PERSONAL_LOAN_SCORE = $request->PERSONAL_LOAN_SCORE;
        $user->GST_EXEMPTED = $request->GST_EXEMPTED;
        $user->RM_EMP_ID = $request->RM_EMP_ID;
        $user->RM_Designation = $request->RM_Designation;
        $user->RM_TITLE = $request->RM_TITLE;
        $user->RM_NAME = $request->RM_NAME;
        $user->RM_Landline_No = $request->RM_Landline_No;
        $user->RM_MOBILE_NO = $request->RM_MOBILE_NO;
        $user->RM_EMAIL_ID = $request->RM_EMAIL_ID;
        $user->DSA_ID = $request->DSA_ID;
        $user->DSA_NAME = $request->DSA_NAME;
        $user->DSA_LANDLINE_NO = $request->DSA_LANDLINE_NO;
        $user->DSA_MOBILE_NO = $request->DSA_MOBILE_NO;
        $user->DSA_EMAIL_ID = $request->DSA_EMAIL_ID;
        $user->GIR_NO = $request->GIR_NO;
        $user->RATION_CARD_NO = $request->RATION_CARD_NO;
        $user->DRIVING_LINC = $request->DRIVING_LINC;
        $user->NPR_NO = $request->NPR_NO;
        $user->PASSPORT_NO = $request->PASSPORT_NO;
        $user->EXPORTER_CODE = $request->EXPORTER_CODE;
        $user->GST_NO = $request->GST_NO;
        $user->Voter_ID	 = $request->Voter_ID;
        $user->CUSTM_2	 = $request->CUSTM_2;
        $user->CATEGORY	 = $request->CATEGORY;
        $user->RELIGION	 = $request->RELIGION;
        $user->MINORITY_STATUS	 = $request->MINORITY_STATUS;
        $user->CASTE = $request->CASTE;
        $user->SUB_CAST = $request->SUB_CAST;
        $user->RESERVATION_TYP = $request->RESERVATION_TYP;
        $user->Physically_Challenged = $request->Physically_Challenged;
        $user->Weaker_Section = $request->Weaker_Section;
        $user->Valued_Customer = $request->Valued_Customer;
        $user->Special_Category_1 = $request->Special_Category_1;
        $user->Vip_Category = $request->Vip_Category;
        $user->Special_Category_2 = $request->Special_Category_2;
        $user->Senior_Citizen = $request->Senior_Citizen;
        $user->Senior_Citizen_From = $request->Senior_Citizen_From;
        $user->SPOUSE = $request->SPOUSE;
        $user->CHILDREN = $request->CHILDREN;
        $user->PARENTS = $request->PARENTS;
        $user->Employee_Staus = $request->Employee_Staus;
        $user->Employee_No = $request->Employee_No;
        $user->save();

        return redirect()->route('user.borrower.list')->with('success', 'Borrower updated');
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
        Borrower::where('id', $request->id)->delete();
        return response()->json(['error' => false, 'title' => 'Deleted', 'message' => 'Record deleted', 'type' => 'success']);
    }

    public function agreementFields(Request $request, $id)
    {
        $borrower_id = $id;
        $data = (object)[];
        $data->agreement = Borrower::select('id', 'name_prefix', 'full_name', 'agreement_id')->with('agreementDetails', 'borrowerAgreementRfq')->where('id', $borrower_id)->get();
        foreach ($data->agreement as $agreement) {
            $data->name_prefix = $agreement->name_prefix;
            $data->full_name = $agreement->full_name;
            $data->agreement_id = $agreement->agreement_id;
            $data->agreement_name = $agreement->agreementDetails->name;
            break;
        }
        $data->parentFields = FieldParent::orderBy('position')->with('childRelation')->get();

        $data->fields = AgreementField::with('fieldDetails')->where('agreement_id', $data->agreement_id)->get();
        $data->agreementRfq = AgreementRfq::where('borrower_id', $borrower_id)->where('agreement_id', $data->agreement_id)->count();

        $data->requiredDocuments = AgreementDocument::with('siblingsDocuments')->where('agreement_id', $data->agreement_id)->where('parent_id', null)->get();

        // $data->uploadedDocuments = AgreementDocumentUpload::where('borrower_id', $borrower_id)->get();

        // dd($data);

        return view('admin.borrower.fields', compact('data', 'id'));
    }

    public function agreementStore(Request $request)
    {
        //dd($request->all());
        $rules = [
            'borrower_id' => 'required|numeric|min:1',
            'agreement_id' => 'required|numeric|min:1',
            'field_name' => 'required'
        ];

        $validate = validator()->make($request->all(), $rules);

        if (!$validate->fails()) {
            DB::beginTransaction();

            try {
                $rfq = new AgreementRfq();
                $rfq->borrower_id = $request->borrower_id;
                $rfq->agreement_id = $request->agreement_id;
                $rfq->data_filled_by = auth()->user()->id;
                $rfq->save();

                foreach ($request->field_name as $index => $field) {
                    $agreement = new AgreementData();
                    $agreement->rfq_id = $rfq->id;
                    $agreement->field_id = 0;
                    $agreement->field_name = $index;
                    $agreement->field_value = checkStringFileAray($field);
                    $agreement->save();
                }

                // activity log
                $logData = [
                    'type' => 'agreement_data_upload',
                    'title' => 'Agreement data uploaded',
                    'desc' => ucwords($rfq->borrowerDetails->name_prefix) . ' ' . $rfq->borrowerDetails->full_name . ', ' . $rfq->agreementDetails->name . ' data added by ' . auth()->user()->emp_id
                ];
                activityLog($logData);

                // notification(sender, receiver, type, message(optional), route(optional))
                $notificationMessage = ucwords($rfq->borrowerDetails->name_prefix) . ' ' . $rfq->borrowerDetails->full_name . ', ' . $rfq->agreementDetails->name . ' data added by ' . auth()->user()->emp_id;
                $notificationRoute = 'user.borrower.list';
                createNotification(auth()->user()->id, 1, 'agreement_data_upload', $notificationMessage, $notificationRoute);

                DB::commit();

                return redirect()->route('user.borrower.agreement', $request->borrower_id)->with('success', 'Fields added');
            } catch (Exception $e) {
                DB::rollback();
            }
        } else {
            return response()->json(['error' => true, 'message' => $validate->errors()->first()]);
        }
    }

    public function uploadToServer(Request $request)
    {
        // dd($request->all());

        $rules = [
            'borrower_id' => 'required|integer|min:1',
            'agreement_document_id' => 'required|integer|min:1',
            'document' => 'required|max:500000|mimes:jpg, jpeg, png, pdf',
        ];

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $filePath = fileUpload($request->document, 'borrower-documents');
            AgreementDocumentUpload::where('borrower_id', $request->borrower_id)->where('agreement_document_id', $request->agreement_document_id)->update(['status' => 0]);
            $file = new AgreementDocumentUpload();
            $file->borrower_id = $request->borrower_id;
            $file->agreement_document_id = $request->agreement_document_id;
            $file->file_path = $filePath;
            $file->file_type = request()->document->getClientOriginalExtension();
            $file->uploaded_by = auth()->user()->id;
            $file->save();

            return response()->json(['response_code' => 200, 'title' => 'success', 'message' => 'Successfully uploaded.']);
        } else {
            return response()->json(['response_code' => 400, 'title' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function showDocument(Request $request)
    {
        $rules = [
            'id' => 'required|integer|min:1'
        ];

        $validator = validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $data = (object)[];
            $data->agreement_document_upload = AgreementDocumentUpload::with(['documentDetails', 'borrowerDetails'])->findOrFail($request->id);

            $data->image = asset($data->agreement_document_upload->file_path);

            return response()->json(['response_code' => 200, 'tile' => 'success', 'message' => $data, 'file' => $data->image]);
        } else {
            return response()->json(['response_code' => 400, 'tile' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function verifyDocument(Request $request)
    {
        $rules = [
            'id' => 'required|integer|min:1',
            'type' => 'required|integer',
        ];

        $validator = validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            if ($request->type == 0) {
                $updateType = 1;
            } else {
                $updateType = 0;
            }

            AgreementDocumentUpload::where('id', $request->id)->update(['verify' => $updateType, 'verified_by' => auth()->user()->id]);

            return response()->json(['response_code' => 200, 'tile' => 'success', 'message' => 'Document updated', 'updateStatusCode' => $updateType]);
        } else {
            return response()->json(['response_code' => 400, 'tile' => 'failure', 'message' => $validator->errors()->first()]);
        }
    }

    public function upload(Request $request)
    {
        if (!empty($request->file)) {
            // if ($request->input('submit') != null ) {
            $file = $request->file('file');
            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");
            // 50MB in Bytes
            $maxFileSize = 50097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'upload/borrower/csv';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // echo '<pre>';print_r($importData_arr);exit();

                    // Insert into database
                    foreach ($importData_arr as $importData) {
                        $insertData = array(
                            "CUSTOMER_ID" => $importData[0],
                            "name_prefix" => isset($importData[1]) ? $importData[1] : null,
                            // "full_name" => (isset($importData[2]) ? $importData[2] : null) . (isset($importData[3]) ? ' ' . $importData[3] : null) . (isset($importData[4]) ? ' ' . $importData[4] : null),
                            "first_name" => isset($importData[2]) ? $importData[2] : null,
                            "middle_name" => isset($importData[3]) ? $importData[3] : null,
                            "last_name" => isset($importData[4]) ? $importData[4] : null,
                            "Customer_Type" => isset($importData[5]) ? $importData[5] : null,
                            "Resident_Status" => isset($importData[6]) ? $importData[6] : null,
                            "Aadhar_Number" => isset($importData[7]) ? $importData[7] : null,
                            "pan_card_number" => isset($importData[8]) ? $importData[8] : null,
                            "Main_Constitution" => isset($importData[9]) ? $importData[9] : null,
                            "Sub_Constitution" => isset($importData[10]) ? $importData[10] : null,

                            "gender" => isset($importData[11]) ? $importData[11] : null,
                            "date_of_birth" => isset($importData[12]) ? $importData[12] : null,
                            "KYC_Date" => isset($importData[13]) ? $importData[13] : null,
                            "Re_KYC_Due_Date" => isset($importData[14]) ? $importData[14] : null,
                            "Minor" => isset($importData[15]) ? $importData[15] : null,
                            "Customer_Category" => isset($importData[16]) ? $importData[16] : null,
                            "mobile" => isset($importData[17]) ? $importData[17] : null,
                            "Alternate_Mobile_No" => isset($importData[18]) ? $importData[18] : null,
                            "email" => isset($importData[19]) ? $importData[19] : null,
                            "Telephone_No" => isset($importData[20]) ? $importData[20] : null,
                            "Office_Telephone_No" => isset($importData[21]) ? $importData[21] : null,
                            "FAX_No" => isset($importData[22]) ? $importData[22] : null,
                            "Preferred_Language" => isset($importData[23]) ? $importData[23] : null,
                            "REMARKS" => isset($importData[24]) ? $importData[24] : null,
                            "KYC_Care_of" => isset($importData[25]) ? $importData[25] : null,
                            "KYC_HOUSE_NO" => isset($importData[26]) ? $importData[26] : null,
                            "KYC_LANDMARK" => isset($importData[27]) ? $importData[27] : null,
                            "KYC_Street" => isset($importData[28]) ? $importData[28] : null,
                            "KYC_LOCALITY" => isset($importData[29]) ? $importData[29] : null,
                            "KYC_PINCODE" => isset($importData[30]) ? $importData[30] : null,

                            "KYC_Country" => isset($importData[31]) ? $importData[31] : null,
                            "KYC_State" => isset($importData[32]) ? $importData[32] : null,
                            "KYC_District" => isset($importData[33]) ? $importData[33] : null,
                            "KYC_POST_OFFICE" => isset($importData[34]) ? $importData[34] : null,
                            "KYC_CITY" => isset($importData[35]) ? $importData[35] : null,
                            "KYC_Taluka" => isset($importData[36]) ? $importData[36] : null,
                            "KYC_Population_Group" => isset($importData[37]) ? $importData[37] : null,
                            "COMM_Care_of" => isset($importData[38]) ? $importData[38] : null,
                            "COMM_HOUSE_NO" => isset($importData[39]) ? $importData[39] : null,
                            "COMM_LANDMARK" => isset($importData[40]) ? $importData[40] : null,
                            "COMM_Street" => isset($importData[41]) ? $importData[41] : null,
                            "COMM_LOCALITY" => isset($importData[42]) ? $importData[42] : null,
                            "COMM_PINCODE" => isset($importData[43]) ? $importData[43] : null,
                            "COMM_Country" => isset($importData[44]) ? $importData[44] : null,
                            "COMM_State" => isset($importData[45]) ? $importData[45] : null,
                            "COMM_District" => isset($importData[46]) ? $importData[46] : null,
                            "COMM_POST_OFFICE" => isset($importData[47]) ? $importData[47] : null,
                            "COMM_CITY" => isset($importData[48]) ? $importData[48] : null,
                            "COMM_Taluka" => isset($importData[49]) ? $importData[49] : null,
                            "COMM_Population_Group" => isset($importData[50]) ? $importData[50] : null,

                            "Social_Media" => isset($importData[51]) ? $importData[51] : null,
                            "Social_Media_ID" => isset($importData[52]) ? $importData[52] : null,
                            "PROFESSION" => isset($importData[53]) ? $importData[53] : null,
                            "EDUCATION" => isset($importData[54]) ? $importData[54] : null,
                            "ORGANISATION_NAME" => isset($importData[55]) ? $importData[55] : null,
                            "NET_INCOME" => isset($importData[56]) ? $importData[56] : null,
                            "NET_EXPENSE" => isset($importData[57]) ? $importData[57] : null,
                            "NET_SAVINGS" => isset($importData[58]) ? $importData[58] : null,
                            "Years_in_Organization" => isset($importData[59]) ? $importData[59] : null,
                            "CIBIL_SCORE" => isset($importData[60]) ? $importData[60] : null,
                            "PERSONAL_LOAN_SCORE" => isset($importData[61]) ? $importData[61] : null,
                            "GST_EXEMPTED" => isset($importData[62]) ? $importData[62] : null,
                            "RM_EMP_ID" => isset($importData[63]) ? $importData[63] : null,
                            "RM_Designation" => isset($importData[64]) ? $importData[64] : null,
                            "RM_TITLE" => isset($importData[65]) ? $importData[65] : null,
                            "RM_NAME" => isset($importData[66]) ? $importData[66] : null,
                            "RM_Landline_No" => isset($importData[67]) ? $importData[67] : null,
                            "RM_MOBILE_NO" => isset($importData[68]) ? $importData[68] : null,
                            "RM_EMAIL_ID" => isset($importData[69]) ? $importData[69] : null,
                            "DSA_ID" => isset($importData[70]) ? $importData[70] : null,
                            "DSA_NAME" => isset($importData[71]) ? $importData[71] : null,
                            "DSA_LANDLINE_NO" => isset($importData[72]) ? $importData[72] : null,
                            "DSA_MOBILE_NO" => isset($importData[73]) ? $importData[73] : null,
                            "DSA_EMAIL_ID" => isset($importData[74]) ? $importData[74] : null,
                            "GIR_NO" => isset($importData[75]) ? $importData[75] : null,
                            "RATION_CARD_NO" => isset($importData[76]) ? $importData[76] : null,
                            "DRIVING_LINC" => isset($importData[77]) ? $importData[77] : null,
                            "NPR_NO" => isset($importData[78]) ? $importData[78] : null,
                            "PASSPORT_NO" => isset($importData[79]) ? $importData[79] : null,
                            "EXPORTER_CODE" => isset($importData[80]) ? $importData[80] : null,

                            "GST_NO" => isset($importData[81]) ? $importData[81] : null,
                            "Voter_ID" => isset($importData[82]) ? $importData[82] : null,
                            "CUSTM_2" => isset($importData[83]) ? $importData[83] : null,
                            "CATEGORY" => isset($importData[84]) ? $importData[84] : null,
                            "RELIGION" => isset($importData[85]) ? $importData[85] : null,
                            "MINORITY_STATUS" => isset($importData[86]) ? $importData[86] : null,
                            "CASTE" => isset($importData[87]) ? $importData[87] : null,
                            "SUB_CAST" => isset($importData[88]) ? $importData[88] : null,
                            "RESERVATION_TYP" => isset($importData[89]) ? $importData[89] : null,
                            "Physically_Challenged" => isset($importData[90]) ? $importData[90] : null,
                            "Weaker_Section" => isset($importData[91]) ? $importData[91] : null,
                            "Valued_Customer" => isset($importData[92]) ? $importData[92] : null,
                            "Special_Category_1" => isset($importData[93]) ? $importData[93] : null,
                            "Vip_Category" => isset($importData[94]) ? $importData[94] : null,
                            "Special_Category_2" => isset($importData[95]) ? $importData[95] : null,
                            "Senior_Citizen" => isset($importData[96]) ? $importData[96] : null,
                            "Senior_Citizen_From" => isset($importData[97]) ? $importData[97] : null,
                            "marital_status" => isset($importData[98]) ? $importData[98] : null,
                            "NO_OF_DEPEND" => isset($importData[99]) ? $importData[99] : null,
                            "SPOUSE" => isset($importData[100]) ? $importData[100] : null,
                            // checked with CSV, STATUS - okay 

                            "CHILDREN" => isset($importData[101]) ? $importData[101] : null,
                            "PARENTS" => isset($importData[102]) ? $importData[102] : null,
                            "Employee_Staus" => isset($importData[103]) ? $importData[103] : null,
                            "Employee_No" => isset($importData[104]) ? $importData[104] : null,
                            "EMP_Date" => isset($importData[105]) ? $importData[105] : null,
                            "Nature_of_Occupation" => isset($importData[106]) ? $importData[106] : null,
                            "EMPLYEER_NAME" => isset($importData[107]) ? $importData[107] : null,
                            "Role" => isset($importData[108]) ? $importData[108] : null,
                            "SPECIALIZATION" => isset($importData[109]) ? $importData[109] : null,
                            "EMP_GRADE" => isset($importData[110]) ? $importData[110] : null,

                            "DESIGNATION" => isset($importData[111]) ? $importData[111] : null,
                            "Office_Address" => isset($importData[112]) ? $importData[112] : null,
                            "Office_Phone" => isset($importData[113]) ? $importData[113] : null,
                            "Office_EXTENSION" => isset($importData[114]) ? $importData[114] : null,
                            "Office_Fax" => isset($importData[115]) ? $importData[115] : null,
                            "Office_MOBILE" => isset($importData[116]) ? $importData[116] : null,
                            "Office_PINCODE" => isset($importData[117]) ? $importData[117] : null,
                            "Office_CITY" => isset($importData[118]) ? $importData[118] : null, // CITY -> Office_CITY
                            "Working_Since" => isset($importData[119]) ? $importData[119] : null,
                            "Working_in_Current_company_Yrs" => isset($importData[120]) ? $importData[120] : null,

                            "RETIRE_AGE" => isset($importData[121]) ? $importData[121] : null,
                            "Nature_of_Business" => isset($importData[122]) ? $importData[122] : null,
                            "Annual_Income" => isset($importData[123]) ? $importData[123] : null,
                            "Prof_Self_Employed" => isset($importData[124]) ? $importData[124] : null,
                            "Prof_Self_Annual_Income" => isset($importData[125]) ? $importData[125] : null,
                            "IT_RETURN_YR1" => isset($importData[126]) ? $importData[126] : null,
                            "INCOME_DECLARED1" => isset($importData[127]) ? $importData[127] : null,
                            "TAX_PAID" => isset($importData[128]) ? $importData[128] : null,
                            "REFUND_CLAIMED1" => isset($importData[129]) ? $importData[129] : null,
                            "IT_RETURN_YR2" => isset($importData[130]) ? $importData[130] : null,

                            "INCOME_DECLARED2" => isset($importData[131]) ? $importData[131] : null,
                            "TAX_PAID2" => isset($importData[132]) ? $importData[132] : null,
                            "REFUND_CLAIMED2" => isset($importData[133]) ? $importData[133] : null,
                            "IT_RETURN_YR3" => isset($importData[134]) ? $importData[134] : null,
                            "INCOME_DECLARED3" => isset($importData[135]) ? $importData[135] : null,
                            "TAX_PAID3" => isset($importData[136]) ? $importData[136] : null,
                            "REFUND_CLAIMED3" => isset($importData[137]) ? $importData[137] : null,
                            "Maiden_Title" => isset($importData[138]) ? $importData[138] : null,
                            "Maiden_First_Name" => isset($importData[139]) ? $importData[139] : null,
                            "Maiden_Middle_Name" => isset($importData[140]) ? $importData[140] : null,
                            // checked with CSV, STATUS - okay 

                            "Maiden_Last_Name" => isset($importData[141]) ? $importData[141] : null,
                            "Father_Title" => isset($importData[142]) ? $importData[142] : null,
                            "Father_First_Name" => isset($importData[143]) ? $importData[143] : null,
                            "Father_Middle_Name" => isset($importData[144]) ? $importData[144] : null,
                            "Father_Last_Name" => isset($importData[145]) ? $importData[145] : null,
                            "Mother_Title" => isset($importData[146]) ? $importData[146] : null,
                            "Mother_First_Name" => isset($importData[147]) ? $importData[147] : null,
                            "Mothers_Maiden_Name" => isset($importData[148]) ? $importData[148] : null,
                            "Generic_Surname" => isset($importData[149]) ? $importData[149] : null,
                            "Spouse_Title" => isset($importData[150]) ? $importData[150] : null,
                            // checked with CSV, STATUS - okay 

                            "Spouse_First_Name" => isset($importData[151]) ? $importData[151] : null,
                            "Spouse_Family_Name" => isset($importData[152]) ? $importData[152] : null,
                            "Identification_Mark" => isset($importData[153]) ? $importData[153] : null,
                            "Country_of_Domicile" => isset($importData[154]) ? $importData[154] : null,
                            "Qualification" => isset($importData[155]) ? $importData[155] : null,
                            "Nationality" => isset($importData[156]) ? $importData[156] : null,
                            "Blood_Group" => isset($importData[157]) ? $importData[157] : null,
                            "Offences" => isset($importData[158]) ? $importData[158] : null,
                            "Politically_Exposed" => isset($importData[159]) ? $importData[159] : null,
                            "Residence_Type" => isset($importData[160]) ? $importData[160] : null,
                            // checked with CSV, STATUS - okay 

                            // "Spouse_First_Name" => isset($importData[161]) ? $importData[161] : null,
                            // "Spouse_Family_Name" => isset($importData[162]) ? $importData[162] : null,
                            // "Identification_Mark" => isset($importData[163]) ? $importData[163] : null,
                            // "Country_of_Domicile" => isset($importData[164]) ? $importData[164] : null,
                            // "Qualification" => isset($importData[165]) ? $importData[165] : null,
                            // "Nationality" => isset($importData[166]) ? $importData[166] : null,
                            // "Blood_Group" => isset($importData[167]) ? $importData[167] : null,
                            // "Offences" => isset($importData[168]) ? $importData[168] : null,
                            // "Politically_Exposed" => isset($importData[169]) ? $importData[169] : null,
                            // "Residence_Type" => isset($importData[170]) ? $importData[170] : null,

                            "AREA" => isset($importData[161]) ? $importData[161] : null,
                            "land_mark" => isset($importData[162]) ? $importData[162] : null,
                            "Owned" => isset($importData[163]) ? $importData[163] : null,
                            "Rented" => isset($importData[164]) ? $importData[164] : null,
                            "Rent_Per_Month" => isset($importData[165]) ? $importData[165] : null,
                            "Ancestral" => isset($importData[166]) ? $importData[166] : null,
                            "EMPLOYERRS" => isset($importData[167]) ? $importData[167] : null,
                            "Staying_Since" => isset($importData[168]) ? $importData[168] : null,

                            // EXTRA FIELDS
                            "full_name" => (isset($importData[2]) ? $importData[2] : null) . (isset($importData[3]) ? ' ' . $importData[3] : null) . (isset($importData[4]) ? ' ' . $importData[4] : null),
                            "occupation" => isset($importData[53]) ? $importData[53] : null,
                            "street_address" => isset($importData[28]) ? $importData[28] : null,
                            "city" => isset($importData[35]) ? $importData[35] : null,
                            "pincode" => isset($importData[30]) ? $importData[30] : null,
                            "state" => isset($importData[32]) ? $importData[32] : null,
                        );
                        // echo '<pre>';print_r($insertData);exit();
                        Borrower::insertData($insertData);
                    }
                    Session::flash('message', 'Import Successful.');
                } else {
                    Session::flash('message', 'File too large. File must be less than 50MB.');
                }
            } else {
                Session::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
            }
        } else {
            Session::flash('message', 'No file found.');
        }

        return redirect()->route('user.borrower.list');
    }
}
