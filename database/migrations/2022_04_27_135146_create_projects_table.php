<?php

use App\Models\Category;
use App\Models\Donor;
use App\Models\Scope;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->foreignIdFor(Category::class,'category_id')->constrained;
            $table->string('start',250);
            $table->string('end',250);
            $table->string('amount',250);
            $table->foreignIdFor(Donor::class,'donor_id')->constrained;
            $table->foreignIdFor(Scope::class,'scope_id')->constrained;
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
        Schema::dropIfExists('projects');
    }
}
