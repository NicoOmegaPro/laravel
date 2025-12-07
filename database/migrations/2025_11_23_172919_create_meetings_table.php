<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trek_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->date('appDateIni');
            $table->date('appDateEnd')->nullable();
            $table->date('day');
            $table->time('hour');
            $table->foreignId('user_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->integer('totalScore')->nullable()->default(0);
            $table->integer('countScore')->nullable()->default(0);
            $table->float('avgScore')->default(0);
            $table->timestamps();
        });

        DB::statement('
    CREATE TRIGGER update_trek_scores_after_insert_meetings
    AFTER INSERT ON meetings
    FOR EACH ROW
    BEGIN
        DECLARE vTotal INT;
        DECLARE vCount INT;
        DECLARE vAvg   FLOAT;

        SELECT IFNULL(SUM(totalScore),0), IFNULL(SUM(countScore),0)
        INTO vTotal, vCount
        FROM meetings
        WHERE trek_id = NEW.trek_id;

        IF vCount = 0 THEN
            SET vAvg = 0;
        ELSE
            SET vAvg = vTotal / vCount;
        END IF;

        UPDATE treks
        SET totalScore = vTotal,
            countScore = vCount,
            avgScore   = vAvg
        WHERE id = NEW.trek_id;
    END;
');


        DB::statement('
    CREATE TRIGGER update_trek_scores_after_update_meetings
    AFTER UPDATE ON meetings
    FOR EACH ROW
    BEGIN
        DECLARE vTotal INT;
        DECLARE vCount INT;
        DECLARE vAvg   FLOAT;

        SELECT IFNULL(SUM(totalScore),0), IFNULL(SUM(countScore),0)
        INTO vTotal, vCount
        FROM meetings
        WHERE trek_id = NEW.trek_id;

        IF vCount = 0 THEN
            SET vAvg = 0;
        ELSE
            SET vAvg = vTotal / vCount;
        END IF;

        UPDATE treks
        SET totalScore = vTotal,
            countScore = vCount,
            avgScore   = vAvg
        WHERE id = NEW.trek_id;
    END;
');

        DB::statement('
    CREATE TRIGGER update_trek_scores_after_delete_meetings
    AFTER DELETE ON meetings
    FOR EACH ROW
    BEGIN
        DECLARE vTotal INT;
        DECLARE vCount INT;
        DECLARE vAvg   FLOAT;

        SELECT IFNULL(SUM(totalScore),0), IFNULL(SUM(countScore),0)
        INTO vTotal, vCount
        FROM meetings
        WHERE trek_id = OLD.trek_id;

        IF vCount = 0 THEN
            SET vAvg = 0;
        ELSE
            SET vAvg = vTotal / vCount;
        END IF;

        UPDATE treks
        SET totalScore = vTotal,
            countScore = vCount,
            avgScore   = vAvg
        WHERE id = OLD.trek_id;
    END;
');
    }

    public function down(): void
    {
        // Primero quitamos los triggers
        DB::statement('DROP TRIGGER IF EXISTS update_trek_scores_after_insert_meetings;');
        DB::statement('DROP TRIGGER IF EXISTS update_trek_scores_after_update_meetings;');
        DB::statement('DROP TRIGGER IF EXISTS update_trek_scores_after_delete_meetings;');

        Schema::dropIfExists('meetings');
    }
};
