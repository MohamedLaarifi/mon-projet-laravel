<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('reponse');
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
        });
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->text('reponse')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained()->onDelete('set null');
        });
    }
};
