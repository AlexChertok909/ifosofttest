<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Wallet, App\Transaction, App\Deposit;

class EveryMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'every:minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Accrue a percentage of the deposit once a minute';

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
        $this->info('Start.');
		
		$deposits = Deposit::where('active', 1)->get();
		
		if($deposits->isEmpty()){
			$this->info('No active diposites');
			return;
		}
		
		$deposits->each(function ($deposit) {
			$amount = round ($deposit->invested * $deposit->invested / 100, 2);
			
			Wallet::where('id', $deposit->wallet_id)->increment('balance', $amount);
			
			$type = 'accrue';
			$deposit->accrue_times -= 1;
														
			if($deposit->accrue_times == 0) {
				$deposit->active = 0;
				$type = 'close_deposit';
			}
							
			$transaction = Transaction::create([
				'type' => $type,
				'user_id' => $deposit->user_id,
				'wallet_id' => $deposit->wallet_id, 
				'amount' => $amount,
				'deposit_id' => $deposit->id,
			]);
				
			$deposit->save();
			
		});
		
		$this->info('Finish.');
    }
}
