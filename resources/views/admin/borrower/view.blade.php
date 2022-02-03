@extends('layouts.auth.master')

@section('title', 'View borrower details')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                                <a href="{{ route('user.borrower.list') }}" class="btn btn-sm btn-primary"> <i
                                        class="fas fa-chevron-left"></i> Back</a>

                                <a href="{{ route('user.borrower.edit', $data->id) }}" class="btn btn-sm btn-success"
                                    title="Edit borrower"><i class="fas fa-edit"></i> Edit</a>

                                <a href="javascript: void(0)" class="btn btn-sm btn-danger" title="Delete borrower"
                                    onclick="confirm4lert('{{ route('user.borrower.destroy') }}', {{ $data->id }}, 'delete')"><i
                                        class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="font-weight-bold mb-1">
                                <span>{{ ucwords($data->name_prefix) }}</span>
                                <span title="Name">{{ $data->full_name }}</span>,
                                <span title="Age"
                                    class="text-muted">{{ date('Y') - date('Y', strtotime($data->date_of_birth)) }}</span>
                                <span title="Gender" class="text-muted">({{ ucwords($data->gender) }})</span>
                            </h6>
                            {{-- <h6 class="font-weight-bold mb-3 text-muted">{{ucwords($data->gender)}}</h6> --}}

                            <p class="text-muted small mb-0">Email</p>
                            <p class="text-dark small">{{ $data->email }}</p>
                            <p class="text-muted small mb-0">Mobile</p>
                            <p class="text-dark small">{{ $data->mobile }}</p>
                            <p class="text-muted small mb-0">PAN card number</p>
                            <p class="text-dark small">{{ $data->pan_card_number }}</p>

                            <hr>

                            <p class="text-muted small mb-0">Occupation</p>
                            <p class="text-dark small">{{ $data->occupation }}</p>
                            <p class="text-muted small mb-0">Date of birth</p>
                            <p class="text-dark small">{{ $data->date_of_birth }}</p>
                            <p class="text-muted small mb-0">Marital status</p>
                            <p class="text-dark small mb-0">{{ $data->marital_status }}</p>

                            <hr>

                            <p class="text-muted small mb-0">Street address2</p>
                            <p class="text-dark small">{{ $data->street_address }}</p>
                            <p class="text-muted small mb-0">City</p>
                            <p class="text-dark small">{{ $data->city }}</p>
                            <p class="text-muted small mb-0">Pincode</p>
                            <p class="text-dark small">{{ $data->pincode }}</p>
                            <p class="text-muted small mb-0">State</p>
                            <p class="text-dark small mb-0">{{ $data->state }}</p>

                            <hr>

                            <p class="text-muted small mb-0">Customer Type</p>
                            <p class="text-dark small">{{ $data->Customer_Type ? $data->Customer_Type : 'NA' }}</p>
                            <p class="text-muted small mb-0">Resident Status</p>
                            <p class="text-dark small">{{ $data->Resident_Status ? $data->Resident_Status : 'NA' }}</p>
                            <p class="text-muted small mb-0">Aadhar Number</p>
                            <p class="text-dark small">{{ $data->Aadhar_Number ? $data->Aadhar_Number : 'NA' }}</p>
                            <p class="text-muted small mb-0">Main Constitution</p>
                            <p class="text-dark small">{{ $data->Main_Constitution ? $data->Main_Constitution : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">KYC Date</p>
                            <p class="text-dark small">{{ $data->KYC_Date ? $data->KYC_Date : 'NA' }}</p>
                            <p class="text-muted small mb-0">Re KYC Due Date </p>
                            <p class="text-dark small">{{ $data->Re_KYC_Due_Date ? $data->Re_KYC_Due_Date : 'NA' }}</p>
                            <p class="text-muted small mb-0">Minor </p>
                            <p class="text-dark small">{{ $data->Minor ? $data->Minor : 'NA' }}</p>
                            <p class="text-muted small mb-0">Customer Category </p>
                            <p class="text-dark small">{{ $data->Customer_Category ? $data->Customer_Category : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Alternate Mobile No </p>
                            <p class="text-dark small">
                                {{ $data->Alternate_Mobile_No ? $data->Alternate_Mobile_No : 'NA' }}</p>
                            <p class="text-muted small mb-0">Telephone No </p>
                            <p class="text-dark small">{{ $data->Telephone_No ? $data->Telephone_No : 'NA' }}</p>
                            <p class="text-muted small mb-0">Office Telephone No </p>
                            <p class="text-dark small">
                                {{ $data->Office_Telephone_No ? $data->Office_Telephone_No : 'NA' }}</p>
                            <p class="text-muted small mb-0">FAX No </p>
                            <p class="text-dark small">{{ $data->FAX_No ? $data->FAX_No : 'NA' }}</p>
                            <p class="text-muted small mb-0">PreferredLanguage </p>
                            <p class="text-dark small">{{ $data->Preferred_Language ? $data->Preferred_Language : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Remarks</p>
                            <p class="text-dark small">{{ $data->REMARKS ? $data->REMARKS : 'NA' }}</p>
                            <p class="text-muted small mb-0">KYC Care of </p>
                            <p class="text-dark small">{{ $data->KYC_Care_of ? $data->KYC_Care_of : 'NA' }}</p>
                            <p class="text-muted small mb-0">KYC House No </p>
                            <p class="text-dark small">{{ $data->KYC_HOUSE_NO ? $data->KYC_HOUSE_NO : 'NA' }}</p>
                            <p class="text-muted small mb-0">KYC Landmark</p>
                            <p class="text-dark small">{{ $data->KYC_LANDMARK ? $data->KYC_LANDMARK : 'NA' }}</p>
                            <p class="text-muted small mb-0">KYC Street </p>
                            <p class="text-dark small">{{ $data->KYC_Street ? $data->KYC_Street : 'NA' }}</p>
                            <p class="text-muted small mb-0">KYC Locality </p>
                            <p class="text-dark small">{{ $data->KYC_LOCALITY ? $data->KYC_LOCALITY : 'NA' }}</p>
                            <p class="text-muted small mb-0">KYC Pincode </p>
                            <p class="text-dark small">{{ $data->KYC_PINCODE ? $data->KYC_PINCODE : 'NA' }}</p>
                            <p class="text-muted small mb-0">KYC Country </p>
                            <p class="text-dark small">{{ $data->KYC_Country ? $data->KYC_Country : 'NA' }}</p>
                            <p class="text-muted small mb-0">KYC State </p>
                            <p class="text-dark small">{{ $data->KYC_State ? $data->KYC_State : 'NA' }}</p>
                            <p class="text-muted small mb-0">KYC District </p>
                            <p class="text-dark small">{{ $data->KYC_District ? $data->KYC_District : 'NA' }}</p>
                            <p class="text-muted small mb-0">KYC Post Office </p>
                            <p class="text-dark small">{{ $data->KYC_POST_OFFICE ? $data->KYC_POST_OFFICE : 'NA' }}</p>


                            <p class="text-muted small mb-0">KYC City </p>
                            <p class="text-dark small">{{ $data->KYC_CITY ? $data->KYC_CITY : 'NA' }}</p>
                            <p class="text-muted small mb-0">KYC Taluka </p>
                            <p class="text-dark small">{{ $data->KYC_Taluka ? $data->KYC_Taluka : 'NA' }}</p>
                            <p class="text-muted small mb-0">Communication Care of </p>
                            <p class="text-dark small">{{ $data->COMM_Care_of ? $data->COMM_Care_of : 'NA' }}</p>
                            <p class="text-muted small mb-0">Communication House No </p>
                            <p class="text-dark small">{{ $data->COMM_HOUSE_NO ? $data->COMM_HOUSE_NO : 'NA' }}</p>
                            <p class="text-muted small mb-0">Communication Landmark </p>
                            <p class="text-dark small">{{ $data->COMM_LANDMARK ? $data->COMM_LANDMARK : 'NA' }}</p>
                            <p class="text-muted small mb-0">Communication Locality </p>
                            <p class="text-dark small">{{ $data->COMM_LOCALITY ? $data->COMM_LOCALITY : 'NA' }}</p>
                            <p class="text-muted small mb-0">Communication Pincode </p>
                            <p class="text-dark small">{{ $data->COMM_PINCODE ? $data->COMM_PINCODE : 'NA' }}</p>
                            <p class="text-muted small mb-0">Communication Country </p>
                            <p class="text-dark small">{{ $data->COMM_Country ? $data->COMM_Country : 'NA' }}</p>
                            <p class="text-muted small mb-0">Communication State </p>
                            <p class="text-dark small">{{ $data->COMM_State ? $data->COMM_State : 'NA' }}</p>
                            <p class="text-muted small mb-0">Communication District </p>
                            <p class="text-dark small">{{ $data->COMM_District ? $data->COMM_District : 'NA' }}</p>
                            <p class="text-muted small mb-0">Communication Post Office </p>
                            <p class="text-dark small">{{ $data->COMM_POST_OFFICE ? $data->COMM_POST_OFFICE : 'NA' }}
                            </p>


                            <p class="text-muted small mb-0">Communication City </p>
                            <p class="text-dark small">{{ $data->COMM_CITY ? $data->COMM_CITY : 'NA' }}</p>
                            <p class="text-muted small mb-0">Communication Taluka </p>
                            <p class="text-dark small">{{ $data->COMM_Taluka ? $data->COMM_Taluka : 'NA' }}</p>
                            <p class="text-muted small mb-0">Communication Population Group </p>
                            <p class="text-dark small">
                                {{ $data->COMM_Population_Group ? $data->COMM_Population_Group : 'NA' }}</p>
                            <p class="text-muted small mb-0">Social Media </p>
                            <p class="text-dark small">{{ $data->Social_Media ? $data->Social_Media : 'NA' }}</p>
                            <p class="text-muted small mb-0">Social Media ID </p>
                            <p class="text-dark small">{{ $data->Social_Media_ID ? $data->Social_Media_ID : 'NA' }}</p>
                            <p class="text-muted small mb-0">Profession </p>
                            <p class="text-dark small">{{ $data->PROFESSION ? $data->PROFESSION : 'NA' }}</p>
                            <p class="text-muted small mb-0">Edeucation </p>
                            <p class="text-dark small">{{ $data->EDUCATION ? $data->EDUCATION : 'NA' }}</p>
                            <p class="text-muted small mb-0">Organisation Name </p>
                            <p class="text-dark small">{{ $data->ORGANISATION_NAME ? $data->ORGANISATION_NAME : 'NA' }}
                            </p>


                            <p class="text-muted small mb-0">Net Income </p>
                            <p class="text-dark small">{{ $data->NET_INCOME ? $data->NET_INCOME : 'NA' }}</p>
                            <p class="text-muted small mb-0">Net Expense </p>
                            <p class="text-dark small">{{ $data->NET_EXPENSE ? $data->NET_EXPENSE : 'NA' }}</p>
                            <p class="text-muted small mb-0">Net Savings </p>
                            <p class="text-dark small">{{ $data->NET_SAVINGS ? $data->NET_SAVINGS : 'NA' }}</p>
                            <p class="text-muted small mb-0">Years in Organization </p>
                            <p class="text-dark small">
                                {{ $data->Years_in_Organization ? $data->Years_in_Organization : 'NA' }}</p>
                            <p class="text-muted small mb-0">Cibil Score </p>
                            <p class="text-dark small">{{ $data->CIBIL_SCORE ? $data->CIBIL_SCORE : 'NA' }}</p>
                            <p class="text-muted small mb-0">Personal Loan Score </p>
                            <p class="text-dark small">
                                {{ $data->PERSONAL_LOAN_SCORE ? $data->PERSONAL_LOAN_SCORE : 'NA' }}</p>
                            <p class="text-muted small mb-0">GST EXEMPTED </p>
                            <p class="text-dark small">{{ $data->GST_EXEMPTED ? $data->GST_EXEMPTED : 'NA' }}</p>
                            <p class="text-muted small mb-0">RM EMP ID </p>
                            <p class="text-dark small">{{ $data->RM_EMP_ID ? $data->RM_EMP_ID : 'NA' }}</p>


                            <p class="text-muted small mb-0">RM Designation </p>
                            <p class="text-dark small">{{ $data->RM_Designation ? $data->RM_Designation : 'NA' }}</p>
                            <p class="text-muted small mb-0">RM Title </p>
                            <p class="text-dark small">{{ $data->RM_TITLE ? $data->RM_TITLE : 'NA' }}</p>
                            <p class="text-muted small mb-0">RM Name </p>
                            <p class="text-dark small">{{ $data->RM_NAME ? $data->RM_NAME : 'NA' }}</p>
                            <p class="text-muted small mb-0">RM Landline No </p>
                            <p class="text-dark small">{{ $data->RM_Landline_No ? $data->RM_Landline_No : 'NA' }}</p>
                            <p class="text-muted small mb-0">RM Mobile Number </p>
                            <p class="text-dark small">{{ $data->RM_MOBILE_NO ? $data->RM_MOBILE_NO : 'NA' }}</p>
                            <p class="text-muted small mb-0">RM Email Id </p>
                            <p class="text-dark small">{{ $data->RM_EMAIL_ID ? $data->RM_EMAIL_ID : 'NA' }}</p>
                            <p class="text-muted small mb-0">DSA Id </p>
                            <p class="text-dark small">{{ $data->DSA_ID ? $data->DSA_ID : 'NA' }}</p>
                            <p class="text-muted small mb-0">DSA Name </p>
                            <p class="text-dark small">{{ $data->DSA_NAME ? $data->DSA_NAME : 'NA' }}</p>
                            <p class="text-muted small mb-0">DSA Landline No </p>
                            <p class="text-dark small">{{ $data->DSA_LANDLINE_NO ? $data->DSA_LANDLINE_NO : 'NA' }}</p>


                            <p class="text-muted small mb-0">DSA Mobile Number</p>
                            <p class="text-dark small">{{ $data->DSA_MOBILE_NO ? $data->DSA_MOBILE_NO : 'NA' }}</p>
                            <p class="text-muted small mb-0">DSA Email Id </p>
                            <p class="text-dark small">{{ $data->DSA_EMAIL_ID ? $data->DSA_EMAIL_ID : 'NA' }}</p>
                            <p class="text-muted small mb-0">GIR No </p>
                            <p class="text-dark small">{{ $data->GIR_NO ? $data->GIR_NO : 'NA' }}</p>
                            <p class="text-muted small mb-0">Ration Card No </p>
                            <p class="text-dark small">{{ $data->RATION_CARD_NO ? $data->RATION_CARD_NO : 'NA' }}</p>
                            <p class="text-muted small mb-0">Driveing Linc </p>
                            <p class="text-dark small">{{ $data->DRIVING_LINC ? $data->DRIVING_LINC : 'NA' }}</p>
                            <p class="text-muted small mb-0">NPR No </p>
                            <p class="text-dark small">{{ $data->NPR_NO ? $data->NPR_NO : 'NA' }}</p>
                            <p class="text-muted small mb-0">Passport No </p>
                            <p class="text-dark small">{{ $data->PASSPORT_NO ? $data->PASSPORT_NO : 'NA' }}</p>
                            <p class="text-muted small mb-0">Exporter Code </p>
                            <p class="text-dark small">{{ $data->EXPORTER_CODE ? $data->EXPORTER_CODE : 'NA' }}</p>


                            <p class="text-muted small mb-0">GST No </p>
                            <p class="text-dark small">{{ $data->GST_NO ? $data->GST_NO : 'NA' }}</p>
                            <p class="text-muted small mb-0">Voter Id </p>
                            <p class="text-dark small">{{ $data->Voter_ID ? $data->Voter_ID : 'NA' }}</p>
                            <p class="text-muted small mb-0">CUSTM 2 </p>
                            <p class="text-dark small">{{ $data->CUSTM_2 ? $data->CUSTM_2 : 'NA' }}</p>
                            <p class="text-muted small mb-0">Category </p>
                            <p class="text-dark small">{{ $data->CATEGORY ? $data->CATEGORY : 'NA' }}</p>
                            <p class="text-muted small mb-0">Religion </p>
                            <p class="text-dark small">{{ $data->RELIGION ? $data->RELIGION : 'NA' }}</p>
                            <p class="text-muted small mb-0">Minority Status </p>
                            <p class="text-dark small">{{ $data->MINORITY_STATUS ? $data->MINORITY_STATUS : 'NA' }}</p>
                            <p class="text-muted small mb-0">CASTE </p>
                            <p class="text-dark small">{{ $data->CASTE ? $data->CASTE : 'NA' }}</p>
                            <p class="text-muted small mb-0">Sub Cast </p>
                            <p class="text-dark small">{{ $data->SUB_CAST ? $data->SUB_CAST : 'NA' }}</p>
                            <p class="text-muted small mb-0">Reservation Type</p>
                            <p class="text-dark small">{{ $data->RESERVATION_TYP ? $data->RESERVATION_TYP : 'NA' }}</p>


                            <p class="text-muted small mb-0">Physically Challenged </p>
                            <p class="text-dark small">
                                {{ $data->Physically_Challenged ? $data->Physically_Challenged : 'NA' }}</p>
                            <p class="text-muted small mb-0">Weaker Section </p>
                            <p class="text-dark small">{{ $data->Weaker_Section ? $data->Weaker_Section : 'NA' }}</p>
                            <p class="text-muted small mb-0">Valued Customer </p>
                            <p class="text-dark small">{{ $data->Valued_Customer ? $data->Valued_Customer : 'NA' }}</p>
                            <p class="text-muted small mb-0">Special Category 1 </p>
                            <p class="text-dark small">
                                {{ $data->Special_Category_1 ? $data->Special_Category_1 : 'NA' }}</p>
                            <p class="text-muted small mb-0">Vip Category </p>
                            <p class="text-dark small">{{ $data->Vip_Category ? $data->Vip_Category : 'NA' }}</p>
                            <p class="text-muted small mb-0">Special Category 2 </p>
                            <p class="text-dark small">
                                {{ $data->Special_Category_2 ? $data->Special_Category_2 : 'NA' }}</p>
                            <p class="text-muted small mb-0">Senior Citizen </p>
                            <p class="text-dark small">{{ $data->Senior_Citizen ? $data->Senior_Citizen : 'NA' }}</p>
                            <p class="text-muted small mb-0">Senior Citizen From </p>
                            <p class="text-dark small">
                                {{ $data->Senior_Citizen_From ? $data->Senior_Citizen_From : 'NA' }}</p>


                            <p class="text-muted small mb-0">No Of Depend </p>
                            <p class="text-dark small">{{ $data->NO_OF_DEPEND ? $data->NO_OF_DEPEND : 'NA' }}</p>
                            <p class="text-muted small mb-0">Spouse </p>
                            <p class="text-dark small">{{ $data->SPOUSE ? $data->SPOUSE : 'NA' }}</p>
                            <p class="text-muted small mb-0">Children </p>
                            <p class="text-dark small">{{ $data->CHILDREN ? $data->CHILDREN : 'NA' }}</p>
                            <p class="text-muted small mb-0">Parents </p>
                            <p class="text-dark small">{{ $data->PARENTS ? $data->PARENTS : 'NA' }}</p>
                            <p class="text-muted small mb-0">Employee Staus </p>
                            <p class="text-dark small">{{ $data->Employee_Staus ? $data->Employee_Staus : 'NA' }}</p>
                            <p class="text-muted small mb-0">Employee No </p>
                            <p class="text-dark small">{{ $data->Employee_No ? $data->Employee_No : 'NA' }}</p>
                            <p class="text-muted small mb-0">EMP Date </p>
                            <p class="text-dark small">{{ $data->EMP_Date ? $data->EMP_Date : 'NA' }}</p>


                            <p class="text-muted small mb-0">Nature of Occupation </p>
                            <p class="text-dark small">
                                {{ $data->Nature_of_Occupation ? $data->Nature_of_Occupation : 'NA' }}</p>
                            <p class="text-muted small mb-0">Employer Name </p>
                            <p class="text-dark small">{{ $data->EMPLYEER_NAME ? $data->EMPLYEER_NAME : 'NA' }}</p>
                            <p class="text-muted small mb-0">Role </p>
                            <p class="text-dark small">{{ $data->Role ? $data->Role : 'NA' }}</p>




                            <p class="text-muted small mb-0">Specialization </p>
                            <p class="text-dark small">{{ $data->SPECIALIZATION ? $data->SPECIALIZATION : 'NA' }}</p>
                            <p class="text-muted small mb-0">Employe Grade </p>
                            <p class="text-dark small">{{ $data->EMP_GRADE ? $data->EMP_GRADE : 'NA' }}</p>
                            <p class="text-muted small mb-0">Designation </p>
                            <p class="text-dark small">{{ $data->DESIGNATION ? $data->DESIGNATION : 'NA' }}</p>
                            <p class="text-muted small mb-0">Office Address </p>
                            <p class="text-dark small">{{ $data->Office_Address ? $data->Office_Address : 'NA' }}</p>
                            <p class="text-muted small mb-0">Office Phone </p>
                            <p class="text-dark small">{{ $data->Office_Phone ? $data->Office_Phone : 'NA' }}</p>
                            <p class="text-muted small mb-0">Office Extansion </p>
                            <p class="text-dark small">{{ $data->Office_EXTENSION ? $data->Office_EXTENSION : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Office Fax </p>
                            <p class="text-dark small">{{ $data->Office_Fax ? $data->Office_Fax : 'NA' }}</p>

                            <p class="text-muted small mb-0">Office Mobile </p>
                            <p class="text-dark small">{{ $data->Office_MOBILE ? $data->Office_MOBILE : 'NA' }}</p>
                            <p class="text-muted small mb-0">Office Pincode </p>
                            <p class="text-dark small">{{ $data->Office_PINCODE ? $data->Office_PINCODE : 'NA' }}</p>
                            <p class="text-muted small mb-0">Office City </p>
                            <p class="text-dark small">{{ $data->Office_CITY ? $data->Office_CITY : 'NA' }}</p>
                            <p class="text-muted small mb-0">Working Since </p>
                            <p class="text-dark small">{{ $data->Working_Since ? $data->Working_Since : 'NA' }}</p>
                            <p class="text-muted small mb-0">Working in Current company Years </p>
                            <p class="text-dark small">
                                {{ $data->Working_in_Current_company_Yrs ? $data->Working_in_Current_company_Yrs : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Retire Age </p>
                            <p class="text-dark small">{{ $data->RETIRE_AGE ? $data->RETIRE_AGE : 'NA' }}</p>
                            <p class="text-muted small mb-0">Nature of Business </p>
                            <p class="text-dark small">
                                {{ $data->Nature_of_Business ? $data->Nature_of_Business : 'NA' }}</p>
                            <p class="text-muted small mb-0">Annual Income </p>
                            <p class="text-dark small">{{ $data->Annual_Income ? $data->Annual_Income : 'NA' }}</p>

                            <p class="text-muted small mb-0">Prof Self Employed </p>
                            <p class="text-dark small">
                                {{ $data->Prof_Self_Employed ? $data->Prof_Self_Employed : 'NA' }}</p>
                            <p class="text-muted small mb-0">Prof Self Annual Income </p>
                            <p class="text-dark small">
                                {{ $data->Prof_Self_Annual_Income ? $data->Prof_Self_Annual_Income : 'NA' }}</p>
                            <p class="text-muted small mb-0">IT Return Year 1 </p>
                            <p class="text-dark small">{{ $data->IT_RETURN_YR1 ? $data->IT_RETURN_YR1 : 'NA' }}</p>
                            <p class="text-muted small mb-0">Income Declared 1</p>
                            <p class="text-dark small">{{ $data->INCOME_DECLARED1 ? $data->INCOME_DECLARED1 : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Tax paid </p>
                            <p class="text-dark small">{{ $data->TAX_PAID ? $data->TAX_PAID : 'NA' }}</p>
                            <p class="text-muted small mb-0">Refund Claimed 1 </p>
                            <p class="text-dark small">{{ $data->REFUND_CLAIMED1 ? $data->REFUND_CLAIMED1 : 'NA' }}</p>
                            <p class="text-muted small mb-0">IT Return Year 2</p>
                            <p class="text-dark small">{{ $data->IT_RETURN_YR2 ? $data->IT_RETURN_YR2 : 'NA' }}</p>

                            <p class="text-muted small mb-0">Income Declared 2 </p>
                            <p class="text-dark small">{{ $data->INCOME_DECLARED2 ? $data->INCOME_DECLARED2 : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Tax Paid 2 </p>
                            <p class="text-dark small">{{ $data->TAX_PAID2 ? $data->TAX_PAID2 : 'NA' }}</p>
                            <p class="text-muted small mb-0">Refund Claimed 2 </p>
                            <p class="text-dark small">{{ $data->REFUND_CLAIMED2 ? $data->REFUND_CLAIMED2 : 'NA' }}</p>
                            <p class="text-muted small mb-0">IT Return Year 3 </p>
                            <p class="text-dark small">{{ $data->IT_RETURN_YR3 ? $data->IT_RETURN_YR3 : 'NA' }}</p>
                            <p class="text-muted small mb-0">Income Declared 3 </p>
                            <p class="text-dark small">{{ $data->INCOME_DECLARED3 ? $data->INCOME_DECLARED3 : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Tax Paid 3 </p>
                            <p class="text-dark small">{{ $data->TAX_PAID3 ? $data->TAX_PAID3 : 'NA' }}</p>


                            <p class="text-muted small mb-0">Refund Claimed 3 </p>
                            <p class="text-dark small">{{ $data->REFUND_CLAIMED3 ? $data->REFUND_CLAIMED3 : 'NA' }}</p>
                            <p class="text-muted small mb-0">Maiden Title </p>
                            <p class="text-dark small">{{ $data->Maiden_Title ? $data->Maiden_Title : 'NA' }}</p>
                            <p class="text-muted small mb-0">Maiden First Name </p>
                            <p class="text-dark small">{{ $data->Maiden_First_Name ? $data->Maiden_First_Name : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Maiden Middle Name </p>
                            <p class="text-dark small">
                                {{ $data->Maiden_Middle_Name ? $data->Maiden_Middle_Name : 'NA' }}</p>
                            <p class="text-muted small mb-0">Maiden Last Name </p>
                            <p class="text-dark small">{{ $data->Maiden_Last_Name ? $data->Maiden_Last_Name : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Father Title </p>
                            <p class="text-dark small">{{ $data->Father_Title ? $data->Father_Title : 'NA' }}</p>

                            <p class="text-muted small mb-0">Father First Name </p>
                            <p class="text-dark small">{{ $data->Father_First_Name ? $data->Father_First_Name : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Father Middle Name </p>
                            <p class="text-dark small">
                                {{ $data->Father_Middle_Name ? $data->Father_Middle_Name : 'NA' }}</p>
                            <p class="text-muted small mb-0">Father Last Name </p>
                            <p class="text-dark small">{{ $data->Father_Last_Name ? $data->Father_Last_Name : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Mother Title </p>
                            <p class="text-dark small">{{ $data->MotherTitle ? $data->Mother_Title : 'NA' }}</p>
                            <p class="text-muted small mb-0">Mother First Name </p>
                            <p class="text-dark small">{{ $data->Mother_First_Name ? $data->Mother_First_Name : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Mothers Middle Name </p>
                            <p class="text-dark small">
                                {{ $data->Mothers_Maiden_Name ? $data->Mothers_Maiden_Name : 'NA' }}</p>


                            <p class="text-muted small mb-0">Generic Surname </p>
                            <p class="text-dark small">{{ $data->Generic_Surname ? $data->Generic_Surname : 'NA' }}</p>
                            <p class="text-muted small mb-0">Spouse Title </p>
                            <p class="text-dark small">{{ $data->Spouse_Title ? $data->Spouse_Title : 'NA' }}</p>
                            <p class="text-muted small mb-0">Spouse First Name </p>
                            <p class="text-dark small">{{ $data->Spouse_First_Name ? $data->Spouse_First_Name : 'NA' }}
                            </p>
                            <p class="text-muted small mb-0">Spouse Family Name </p>
                            <p class="text-dark small">
                                {{ $data->Spouse_Family_Name ? $data->Spouse_Family_Name : 'NA' }}</p>
                            <p class="text-muted small mb-0">Identification Mark </p>
                            <p class="text-dark small">
                                {{ $data->Identification_Mark ? $data->Identification_Mark : 'NA' }}</p>
                            <p class="text-muted small mb-0">Country of Domicile </p>
                            <p class="text-dark small">
                                {{ $data->Country_of_Domicile ? $data->Country_of_Domicile : 'NA' }}</p>

                            <p class="text-muted small mb-0">Qualification </p>
                            <p class="text-dark small">{{ $data->Qualification ? $data->Qualification : 'NA' }}</p>
                            <p class="text-muted small mb-0">Nationality </p>
                            <p class="text-dark small">{{ $data->Nationality ? $data->Nationality : 'NA' }}</p>
                            <p class="text-muted small mb-0">Blood Group </p>
                            <p class="text-dark small">{{ $data->Blood_Group ? $data->Blood_Group : 'NA' }}</p>
                            <p class="text-muted small mb-0">Offences </p>
                            <p class="text-dark small">{{ $data->Offences ? $data->Offences : 'NA' }}</p>
                            <p class="text-muted small mb-0">Politically Exposed </p>
                            <p class="text-dark small">
                                {{ $data->Politically_Exposed ? $data->Politically_Exposed : 'NA' }}</p>
                            <p class="text-muted small mb-0">Residence Type </p>
                            <p class="text-dark small">{{ $data->Residence_Type ? $data->Residence_Type : 'NA' }}</p>
                            <p class="text-muted small mb-0">Area </p>
                            <p class="text-dark small">{{ $data->AREA ? $data->AREA : 'NA' }}</p>
                            <p class="text-muted small mb-0">land Mark </p>
                            <p class="text-dark small">{{ $data->land_mark ? $data->land_mark : 'NA' }}</p>


                            <p class="text-muted small mb-0">Owned </p>
                            <p class="text-dark small">{{ $data->Owned ? $data->Owned : 'NA' }}</p>
                            <p class="text-muted small mb-0">Rented </p>
                            <p class="text-dark small">{{ $data->Rented ? $data->Rented : 'NA' }}</p>
                            <p class="text-muted small mb-0">Rent Per Month </p>
                            <p class="text-dark small">{{ $data->Rent_Per_Month ? $data->Rent_Per_Month : 'NA' }}</p>
                            <p class="text-muted small mb-0">Ancestral </p>
                            <p class="text-dark small">{{ $data->Ancestral ? $data->Ancestral : 'NA' }}</p>
                            <p class="text-muted small mb-0">Staying Since </p>
                            <p class="text-dark small">{{ $data->Staying_Since ? $data->Staying_Since : 'NA' }}</p>
                            <p class="text-muted small mb-0">Emoloyerrs </p>
                            <p class="text-dark small">{{ $data->EMPLOYERRS ? $data->EMPLOYERRS : 'NA' }}</p>




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
