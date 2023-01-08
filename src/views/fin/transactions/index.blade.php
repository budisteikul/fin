@inject('fin', 'budisteikul\fin\Classes\FinClass')
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
			modal: true,
          touch: false,
          autoFocus: false
   		});	
	}
	
	function EDIT(id)
	{
		$.fancybox.open({
        	type: 'ajax',
       	 	src: '{{ route('route_fin_transactions.index') }}/'+ id +'/edit',
			modal: true,
          touch: false,
          autoFocus: false
   		});
		
	}
	</script>
@endpush





<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Transactions</div>
                <div class="card-body">
                	
                	<div class="row w-100">
                	<div class="col  text-left">
                   		{!! $fin::select_yearmonth_form($tahun,$bulan)  !!}
                    </div>
                    
                	</div>
                	<hr />
                	<div class="row w-100">
                	<div class="col  text-left">
                   		<button type="button" class="btn btn-primary"  onclick="CREATE(); return false;"><b class="fa fa-plus-square"></b> Create Transactions</button>
                    </div>
                    <div class="col-auto text-right mr-0 pr-0">
                    	<a type="button" class="btn btn-secondary" href="{{ route('route_fin_categories.index') }}">
                    		<i class="fas fa-list"></i> Categories</a>
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
