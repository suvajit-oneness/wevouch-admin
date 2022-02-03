<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Borrower extends Model
{
    use HasFactory, SoftDeletes;

    public static function insertData($data) {
        $value = DB::table('borrowers')->where('pan_card_number', $data['pan_card_number'])->get();
        if($value->count() == 0) {
           DB::table('borrowers')->insert($data);
        }
    }

    public function agreementDetails() {
        return $this->belongsTo('App\Models\Agreement', 'agreement_id', 'id');
    }

    public function borrowerAgreementRfq()
    {
        return $this->hasOne('App\Models\AgreementRfq', 'borrower_id', 'id');
    }
}
