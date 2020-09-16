<?php

declare(strict_types = 1);

namespace App\Http\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Wallet;

class BalanceHelper
{
    public function __construct()
    {
		
    }

    /**
     * @return array
     */
    public function getBalance(): array
	{
        $balance = Wallet::where('user_id', Auth::id())->first('balance');
		
		if(empty($balance)){
			// todo write in log
			return ['balance' => 0.00];
		}
		
        return ['balance' => $balance->balance];
	}
}
