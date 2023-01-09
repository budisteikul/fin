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
     						url: '{{ route('route_fin_transfer.index') }}/'+ id
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
       	 	src: '{{ route('route_fin_transfer.create') }}',
			modal: true,
          touch: false,
          autoFocus: false
   		});	
	}
	
	function EDIT(id)
	{
		$.fancybox.open({
        	type: 'ajax',
       	 	src: '{{ route('route_fin_transfer.index') }}/'+ id +'/edit',
			modal: true,
          touch: false,
          autoFocus: false
   		});
		
	}

	function CURRENCY()
	{
		$.fancybox.open({
        	type: 'ajax',
       	 	src: '{{ route('route_fin_currency.index') }}',
			modal: true,
          touch: false,
          autoFocus: false
   		});
		
	}

	function CHECK_CURRENCY()
	{
    
    var error = false;
    $("#check").attr("disabled", true);
    $('#check').html('<i class="fa fa-spinner fa-spin"></i>');
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
                    $("#result").empty().append('<div class="alert alert-secondary alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+ data.message +'</div>').hide().fadeIn();
                    $("#check").attr("disabled", false);
                    $('#check').html('{{ __('Check') }}');
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
                <div class="card-header">Transfer</div>
                <div class="card-body">
                	
                	<div class="row w-100">
                	<div class="col  text-left">
                   		<button type="button" class="btn btn-primary"  onclick="CREATE(); return false;"><b class="fa fa-plus-square"></b> Create Transfer</button>
                    </div>
                    <div class="col-auto text-right mr-0 pr-0">

                    	<button type="button" class="btn btn-secondary" onclick="CURRENCY(); return false;">
                    		<i class="fas fa-search-dollar"></i> Check Currency</button>

                    	<a type="button" class="btn btn-secondary" href="{{ route('route_fin_recipient.index') }}">
                    		<i class="fas fa-list"></i> Recipients</a>
                    </div>
                	</div>
      
      	<hr>
        The value to be transferred is : {{ $amount }}
        <hr>
        
		{!! $dataTable->table(['class'=>'table table-sm table-bordered table-hover table-striped table-responsive w-100 d-block d-md-table']) !!}
		
                </div>
            </div>
        </div>
    </div>

{!! $dataTable->scripts() !!}

@endsection
