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
				<a href="<?php echo base_url('home/addInvoice') ?>" title="Add New Invoice">
					<button type="button" class="btn btn-primary">
						Add New Invoice
					</button>
				</a>
			</div>
			<div class="table-responsive">
				<table class="table table-striped" id="invoice">
					<thead>
						<tr>
							<th>Invoice ID</th>
							<th>Issue Date</th>
							<th>Due Date</th>
							<th>Subject</th>
							<th>Sender</th>
							<th>Receiver</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($results!=FALSE){
								foreach($results as $rows){
									?>
									<tr>
										<td><?php echo $rows->invoiceID ?></td>
										<td><?php echo date('d M Y',strtotime($rows->issueDate)) ?></td>
										<td><?php echo date('d M Y',strtotime($rows->dueDate)) ?></td>
										<td><?php echo $rows->subject ?></td>
										<td><?php echo $rows->sender ?></td>
										<td><?php echo $rows->receiver ?></td>
										<td>
											<?php
												if($rows->statusinvoice == 0)
													echo "<span class=\"badge bg-secondary\">Unpaid</span>";
												else if($rows->statusinvoice == 1)
													echo "<span class=\"badge bg-success\">Paid</span>";
												else if($rows->statusinvoice == 2)
													echo "<span class=\"badge bg-danger\">Terminated</span>";
											?>
										</td>
										<td>
											<?php if($rows->statusinvoice == 1){?>
											<a href="<?php echo base_url('home/printInvoice/'.$rows->invoiceID) ?>" title="Print Invoice">Print</a>
											<?php 
												}
											else{
												?>
												<a href="<?php echo base_url('home/payInvoice/'.$rows->invoiceID) ?>" title="Detail Invoice">Pay</a>
												<?php
											} ?>
											<a href="<?php echo base_url('home/detailInvoice/'.$rows->invoiceID) ?>" title="Detail Invoice">Detail</a>
											<a href="<?php echo base_url('home/editInvoice/'.$rows->invoiceID) ?>" title="Edit Invoice">Edit</a>
											<a href="<?php echo base_url('home/deleteInvoice/'.$rows->invoiceID) ?>" title="Detail Invoice" onclick="return confirm('Are you sure want to delete this data?')">Delete</a>
										</td>
									</tr>
									<?php
								}
							}
						?>
                	</tbody>
				</table>
			</div>
		</div>
	</div>
	

	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function () {
			$('#invoice').DataTable();
		});
	</script>
	<script>
		$( function() {
			$( ".datepicker" ).datepicker({
				"dateFormat":"yy-mm-dd"
			});
		} );
	</script>
</body>
</html>
