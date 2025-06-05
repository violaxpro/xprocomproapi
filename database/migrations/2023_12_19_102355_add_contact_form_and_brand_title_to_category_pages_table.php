<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactFormAndBrandTitleToCategoryPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_pages', function (Blueprint $table) {
            $table->string('brand_title')->nullable()->after('description');
            $table->tinyInteger('show_contact_form')->after('brand_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_pages', function (Blueprint $table) {
            //
        });
    }
}
