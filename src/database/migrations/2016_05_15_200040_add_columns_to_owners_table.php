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
            $table->dropColumns('fiscal_code');
            $table->dropColumns('reg_com_nr');
            $table->dropColumns('city');
            $table->dropColumns('county');
            $table->dropColumns('address');
            $table->dropColumns('postal_code');
            $table->dropColumns('bank');
            $table->dropColumns('bank_account');
            $table->dropColumns('contact');
            $table->dropColumns('phone');
            $table->dropColumns('email');
            $table->dropColumns('is_individual');
        });
    }
}
