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

					<div>
						{{ __('You are logged in!') }}
						{{ __('Balance = ') }} {{ $balance }}
					</div>
					
					<div>Депозиты</div>
					<table class="table">
					  <thead>
						<tr>
						  <th scope="col">ID</th>
						  <th scope="col">Сумма вклада</th>
						  <th scope="col">Процент</th>
						  <th scope="col">Количество текущих начислений</th>
						  <th scope="col">Сумма начислений</th>
						  <th scope="col">Статус депозита</th>
						  <th scope="col">Дата</th>
						</tr>
					  </thead>
					  <tbody>
						@foreach ($deposits as $deposit)
						<tr>
						  <th scope="row">{{ @$deposit['id'] }}</th>
						  <td>{{ @$deposit['invested'] }}</td>
						  <td>{{ @$deposit['percent'] }}</td>
						  <td>{{ @$deposit['accrued'] }}</td>
						  <td>{{ @$deposit['amount'] }}</td>
						  <td>{{ @$deposit['active'] }}</td>
						  <td>{{ @$deposit['created_at'] }}</td>
						</tr>
						@endforeach
					  </tbody>
					</table>
					
					<div>Транзакции </div>
					<table class="table">
					  <thead>
						<tr>
						  <th scope="col">ID</th>
						  <th scope="col">Тип</th>
						  <th scope="col">Сумма</th>
						  <th scope="col">Дата</th>
						</tr>
					  </thead>
					  <tbody>
						@foreach ($transactions as $transaction)
						<tr>
						  <th scope="row">{{ @$transaction['id'] }}</th>
						  <td>{{ @$transaction['type'] }}</td>
						  <td>{{ @$transaction['amount'] }}</td>
						  <td>{{ @$transaction['created_at'] }}</td>
						</tr>
						@endforeach
					  </tbody>
					</table>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
