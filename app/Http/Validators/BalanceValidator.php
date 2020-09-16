<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidatorType;
use App\Rules\PositiveNumbers;
use App\Rules\CountFloaNumbers;

class balanceValidator
{
	protected $positiveNumbers;
    protected $countFloaNumbers;

    /**
     * Create a new controller instance.
     *
	 * @param PositiveNumbers $positiveNumbers
	 * @param CountFloaNumbers $countFloaNumbers
	 * @return void
     */
	public function __construct(PositiveNumbers $positiveNumbers, CountFloaNumbers $countFloaNumbers)
    {
        $this->positiveNumbers = $positiveNumbers;
        $this->countFloaNumbers = $countFloaNumbers;
    }
	
	/**
	 * @return ValidatorType
	 */
	public function amountRequestValidator(): ValidatorType
    {
        return Validator::make(request()->toArray(), [
			 'amount' => ['required', 'numeric', $this->positiveNumbers, $this->countFloaNumbers],
		]);
    }
}
