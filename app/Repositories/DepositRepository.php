<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

use App\Wallet, App\Transaction, App\Deposit;

use Illuminate\Support\Facades\DB;

class DepositRepository
{   	
	/**
	 * @param float $amount
	 * @return void 
	 */
	public function create($amount)
	{	
		$userId = Auth::id();
		DB::transaction(function () use ($amount, $userId) {
						
			$wallet = Wallet::where('user_id', $userId)->first();
			
			if(empty($wallet))
				throw new \Exception('error receiving wallet');
			
			if($wallet->balance < $amount)
				throw new \Exception('error low balance');
			
			$wallet->balance -= $amount;
			$wallet->save();
			
			$deposit = Deposit::create([
				'type' => 'create_deposit',
				'user_id' => $userId,
				'wallet_id' => $wallet->id, 
				'invested' => $amount,
				'percent' => 20.00,
				'active' => 1,
				'duration' => 10,
				'accrue_times' => 10
			]);
			
			if(empty($deposit))
				throw new \Exception('deposit creation error');
			
			$transaction = Transaction::create([
				'type' => 'create_deposit',
				'user_id' => $userId,
				'wallet_id' => $wallet->id, 
				'amount' => $amount,
				'deposit_id' => $deposit->id,
			]);
			
			if(empty($transaction))
				throw new \Exception('transaction creation error');
			
		});
		
	}
		
}	
