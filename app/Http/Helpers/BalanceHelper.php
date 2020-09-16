<?php

declare(strict_types = 1);

namespace App\Http\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Wallet, App\Deposit, App\Transaction;

class BalanceHelper
{
    public function __construct()
    {
		
    }

    /**
     * @return float
     */
    public function getBalance()
	{
        $balance = Wallet::where('user_id', Auth::id())->first('balance');
		
		if(empty($balance)){
			// todo write in log
			return 0.00;
		}
		
        return $balance->balance;
	}
	
	 /**
     * @return array
     */
    public function getDeposits(): array
	{
        $deposits = Deposit::where('user_id', Auth::id())
			->get(['id', 'invested', 'percent', 'active', 'accrue_times', 'created_at']);
		
		if($deposits->isEmpty())
			return [];
				
		$deposits = $deposits->toArray();
		
		foreach ($deposits as &$deposit) {
			$deposit['accrued'] = 10 - $deposit['accrue_times'];
			$deposit['amount'] = $deposit['accrued'] *  $deposit['invested'] * $deposit['percent'] / 100;
		}
		
		unset($deposit);
		
        return $deposits;
	}
	
	/**
     * @return array
     */
    public function getTransactions(): array
	{
        $transactions = Transaction::where('user_id', Auth::id())
			->get(['id', 'type', 'amount', 'created_at']);
		
		if($transactions->isEmpty())
			return [];
				
		return $transactions->toArray();
	}
}
