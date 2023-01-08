<script language="javascript">
function UPDATE()
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
		type: 'PUT',
		url: '{{ route('route_fin_transfer.update',$transfer->id) }}',
		success: function (data) {
        	$('#dataTableBuilder').DataTable().ajax.reload( null, false );
			$("#result").empty().append('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Success!</b></div>').hide().fadeIn();
       				setTimeout(function (){
  						$.fancybox.close();
					}, 1000);
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
                <div class="card-header pr-0"><div class="row align-items-center w-100">
                    <div class="col text-left">
                        <div class="d-flex align-self-center">
                        Edit Transfer
                        </div>
                    </div>
                    <div class="col-auto text-right mr-0 pr-0">
                        <div class="btn-toolbar justify-content-end">
                            <button class="btn btn-sm btn-danger mr-0" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Close</button>
                        </div>
                    </div>
                </div></div>
                <div class="card-body">
				
<form onSubmit="UPDATE(); return false;">
<div id="result"></div>


<div class="form-group">
    <label for="wise_id">Recipients</label>
    <select class="form-control" id="wise_id">
      @foreach($recipients as $recipient)
      <option value="{{ $recipient->wise_id }}" {{  ($recipient->wise_id == $transfer->wise_id) ? "selected" : "" }}>{{ $recipient->bank_name }}</option>
      @endforeach
    </select>
  </div>


<div class="form-group">
	<label for="amount">Amount :</label>
	<input type="number" step="0.01" id="amount" name="amount" class="form-control" value="{{ $transfer->idr }}" placeholder="amount">
</div>

<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</form>
</div>
</div>       




				
        </div>
    </div>

</div>