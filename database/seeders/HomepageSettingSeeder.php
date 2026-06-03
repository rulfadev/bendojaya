<?php

namespace Database\Seeders;

use App\Models\HomepageSetting;
use Illuminate\Database\Seeder;

class HomepageSettingSeeder extends Seeder
{
    public function run(): void
    {
        if (! HomepageSetting::query()->exists()) {
            HomepageSetting::query()->create(HomepageSetting::defaults());
        }
    }
}
