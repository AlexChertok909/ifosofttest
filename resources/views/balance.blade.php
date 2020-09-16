@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('balance!') }}
					
					<form method="POST" action="{{ route('addBalance') }}">
                       @csrf
					   
					    <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount"  type="number" step="0.01" min="0" placeholder="0,00" class="form-control @error('amount') is-invalid @enderror" name="amount" value="0">

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
						 <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Balance') }}
                                </button>
                            </div>
                        </div>
                    </form>
					
 					<div>
						{{ $result }} 
					</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
