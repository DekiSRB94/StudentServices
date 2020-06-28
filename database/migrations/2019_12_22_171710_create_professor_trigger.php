<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_User_Default_Member_Role_2 AFTER INSERT ON `professors` FOR EACH ROW
            BEGIN
                INSERT INTO users (`name`, `surname`, `address`, `email`, `password`, `phone`, `role`, `created_at`, `updated_at`) 
                VALUES (NEW.name, NEW.surname, NEW.address, NEW.email, NEW.password, NEW.phone_number, 2, now(), null);
            END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_User_Default_Member_Role_2`');
    }

}
