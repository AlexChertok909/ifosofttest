<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Validators\CommonValidator;
use App\Repositories\BalanceRepository;

class BalanceController extends Controller
{
	private $commonValidator;
	private $balanceRepository;
	
	/**
     * Create a new controller instance.
     *
	 * @param CommonValidator $commonValidator
	 * @param BalanceRepository $balanceRepository
	 * @return void
     */
    public function __construct(CommonValidator $commonValidator, BalanceRepository $balanceRepository)
    {
        $this->middleware('auth');
		$this->commonValidator = $commonValidator;
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
		$validator = $this->commonValidator->amountRequestValidator();
		
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
