<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Validators\DepositValidator;
use App\Repositories\DepositRepository;


class DepositController extends Controller
{
    
	private $depositValidator;
	private $depositRepository;
	
	/**
     * Create a new controller instance.
     *
	 * @param DepositValidator $depositValidator
	 * @param DepositRepository $depositRepository
	 * @return void
     */
    public function __construct(DepositValidator $depositValidator, DepositRepository $depositRepository)
    {
        $this->middleware('auth');
		$this->depositValidator = $depositValidator;
		$this->depositRepository = $depositRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('deposit', ['result' => '']);
    }
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {        
		$validator = $this->depositValidator->amountRequestValidator();
		
        if ($validator->fails())
			return redirect('deposit')
                        ->withErrors($validator)
                        ->withInput();
		
		try {
			$this->depositRepository->create(request('amount'));
		} catch (\Exception $e) {
			return view('deposit', ['result' => 'Deposit not added. '.$e->getMessage()]);
		}
		
		return view('deposit', ['result' => 'Deposit added.']);
    }
}
