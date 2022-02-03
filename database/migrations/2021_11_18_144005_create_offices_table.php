<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('mobile', 20);
            $table->string('email');
            $table->string('street_address');
            $table->string('pincode', 10);
            $table->string('city');
            $table->string('state');
            $table->text('comment');
            $table->softdeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        $data = [
            'name' => 'Kolkata office',
            'code' => 'PFSL001',
            'mobile' => '9876543210',
            'email' => 'pfsl.kolkata.PFSL001@gmail.com',
            'street_address' => 'B/19 HN road',
            'pincode' => '700001',
            'city' => 'Kolkata',
            'state' => 'West Bengal',
            'comment' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, odio cupiditate laboriosam repudiandae soluta deleniti velit. Modi mollitia inventore ab provident perspiciatis minima hic, veritatis voluptas sit distinctio obcaecati maxime incidunt, omnis officiis nobis? Eveniet, itaque. Odit placeat beatae iste, facilis minus quos quaerat reiciendis? Quos reiciendis impedit&apos;s illum officia!'
        ];

        DB::table('offices')->insert($data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offices');
    }
}
