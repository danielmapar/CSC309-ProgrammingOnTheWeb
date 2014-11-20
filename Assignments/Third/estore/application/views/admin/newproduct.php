<?php
include("application/views/header.php") ?>

<h2>New item</h2>
<div class="row">
 <h4>Item information</h4>
      <?php echo form_open_multipart("/admin/insertProd", 'class="form-horizontal" role="form"'); ?>
	   <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
	    <div class="col-sm-4">
	     <?php echo form_input('name',set_value('name'),"class='form-control'  placeholder='Name' required"); ?> 
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Desciption</label>
	    <div class="col-sm-10">
	    <?php echo form_input('description',set_value('description'),"class='form-control'  placeholder='Description' required"); ?> 
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Price</label>
	    <div class="col-sm-2">
	    <?php echo form_input('price',set_value('price'),"class='form-control'  placeholder='Price' required"); ?> 
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Photo</label>
	    <div class="col-sm-3">
				<input type="file" name="userfile" size="20" />
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <?php echo form_submit('submit','Add product','class="btn btn-primary"'); ?>
	    </div>
	  </div>
      <?php echo form_close(); ?>
  </div>


<?php
include("application/views/footer.php") ?>