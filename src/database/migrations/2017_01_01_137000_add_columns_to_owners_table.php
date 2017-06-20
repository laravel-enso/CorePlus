<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnsToOwnersTable extends Migration
{
    public function up()
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->string('fiscal_code')->unique()->nullable()->after('name');
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

    public function down()
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn([
                'fiscal_code',
                'reg_com_nr',
                'city',
                'county',
                'address',
                'postal_code',
                'bank',
                'bank_account',
                'contact',
                'phone',
                'email',
                'is_individual'
            ]);
        });
    }
}
