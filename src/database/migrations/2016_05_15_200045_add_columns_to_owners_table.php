<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnsToOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->string('fiscal_code')->unique('fiscal_code')->nullable();
            $table->string('reg_com_nr')->nullable();
            $table->string('city')->nullable();
            $table->string('county')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('contact')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_individual')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn('fiscal_code');
            $table->dropColumn('reg_com_nr');
            $table->dropColumn('city');
            $table->dropColumn('county');
            $table->dropColumn('address');
            $table->dropColumn('postal_code');
            $table->dropColumn('bank');
            $table->dropColumn('bank_account');
            $table->dropColumn('contact');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('is_individual');
        });
    }
}
