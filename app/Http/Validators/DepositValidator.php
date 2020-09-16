<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidatorType;
use App\Rules\BetweenNumbers;
use App\Rules\countFloaNumbers;

class DepositValidator
{
	protected $betweenNumbers;
    protected $countFloaNumbers;

    /**
     * Create a new controller instance.
     *
	 * @param BetweenNumbers $betweenNumbers
	 * @param CountFloaNumbers $countFloaNumbers
	 * @return void
     */
	public function __construct(BetweenNumbers $betweenNumbers, CountFloaNumbers $countFloaNumbers)
    {
        $this->betweenNumbers = $betweenNumbers;
        $this->countFloaNumbers = $countFloaNumbers;
    }
	
	/**
	 * @return ValidatorType
	 */
	public function amountRequestValidator(): ValidatorType
    {
        return Validator::make(request()->toArray(), [
			 'amount' => ['required', 'numeric', $this->betweenNumbers, $this->countFloaNumbers],
		]);
    }
}
