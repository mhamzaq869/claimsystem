<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contract;

class ContractStatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contract:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Contract status update on new,late,cancel and complete';

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

        foreach(Contract::all() as $contract ){

            $today = date('Y-m-d H:i:s');
            Contract::where('completed',0)->where('expired','<',$today)->update([
                'status' => 'late'
            ]);
        }

    }
}
