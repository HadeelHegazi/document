<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM documents where md5(id) = '{$_GET['id']}' ")->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title')
		$k = 'ftitle';
	$$k = $v;
}
?>
<div class="col-lg-12">
      <?php if(isset($_SESSION['login_id'])): ?>
	<div class="row">
		<div class="col-md-12 mb-2">
			<button class="btn bg-light border float-right" type="button" id="share"><i class="fa fa-share"></i> Share This Document</button>
		</div>
	</div>
    <?php endif; ?>
	<div class="row">
		<div class="col-md-7">
			<div class="card card-outline card-info">
				<div class="card-header">
					<div class="card-tools">
						<small class="text-muted">
							Date Uploaded: <?php echo date("M d, Y",strtotime($date_created)) ?>
						</small>
					</div>
				</div>
				<div class="card-body">
					<div class="callout callout-info">
						<dl>
							<dt>Title</dt>
							<dd><?php echo $ftitle ?></dd>
						</dl>
					</div>
                    <div class="callout callout-info">
                        <dl>
                            <dt>Plaintiff Name</dt>
                            <dd><?php echo htmlspecialchars($plaintiff_name, ENT_QUOTES, 'UTF-8') ?></dd>
                            <dt>Plaintiff Contact</dt>
                            <dd><?php echo htmlspecialchars($plaintiff_contact, ENT_QUOTES, 'UTF-8') ?></dd>
                            <dt>Plaintiff Claim Details</dt>
                            <dd><?php echo nl2br(htmlspecialchars($plaintiff_claim_details, ENT_QUOTES, 'UTF-8')) ?></dd>
                            <dt>Plaintiff Amount</dt>
                            <dd><?php echo number_format($plaintiff_amount, 2) ?></dd>
                        </dl>
                    </div>
                    <div class="callout callout-info">
                        <dl>
                            <dt>Defendant Name</dt>
                            <dd><?php echo htmlspecialchars($defendant_name, ENT_QUOTES, 'UTF-8') ?></dd>
                            <dt>Defendant Contact</dt>
                            <dd><?php echo htmlspecialchars($defendant_contact, ENT_QUOTES, 'UTF-8') ?></dd>
                            <dt>Defendant Claim Details</dt>
                            <dd><?php echo nl2br(htmlspecialchars($defendant_claim_details, ENT_QUOTES, 'UTF-8')) ?></dd>
                            <dt>Defendant Amount</dt>
                            <dd><?php echo number_format($defendant_amount, 2) ?></dd>
                        </dl>
                    </div>
                </div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3><b>File/s</b></h3>
				</div>
				<div class="card-body">
					<div class="col-md-12">
						<div class="alert alert-info px-2 py-1"><i class="fa fa-info-circle"></i> Click the file to download.</div>
						
						<div class="row">
						<?php
						// Helper function to convert Unicode escape sequences to UTF-8 characters
						function decode_unicode_escape_sequences($str) {
							return preg_replace_callback('/u([0-9a-fA-F]{4})/', function ($matches) {
								return mb_convert_encoding(pack('H*', $matches[1]), 'UTF-8', 'UCS-2BE');
							}, $str);
						}

						// Check if the JSON string is set and not empty
						if (isset($file_json) && !empty($file_json)):
							// Decode the JSON data into a PHP array
							$file_array = json_decode($file_json, true);

							// Ensure UTF-8 encoding for each filename
							foreach ($file_array as $filename):
								// Decode any Unicode escape sequences
								$filename = decode_unicode_escape_sequences($filename);

								// Ensure UTF-8 encoding
								if (!mb_check_encoding($filename, 'UTF-8')) {
									$filename = utf8_encode($filename);
								}

								// Check if the file exists in the specified directory
								if (is_file('assets/uploads/' . $filename)):
									// Read file contents if needed
									$_f = file_get_contents('assets/uploads/' . $filename);

									// Use UTF-8 encoding to split the filename for display
									$dname = explode('_', $filename);
						?>
									<!-- Display the file item -->
									<div class="col-sm-3">
										<a href="download.php?f=<?php echo urlencode($filename); ?>" target="_blank" class="text-white border-rounded file-item p-1">
											<span class="img-fluid bg-dark border-rounded px-2 py-2 d-flex justify-content-center align-items-center" style="width: 100px;height: 100px">
												<h3 class="bg-dark"><i class="fa fa-download"></i></h3>
											</span>
											<span class="text-dark"><?php echo htmlspecialchars($dname[1] ?? $filename, ENT_QUOTES, 'UTF-8'); ?></span>
										</a>
									</div>
						<?php 
								endif;
							endforeach;
						endif;
						?>
					</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('.file-item').hover(function(){
		$(this).addClass("active")
	})
	$('file-item').mouseout(function(){
		$(this).removeClass("active")
	})
	$('.file-item').click(function(e){
		e.preventDefault()
		_conf("Are you sure to download this file?","dl",['"'+$(this).attr('href')+'"'])
	})
	function dl($link){
		start_load()
		window.open($link,"_blank")
		end_load()
	}
	$('#share').click(function(){
		uni_modal("<i class='fa fa-share'></i> Share this document using the link.","modal_share_link.php?did=<?php echo md5($id) ?>")
	})
</script>