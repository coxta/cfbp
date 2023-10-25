<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecordType;
use App\Models\Group;
use App\Models\Member;
use App\Models\User;

class RecordTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Group Types
        $masterGroupType = RecordType::create([
            'name' => 'Master',
            'model' => 'Group',
            'description' => 'The master record for unaffiliated contests'
        ]);
        $publicGroupType = RecordType::create([
            'name' => 'Public',
            'model' => 'Group',
            'description' => 'Public groups'
        ]);
        $privateGroupType = RecordType::create([
            'name' => 'Private',
            'model' => 'Group',
            'description' => 'Private groups'
        ]);

        // The master group
        $masterGroup = Group::create([
            'name' => 'Master',
            'type_id' => $masterGroupType->id,
            'user_id' => User::where('admin', true)->first()->id,
        ]);

        // Member Types
        $memberCommishType = RecordType::create([
            'name' => 'Commissioner',
            'model' => 'Member',
            'description' => 'Commissioners for a Group'
        ]);
        $memberTreasurerType = RecordType::create([
            'name' => 'Treasurer',
            'model' => 'Member',
            'description' => 'Treasurers for a Group'
        ]);
        $memberMemberType = RecordType::create([
            'name' => 'Member',
            'model' => 'Member',
            'description' => 'Members for a Group'
        ]);

        // The master group commissioner
        $commissioner = Member::create([
            'group_id' => $masterGroup->id,
            'type_id' => $memberCommishType->id,
            'user_id' => $masterGroup->user_id
        ]);

        // Contest Types
        $classicContestType = RecordType::create([
            'name' => 'Classic',
            'model' => 'Contest',
            'description' => 'Pick the straight-up winner in 10 games.  Each game is worth 10 points.'
        ]);
        $spreadsContestType = RecordType::create([
            'name' => 'Spreads',
            'model' => 'Contest',
            'description' => 'Pick winners against the spread in 12 games.  Each game is worth 10 points.'
        ]);
        $tieredSpreadsContestType = RecordType::create([
            'name' => 'Tiered Spreads',
            'model' => 'Contest',
            'description' => 'Pick winners against the spread in 15 tiered games.  Tier 1 = 1pt, Tier 2 = 2pts, Tier 3 = 3pts.'
        ]);

    }
}
