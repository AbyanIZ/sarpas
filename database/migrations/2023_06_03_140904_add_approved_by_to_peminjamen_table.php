<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedByToPeminjamenTable extends Migration
{
    public function up()
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->foreignId('approved_by')->nullable()->constrained('users')->after('status');
        });
    }

    public function down()
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn('approved_by');
        });
    }
}
