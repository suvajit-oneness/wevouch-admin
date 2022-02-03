<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAgreementDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rfq_id');
            // $table->bigInteger('borrower_id');
            // $table->bigInteger('agreement_id');
            $table->bigInteger('field_id');
            $table->text('field_name');
            $table->text('field_value');
            // $table->bigInteger('data_filled_by');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agreement_data');
    }
}
