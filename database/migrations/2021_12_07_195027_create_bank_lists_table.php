<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBankListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_lists', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('type')->comment('Public-sector banks, Private-sector banks');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
            ['name' => 'Bank of Baroda', 'type' => 'Public-sector banks'],
            ['name' => 'Vijaya Bank', 'type' => 'Public-sector banks'],
            ['name' => 'Dena Bank', 'type' => 'Public-sector banks'],
            ['name' => 'Bank of India', 'type' => 'Public-sector banks'],
            ['name' => 'Bank of Maharashtra', 'type' => 'Public-sector banks'],
            ['name' => 'Canara Bank', 'type' => 'Public-sector banks'],
            ['name' => 'Syndicate Bank', 'type' => 'Public-sector banks'],
            ['name' => 'Central Bank of India', 'type' => 'Public-sector banks'],
            ['name' => 'Indian Bank', 'type' => 'Public-sector banks'],
            ['name' => 'Allahabad Bank', 'type' => 'Public-sector banks'],
            ['name' => 'Indian Overseas Bank', 'type' => 'Public-sector banks'],
            ['name' => 'Punjab and Sind Bank', 'type' => 'Public-sector banks'],
            ['name' => 'Punjab National Bank', 'type' => 'Public-sector banks'],
            ['name' => 'Oriental Bank of Commerce', 'type' => 'Public-sector banks'],
            ['name' => 'United Bank of India', 'type' => 'Public-sector banks'],
            ['name' => 'State Bank of India', 'type' => 'Public-sector banks'],
            ['name' => 'State Bank of Bikaner & Jaipur', 'type' => 'Public-sector banks'],
            ['name' => 'State Bank of Hyderabad', 'type' => 'Public-sector banks'],
            ['name' => 'State Bank of Indore', 'type' => 'Public-sector banks'],
            ['name' => 'State Bank of Mysore', 'type' => 'Public-sector banks'],
            ['name' => 'State Bank of Patiala', 'type' => 'Public-sector banks'],
            ['name' => 'State Bank of Saurashtra', 'type' => 'Public-sector banks'],
            ['name' => 'State Bank of Travancore', 'type' => 'Public-sector banks'],
            ['name' => 'Bhartiya Mahila Bank', 'type' => 'Public-sector banks'],
            ['name' => 'UCO Bank', 'type' => 'Public-sector banks'],
            ['name' => 'Union Bank of India', 'type' => 'Public-sector banks'],
            ['name' => 'Andhra Bank', 'type' => 'Public-sector banks'],
            ['name' => 'Corporation Bank', 'type' => 'Public-sector banks'],


            ['name' => 'Axis Bank', 'type' => 'Private-sector banks'],
            ['name' => 'Bandhan Bank', 'type' => 'Private-sector banks'],
            ['name' => 'CSB Bank', 'type' => 'Private-sector banks'],
            ['name' => 'City Union Bank', 'type' => 'Private-sector banks'],
            ['name' => 'DCB Bank', 'type' => 'Private-sector banks'],
            ['name' => 'Dhanlaxmi Bank', 'type' => 'Private-sector banks'],
            ['name' => 'Federal Bank', 'type' => 'Private-sector banks'],
            ['name' => 'HDFC Bank', 'type' => 'Private-sector banks'],
            ['name' => 'ICICI Bank', 'type' => 'Private-sector banks'],
            ['name' => 'IDBI Bank', 'type' => 'Private-sector banks'],
            ['name' => 'IDFC First Bank', 'type' => 'Private-sector banks'],
            ['name' => 'IndusInd Bank', 'type' => 'Private-sector banks'],
            ['name' => 'Jammu & Kashmir Bank', 'type' => 'Private-sector banks'],
            ['name' => 'Karnataka Bank', 'type' => 'Private-sector banks'],
            ['name' => 'Karur Vysya Bank', 'type' => 'Private-sector banks'],
            ['name' => 'Kotak Mahindra Bank', 'type' => 'Private-sector banks'],
            ['name' => 'Nainital Bank', 'type' => 'Private-sector banks'],
            ['name' => 'RBL Bank', 'type' => 'Private-sector banks'],
            ['name' => 'South Indian Bank', 'type' => 'Private-sector banks'],
            ['name' => 'Tamilnad Mercantile Bank', 'type' => 'Private-sector banks'],
            ['name' => 'Yes Bank', 'type' => 'Private-sector banks'],


            ['name' => 'Andhra Pradesh', 'type' => 'Regional Rural Banks'],
            ['name' => 'Arunachal Pradesh', 'type' => 'Regional Rural Banks'],
            ['name' => 'Assam', 'type' => 'Regional Rural Banks'],
            ['name' => 'Bihar', 'type' => 'Regional Rural Banks'],
            ['name' => 'Chhattisgarh', 'type' => 'Regional Rural Banks'],
            ['name' => 'Gujarat', 'type' => 'Regional Rural Banks'],
            ['name' => 'Haryana', 'type' => 'Regional Rural Banks'],
            ['name' => 'Himachal Pradesh', 'type' => 'Regional Rural Banks'],
            ['name' => 'Jammu And Kashmir', 'type' => 'Regional Rural Banks'],
            ['name' => 'Jharkhand', 'type' => 'Regional Rural Banks'],
            ['name' => 'Karnataka', 'type' => 'Regional Rural Banks'],
            ['name' => 'Kerala', 'type' => 'Regional Rural Banks'],
            ['name' => 'Madhya Pradesh', 'type' => 'Regional Rural Banks'],
            ['name' => 'Maharashtra', 'type' => 'Regional Rural Banks'],
            ['name' => 'Manipur', 'type' => 'Regional Rural Banks'],
            ['name' => 'Meghalaya', 'type' => 'Regional Rural Banks'],
            ['name' => 'Mizoram', 'type' => 'Regional Rural Banks'],
            ['name' => 'Nagaland', 'type' => 'Regional Rural Banks'],
            ['name' => 'Odisha', 'type' => 'Regional Rural Banks'],
            ['name' => 'Puducherry', 'type' => 'Regional Rural Banks'],
            ['name' => 'Punjab', 'type' => 'Regional Rural Banks'],
            ['name' => 'Rajasthan', 'type' => 'Regional Rural Banks'],
            ['name' => 'Tamil Nadu', 'type' => 'Regional Rural Banks'],
            ['name' => 'Telangana', 'type' => 'Regional Rural Banks'],
            ['name' => 'Tripura', 'type' => 'Regional Rural Banks'],
            ['name' => 'Uttar Pradesh', 'type' => 'Regional Rural Banks'],
            ['name' => 'Uttarakhand', 'type' => 'Regional Rural Banks'],
            ['name' => 'West Bengal', 'type' => 'Regional Rural Banks'],
           
        ];

        DB::table('bank_lists')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_lists');
    }
}
