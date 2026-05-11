<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'email')) {
                $table->string('email')->nullable();
            }

            if (!Schema::hasColumn('orders', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn('orders', 'address')) {
                $table->string('address')->nullable();
            }

            if (!Schema::hasColumn('orders', 'city')) {
                $table->string('city')->nullable();
            }

            if (!Schema::hasColumn('orders', 'bank_reference')) {
                $table->string('bank_reference')->nullable();
            }

            if (!Schema::hasColumn('orders', 'payment_note')) {
                $table->text('payment_note')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $columnsToDrop = [];

            foreach ([
                'email',
                'phone',
                'address',
                'city',
                'bank_reference',
                'payment_note'
            ] as $column) {
                if (Schema::hasColumn('orders', $column)) {
                    $columnsToDrop[] = $column;
                }
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};