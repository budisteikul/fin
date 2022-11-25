@extends('coresdk::layouts.app')
@section('content')
@push('scripts')
<script language="javascript">
function CHECK_CURRENCY()
{
    var error = false;
    $("#submit").attr("disabled", true);
    $('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
    var input = ["amount"];
    
    $.each(input, function( index, value ) {
        $('#'+ value).removeClass('is-invalid');
        $('#span-'+ value).remove();
    });
    
    
    $.ajax({
        data: {
            "_token": $("meta[name=csrf-token]").attr("content"),
            "amount": $('#amount').val()
        },
        type: 'POST',
        url: '{{ route('route_fin_currency.index') }}'
        }).done(function( data ) {
            
            if(data.id=="1")
            {
                    $("#result").empty().append('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+ data.message +'</div>').hide().fadeIn();
                    $("#submit").attr("disabled", false);
                    $('#submit').html('{{ __('Check') }}');
            }
            else
            {
                $.each( data, function( index, value ) {
                    $('#'+ index).addClass('is-invalid');
                        if(value!="")
                        {
                            $('#'+ index).after('<span id="span-'+ index  +'" class="invalid-feedback" role="alert"><strong>'+ value +'</strong></span>');
                        }
                    });
                $("#submit").attr("disabled", false);
                $('#submit').html('{{ __('Check') }}');
            }
        });
    
    
    return false;
}
</script>
@endpush
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Currencies</div>
                <div class="card-body">

<form onSubmit="CHECK_CURRENCY(); return false;">
<div id="result"></div>
<div class="form-group">
	<label for="amount">Amount :</label>
	<input type="number" id="amount" name="amount" class="form-control" placeholder="Amount" autocomplete="off" value="">
</div>
<button id="submit" type="submit" class="btn btn-primary">Check</button> 
</form>
<br />
                </div>
            </div>
        </div>
    </div>
@endsection