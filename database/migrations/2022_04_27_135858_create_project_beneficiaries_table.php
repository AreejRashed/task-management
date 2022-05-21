<?php

use App\Models\Beneficiary;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'user_id')->constrained();
            $table->foreignIdFor(Project::class,'project_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_beneficiaries');
    }
}
