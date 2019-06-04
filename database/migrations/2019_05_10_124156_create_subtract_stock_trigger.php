<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubtractStockTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        delimiter $ 
        CREATE OR REPLACE TRIGGER subtract_stock
        AFTER INSERT ON material_project FOR EACH ROW
        BEGIN
            UPDATE materials SET stock = stock - NEW.amount
            WHERE id = NEW.material_id; 
        END $
        DELIMITER ;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `subtract_stock`');
    }
}
