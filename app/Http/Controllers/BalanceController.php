<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Validators\BalanceValidator;
use App\Repositories\BalanceRepository;

class BalanceController extends Controller
{
	private $balanceValidator;
	private $balanceRepository;
	
	/**
     * Create a new controller instance.
     *
	 * @param BalanceValidator $balanceValidator
	 * @param BalanceRepository $balanceRepository
	 * @return void
     */
    public function __construct(BalanceValidator $balanceValidator, BalanceRepository $balanceRepository)
    {
        $this->middleware('auth');
		$this->balanceValidator = $balanceValidator;
		$this->balanceRepository = $balanceRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
		return view('balance', ['result' => '']);
    }
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add()
    {        
		$validator = $this->balanceValidator->amountRequestValidator();
		
        if ($validator->fails())
			return redirect('balance')
                        ->withErrors($validator)
                        ->withInput();
						
		
		try {
			$this->balanceRepository->add(request('amount'));
		} catch (\Exception $e) {
			return view('balance', ['result' => 'Balance not added. '.$e->getMessage()]);
		}
		
		return view('balance', ['result' => 'Balance added.']);
    }
}
