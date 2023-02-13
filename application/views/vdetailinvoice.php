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
				<a href="<?php echo base_url('') ?>" title="Back to Invoice">
					<button type="button" class="btn btn-primary">
						Back to Invoice
					</button>
				</a>
			</div>
            <div class="text-center">
				<h2>Detail Invoice</h2>
			</div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                    <table class="table">
                        <tr>
                            <th>Invoice ID</th>
                            <td><?php echo $result['invoiceID']; ?></td>
                        </tr>
                        <tr>
                            <th>Issue Date</th>
                            <td><?php echo date('d M Y',strtotime($result['issueDate'])); ?></td>
                        </tr>
                        <tr>
                            <th>Due Date</th>
                            <td><?php echo date('d M Y',strtotime($result['dueDate'])); ?></td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td><?php echo ($result['subject']); ?></td>
                        </tr>
                    </table>
                    </div>
                    <div class="col-12 col-md-6">
                        <table class="table">
                            <tr>
                                <th rowspan="2">From</th>
                                <td><?php echo $result['sender'] ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $result['senderAddress'] ?></td>
                            </tr>
                            <tr>
                                <th rowspan="2">For</th>
                                <td><?php echo $result['receiver'] ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $result['receiverAddress'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
			<div class="table-responsive">
                <?php echo form_open(''); ?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Item Type</th>
							<th>Decsription</th>
							<th>Quantity</th>
							<th>Unit Price</th>
						</tr>
					</thead>
					<tbody id="detailInvoice">
						<?php
                            $i = 0;
                            if($results != FALSE){
                                foreach($results as $rows){
                                    ?>
                                    <tr>
                                        <td><input type="text" name="itemtype<?php echo $i ?>" class="form-control" value="<?php echo $rows->itemtype ?>"></td>
                                        <td><input type="text" name="description<?php echo $i ?>" class="form-control" value="<?php echo $rows->description ?>"></td>
                                        <td><input type="text" name="qty<?php echo $i ?>" class="form-control" value="<?php echo $rows->qty ?>"></td>
                                        <td><input type="text" name="unitprice<?php echo $i ?>" class="form-control" value="<?php echo $rows->unitprice ?>"></td> 
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                        ?>
                	</tbody>
				</table>
                <button class="btn btn-primary" onclick="addRows()" type="button">Add Row</button>
                <button class="btn btn-primary" onclick="deleteRows()" type="button">Remove Row</button>
                <button class="btn btn-primary" type="submit">Save Changes</button>
                <?php echo form_close(); ?>
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
        var lastRow = <?php echo $i; ?>;
		$( function() {
			$( ".datepicker" ).datepicker({
				"dateFormat":"yy-mm-dd"
			});
		} );
            function addRows() {
            var table = document.getElementById("detailInvoice");
            var row = table.insertRow(0);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            cell1.innerHTML = "<input type='hidden' name='rowID[]' value='"+lastRow+"' /><input type='text' name='itemtype"+lastRow+"' class='form-control'>";
            cell2.innerHTML = "<input type='text' name='description"+lastRow+"' class='form-control'>";
            cell3.innerHTML = "<input type='text' name='qty"+lastRow+"' class='form-control'>";
            cell4.innerHTML = "<input type='text' name='unitprice"+lastRow+"' class='form-control'>";
            lastRow++;
            }
            function deleteRows() {
            lastRow--;
            document.getElementById("detailInvoice").deleteRow(0);
            }
    </script>
</body>
</html>
