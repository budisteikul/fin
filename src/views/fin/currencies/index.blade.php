

<div class="h-100" style="width:99%">

<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Currencies</div>
                <div class="card-body">

<form onSubmit="CHECK_CURRENCY(); return false;">
<div id="result"></div>
<div class="form-group">
	<label for="amount">Amount (IDR) :</label>
	<input type="number" id="amount" name="amount" class="form-control" placeholder="Amount" autocomplete="off" value="">
</div>
<button  class="btn btn-danger" type="button" onClick="$.fancybox.close();"><i class="fa fa-window-close"></i> Close</button>
<button id="check" type="submit" class="btn btn-primary"><i class="fas fa-search-dollar"></i> Check</button>
</form>
<br />
                </div>
            </div>
        </div>
    </div>

</div>
