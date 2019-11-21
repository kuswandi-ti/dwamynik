<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">				
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#absensi" role="tab"><span class="hidden-sm-up"><i class="fas fa-history"></i></span> <span class="hidden-xs-down">Data Absensi</span></a> </li>
					<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#surat_peringatan" role="tab"><span class="hidden-sm-up"><i class="fas fa-bullhorn"></i></span> <span class="hidden-xs-down">Surat Peringatan</span></a> </li>
				</ul>
				
				<div class="tab-content tabcontent-border">
					<!-- Absensi -->
					<div class="tab-pane active" id="absensi" role="tabpanel">						
						<div class="p-20">
							<div class="row">
								<div class="col-md-4 col-sm-6">
									<h6 class="card-subtitle">Pilih tahun untuk melihat <strong><span class="text-danger">Data Absensi</span></strong></h6>
									<form action="attendance/proses_absen" method="POST">
										<div class="input-group">
											<select id="thn" name="thn" class="form-control select2">
												<?php for ($i = 2014; $i <= (date('Y') + 6); $i++) { ?>
													<option <?php echo ($tahun == $i ? 'selected' : '') ?> value="<?php echo $i ?>"><?php echo $i ?></option>
												<?php } ?>
											</select>
											<div class="input-group-append">
												<button type="submit" id="btn_absensi" name="btn_absensi" class="btn btn-primary btn-sm" onclick="$('#absensi_info').text('Please Wait, Loading Data ...');"><i class="fa fa-eye"></i> &nbsp; Tampilkan</button>
											</div>
											<h3 id="absensi_info" class="text-danger"></h3>
										</div>
									</form>
								</div>								
							</div>
							<div>&nbsp;</div>
							<?php if ( $this->uri->segment(3) != null ): ?>
								<div class="row">
									<div class="col-12">
										<div class="table-responsive">
											<table class="table table-striped color-table info-table" style="cursor: pointer;">
												<thead>
													<tr>
														<th class="text-center align-middle font-weight-bold" width="5%">NO</th>
														<th class="text-center align-middle font-weight-bold" width="40%">BULAN</th>
														<th class="text-center align-middle font-weight-bold" width="10%">T</th>
														<th class="text-center align-middle font-weight-bold" width="10%">I</th>
														<th class="text-center align-middle font-weight-bold" width="10%">A</th>
														<th class="text-center align-middle font-weight-bold" width="10%">SKD</th>
														<th class="text-center align-middle font-weight-bold" width="10%">S</th>
														<th class="text-center align-middle font-weight-bold" width="5%">DETAIL</th>
													</tr>
												</thead>
												<tbody>
													<tr data-toggle="modal" data-target="#modal_dtl_1">
														<td align="center" class="align-middle">1</td>
														<td align="center" class="align-middle">JANUARI</td>
														<td align="center" class="align-middle">
															<h4 class="text-warning font-weight-bold"><?php echo $TOTAL_TERLAMBAT_1; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-info font-weight-bold"><?php echo $TOTAL_IJIN_1; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-danger font-weight-bold"><?php echo $TOTAL_ALPA_1; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-primary font-weight-bold"><?php echo $TOTAL_SKD_1; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-success font-weight-bold"><?php echo $TOTAL_SAKIT_1; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<button type="button" class="btn waves-effect waves-light btn-xs btn-secondary">Show Detail <i class="fas fa-angle-double-right"></i> </button>
														</td>
													</tr>
													<tr data-toggle="modal" data-target="#modal_dtl_2">
														<td align="center" class="align-middle">2</td>
														<td align="center" class="align-middle">FEBRUARI</td>
														<td align="center" class="align-middle">
															<h4 class="text-warning font-weight-bold"><?php echo $TOTAL_TERLAMBAT_2; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-info font-weight-bold"><?php echo $TOTAL_IJIN_2; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-danger font-weight-bold"><?php echo $TOTAL_ALPA_2; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-primary font-weight-bold"><?php echo $TOTAL_SKD_2; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-success font-weight-bold"><?php echo $TOTAL_SAKIT_2; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<button type="button" class="btn waves-effect waves-light btn-xs btn-secondary">Show Detail <i class="fas fa-angle-double-right"></i> </button>
														</td>
													</tr>
													<tr data-toggle="modal" data-target="#modal_dtl_3">
														<td align="center" class="align-middle">3</td>
														<td align="center" class="align-middle">MARET</td>
														<td align="center" class="align-middle">
															<h4 class="text-warning font-weight-bold"><?php echo $TOTAL_TERLAMBAT_3; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-info font-weight-bold"><?php echo $TOTAL_IJIN_3; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-danger font-weight-bold"><?php echo $TOTAL_ALPA_3; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-primary font-weight-bold"><?php echo $TOTAL_SKD_3; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-success font-weight-bold"><?php echo $TOTAL_SAKIT_3; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<button type="button" class="btn waves-effect waves-light btn-xs btn-secondary">Show Detail <i class="fas fa-angle-double-right"></i> </button>
														</td>
													</tr>
													<tr data-toggle="modal" data-target="#modal_dtl_4">
														<td align="center" class="align-middle">4</td>
														<td align="center" class="align-middle">APRIL</td>
														<td align="center" class="align-middle">
															<h4 class="text-warning font-weight-bold"><?php echo $TOTAL_TERLAMBAT_4; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-info font-weight-bold"><?php echo $TOTAL_IJIN_4; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-danger font-weight-bold"><?php echo $TOTAL_ALPA_4; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-primary font-weight-bold"><?php echo $TOTAL_SKD_4; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-success font-weight-bold"><?php echo $TOTAL_SAKIT_4; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<button type="button" class="btn waves-effect waves-light btn-xs btn-secondary">Show Detail <i class="fas fa-angle-double-right"></i> </button>
														</td>
													</tr>
													<tr data-toggle="modal" data-target="#modal_dtl_5">
														<td align="center" class="align-middle">5</td>
														<td align="center" class="align-middle">MEI</td>
														<td align="center" class="align-middle">
															<h4 class="text-warning font-weight-bold"><?php echo $TOTAL_TERLAMBAT_5; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-info font-weight-bold"><?php echo $TOTAL_IJIN_5; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-danger font-weight-bold"><?php echo $TOTAL_ALPA_5; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-primary font-weight-bold"><?php echo $TOTAL_SKD_5; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-success font-weight-bold"><?php echo $TOTAL_SAKIT_5; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<button type="button" class="btn waves-effect waves-light btn-xs btn-secondary">Show Detail <i class="fas fa-angle-double-right"></i> </button>
														</td>
													</tr>
													<tr data-toggle="modal" data-target="#modal_dtl_6">
														<td align="center" class="align-middle">6</td>
														<td align="center" class="align-middle">JUNI</td>
														<td align="center" class="align-middle">
															<h4 class="text-warning font-weight-bold"><?php echo $TOTAL_TERLAMBAT_6; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-info font-weight-bold"><?php echo $TOTAL_IJIN_6; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-danger font-weight-bold"><?php echo $TOTAL_ALPA_6; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-primary font-weight-bold"><?php echo $TOTAL_SKD_6; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-success font-weight-bold"><?php echo $TOTAL_SAKIT_6; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<button type="button" class="btn waves-effect waves-light btn-xs btn-secondary">Show Detail <i class="fas fa-angle-double-right"></i> </button>
														</td>
													</tr>
													<tr data-toggle="modal" data-target="#modal_dtl_7">
														<td align="center" class="align-middle">7</td>
														<td align="center" class="align-middle">JULI</td>
														<td align="center" class="align-middle">
															<h4 class="text-warning font-weight-bold"><?php echo $TOTAL_TERLAMBAT_7; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-info font-weight-bold"><?php echo $TOTAL_IJIN_7; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-danger font-weight-bold"><?php echo $TOTAL_ALPA_7; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-primary font-weight-bold"><?php echo $TOTAL_SKD_7; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-success font-weight-bold"><?php echo $TOTAL_SAKIT_7; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<button type="button" class="btn waves-effect waves-light btn-xs btn-secondary">Show Detail <i class="fas fa-angle-double-right"></i> </button>
														</td>
													</tr>
													<tr data-toggle="modal" data-target="#modal_dtl_8">
														<td align="center" class="align-middle">8</td>
														<td align="center" class="align-middle">AGUSTUS</td>
														<td align="center" class="align-middle">
															<h4 class="text-warning font-weight-bold"><?php echo $TOTAL_TERLAMBAT_8; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-info font-weight-bold"><?php echo $TOTAL_IJIN_8; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-danger font-weight-bold"><?php echo $TOTAL_ALPA_8; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-primary font-weight-bold"><?php echo $TOTAL_SKD_8; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-success font-weight-bold"><?php echo $TOTAL_SAKIT_8; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<button type="button" class="btn waves-effect waves-light btn-xs btn-secondary">Show Detail <i class="fas fa-angle-double-right"></i> </button>
														</td>
													</tr>
													<tr data-toggle="modal" data-target="#modal_dtl_9">
														<td align="center" class="align-middle">9</td>
														<td align="center" class="align-middle">SEPTEMBER</td>
														<td align="center" class="align-middle">
															<h4 class="text-warning font-weight-bold"><?php echo $TOTAL_TERLAMBAT_9; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-info font-weight-bold"><?php echo $TOTAL_IJIN_9; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-danger font-weight-bold"><?php echo $TOTAL_ALPA_9; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-primary font-weight-bold"><?php echo $TOTAL_SKD_9; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-success font-weight-bold"><?php echo $TOTAL_SAKIT_9; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<button type="button" class="btn waves-effect waves-light btn-xs btn-secondary">Show Detail <i class="fas fa-angle-double-right"></i> </button>
														</td>
													</tr>
													<tr data-toggle="modal" data-target="#modal_dtl_10">
														<td align="center" class="align-middle">10</td>
														<td align="center" class="align-middle">OKTOBER</td>
														<td align="center" class="align-middle">
															<h4 class="text-warning font-weight-bold"><?php echo $TOTAL_TERLAMBAT_10; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-info font-weight-bold"><?php echo $TOTAL_IJIN_10; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-danger font-weight-bold"><?php echo $TOTAL_ALPA_10; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-primary font-weight-bold"><?php echo $TOTAL_SKD_10; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-success font-weight-bold"><?php echo $TOTAL_SAKIT_10; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<button type="button" class="btn waves-effect waves-light btn-xs btn-secondary">Show Detail <i class="fas fa-angle-double-right"></i> </button>
														</td>
													</tr>
													<tr data-toggle="modal" data-target="#modal_dtl_11">
														<td align="center" class="align-middle">11</td>
														<td align="center" class="align-middle">NOVEMBER</td>
														<td align="center" class="align-middle">
															<h4 class="text-warning font-weight-bold"><?php echo $TOTAL_TERLAMBAT_11; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-info font-weight-bold"><?php echo $TOTAL_IJIN_11; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-danger font-weight-bold"><?php echo $TOTAL_ALPA_11; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-primary font-weight-bold"><?php echo $TOTAL_SKD_11; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-success font-weight-bold"><?php echo $TOTAL_SAKIT_11; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<button type="button" class="btn waves-effect waves-light btn-xs btn-secondary">Show Detail <i class="fas fa-angle-double-right"></i> </button>
														</td>
													</tr>
													<tr data-toggle="modal" data-target="#modal_dtl_12">
														<td align="center" class="align-middle">12</td>
														<td align="center" class="align-middle">DESEMBER</td>
														<td align="center" class="align-middle">
															<h4 class="text-warning font-weight-bold"><?php echo $TOTAL_TERLAMBAT_12; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-info font-weight-bold"><?php echo $TOTAL_IJIN_12; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-danger font-weight-bold"><?php echo $TOTAL_ALPA_12; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-primary font-weight-bold"><?php echo $TOTAL_SKD_12; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<h4 class="text-success font-weight-bold"><?php echo $TOTAL_SAKIT_12; ?></h4>
														</td>
														<td align="center" class="align-middle">
															<button type="button" class="btn waves-effect waves-light btn-xs btn-secondary">Show Detail <i class="fas fa-angle-double-right"></i></button>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<?php echo $MODAL_ABSEN_1; ?>
								<?php echo $MODAL_ABSEN_2; ?>
								<?php echo $MODAL_ABSEN_3; ?>
								<?php echo $MODAL_ABSEN_4; ?>
								<?php echo $MODAL_ABSEN_5; ?>
								<?php echo $MODAL_ABSEN_6; ?>
								<?php echo $MODAL_ABSEN_7; ?>
								<?php echo $MODAL_ABSEN_8; ?>
								<?php echo $MODAL_ABSEN_9; ?>
								<?php echo $MODAL_ABSEN_10; ?>
								<?php echo $MODAL_ABSEN_11; ?>
								<?php echo $MODAL_ABSEN_12; ?>
							<?php endif ?>
						</div>
					</div>					

					<!-- Surat Peringatan -->
					<div class="tab-pane p-20" id="surat_peringatan" role="tabpanel">
						<div class="table-responsive">
						    <table class="table table-striped color-table info-table">
						        <thead>
						            <tr>
						                <th class="text-center align-middle" width="1%"><i class="ti-zoom-in"></i></th>
			                            <th class="text-center align-middle" width="25%">No SP</th>
			                            <th class="text-center align-middle" width="20%">Tgl SP</th>  
			                            <th class="text-center align-middle" width="15%">Surat Tindakan</th>  
			                            <th class="text-center align-middle">Masa Berlaku Tindakan</th>
						            </tr>
						        </thead>
						        <tbody>
						            <?php
						            	$no = 0 ;
						            	if (count($get_data_sp) > 0) {
						            		foreach ($get_data_sp as $row) {
						            ?>
							            		<tr style="cursor: pointer;" id="show_detail_peringatan" data-id="<?php echo $row['id']; ?>" data-no="<?php echo $row['no_ba']; ?>">
													<td class="text-center align-middle"><i class="fas fa-angle-down"></i></td>
													<td class="text-center align-middle"><?php echo $row['no_ba']; ?></td>
													<td class="text-center align-middle">
														<?php echo date($this->config->item('FORMAT_DATE_TO_DISPLAY'), strtotime( $row['tgl_ba'] )); ?>	
													</td>
													<td class="text-center align-middle"><?php echo $row['desc_surat_recomend']; ?></td>
													<td class="text-center align-middle">
														<?php echo ($row['tgl_mb_awal'] == '0000-00-00' ? '0000-00-00' : date($this->config->item('FORMAT_DATE_TO_DISPLAY'), strtotime($row['tgl_mb_awal']))) . ' - ' . ($row['tgl_mb_akhir'] == '0000-00-00' ? '0000-00-00' : date($this->config->item('FORMAT_DATE_TO_DISPLAY'), strtotime($row['tgl_mb_akhir']))) . ' ( <span class="label label-danger">' . $row['masa_berlaku'] . '</span> )'; ?>
													</td>
												</tr>
						            <?php
						        			}
						            	}
						            ?>
						        </tbody>
						    </table>
						</div>

						<div class="modal" id="modal_detail_peringatan" tabindex="-1" role="dialog">
							<div class="modal-dialog modal-lg" role="document" style="max-width:80%!important;">
								<div class="modal-content">
									<div class="modal-header">';
										<h5 class="modal-title">Detail Surat Peringatan (SP)</h5>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12 col-xs-12 b-r">
												<h4 id="caption_detail_peringatan" class="text-center"></h4>
												<div class="table-responsive">
												    <div id="data_detail_peringatan"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>