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
            $table->string('fiscal_code')->unique('fiscal_code')->nullable()->after('name');
            $table->string('reg_com_nr')->nullable()->after('fiscal_code');
            $table->string('city')->nullable()->after('reg_com_nr');
            $table->string('county')->nullable()->after('city');
            $table->string('address')->nullable()->after('county');
            $table->string('postal_code')->nullable()->after('address');
            $table->string('bank')->nullable()->after('postal_code');
            $table->string('bank_account')->nullable()->after('bank');
            $table->string('contact')->nullable()->after('bank_account');
            $table->string('phone')->nullable()->after('contact');
            $table->string('email')->nullable()->after('phone');
            $table->boolean('is_individual')->default(false)->after('email');
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
