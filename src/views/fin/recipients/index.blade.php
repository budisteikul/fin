@extends('coresdk::layouts.app')
@section('content')
@push('scripts')
<script type="text/javascript">
	function UPDATE(id,status)
	{
		var title = '';
		if(status==1)
		{
			title = 'Make it default transfer';
			type = 'green';
			btnClass = 'btn-success';
		}
		else
		{
			title = 'Disable default transfer';
			type = 'orange';
			btnClass = 'btn-warning';
		}

		$.confirm({
    		title: title,
    		content: 'Are you sure?',
    		type: type,
			icon: 'fa fa-warning',
    		buttons: {   
        		ok: {
            		text: "OK",
            		btnClass: btnClass,
            		keys: ['enter'],
            		action: function(){
                 		var table = $('#dataTableBuilder').DataTable();
						$.ajax({
  						data: {
        					"_token": $("meta[name=csrf-token]").attr("content"),
							"action": 'update',
							"status": status
        				},
						type: 'PUT',
						url: '{{ route('route_fin_recipient.index') }}/'+ id
						}).done(function( msg ) {
							table.ajax.reload( null, false );
						});	
            		}
        		},
        		cancel: function(){
                	console.log('the user clicked cancel');
        		}
    		}
		});
		
	}

	function DELETE(id)
	{
		$.confirm({
    		title: 'Warning',
    		content: 'Are you sure?',
    		type: 'red',
			icon: 'fa fa-warning',
    		buttons: {   
        		ok: {
            		text: "OK",
            		btnClass: 'btn-danger',
            		keys: ['enter'],
            		action: function(){
                 		var table = $('#dataTableBuilder').DataTable();
							$.ajax({
							beforeSend: function(request) {
    							request.setRequestHeader("X-CSRF-TOKEN", $("meta[name=csrf-token]").attr("content"));
  						},
     						type: 'DELETE',
     						url: '{{ route('route_fin_recipient.index') }}/'+ id
						}).done(function( msg ) {
							table.ajax.reload( null, false );
						});	
            		}
        		},
        		cancel: function(){
                	console.log('the user clicked cancel');
        		}
    		}
		});
		
	}

	function CREATE()
	{
		$.fancybox.open({
        	type: 'ajax',
       	 	src: '{{ route('route_fin_recipient.create') }}',
			touch: false,
			modal: true,
   		});	
	}
</script>
@endpush
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Recipients</div>
                <div class="card-body">
                	<div class="row w-100">
                	<div class="col  text-left">
                   		<button type="button" class="btn btn-primary"  onclick="CREATE(); return false;"><b class="fa fa-plus-square"></b> Add Recipients</button>
                    </div>
                    
                </div>
      	
        <hr>
        
		{!! $dataTable->table(['class'=>'table table-sm table-bordered table-hover table-striped table-responsive w-100 d-block d-md-table']) !!}
		
                </div>
            </div>
        </div>
    </div>

{!! $dataTable->scripts() !!}

@endsection
