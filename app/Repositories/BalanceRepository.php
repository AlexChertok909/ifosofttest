<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

use App\Wallet, App\Transaction;

use Illuminate\Support\Facades\DB;

class BalanceRepository
{   	
	/**
	 * @param float $amount
	 * @return void 
	 */
	public function add($amount)
	{	
		$userId = Auth::id();
		DB::transaction(function () use ($amount, $userId) {
						
			$wallet = Wallet::where('user_id', $userId)->first();
			
			if(empty($wallet))
				throw new \Exception('error receiving wallet');
			
			$wallet->balance += $amount;
			$wallet->save();
			
			$transaction = Transaction::create([
				'type' => 'enter',
				'user_id' => $userId,
				'wallet_id' => $wallet->id, 
				'amount' => $amount,
			]);
			
			if(empty($transaction))
				throw new \Exception('transaction creation error');
			
		});
		
	}
	
		
}	
