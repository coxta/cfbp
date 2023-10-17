<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        $statement = '
            CREATE VIEW current_games 
            AS
            SELECT 
                c.id as calendar_id,
                CONCAT(c.year," ",c.name) as calendar_name,
                w.id as week_id,
                w.`name` as week_name,
                w.description as week_desc,
                g.id as game_id,
                g.short_name,
                g.start_date,
                g.status_desc,
                g.away_team as away_id,
                a.`location` as away_location,
                a.`name` as away_name,
                g.away_rank,
                g.away_records,
                g.away_score,
                g.home_team as home_id,
                h.`location` as home_location,
                h.`name` as home_name,
                g.home_rank,
                g.home_records,
                g.home_score
            FROM calendars as c
            LEFT JOIN weeks as w 
                ON w.calendar_id = c.id 
            LEFT JOIN games as g 
                ON c.id = g.calendar_id
                AND w.id = g.week_id
            LEFT JOIN teams as a 
                ON g.away_team = a.id
            LEFT JOIN teams as h
                ON g.home_team = h.id
            WHERE CURRENT_DATE BETWEEN w.start_date and w.end_date
            ORDER BY g.start_date
        ';

        DB::statement($statement);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_games');
    }
    
};
