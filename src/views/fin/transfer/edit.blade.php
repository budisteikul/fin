<script language="javascript">
function UPDATE()
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
		type: 'PUT',
		url: '{{ route('route_fin_transfer.update',$transfer->id) }}',
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
                <div class="card-header">Edit Transfer</div>
                <div class="card-body">
				
<form onSubmit="UPDATE(); return false;">
<div id="result"></div>





<div class="form-group">
	<label for="amount">Amount :</label>
	<input type="number" step="0.01" id="amount" name="amount" class="form-control" value="{{ $transfer->idr }}" placeholder="amount">
</div>

<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Cancel</button>
<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
</div>
</div>       




				
        </div>
    </div>

</div>