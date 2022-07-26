<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        $this->call([ProjectTableSeeder::class]);
        $this->call([FinancialGroupTableSeeder::class]);
        $this->call([ResearchGroupTableSeeder::class]);
        $this->call([PubblicationTableSeeder::class]);
        $this->call([BudgetTableSeeder::class]);
        $this->call([ScientificPublicationsSeeder::class]);
        $this->call([FinanziatoreTableSeeder::class]);
        $this->call([SubprojectsSeeder::class]);
        $this->call([SubprojectsResearchersSeeder::class]);
        $this->call([MilestoneSeeder::class]);
        $this->call([ReportSeeder::class]);
    }
}
