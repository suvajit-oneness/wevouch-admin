<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductDatas extends Model
{
    use HasFactory;

    public static function insertData($data) {
        $value = DB::table('product_datas')->where('model_name', $data['model_name'])->where('model_no', $data['model_no'])->get();
        if($value->count() == 0) {
           DB::table('product_datas')->insert($data);
        }
    }

    public function brandDetails() {
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }
}
