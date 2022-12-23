@extends('coresdk::layouts.app')
@section('content')
@push('scripts')
<script type="text/javascript">
	function UPDATE(id)
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
  						data: {
        					"_token": $("meta[name=csrf-token]").attr("content"),
							"action": 'update'
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
</script>
@endpush
<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Recipients</div>
                <div class="card-body">
                	<div class="row w-100">
                	<!-- div class="col  text-left">
                   		<button type="button" class="btn btn-primary"  onclick="CREATE(); return false;"><b class="fa fa-plus-square"></b> Add Recipients</button>
                    </div -->
                    
                </div>
      	
        <hr>
        
		{!! $dataTable->table(['class'=>'table table-sm table-bordered table-hover table-striped table-responsive w-100 d-block d-md-table']) !!}
		
                </div>
            </div>
        </div>
    </div>

{!! $dataTable->scripts() !!}

@endsection
