<style type="text/css">
	.alert {
	    z-index: 9999;
	    top: 18px;
	    right: 18px;
	    min-width: 30%;
	    position: fixed;
	    animation: slide 0.5s forwards;
	    border-radius: 5px;
    	background-color: #FFF;
	    -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
	    -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
	    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
	}
	.alert button{
		color: #FFF;
	}
	.alert li{
		list-style: none;
	}
	.alert-success {
	    color: #ffffff;
	    background-color: rgba(38, 185, 154, 0.88);
	    border-color: rgba(38, 185, 154, 0.88);
	}

	.alert-info {
	    color: #E9EDEF;
	    background-color: rgba(52, 152, 219, 0.88);
	    border-color: rgba(52, 152, 219, 0.88);
	}

	.alert-warning {
	    color: #E9EDEF;
	    background-color: rgba(243, 156, 18, 0.88);
	    border-color: rgba(243, 156, 18, 0.88);
	}

	.alert-danger,
	.alert-error {
	    color: #E9EDEF;
	    background-color: rgba(231, 76, 60, 0.88);
	    border-color: rgba(231, 76, 60, 0.88);
	}
</style>

@if ($message = Session::get('status'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Success! <hr></strong>	
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>Success! <hr></strong>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>Errors! <hr></strong>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>Warning! <hr></strong>	
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>Info! <hr></strong>	
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">	
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>Whoops! <hr></strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<script>
	window.setTimeout(function() {
	    $(".alert").fadeTo(10000, 0).slideUp(10000, function(){
	        $(this).remove(); 
	    });
	}, 10000);
</script>