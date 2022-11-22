@extends('coresdk::layouts.app')
@section('content')
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Currencies</div>
                <div class="card-body">

<form method="POST" action="{{ route('route_fin_currency.index') }}">
@csrf
<div class="form-group">
	<label for="amount">Amount :</label>
	<input type="number" id="amount" name="amount" class="form-control" placeholder="Amount" autocomplete="off" value="{{ $amount }}">
</div>
<button id="submit" type="submit" class="btn btn-primary">Check</button> 
</form>
<br />

        			@foreach($data as $currency)
        				{{ $currency['type'] }} {{ $currency['value'] }} <br />
        			@endforeach
		
		
                </div>
            </div>
        </div>
    </div>
@endsection