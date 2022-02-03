<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        DB::statement("INSERT INTO `brands` (`id`, `name`) VALUES
        (1, 'LG'),
        (2, 'Philips'),
        (3, 'Daikin'),
        (4, 'Sony'),
        (5, 'IFB'),
        (6, 'Orient Electric'),
        (7, 'Morphy Richards'),
        (8, 'Prestige'),
        (9, 'Xiaomi'),
        (10, 'Realme'),
        (11, 'OnePlus'),
        (12, 'Kenstar'),
        (13, 'Bose'),
        (14, 'Panasonic'),
        (15, 'Bajaj Electricals'),
        (16, 'Whirlpool'),
        (17, 'Haier'),
        (18, 'Samsung'),
        (19, 'Havells'),
        (20, 'Symphony'),
        (21, 'Dell'),
        (22, 'Vivo'),
        (23, 'Oppo'),
        (24, 'Lenovo'),
        (25, 'Boat'),
        (26, 'Asus'),
        (27, 'Acer'),
        (28, 'JBL'),
        (29, 'Nikon'),
        (30, 'iBall'),
        (31, 'Zebronics'),
        (32, 'Sennheiser'),
        (33, 'POCO'),
        (34, 'Butterfly'),
        (35, 'Sunflame'),
        (36, 'VGuard'),
        (37, 'Hawkins'),
        (38, 'Microtek'),
        (39, 'Greenchef'),
        (40, 'Maharaja Whiteline'),
        (41, 'Samsonite'),
        (42, 'Huwaei'),
        (43, 'Motorola'),
        (44, 'Toshiba'),
        (45, 'Hisense'),
        (46, 'Sanyo'),
        (47, 'Apple'),
        (48, 'Crompton'),
        (49, 'HP'),
        (50, 'Nokia'),
        (51, 'Fastrack'),
        (53, 'Kutchina'),
        (54, 'Casio'),
        (55, 'Titan'),
        (56, 'Anchor'),
        (57, 'Hitachi'),
        (58, 'Godrej'),
        (59, 'Pigeon'),
        (60, 'Black & Decker'),
        (61, 'Eveready'),
        (62, 'Police'),
        (63, 'IDEE'),
        (64, 'RayBan'),
        (65, 'Micromax'),
        (66, 'Croma'),
        (67, 'Reconnect'),
        (68, 'Nirlep'),
        (69, 'DeLonghi'),
        (70, 'Lloyd'),
        (71, 'Usha'),
        (72, 'Voltas'),
        (73, 'Vu'),
        (74, 'Onida'),
        (75, 'Honor'),
        (76, 'Kent'),
        (77, 'Wonderchef'),
        (78, 'Syska'),
        (79, 'Videocon'),
        (80, 'Anker'),
        (81, 'Oakter'),
        (82, 'Kaff'),
        (83, 'Hamilton Beach'),
        (85, 'Kodak'),
        (86, 'Akai'),
        (87, 'TCL'),
        (88, 'Kevin'),
        (89, 'Sansui'),
        (90, 'Jaipan'),
        (91, 'Khaitan'),
        (92, 'Faber'),
        (93, 'Siemens'),
        (94, 'Bosch'),
        (95, 'VIP'),
        (96, 'Safari'),
        (97, 'Vinod'),
        (98, 'Koryo'),
        (99, 'BPL'),
        (100, 'Nova'),
        (101, 'Preethi'),
        (102, 'AO Smith'),
        (103, 'Livpure'),
        (104, 'Microsoft'),
        (105, 'Canon'),
        (106, 'Elica'),
        (107, 'Aquaguard'),
        (108, 'Blue Star'),
        (109, 'Compaq'),
        (110, 'Gilma'),
        (111, 'iBell'),
        (112, 'Kelvinator'),
        (113, 'Lifelong'),
        (114, 'TATA Swach'),
        (115, 'CrabTree'),
        (116, 'MarQ'),
        (117, 'Borosil'),
        (118, 'Carrier'),
        (119, 'Electrolux'),
        (120, 'Epson')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
