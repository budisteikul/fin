
@inject('FinClass', 'budisteikul\fin\Classes\FinClass')
 
<div class="h-100" style="width:99%">		
 
    <div class="row justify-content-center">
        <div class="col-md-12 pr-0 pl-0 pt-0 pb-0">
             <div class="card">
             
	<div class="card-header pr-0"><div class="row align-items-center w-100">
                    <div class="col text-left">
                        <div class="d-flex align-self-center">
                        Add Category
                        </div>
                    </div>
                    <div class="col-auto text-right mr-0 pr-0">
                        <div class="btn-toolbar justify-content-end">
                            <button class="btn btn-sm btn-danger mr-0" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Close</button>
                        </div>
                    </div>
                </div></div>
	<div class="card-body">
				
<form onSubmit="STORE(); return false;">

<div id="result"></div>

<div class="form-group">
	<label for="name">Name :</label>
	<input type="text" id="name" name="name" class="form-control" placeholder="name">
</div>

<div class="form-group">
    <label for="parent_id">Parent</label>
    <select class="form-control" id="parent_id">
      <option value="0">No Parent</option>
      @foreach($categories as $category)
      <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->type }})</option>
      @endforeach
    </select>
</div>

<div class="form-group" id="form-type">
	<label for="type">Type :</label>
    <select class="form-control" id="type">
      <option value="Expenses">Expenses</option>
      <option value="Revenue">Revenue</option>
      <option value="Cost of Goods Sold">Cost of Goods Sold</option>
	</select>
</div>


       
	<button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
	</form>
	</div>
</div>       
		
        
        		
        </div>
    </div>

</div>


<script language="javascript">


$('#parent_id').on('change', function() {
 if(this.value>0)
 {
 	$('#form-type').hide();
 }
 else
 {
 	$('#form-type').show();
 }
  
});

function STORE()
{
	var error = false;
	$("#submit").attr("disabled", true);
	$('#submit').html('<i class="fa fa-spinner fa-spin"></i>');
	var input = ["name","type"];
	
	$.each(input, function( index, value ) {
  		$('#'+ value).removeClass('is-invalid');
  		$('#span-'+ value).remove();
	});
	
	
	$.ajax({
		data: {
        	"_token": $("meta[name=csrf-token]").attr("content"),
			"name": $('#name').val(),
			"type": $('#type').val(),
			"parent_id": $('#parent_id').val(),
        },
		type: 'POST',
		url: '{{ route('route_fin_categories.store') }}'
		}).done(function( data ) {
			
			if(data.id=="1")
			{
				
       				$('#dataTableBuilder').DataTable().ajax.reload( null, false );
					$("#result").empty().append('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>Success!</b></div>').hide().fadeIn();
       				setTimeout(function (){
  						$.fancybox.close();
					}, 1000);
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
				$('#submit').html('<i class="fa fa-save"></i> {{ __('Save') }}');
			}
		});
	
	
	return false;
}
</script>