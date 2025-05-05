<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('demande_devis_offre', function (Blueprint $table) {
        $table->id();
        $table->foreignId('demande_devis_id')->constrained('demande_devis')->onDelete('cascade');
        $table->foreignId('offre_id')->constrained('offres')->onDelete('cascade');
    });
}


    public function down(): void
    {
        Schema::dropIfExists('demande_devis_offre');
    }
};
