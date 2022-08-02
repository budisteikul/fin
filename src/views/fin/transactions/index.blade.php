@extends('coresdk::layouts.app')
@section('content')
@push('scripts')
<script type="text/javascript">

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
     						url: '{{ route('route_fin_transactions.index') }}/'+ id
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
       	 	src: '{{ route('route_fin_transactions.create') }}',
			touch: false,
			modal: true,
			autoFocus: false,
   		});	
	}
	
	function EDIT(id)
	{
		$.fancybox.open({
        	type: 'ajax',
       	 	src: '{{ route('route_fin_transactions.index') }}/'+ id +'/edit',
			modal: true,
			autoFocus: false,
   		});
		
	}
	</script>
@endpush





<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">transactions</div>
                <div class="card-body">
      
      	<button type="button" class="btn btn-secondary"  onclick="CREATE(); return false;"><b class="fa fa-plus-square"></b> Add transactions</button>
        <hr>
        
		{!! $dataTable->table(['class'=>'table table-hover table-striped table-responsive w-100 d-block d-md-table']) !!}
		
                </div>
            </div>
        </div>
    </div>

{!! $dataTable->scripts() !!}

@endsection
