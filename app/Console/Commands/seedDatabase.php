<?php

namespace App\Console\Commands;

use App\Models\Component;
use App\Models\ComponentIssue;
use App\Models\Issue;
use App\Models\Timelog;
use App\Models\User;
use App\Services\Agily\Client;
use Illuminate\Console\Command;

class seedDatabase extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:seedDatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with API records';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $agilyApi = new Client();

        $issues = $agilyApi->issues()->get();
        $components = $agilyApi->components()->get();
        $timelogs = $agilyApi->timelogs()->get();
        $users = $agilyApi->users()->get();

        try {
            foreach ($users as $user) {
                $userModel = new User();
                $userModel->id = $user->id;
                $userModel->name = $user->name;
                $userModel->email = $user->email;
                $userModel->save();
            }

            foreach ($components as $component) {
                $componentModel = new Component();
                $componentModel->id = $component->id;
                $componentModel->name = $component->name;
                $componentModel->save();
            }

            foreach ($issues as $issue) {
                $issueModel = new Issue();
                $issueModel->id = $issue->id;
                $issueModel->code = $issue->code;
                $issueModel->save();

                foreach ($issue->components as $component) {
                    $componentIssueModel = new ComponentIssue();
                    $componentIssueModel->component_id = $component;
                    $componentIssueModel->issue_id = $issue->id;
                    $componentIssueModel->save();
                }
            }

            foreach ($timelogs as $timelog) {
                $timelogModel = new Timelog();
                $timelogModel->id = $timelog->id;
                $timelogModel->issue_id = $timelog->issue_id;
                $timelogModel->user_id = $timelog->user_id;
                $timelogModel->seconds_logged = $timelog->seconds_logged;
                $timelogModel->save();
            }

            $this->info('Database seeded!');

        } catch (\Throwable $th) {
            $this->info($th->getMessage());
        }
    }
}
