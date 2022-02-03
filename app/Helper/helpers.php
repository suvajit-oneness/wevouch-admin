<?php

use App\Models\Activity;
use App\Models\AgreementData;
use App\Models\AgreementRfq;
use App\Models\Field;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;

// generate alpha numeric for usage
function generateUniqueAlphaNumeric($length = 8)
{
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
        $number = random_int(0, 36);
        $character = base_convert($number, 10, 36);
        $random_string .= $character;
    }
    return $random_string;
}

// limit words in view, no need to show full text
function words($string, $words = 100)
{
    return \Illuminate\Support\Str::limit($string, $words);
}

// random number generate
function randomGenerator()
{
    return uniqid() . '' . date('ymdhis') . '' . uniqid();
}

// empty string check
function emptyCheck($string, $date = false)
{
    if ($date) {
        return !empty($string) ? date('Y-m-d', strtotime($string)) : '0000-00-00';
    }
    return !empty($string) ? $string : '';
}

// file upload from controller function
function fileUpload($file, $folder = 'image')
{
    $random = randomGenerator();
    $file->move('upload/' . $folder . '/', $random . '.' . $file->getClientOriginalExtension());
    $fileurl = 'upload/' . $folder . '/' . $random . '.' . $file->getClientOriginalExtension();
    return $fileurl;
}

function checkStringFileAray($data)
{
    if ($data != '') {
        if (is_array($data)) {
            return ($data ? implode(',', $data) : '');
        } elseif (is_string($data)) {
            return $data;
        } else {
            return fileUpload($data, 'agreementUploads');
        }
    }

    return '';
}

// form elements check & show values
/*** fields blade & admin.borrower.fields blade ***/
// parameters fields id, field name - placeholder, field type - text/email, value - select/radio, 
function form3lements($field_id, $name, $type, $value=null, $key_name, $required=null, $borrowerId=null, $form_type=null)
{
    $respValue = '';
    $disabledField = '';
    $optionalFieldsData = ''; // optional for officially valid documents
    $extraClass = ''; // extra class name for filtering
    if (!empty($borrowerId)) {
        // in case of adding agreement data, auto-fill borrower details starts
        if (isset($form_type) == 'create') {
            // fetching borrower details
            $borrower = \App\Models\Borrower::findOrFail($borrowerId);
            switch($key_name){
                // borrower id
                case 'customerid' :
                    $disabledField = '';
                    $respValue = $borrower->CUSTOMER_ID;
                    break;
                // borrower name prefix
                case 'prefixoftheborrower' :
                    $disabledField = '';
                    $respValue = $borrower->name_prefix;
                    break;
                // borrower full name
                case 'nameoftheborrower' :
                    $disabledField = '';
                    $respValue = $borrower->full_name;
                    break;
                // Officially Valid Documents of the Borrower
                case 'officiallyvaliddocumentsoftheborrower' :
                    // 	Officially Valid Documents entry fields

                    // 1 borrower - aadhar card
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataAadharNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'aadharcardnumberoftheborrower')->first();
                            if ($agreementDataAadharNo) {
                                // if data is filled & watching only
                                $respValueAadharCardNo = $agreementDataAadharNo->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueAadharCardNo = $borrower->Aadhar_Number;
                    }

                    $optionalFieldsInsideData = '<input type="text" placeholder="Aadhar card number of the Borrower" class="form-control form-control-sm text-uppercase" name="field_name[aadharcardnumberoftheborrower]" value="'.$respValueAadharCardNo.'" style="display:none;"><input type="hidden" value="96" name="field_id[96]">';

                    // 2 borrower - voter card
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataVoterCardNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'votercardnumberoftheborrower')->first();
                            if ($agreementDataVoterCardNo) {
                                // if data is filled & watching only
                                $respValueVoterCardNo = $agreementDataVoterCardNo->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueVoterCardNo = $borrower->Voter_ID;
                    }

                    $optionalFieldsInsideData .= '<input type="text" placeholder="Voter card number of the Borrower" class="form-control form-control-sm text-uppercase" name="field_name[votercardnumberoftheborrower]" value="'.$respValueVoterCardNo.'" style="display:none;"><input type="hidden" value="97" name="field_id[97]">';

                    // 3 borrower - bank acc no, name, ifsc
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataBankAccNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'bankaccountnumberoftheborrower')->first();
                            $agreementDataBankName = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'banknameoftheborrower')->first();
                            $agreementDataBankIfsc = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'bankifscoftheborrower')->first();
                            if ($agreementDataBankAccNo) {
                                // if data is filled & watching only
                                $respValueBankAccNo = $agreementDataBankAccNo->field_value;
                            }
                            if ($agreementDataBankName) {
                                // if data is filled & watching only
                                $respValueBankName = $agreementDataBankName->field_value;
                            }
                            if ($agreementDataBankIfsc) {
                                // if data is filled & watching only
                                $respValueBankIfsc = $agreementDataBankIfsc->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueBankAccNo = '';
                        $respValueBankName = '';
                        $respValueBankIfsc = '';
                    }

                    $optionalFieldsInsideData .= '<div class="row"> <div class="col-4"> <input type="text" placeholder="Bank account number of the Borrower" class="form-control form-control-sm" name="field_name[bankaccountnumberoftheborrower]" value="'.$respValueBankAccNo.'" style="display:none;"><input type="hidden" value="98" name="field_id[98]"> </div><div class="col-4"> <input type="text" placeholder="Bank name of the Borrower" class="form-control form-control-sm" name="field_name[banknameoftheborrower]" value="'.$respValueBankName.'" style="display:none;"><input type="hidden" value="99" name="field_id[99]"> </div><div class="col-4"> <input type="text" placeholder="Bank IFSC of the Borrower" class="form-control form-control-sm text-uppercase" name="field_name[bankifscoftheborrower]" value="'.$respValueBankIfsc.'" style="display:none;"><input type="hidden" value="100" name="field_id[100]"> </div> </div>';

                    // 4 borrower - driving license, issue, expiry
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataLicenseNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'drivinglicensenumberoftheborrower')->first();
                            $agreementDataLicenseIssue = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'drivinglicenseissuedateoftheborrower')->first();
                            $agreementDataLicenseExpiry = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'drivinglicenseexpirydateoftheborrower')->first();
                            if ($agreementDataLicenseNo) {
                                // if data is filled & watching only
                                $respValueLicenseNo = $agreementDataLicenseNo->field_value;
                            }
                            if ($agreementDataLicenseIssue) {
                                // if data is filled & watching only
                                $respValueLicenseIssue = $agreementDataLicenseIssue->field_value;
                            }
                            if ($agreementDataLicenseExpiry) {
                                // if data is filled & watching only
                                $respValueLicenseExpiry = $agreementDataLicenseExpiry->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueLicenseNo = $borrower->DRIVING_LINC;
                        $respValueLicenseIssue = '';
                        $respValueLicenseExpiry = '';
                    }

                    $optionalFieldsInsideData .= '<div class="row" id="borrowerDrivingLicenseHolder" style="display:none"> <div class="col-4"> <input type="text" placeholder="Driving license number of the Borrower" class="form-control form-control-sm text-uppercase" name="field_name[drivinglicensenumberoftheborrower]" value="'.$respValueLicenseNo.'"><input type="hidden" value="101" name="field_id[101]"> <p class="small text-muted my-1">Driving license number</p> </div><div class="col-4"> <input type="date" placeholder="Driving license issue date of the Borrower" class="form-control form-control-sm" name="field_name[drivinglicenseissuedateoftheborrower]" value="'.$respValueLicenseIssue.'"><input type="hidden" value="102" name="field_id[102]"> <p class="small text-muted my-1">Issue date</p> </div><div class="col-4"> <input type="date" placeholder="Driving license expiry date of the Borrower" class="form-control form-control-sm" name="field_name[drivinglicenseexpirydateoftheborrower]" value="'.$respValueLicenseExpiry.'"><input type="hidden" value="103" name="field_id[103]"> <p class="small text-muted my-1">Expiry date</p> </div> </div>';

                    // 5 borrower - electricity bill
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataElecBill = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'electricitybillnumberoftheborrower')->first();
                            if ($agreementDataElecBill) {
                                // if data is filled & watching only
                                $respValueElecBill = $agreementDataElecBill->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueElecBill = '';
                    }

                    $optionalFieldsInsideData .= '<input type="text" placeholder="Electricity bill number of the Borrower" class="form-control form-control-sm text-uppercase" name="field_name[electricitybillnumberoftheborrower]" value="'.$respValueElecBill.'" style="display:none;"><input type="hidden" value="104" name="field_id[104]">';

                    // 6 borrower - passport, issue, expiry
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataPassportNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'passportnumberoftheborrower')->first();
                            $agreementDataPassportIssue = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'passportissuedateoftheborrower')->first();
                            $agreementDataPassportExpiry = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'passportexpirydateoftheborrower')->first();
                            if ($agreementDataPassportNo) {
                                // if data is filled & watching only
                                $respValuePassportNo = $agreementDataPassportNo->field_value;
                            }
                            if ($agreementDataPassportIssue) {
                                // if data is filled & watching only
                                $respValuePassportIssue = $agreementDataPassportIssue->field_value;
                            }
                            if ($agreementDataPassportExpiry) {
                                // if data is filled & watching only
                                $respValuePassportExpiry = $agreementDataPassportExpiry->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValuePassportNo = $borrower->PASSPORT_NO;
                        $respValuePassportIssue = '';
                        $respValuePassportExpiry = '';
                    }

                    $optionalFieldsInsideData .= '<div class="row" id="borrowerPassportHolder" style="display: none;"> <div class="col-4"> <input type="text" placeholder="Passport number of the Borrower" class="form-control form-control-sm text-uppercase" name="field_name[passportnumberoftheborrower]" value="'.$respValuePassportNo.'"><input type="hidden" value="105" name="field_id[105]"> <p class="small text-muted my-1">Passport number</p> </div><div class="col-4"> <input type="date" placeholder="Passport issue date of the Borrower" class="form-control form-control-sm" name="field_name[passportissuedateoftheborrower]" value="'.$respValuePassportIssue.'"><input type="hidden" value="106" name="field_id[106]"> <p class="small text-muted my-1">Issue date</p> </div><div class="col-4"> <input type="date" placeholder="Passport expiry date of the Borrower" class="form-control form-control-sm" name="field_name[passportexpirydateoftheborrower]" value="'.$respValuePassportExpiry.'"><input type="hidden" value="107" name="field_id[107]"> <p class="small text-muted my-1">Expiry date</p> </div> </div>';

                    $optionalFieldsData = '<div class="w-100 mt-3">'.$optionalFieldsInsideData.'</div>';

                break;













                // Officially Valid Documents of the Co-Borrower 1
                case 'officiallyvaliddocumentsofthecoborrower' :
                    // 	Officially Valid Documents entry fields

                    // 1 coborrower - aadhar card
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataAadharNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'aadharcardnumberofthecoborrower')->first();
                            if ($agreementDataAadharNo) {
                                // if data is filled & watching only
                                $respValueAadharCardNo = $agreementDataAadharNo->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueAadharCardNo = '';
                    }

                    $optionalFieldsInsideData = '<input type="text" placeholder="Aadhar card number of the Co-Borrower" class="form-control form-control-sm text-uppercase" name="field_name[aadharcardnumberofthecoborrower]" value="'.$respValueAadharCardNo.'" style="display:none;"><input type="hidden" value="108" name="field_id[108]">';

                    // 2 coborrower - voter card
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataVoterCardNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'votercardnumberofthecoborrower')->first();
                            if ($agreementDataVoterCardNo) {
                                // if data is filled & watching only
                                $respValueVoterCardNo = $agreementDataVoterCardNo->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueVoterCardNo = '';
                    }

                    $optionalFieldsInsideData .= '<input type="text" placeholder="Voter card number of the Co-Borrower" class="form-control form-control-sm text-uppercase" name="field_name[votercardnumberofthecoborrower]" value="'.$respValueVoterCardNo.'" style="display:none;"><input type="hidden" value="109" name="field_id[109]">';

                    // 3 coborrower - bank acc no, name, ifsc
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataBankAccNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'bankaccountnumberofthecoborrower')->first();
                            $agreementDataBankName = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'banknameofthecoborrower')->first();
                            $agreementDataBankIfsc = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'bankifscofthecoborrower')->first();
                            if ($agreementDataBankAccNo) {
                                // if data is filled & watching only
                                $respValueBankAccNo = $agreementDataBankAccNo->field_value;
                            }
                            if ($agreementDataBankName) {
                                // if data is filled & watching only
                                $respValueBankName = $agreementDataBankName->field_value;
                            }
                            if ($agreementDataBankIfsc) {
                                // if data is filled & watching only
                                $respValueBankIfsc = $agreementDataBankIfsc->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueBankAccNo = '';
                        $respValueBankName = '';
                        $respValueBankIfsc = '';
                    }

                    $optionalFieldsInsideData .= '<div class="row"> <div class="col-4"> <input type="text" placeholder="Bank account number of the Co-Borrower" class="form-control form-control-sm" name="field_name[bankaccountnumberofthecoborrower]" value="'.$respValueBankAccNo.'" style="display:none;"><input type="hidden" value="110" name="field_id[110]"> </div><div class="col-4"> <input type="text" placeholder="Bank name of the Co-Borrower" class="form-control form-control-sm" name="field_name[banknameofthecoborrower]" value="'.$respValueBankName.'" style="display:none;"><input type="hidden" value="111" name="field_id[111]"> </div><div class="col-4"> <input type="text" placeholder="Bank IFSC of the Co-Borrower" class="form-control form-control-sm text-uppercase" name="field_name[bankifscofthecoborrower]" value="'.$respValueBankIfsc.'" style="display:none;"><input type="hidden" value="112" name="field_id[112]"> </div> </div>';

                    // 4 coborrower - driving license, issue, expiry
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataLicenseNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'drivinglicensenumberofthecoborrower')->first();
                            $agreementDataLicenseIssue = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'drivinglicenseissuedateofthecoborrower')->first();
                            $agreementDataLicenseExpiry = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'drivinglicenseexpirydateofthecoborrower')->first();
                            if ($agreementDataLicenseNo) {
                                // if data is filled & watching only
                                $respValueLicenseNo = $agreementDataLicenseNo->field_value;
                            }
                            if ($agreementDataLicenseIssue) {
                                // if data is filled & watching only
                                $respValueLicenseIssue = $agreementDataLicenseIssue->field_value;
                            }
                            if ($agreementDataLicenseExpiry) {
                                // if data is filled & watching only
                                $respValueLicenseExpiry = $agreementDataLicenseExpiry->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueLicenseNo = '';
                        $respValueLicenseIssue = '';
                        $respValueLicenseExpiry = '';
                    }

                    $optionalFieldsInsideData .= '<div class="row" id="coBorrower1DrivingLicenseHolder" style="display: none;"> <div class="col-4"> <input type="text" placeholder="Driving license number of the Co-Borrower" class="form-control form-control-sm text-uppercase" name="field_name[drivinglicensenumberofthecoborrower]" value="'.$respValueLicenseNo.'"><input type="hidden" value="113" name="field_id[113]"> <p class="small text-muted my-1">Driving license number</p> </div><div class="col-4"> <input type="date" placeholder="Driving license issue date of the Co-Borrower" class="form-control form-control-sm" name="field_name[drivinglicenseissuedateofthecoborrower]" value="'.$respValueLicenseIssue.'"><input type="hidden" value="114" name="field_id[114]"> <p class="small text-muted my-1">Issue date</p> </div><div class="col-4"> <input type="date" placeholder="Driving license expiry date of the Co-Borrower" class="form-control form-control-sm" name="field_name[drivinglicenseexpirydateofthecoborrower]" value="'.$respValueLicenseExpiry.'"><input type="hidden" value="115" name="field_id[115]"> <p class="small text-muted my-1">Expiry date</p> </div> </div>';

                    // 5 coborrower - electricity bill
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataElecBill = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'electricitybillnumberofthecoborrower')->first();
                            if ($agreementDataElecBill) {
                                // if data is filled & watching only
                                $respValueElecBill = $agreementDataElecBill->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueElecBill = '';
                    }

                    $optionalFieldsInsideData .= '<input type="text" placeholder="Electricity bill number of the Co-Borrower" class="form-control form-control-sm text-uppercase" name="field_name[electricitybillnumberofthecoborrower]" value="'.$respValueElecBill.'" style="display:none;"><input type="hidden" value="116" name="field_id[116]">';

                    // 6 coborrower - passport, issue, expiry
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataPassportNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'passportnumberofthecoborrower')->first();
                            $agreementDataPassportIssue = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'passportissuedateofthecoborrower')->first();
                            $agreementDataPassportExpiry = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'passportexpirydateofthecoborrower')->first();
                            if ($agreementDataPassportNo) {
                                // if data is filled & watching only
                                $respValuePassportNo = $agreementDataPassportNo->field_value;
                            }
                            if ($agreementDataPassportIssue) {
                                // if data is filled & watching only
                                $respValuePassportIssue = $agreementDataPassportIssue->field_value;
                            }
                            if ($agreementDataPassportExpiry) {
                                // if data is filled & watching only
                                $respValuePassportExpiry = $agreementDataPassportExpiry->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValuePassportNo = '';
                        $respValuePassportIssue = '';
                        $respValuePassportExpiry = '';
                    }

                    $optionalFieldsInsideData .= '<div class="row" id="coBorrower1PassportHolder" style="display: none;"> <div class="col-4"> <input type="text" placeholder="Passport number of the Co-Borrower" class="form-control form-control-sm text-uppercase" name="field_name[passportnumberofthecoborrower]" value="'.$respValuePassportNo.'"><input type="hidden" value="117" name="field_id[117]"> <p class="small text-muted my-1">Passport number</p> </div><div class="col-4"> <input type="date" placeholder="Passport issue date of the Co-Borrower" class="form-control form-control-sm" name="field_name[passportissuedateofthecoborrower]" value="'.$respValuePassportIssue.'"><input type="hidden" value="118" name="field_id[118]"> <p class="small text-muted my-1">Issue date</p> </div><div class="col-4"> <input type="date" placeholder="Passport expiry date of the Co-Borrower" class="form-control form-control-sm" name="field_name[passportexpirydateofthecoborrower]" value="'.$respValuePassportExpiry.'"><input type="hidden" value="119" name="field_id[119]"> <p class="small text-muted my-1">Expiry date</p> </div> </div>';

                    $optionalFieldsData = '<div class="w-100 mt-3">'.$optionalFieldsInsideData.'</div>';

                break;













                // Officially Valid Documents of the Co-Borrower 2
                case 'officiallyvaliddocumentsofthecoborrower2' :
                    // 	Officially Valid Documents entry fields

                    // 1 coborrower - aadhar card
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataAadharNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'aadharcardnumberofthecoborrower2')->first();
                            if ($agreementDataAadharNo) {
                                // if data is filled & watching only
                                $respValueAadharCardNo = $agreementDataAadharNo->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueAadharCardNo = '';
                    }

                    $optionalFieldsInsideData = '<input type="text" placeholder="Aadhar card number of the Co-Borrower 2" class="form-control form-control-sm text-uppercase" name="field_name[aadharcardnumberofthecoborrower2]" value="'.$respValueAadharCardNo.'" style="display:none;"><input type="hidden" value="108" name="field_id[108]">';

                    // 2 coborrower - voter card
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataVoterCardNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'votercardnumberofthecoborrower2')->first();
                            if ($agreementDataVoterCardNo) {
                                // if data is filled & watching only
                                $respValueVoterCardNo = $agreementDataVoterCardNo->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueVoterCardNo = '';
                    }

                    $optionalFieldsInsideData .= '<input type="text" placeholder="Voter card number of the Co-Borrower 2" class="form-control form-control-sm text-uppercase" name="field_name[votercardnumberofthecoborrower2]" value="'.$respValueVoterCardNo.'" style="display:none;"><input type="hidden" value="109" name="field_id[109]">';

                    // 3 coborrower - bank acc no, name, ifsc
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataBankAccNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'bankaccountnumberofthecoborrower2')->first();
                            $agreementDataBankName = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'banknameofthecoborrower2')->first();
                            $agreementDataBankIfsc = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'bankifscofthecoborrower2')->first();
                            if ($agreementDataBankAccNo) {
                                // if data is filled & watching only
                                $respValueBankAccNo = $agreementDataBankAccNo->field_value;
                            }
                            if ($agreementDataBankName) {
                                // if data is filled & watching only
                                $respValueBankName = $agreementDataBankName->field_value;
                            }
                            if ($agreementDataBankIfsc) {
                                // if data is filled & watching only
                                $respValueBankIfsc = $agreementDataBankIfsc->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueBankAccNo = '';
                        $respValueBankName = '';
                        $respValueBankIfsc = '';
                    }

                    $optionalFieldsInsideData .= '<div class="row"> <div class="col-4"> <input type="text" placeholder="Bank account number of the Co-Borrower 2" class="form-control form-control-sm" name="field_name[bankaccountnumberofthecoborrower2]" value="'.$respValueBankAccNo.'" style="display:none;"><input type="hidden" value="110" name="field_id[110]"> </div><div class="col-4"> <input type="text" placeholder="Bank name of the Co-Borrower 2" class="form-control form-control-sm" name="field_name[banknameofthecoborrower2]" value="'.$respValueBankName.'" style="display:none;"><input type="hidden" value="111" name="field_id[111]"> </div><div class="col-4"> <input type="text" placeholder="Bank IFSC of the Co-Borrower 2" class="form-control form-control-sm text-uppercase" name="field_name[bankifscofthecoborrower2]" value="'.$respValueBankIfsc.'" style="display:none;"><input type="hidden" value="112" name="field_id[112]"> </div> </div>';

                    // 4 coborrower - driving license, issue, expiry
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataLicenseNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'drivinglicensenumberofthecoborrower2')->first();
                            $agreementDataLicenseIssue = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'drivinglicenseissuedateofthecoborrower2')->first();
                            $agreementDataLicenseExpiry = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'drivinglicenseexpirydateofthecoborrower2')->first();
                            if ($agreementDataLicenseNo) {
                                // if data is filled & watching only
                                $respValueLicenseNo = $agreementDataLicenseNo->field_value;
                            }
                            if ($agreementDataLicenseIssue) {
                                // if data is filled & watching only
                                $respValueLicenseIssue = $agreementDataLicenseIssue->field_value;
                            }
                            if ($agreementDataLicenseExpiry) {
                                // if data is filled & watching only
                                $respValueLicenseExpiry = $agreementDataLicenseExpiry->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueLicenseNo = '';
                        $respValueLicenseIssue = '';
                        $respValueLicenseExpiry = '';
                    }

                    $optionalFieldsInsideData .= '<div class="row" id="coBorrower2DrivingLicenseHolder" style="display:none"> <div class="col-4"> <input type="text" placeholder="Driving license number of the Co-Borrower 2" class="form-control form-control-sm text-uppercase" name="field_name[drivinglicensenumberofthecoborrower2]" value="'.$respValueLicenseNo.'"><input type="hidden" value="113" name="field_id[113]"> <p class="small text-muted my-1">Driving license number</p> </div><div class="col-4"> <input type="date" placeholder="Driving license issue date of the Co-Borrower 2" class="form-control form-control-sm" name="field_name[drivinglicenseissuedateofthecoborrower2]" value="'.$respValueLicenseIssue.'"><input type="hidden" value="114" name="field_id[114]"> <p class="small text-muted my-1">Issue date</p> </div><div class="col-4"> <input type="date" placeholder="Driving license expiry date of the Co-Borrower 2" class="form-control form-control-sm" name="field_name[drivinglicenseexpirydateofthecoborrower2]" value="'.$respValueLicenseExpiry.'"><input type="hidden" value="115" name="field_id[115]"> <p class="small text-muted my-1">Expiry date</p> </div> </div>';

                    // 5 coborrower - electricity bill
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataElecBill = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'electricitybillnumberofthecoborrower2')->first();
                            if ($agreementDataElecBill) {
                                // if data is filled & watching only
                                $respValueElecBill = $agreementDataElecBill->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueElecBill = '';
                    }

                    $optionalFieldsInsideData .= '<input type="text" placeholder="Electricity bill number of the Co-Borrower 2" class="form-control form-control-sm text-uppercase" name="field_name[electricitybillnumberofthecoborrower2]" value="'.$respValueElecBill.'" style="display:none;"><input type="hidden" value="116" name="field_id[116]">';

                    // 6 coborrower - passport, issue, expiry
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataPassportNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'passportnumberofthecoborrower2')->first();
                            $agreementDataPassportIssue = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'passportissuedateofthecoborrower2')->first();
                            $agreementDataPassportExpiry = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'passportexpirydateofthecoborrower2')->first();
                            if ($agreementDataPassportNo) {
                                // if data is filled & watching only
                                $respValuePassportNo = $agreementDataPassportNo->field_value;
                            }
                            if ($agreementDataPassportIssue) {
                                // if data is filled & watching only
                                $respValuePassportIssue = $agreementDataPassportIssue->field_value;
                            }
                            if ($agreementDataPassportExpiry) {
                                // if data is filled & watching only
                                $respValuePassportExpiry = $agreementDataPassportExpiry->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValuePassportNo = '';
                        $respValuePassportIssue = '';
                        $respValuePassportExpiry = '';
                    }

                    $optionalFieldsInsideData .= '<div class="row" id="coBorrower2PassportHolder" style="display:none"> <div class="col-4"> <input type="text" placeholder="Passport number of the Co-Borrower 2" class="form-control form-control-sm text-uppercase" name="field_name[passportnumberofthecoborrower2]" value="'.$respValuePassportNo.'"><input type="hidden" value="117" name="field_id[117]"> <p class="small text-muted my-1">Passport number</p> </div><div class="col-4"> <input type="date" placeholder="Passport issue date of the Co-Borrower 2" class="form-control form-control-sm" name="field_name[passportissuedateofthecoborrower2]" value="'.$respValuePassportIssue.'"><input type="hidden" value="118" name="field_id[118]"> <p class="small text-muted my-1">Issue date</p> </div><div class="col-4"> <input type="date" placeholder="Passport expiry date of the Co-Borrower 2" class="form-control form-control-sm" name="field_name[passportexpirydateofthecoborrower2]" value="'.$respValuePassportExpiry.'"><input type="hidden" value="119" name="field_id[119]"> <p class="small text-muted my-1">Expiry date</p> </div> </div>';

                    $optionalFieldsData = '<div class="w-100 mt-3">'.$optionalFieldsInsideData.'</div>';

                break;













                // Officially Valid Documents of the Guarantor
                case 'officiallyvaliddocumentsoftheguarantor' :
                    // 	Officially Valid Documents entry fields

                    // 1 guarantor - aadhar card
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataAadharNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'aadharcardnumberoftheguarantor')->first();
                            if ($agreementDataAadharNo) {
                                // if data is filled & watching only
                                $respValueAadharCardNo = $agreementDataAadharNo->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueAadharCardNo = '';
                    }

                    $optionalFieldsInsideData = '<input type="text" placeholder="Aadhar card number of the Guarantor" class="form-control form-control-sm text-uppercase" name="field_name[aadharcardnumberoftheguarantor]" value="'.$respValueAadharCardNo.'" style="display:none;"><input type="hidden" value="120" name="field_id[120]">';

                    // 2 guarantor - voter card
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataVoterCardNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'votercardnumberoftheguarantor')->first();
                            if ($agreementDataVoterCardNo) {
                                // if data is filled & watching only
                                $respValueVoterCardNo = $agreementDataVoterCardNo->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueVoterCardNo = '';
                    }

                    $optionalFieldsInsideData .= '<input type="text" placeholder="Voter card number of the Guarantor" class="form-control form-control-sm text-uppercase" name="field_name[votercardnumberoftheguarantor]" value="'.$respValueVoterCardNo.'" style="display:none;"><input type="hidden" value="121" name="field_id[121]">';

                    // 3 guarantor - bank acc no, name, ifsc
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataBankAccNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'bankaccountnumberoftheguarantor')->first();
                            $agreementDataBankName = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'banknameoftheguarantor')->first();
                            $agreementDataBankIfsc = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'bankifscoftheguarantor')->first();
                            if ($agreementDataBankAccNo) {
                                // if data is filled & watching only
                                $respValueBankAccNo = $agreementDataBankAccNo->field_value;
                            }
                            if ($agreementDataBankName) {
                                // if data is filled & watching only
                                $respValueBankName = $agreementDataBankName->field_value;
                            }
                            if ($agreementDataBankIfsc) {
                                // if data is filled & watching only
                                $respValueBankIfsc = $agreementDataBankIfsc->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueBankAccNo = '';
                        $respValueBankName = '';
                        $respValueBankIfsc = '';
                    }

                    $optionalFieldsInsideData .= '<div class="row"> <div class="col-4"> <input type="text" placeholder="Bank account number of the Guarantor" class="form-control form-control-sm" name="field_name[bankaccountnumberoftheguarantor]" value="'.$respValueBankAccNo.'" style="display:none;"><input type="hidden" value="122" name="field_id[122]"> </div><div class="col-4"> <input type="text" placeholder="Bank name of the Guarantor" class="form-control form-control-sm" name="field_name[banknameoftheguarantor]" value="'.$respValueBankName.'" style="display:none;"><input type="hidden" value="123" name="field_id[123]"> </div><div class="col-4"> <input type="text" placeholder="Bank IFSC of the Guarantor" class="form-control form-control-sm text-uppercase" name="field_name[bankifscoftheguarantor]" value="'.$respValueBankIfsc.'" style="display:none;"><input type="hidden" value="124" name="field_id[124]"> </div> </div>';

                    // 4 guarantor - driving license, issue, expiry
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataLicenseNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'drivinglicensenumberoftheguarantor')->first();
                            $agreementDataLicenseIssue = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'drivinglicenseissuedateoftheguarantor')->first();
                            $agreementDataLicenseExpiry = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'drivinglicenseexpirydateoftheguarantor')->first();
                            if ($agreementDataLicenseNo) {
                                // if data is filled & watching only
                                $respValueLicenseNo = $agreementDataLicenseNo->field_value;
                            }
                            if ($agreementDataLicenseIssue) {
                                // if data is filled & watching only
                                $respValueLicenseIssue = $agreementDataLicenseIssue->field_value;
                            }
                            if ($agreementDataLicenseExpiry) {
                                // if data is filled & watching only
                                $respValueLicenseExpiry = $agreementDataLicenseExpiry->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueLicenseNo = '';
                        $respValueLicenseIssue = '';
                        $respValueLicenseExpiry = '';
                    }

                    $optionalFieldsInsideData .= '<div class="row" id="guarantorDrivingLicenseHolder" style="display:none"> <div class="col-4"> <input type="text" placeholder="Driving license number of the Guarantor" class="form-control form-control-sm text-uppercase" name="field_name[drivinglicensenumberoftheguarantor]" value="'.$respValueLicenseNo.'"><input type="hidden" value="125" name="field_id[125]"> <p class="small text-muted my-1">Driving license number</p> </div><div class="col-4"> <input type="date" placeholder="Driving license issue date of the Guarantor" class="form-control form-control-sm" name="field_name[drivinglicenseissuedateoftheguarantor]" value="'.$respValueLicenseIssue.'"><input type="hidden" value="126" name="field_id[126]"> <p class="small text-muted my-1">Expiry date</p> </div><div class="col-4"> <input type="date" placeholder="Driving license expiry date of the Guarantor" class="form-control form-control-sm" name="field_name[drivinglicenseexpirydateoftheguarantor]" value="'.$respValueLicenseExpiry.'"><input type="hidden" value="127" name="field_id[127]"> <p class="small text-muted my-1">Expiry date</p> </div> </div>';

                    // 5 guarantor - electricity bill
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataElecBill = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'electricitybillnumberoftheguarantor')->first();
                            if ($agreementDataElecBill) {
                                // if data is filled & watching only
                                $respValueElecBill = $agreementDataElecBill->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueElecBill = '';
                    }

                    $optionalFieldsInsideData .= '<input type="text" placeholder="Electricity bill number of the Guarantor" class="form-control form-control-sm text-uppercase" name="field_name[electricitybillnumberoftheguarantor]" value="'.$respValueElecBill.'" style="display:none;"><input type="hidden" value="128" name="field_id[128]">';

                    // 6 guarantor - passport, issue, expiry
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataPassportNo = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'passportnumberoftheguarantor')->first();
                            $agreementDataPassportIssue = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'passportissuedateoftheguarantor')->first();
                            $agreementDataPassportExpiry = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'passportexpirydateoftheguarantor')->first();
                            if ($agreementDataPassportNo) {
                                // if data is filled & watching only
                                $respValuePassportNo = $agreementDataPassportNo->field_value;
                            }
                            if ($agreementDataPassportIssue) {
                                // if data is filled & watching only
                                $respValuePassportIssue = $agreementDataPassportIssue->field_value;
                            }
                            if ($agreementDataPassportExpiry) {
                                // if data is filled & watching only
                                $respValuePassportExpiry = $agreementDataPassportExpiry->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValuePassportNo = '';
                        $respValuePassportIssue = '';
                        $respValuePassportExpiry = '';
                    }

                    $optionalFieldsInsideData .= '<div class="row" id="guarantorPassportHolder" style="display:none"> <div class="col-4"> <input type="text" placeholder="Passport number of the Guarantor" class="form-control form-control-sm text-uppercase" name="field_name[passportnumberoftheguarantor]" value="'.$respValuePassportNo.'"><input type="hidden" value="129" name="field_id[129]"> <p class="small text-muted my-1">Passport number</p> </div><div class="col-4"> <input type="date" placeholder="Passport issue date of the Guarantor" class="form-control form-control-sm" name="field_name[passportissuedateoftheguarantor]" value="'.$respValuePassportIssue.'"><input type="hidden" value="130" name="field_id[130]"> <p class="small text-muted my-1">Issue date</p> </div><div class="col-4"> <input type="date" placeholder="Passport expiry date of the Guarantor" class="form-control form-control-sm" name="field_name[passportexpirydateoftheguarantor]" value="'.$respValuePassportExpiry.'"><input type="hidden" value="131" name="field_id[131]"> <p class="small text-muted my-1">Expiry date</p> </div> </div>';

                    $optionalFieldsData = '<div class="w-100 mt-3">'.$optionalFieldsInsideData.'</div>';

                break;


















                // borrower date of birth
                case 'dateofbirthoftheborrower' :
                    $disabledField = '';
                    $respValue = $borrower->date_of_birth;
                    break;
                // borrower email id
                case 'emailidoftheborrower' :
                    $disabledField = '';
                    $respValue = $borrower->email;
                    break;
                // borrower mobile number
                case 'mobilenumberoftheborrower' :
                    $disabledField = '';
                    $respValue = $borrower->mobile;
                    break;
                // borrower pan card number
                case 'pancardnumberoftheborrower' :
                    $disabledField = '';
                    $respValue = $borrower->pan_card_number;
                    break;
                // borrower occupation
                case 'occupationoftheborrower' :
                    $disabledField = '';
                    $respValue = $borrower->occupation;
                    break;
                // borrower marital status
                case 'maritalstatusoftheborrower' :
                    $disabledField = '';
                    $respValue = $borrower->marital_status;
                    break;
                // borrower street address
                case 'streetaddressoftheborrower' :
                    $disabledField = '';

                    $display_house_no = (strtolower($borrower->KYC_HOUSE_NO) != 'na' && $borrower->KYC_HOUSE_NO != '') ? $borrower->KYC_HOUSE_NO.' ' : '';
                    $display_street = (strtolower($borrower->KYC_Street) != 'na' || $borrower->KYC_Street != '') ? $borrower->KYC_Street.' ' : '';
                    $display_locality = (strtolower($borrower->KYC_LOCALITY) != 'na' || $borrower->KYC_LOCALITY != '') ? $borrower->KYC_LOCALITY.' ' : '';
                    $display_city = (strtolower($borrower->KYC_CITY) != 'na' || $borrower->KYC_CITY != '') ? $borrower->KYC_CITY.' ' : '';
                    $display_state = (strtolower($borrower->KYC_State) != 'na' || $borrower->KYC_State != '') ? $borrower->KYC_State.' ' : '';
                    $display_pincode = (strtolower($borrower->KYC_PINCODE) != 'na' || $borrower->KYC_PINCODE != '') ? $borrower->KYC_PINCODE.' ' : '';
                    $display_country = (strtolower($borrower->KYC_Country) != 'na' || $borrower->KYC_Country != '') ? $borrower->KYC_Country.' ' : '';

                    $respValue = $display_house_no.$display_street.$display_locality.$display_city.$display_state.$display_pincode.$display_country;

                    break;
                // IFS code fetch API
                case 'ifscodeofborrower' :
                    $disabledField = '';
                    $extraClass = 'ifsCodeFetch text-uppercase';
                    break;
                // Rate of interest/ processing charge/ documentation fee/ monthly EMI/ Penal Interest percentage
                case 'rateofinterest' :
                    $disabledField = '';
                    $extraClass = 'numberField';
                    break;
                // processing charge
                case 'processingchargeinpercentage' :
                    $disabledField = '';
                    $extraClass = 'numberField';
                    break;
                // documentation fee
                case 'documentationfee' :
                    $disabledField = '';
                    $extraClass = 'numberField';
                    break;
                // monthly EMI
                case 'monthlyemiindigits' :
                    $disabledField = '';
                    $extraClass = 'numberField';
                    break;
                // Penal Interest percentage
                case 'penalinterestpercentage' :
                    $disabledField = '';
                    $extraClass = 'numberField';
                    break;
                // Date of credit of EMI into Lender's Bank Account
                case 'dateofcreditofemiintolendersbankaccount' :
                    // value
                    if ($form_type == 'show') {
                        // if rfq found, fetch filled data
                        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
                        if ($rfq) {
                            $agreementDataOtherDate = AgreementData::where('rfq_id', $rfq->id)->where('field_name', 'otherdateofemicredit')->first();
                            if ($agreementDataOtherDate) {
                                // if data is filled & watching only
                                $respValueOtherDate = $agreementDataOtherDate->field_value;
                            }
                        }
                    } else {
                        // if data is not filled
                        $respValueOtherDate = '';
                    }

                    $valueOtherDateEmiCredit = Field::select('value')->where('key_name', 'otherdateofemicredit')->first();

                    $expValue = explode(', ', $valueOtherDateEmiCredit->value);
                    $option = '<option value="" selected hidden>Select Other date of EMI credit</option>';
                    foreach ($expValue as $index => $val) {
                        $selected = '';
                        if (strtolower($respValueOtherDate) == strtolower($val)) $selected = 'selected';

                        $option .= '<option value="'.$val.'" '.$selected.'>'.$val.'</option>';
                    }

                    $optionalFieldsInsideData = '<select class="form-control form-control-sm" name="field_name[otherdateofemicredit]" style="display:none;">'.$option.'</select><input type="hidden" value="75" name="field_id[75]">';

                    // $optionalFieldsInsideData = '<input type="text" placeholder="Other date of EMI credit" class="form-control form-control-sm" name="field_name[otherdateofemicredit]" value="'.$respValueOtherDate.'" style="display:none;"><input type="hidden" value="120" name="field_id[120]">';

                    $optionalFieldsData = '<div class="w-100 mt-3">'.$optionalFieldsInsideData.'</div>';

                break;
                default :
                    $disabledField = '';
                    $respValue = '';
                    $extraClass = '';
                    break;
            }
        }
        // in case of adding agreement data, auto-fill borrower details ends

        // if rfq found, fetch filled data
        $rfq = AgreementRfq::select('id')->where('borrower_id', $borrowerId)->first();
        if ($rfq) {
            $agreementData = AgreementData::where('rfq_id', $rfq->id)->where('field_name', $key_name)->first();
            if ($agreementData) $respValue = $agreementData->field_value;

            $disabledField = '';
        }
    }

    // adding extra text after fields
    $extraPostField = '';
    $extraPreField = '';
    if ($key_name == 'loanamountindigits') $extraPreField = '<span class="post-text">Rs.</span>';
    if ($key_name == 'processingchargeinpercentage') $extraPostField = '<span class="post-text">+ Taxes</span>';
    if ($key_name == 'documentationfee') {
        $extraPreField = '<span class="post-text">Rs.</span>';
        $extraPostField = '<span class="post-text">+ Taxes</span>';
    }

    // working with required/ optional fields
    if ($key_name == 'otherdateofemicredit') $required = '';
    if ($key_name == 'demandpromissorynoteforcoborrowerdate') $required = '';
    if ($key_name == 'continuingsecurityletterdate2') $required = '';
    if ($key_name == 'otherdocumentstobeattachedwithapplicationforloan') $required = '';
    // if ($key_name == 'otherdateofemicredit' && $key_name = 'demandpromissorynoteforcoborrowerdate' && $key_name = 'continuingsecurityletterdate2') {
    //     $required = '';
    // }

    switch ($type) {
        case 'text':
            $response = $extraPreField.'<input type="text" placeholder="' . $name . '" class="form-control form-control-sm '.$extraClass.'" name="field_name[' . $key_name . ']" ' . $required . ' value="' . $respValue . '" '.$disabledField.' ><input type="hidden" value="' . $field_id . '" name="field_id[' . $field_id . ']">'.$extraPostField;
            break;
        case 'email':
            $response = $extraPreField.'<input type="email" placeholder="' . $name . '" class="form-control form-control-sm" name="field_name[' . $key_name . ']" ' . $required . ' value="' . $respValue . '" '.$disabledField.'><input type="hidden" value="' . $field_id . '" name="field_id[' . $field_id . ']">'.$extraPostField;
            break;
        case 'number':
            $response = $extraPreField.'<input type="number" placeholder="' . $name . '" class="form-control form-control-sm" name="field_name[' . $key_name . ']" ' . $required . ' value="' . $respValue . '" '.$disabledField.'><input type="hidden" value="' . $field_id . '" name="field_id[' . $field_id . ']">'.$extraPostField;
            break;
        case 'date':
            // if (isset($form_type) == 'show') {
            //     $respValue = date('Y-m-d', strtotime($respValue));
            // } else {
            //     $respValue = '';
            // }

            $response = $extraPreField.'<input type="date" placeholder="' . $name . '" class="form-control form-control-sm" name="field_name[' . $key_name . ']" ' . $required . ' value="' . $respValue . '" '.$disabledField.' '.$respValue.'><input type="hidden" value="' . $field_id . '" name="field_id[' . $field_id . ']">'.$extraPostField;
            break;
        case 'time':
            $response = $extraPreField.'<input type="time" placeholder="' . $name . '" class="form-control form-control-sm" name="field_name[' . $key_name . ']" ' . $required . ' value="' . $respValue . '" '.$disabledField.'><input type="hidden" value="' . $field_id . '" name="field_id[' . $field_id . ']">'.$extraPostField;
            break;
        case 'file':
            $response = '<div class="custom-file custom-file-sm"><input type="file" class="custom-file-input" id="customFile" name="field_name[' . $key_name . ']" ' . $required . ' '.$disabledField.'><label class="custom-file-label" for="customFile">Choose ' . $name . '</label></div><input type="hidden" value="' . $field_id . '" name="field_id[' . $field_id . ']">';
            break;
        case 'select':
            $expValue = explode(', ', $value);
            $option = '<option value="" selected hidden>Select ' . $name . '</option>';
            foreach ($expValue as $index => $val) {
                $selected = '';
                if (strtolower($respValue) == strtolower($val)) $selected = 'selected';

                $option .= '<option value="' . $val . '" ' . $selected . '>' . $val . '</option>';
            }
            $response = '<select class="form-control form-control-sm" name="field_name[' . $key_name . ']" ' . $required . ' '.$disabledField.'>' . $option . '</select><input type="hidden" value="' . $field_id . '" name="field_id[' . $field_id . ']">';
            break;
        case 'checkbox':
            $expValue = explode(', ', $value);
            $checkedValues = explode(',', strtolower($respValue));
            $option = '';
            foreach ($expValue as $index => $val) {
                $checked = '';
                if(in_array(strtolower($val),$checkedValues)) {$checked = 'checked';}

                $option .= '<div class="single-checkbox-holder"><input class="form-check-input" type="checkbox" name="field_name[' . $key_name . '][]" id="' . $key_name . '-' . $index . '" value="' . $val . '" '.$checked.' '.$disabledField.'> <label for="' . $key_name . '-' . $index . '" class="form-check-label mr-1">' . $val.' </label></div>';
            }
            $response = '<div class="form-check">' . $option . '</div><input type="hidden" value="' . $field_id . '" name="field_id[' . $field_id . ']">';
            break;
        case 'radio':
            $expValue = explode(', ', $value);
            $option = '';
            foreach ($expValue as $index => $val) {
                $checked = '';
                if ($respValue == $val) $checked = 'checked';
                $option .= '<input class="form-check-input" type="radio" name="field_name[' . $key_name . ']" id="' . $key_name . '-' . $index . '" value="' . $val . '" ' . $required . ' ' . $checked . ' '.$disabledField.'> <label for="' . $key_name . '-' . $index . '" class="form-check-label mr-1">' . $val . '</label><input type="hidden" value="' . $field_id . '" name="field_id[' . $field_id . ']">';
            }
            $response = '<div class="w-100"><div class="form-check form-check-inline nowrap">' . $option . '</div>'.$optionalFieldsData.'</div>';
            break;
        case 'textarea':
            $response = '<textarea placeholder="' . $name . '" class="form-control form-control-sm" style="min-height:100px;max-height:200px" name="field_name[' . $key_name . ']" ' . $required . ' '.$disabledField.'>' . $respValue . '</textarea><input type="hidden" value="' . $field_id . '" name="field_id[' . $field_id . ']">';
            break;
        default:
            $response = '<input type="text">';
            break;
    }

    return $response;
}

// generate key name from field name
function generateKeyForForm(string $string)
{
    $key = '';
    for ($i = 0; $i < strlen($string); $i++) {
        if (!preg_match('/[^A-Za-z]+/', $string[$i])) {
            $key .= strtolower($string[$i]);
        }
    }
    return $key;
}

// send mail helper
function SendMail($data)
{
    // mail log
    $newMail = new \App\Models\MailLog();
    $newMail->from = env('MAIL_FROM_ADDRESS');
    $newMail->to = $data['email'];
    $newMail->subject = $data['subject'];
    $newMail->blade_file = $data['blade_file'];
    $newMail->payload = json_encode($data);
    $newMail->save();

    // send mail
    Mail::send('mail/' . $data['blade_file'], $data, function ($message) use ($data) {
        $message->to($data['email'], $data['name'])
            ->subject($data['subject'])
            ->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
    });
}

// notification create helper
function createNotification(int $sender, int $receiver, string $type, string $message = null, string $route = null)
{
    switch ($type) {
        case 'user_registration':
            $title = 'Registration successfull';
            $message = 'Please check & update your profile as needed';
            $route = 'user.profile';
            break;
        case 'new_borrower':
            $title = 'New borrower created';
            $message = $message;
            $route = 'user.borrower.list';
            break;
        case 'agreement_data_upload':
            $title = 'Agreement data uploaded';
            $message = $message;
            $route = $route;
            break;
        default:
            $title = '';
            $message = '';
            $route = '';
            break;
    }

    $notification = new App\Models\Notification;
    $notification->sender_id = $sender;
    $notification->receiver_id = $receiver;
    $notification->type = $type;
    $notification->title = $title;
    $notification->message = $message;
    $notification->route = $route;
    $notification->save();
}

// activity log helper
function activityLog(array $data)
{
    $activity = new Activity;
    $activity->user_id = auth()->user()->id;
    $activity->user_device = '';
    $activity->ip_address = Request::ip();
    $activity->latitude = '';
    $activity->longitude = '';
    $activity->type = $data['type'];
    $activity->title = $data['title'];
    $activity->description = $data['desc'];
    $activity->save();
}

// check if agreement related document is uploaded or not
function documentSrc(int $agreement_document_id, int $borrower_id, string $type)
{
    $image = asset('admin/static-required/blank.png');
    $detailsShow = '<label for="file_' . $agreement_document_id . '" class="btn btn-xs btn-primary" id="image__preview_label' . $agreement_document_id . '">Browse <i class="fas fa-camera"></i></label>';

    $document = \App\Models\AgreementDocumentUpload::where('agreement_document_id', $agreement_document_id)->where('borrower_id', $borrower_id)->where('status', 1)->latest()->first();
    if ($document) {
        $image = asset($document->file_path);

        $verifyShow = '<a href="javascript: void(0)" class="btn btn-xs btn-success mb-2" title="Document verified" onclick="viewUploadedDocument(' . $document->id . ')" id="verifyDocToggle' . $document->id . '"> <i class="fas fa-clipboard-check"></i> </a>';
        if ($document->verify == 0) {
            $verifyShow = '<a href="javascript: void(0)" class="btn btn-xs btn-danger mb-2" title="Document unverified" onclick="viewUploadedDocument(' . $document->id . ')" id="verifyDocToggle' . $document->id . '"> <i class="fas fa-question-circle"></i> </a>';
        }

        $detailsShow = '<a href="javascript: void(0)" class="btn btn-xs btn-primary mb-2" onclick="viewUploadedDocument(' . $document->id . ')"><i class="fas fa-eye"></i></a> <label for="file_' . $agreement_document_id . '" class="btn btn-xs btn-dark" id="image__preview_label' . $agreement_document_id . '">Browse <i class="fas fa-camera"></i></label> ' . $verifyShow;
    }

    if ($type == 'image') {
        return $image;
    } else {
        return $detailsShow;
    }
}
