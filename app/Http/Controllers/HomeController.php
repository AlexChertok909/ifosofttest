<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\BalanceHelper;

class HomeController extends Controller
{
    private $balanceHelper;
	
	/**
     * Create a new controller instance.
     *
	 * @param BalanceHelper $balanceHelper
     * @return void
     */
    public function __construct(BalanceHelper $balanceHelper)
    {
        $this->middleware('auth');
		$this->balanceHelper = $balanceHelper;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $balance = $this->balanceHelper->getBalance();
		$deposits = $this->balanceHelper->getDeposits();
		$transactions = $this->balanceHelper->getTransactions();
		
		return view('home', ['balance' => $balance,
							 'deposits' => $deposits,
							 'transactions' => $transactions]);
    }
}
