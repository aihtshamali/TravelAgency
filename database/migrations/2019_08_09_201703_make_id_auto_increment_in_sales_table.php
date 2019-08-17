<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeIdAutoIncrementInSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('CRM_Sale', function (Blueprint $table) {
        //    $table->bigInt( 'SaleID' )->nullable()->change();
            // DB::statement("ALTER TABLE [CRM_Sale] DROP COLUMN SaleID ALTER TABLE [CRM_Sale] ADD SaleID INT IDENTITY(1,1)");
        //    $table->integer('SaleID')->primary()->change();           
        });
                Schema::enableForeignKeyConstraints();

    }

  public function down()
    {
        // DB::statement("ALTER TABLE sales_order_details MODIFY id INT NOT NULL");
        // DB::statement("ALTER TABLE sales_order_details DROP PRIMARY KEY");
        // DB::statement("ALTER TABLE sales_order_details MODIFY id INT NULL");
    }
}
