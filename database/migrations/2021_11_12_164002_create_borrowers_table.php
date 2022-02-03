<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBorrowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowers', function (Blueprint $table) {
            $table->id();
            $table->string('name_prefix', 50)->nullable();
            $table->string('full_name')->default('')->nullable();
            $table->string('first_name')->default('')->nullable();
            $table->string('middle_name')->default('')->nullable();
            $table->string('last_name')->default('')->nullable();
            $table->string('gender', 30)->default('')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile', 20)->nullable();
            $table->bigInteger('agreement_id')->default(0)->nullable();
            $table->string('occupation')->nullable();
            $table->string('date_of_birth', 30)->nullable();
            $table->string('marital_status', 30)->nullable();
            $table->string('image_path')->nullable()->default('admin/dist/img/generic-user-icon.png');
            $table->string('signature_path')->nullable()->default('');
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('state')->nullable();
            $table->integer('block')->nullable()->default(0)->comment('0 is active, 1 is blocked');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        // $data = ['name_prefix' => 'Mr', 'full_name' => 'Yash Vardhan', 'gender' => 'male', 'email' => 'vardhan.yash@email.com', 'mobile' => '9038775709', 'occupation' => 'IT analyst', 'date_of_birth' => '1996-11-07', 'marital_status' => 'unmarried', 'street_address' => 'B/19 HN road', 'city' => 'Kolkata', 'pincode' => '700067', 'state' => 'West Bengal'];

        // DB::table('borrowers')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowers');
    }
}
