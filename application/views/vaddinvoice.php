<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Invoice System</title>
	<link href="<?php echo base_url('invoice.css') ?>" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body>
	<div class="container form-invoice">
		<div class="col-12 col-md-10 offset-md-1">
			<h1 class="header">INVOICE SYSTEM</h1>
			<div class="form-group">
				<a href="<?php echo base_url('home') ?>" title="Back to Invoice">
					<button type="button" class="btn btn-primary">
						Back to Invoice
					</button>
				</a>
			</div>
			<div class="text-center">
				<h2>Add New Invoice</h2>
			</div>
			<?php 
			echo validation_errors();
			echo form_open(''); ?>
            <div class="form-group">
			    <label for="">Invoice ID</label>
				<input type="text" name="invoiceID" class="form-control" value="<?php echo $invoiceID ?>" readonly id="invoiceID" />
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-6">
							<label for="">Issue Date*</label>
							<input type="text" name="issueDate" class="form-control datepicker" value="<?php echo set_value('issueDate') ?>" id="issueDate" placeholder="yyyy-mm-dd"/>
					</div>
					<div class="col-12 col-md-6">
							<label for="">Due Date*</label>
							<input type="text" name="dueDate" class="form-control datepicker" value="<?php echo set_value('dueDate') ?>" id="dueDate" placeholder="yyyy-mm-dd"/>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="">Subject*</label>
				<input type="text" name="subject" class="form-control" value="<?php echo set_value('subject') ?>" placeholder="Type subject for your Invoice" id="subject"/>
			</div>
			<div class="form-group">
				<label for="">Sender*</label>
				<input type="text" name="sender" class="form-control" value="<?php echo set_value('sender') ?>" placeholder="Who's invoice's sender" id="sender"/>
			</div>
			<div class="form-group">
				<label for="">Sender's Address</label>
				<textarea class="form-control" name="senderAddress" id="senderAddress"></textarea>
			</div>
			<div class="form-group">
				<label for="">Invoice's for*</label>
				<input type="text" name="receiver" class="form-control" value="<?php echo set_value('receiver') ?>" placeholder="Who's invoice's receiver" id="receiver"/>
			</div>
			<div class="form-group">
				<label for="">Receiver's Address</label>
				<textarea class="form-control" name="receiverAddress" id="receiverAddress"></textarea>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Save Changes</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
	
	<script>
		
		$( function() {
			$( ".datepicker" ).datepicker({
				"dateFormat":"yy-mm-dd"
			});
		} );
	</script>
</body>
</html>
