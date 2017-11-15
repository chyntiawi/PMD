<?= $this->load->view('header')?>
<?php

 if(!IsUserLogin()){ ?>
 	
	<div class='alert alert-warning'>
 		Silahkan <?= anchor('user', 'Login')?> Dulu
	</div>
				
<?php
 }else if(!IsAllowView(MODULPROJECT)){
 ?>		
 	<div class='alert alert-warning'>
 		Tidak diizinkan melihat data
	</div>
<?	
 }else{
		
		
		
	if(!IsAllowDelete(MODULPROJECT)){
?>			
		<style>
			.cekboxaction{
				display:none;
			}
		</style>
<?php		
	}

	
	$data = array();
	$i = 0;
	foreach ($c->result_array() as $d){
		
		$data[$i] = array(
						'<input type="checkbox" class="cekbox" name="cekbox[]" value="'.$d[COL_ROLEID].'" />',
						$d[COL_ROLEID],
						anchor('role/edit/'.$d[COL_ROLEID],$d[COL_ROLENAME]),
						// $d[COL_CREATEDON],
						// $d[COL_CREATEDBY],
						// $d[COL_ISACTIVE]
						
					);
		$i++;
	}
	$data = json_encode($data);
	?>

	<div class="page-wrapper">	
		<div class="row">
			<div class="col-md-12">
				<h1><?= $title ?></h1>
					<?php if(!IsAllowDelete(MODULROLE)){ ?>
						<script>
							$(document).ready(function(){
								$('.cekboxaction').hide();
							});
						</script>
					<?php } ?>					
					
					<p>
						<?=anchor('role/delete','<i class="clip-remove"></i> Hapus',array('class'=>'cekboxaction ui btn btn-danger','confirm'=>'Apa anda yakin?'))?>
						
					</p>
					<?php
						if(IsAllowView(MODULROLE)){
					?>
					<!-- <div class="table-responsive">	 -->
						<form id="dataform" method="post" action="#">
							<table id="databerita" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered" width="100%">
							</table>
						</form>
					<!-- </div> -->
					<?php }else{ ?>
						<div class="error">Tidak diizinkan melihat data</div>
					<?php } ?>
					<div class="clear"></div>

				</div>
			</div>
		</div>


<script type="text/javascript">
$(document).ready(function(){
	var pelangganTable = $('#databerita').dataTable({
        "aaData": <?=$data?>,
        // "bJQueryUI": true,
        "aaSorting" : [[1,'desc']],
    	// "sPaginationType": "full_numbers",
    	"scrollY" : 400,
    	"scrollX" : "150%",
    	"iDisplayLength": 100,
		"aLengthMenu": [[100, 1000, 5000, -1], [100, 1000, 5000, "Semua"]],
        "aoColumns": [
        	{"sTitle": "<input type=\"checkbox\" id=\"cekbox\" class=\"cekbox\" />","sWidth":15,bSortable:false},
        	{"sTitle": "ID Role"},
            {"sTitle": "Nama Role"},
            // {"sTitle": "Dibuat Tanggal"},
            // {"sTitle": "Dibuat Oleh"},
            // {"sTitle": "Status"}
        ],
        "dom":"R<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
	    "buttons": ['copyHtml5','excelHtml5','csvHtml5','pdfHtml5','print']
    });
    $("input[aria-controls=databerita]").unbind().bind('keyup',function(e){
	    if (e.keyCode == 13) {
	        pelangganTable.fnFilter(this.value);
	    }
	});
	$('#dataform').find('input').keydown(function(e){
		if(e.which == 13){
			return false;
		}
	});


});


</script>
<?php } ?>
<?= $this->load->view('footer')?>