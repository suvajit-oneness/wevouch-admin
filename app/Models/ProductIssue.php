<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductIssue extends Model
{
    use HasFactory;

    public static function insertData($data) {
        $value = DB::table('product_issues')->where('category', $data['category'])->where('function', $data['function'])->where('issue', $data['issue'])->get();
        if($value->count() == 0) {
           DB::table('product_issues')->insert($data);
        }
    }
}
