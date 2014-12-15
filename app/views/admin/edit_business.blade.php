@extends('admin._layout')

@section('content')
<div class="panel-heading">
  Business Info
</div>
<div class="panel-body" style="width:800px ">
{{ Form::open(['route' => 'admin.business.edit', 'method' =>'POST','class'=>'form-horizontal']) }}
    <div class="form-group">
        <label for="inputBusinessID" class="col-lg-2 control-label">Business ID</label>
        <div class="col-lg-10">
            <input class="form-control input-sm" name="businessid" id="inputbusinessid" placeholder="BusinessID" disabled value="BU00001">
        </div>
	</div>
	<div class="form-group">
        <label for="inputbusinessName" class="col-lg-2 control-label">Business Name</label>
        <div class="col-lg-10">
            <input class="form-control input-sm" id="inputbusinessName" name="businessName" placeholder="Business Name">
        </div>
    </div>
    <div class="form-group">
         <label for="inputbudget" class="col-lg-2 control-label">Budget</label>
         <div class="col-lg-10">
               <input class="form-control input-sm" id="inputbudget" name="budget" placeholder="Budget">
         </div>
    </div>
    <div class="form-group">
          <label for="inputminideliveryAmt" class="col-lg-2 control-label">Minimum Delivery Amount</label>
          <div class="col-lg-10">
                <input class="form-control input-sm" id="inputminideliveryAmt" name="minideliveryamt" placeholder="Minimun Delivery Amount">
          </div>
    </div>
    <div class="form-group">
          <label for="inputminiraildelAmt" class="col-lg-2 control-label">Minimum Rail Delivery Amount</label>
          <div class="col-lg-10">
                 <input class="form-control input-sm" id="inputminiraildelAmt" name="miniraildeliveryamt" placeholder="Minimun Rail Delivery Amount">
          </div>
    </div>
    <div class="form-group">
              <label for="inputminipckAmt" class="col-lg-2 control-label">Minimum Pickup Amount</label>
           <div class="col-lg-10">
                <input class="form-control input-sm" id="inputminipckAmt" name="minipickupamt" placeholder="Minimun Pickup Amount">
           </div>
    </div>
     <div class="form-group">
		<label class="col-lg-2 control-label">Outdoor Catering</label>
			<div class="col-lg-10">
				<label class="label-radio inline">
		     		<input name="outdoorcatering" type="radio">
			    	<span class="custom-radio"></span>
					Yes
				</label>
				<label class="label-radio inline">
					<input name="outdoorcatering" type="radio">
				    <span class="custom-radio"></span>
					 No
					</label>
			</div>
	 </div>
	 <div class="form-group">
	    <label class="col-lg-2 control-label">Outdoor Catering Comments</label>
		    <div class="col-lg-10">
				<textarea class="form-control" id="txtoutdoorComments" rows="3"></textarea>
			</div>
	</div>
    <div class="form-group">
    		<label class="col-lg-2 control-label">Party Hall</label>
    			<div class="col-lg-10">
    				<label class="label-radio inline">
    		     		<input name="partyhall" type="radio">
    			    	<span class="custom-radio"></span>
    					Yes
    				</label>
    				<label class="label-radio inline">
    					<input name="partyhall" type="radio">
    				    <span class="custom-radio"></span>
    					 No
    					</label>
    	        </div>
    </div>
    <div class="form-group">
    	    <label class="col-lg-2 control-label">Outdoor Catering Comments</label>
    		    <div class="col-lg-10">
    				<textarea class="form-control" id="txtpartyhallcomments" rows="3"></textarea>
    			</div>
    </div>
{{ Form::close() }}
</div>
@endsection