<script language="javascript">


function STORE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["amount","wise_id"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"amount": $('#amount').val(),
			"wise_id": $('#wise_id').val()
        },
		type: 'POST',
		url: '{{ route('route_fin_transfer.store') }}',
		success: function (data) {
        	$('#dataTableBuilder').DataTable().ajax.reload( null, false );
			$.fancybox.close();	
    	},
    	error: function (data) {
    		
        	$.each(data.responseJSON.errors, function (key, value) {
        		
        		$('#'+ key).addClass('is-invalid');
				if(value!="")
				{
					$('#'+ key).after('<span id="span-'+ key  +'" class="invalid-feedback" role="alert"><strong>'+ value +'</strong></span>');
				}
				$("#submit").attr("disabled", false);
				$('#submit').html('<i class="fa fa-save"></i> {{ __('Save') }}');
				
        	});
        	
    	}
	});
	
	
	return false;
}
</script>

<div class="h-100" style="width:99%">		
 
    <div class="row justify-content-center">
        <div class="col-md-12 pr-0 pl-0 pt-0 pb-0">
             <div class="card">
             
	<div class="card-header">Add Transfer</div>
	<div class="card-body">
				
<form onSubmit="STORE(); return false;">

<div id="result"></div>

<div class="form-group">
    <label for="wise_id">Recipients</label>
    <select class="form-control" id="wise_id">
      @foreach($recipients as $recipient)
      <option value="{{ $recipient->wise_id }}">{{ $recipient->account_holder }} - {{ $recipient->account_number }} - {{ $recipient->bank_name }}</option>
      @endforeach
    </select>
</div>

<div class="form-group">
	<label for="amount">Amount (IDR) :</label>
	<input type="number" step="0.01" id="amount" name="amount" class="form-control" placeholder="amount">
</div>
       
	<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Close</button>
	<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
	</form>
	</div>
</div>       
		
        
        		
        </div>
    </div>

</div>
