<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
	if ($get_data_karyawan->verified == 'Y'): 
?>
    <div class="alert alert-info alert-dismissible fade show col-12" role="alert">
        <strong class="text-danger h4"><marquee behavior="alternate" direction="">Mynik sudah di verifikasi oleh HRD</marquee></strong>
    </div>	
<?php 
	endif 
?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-6 col-sm-12 col-12 mt-2 mb-2">
						<div class="row">
							<!-- fungsi field_set() diambil dari helper -->
							<div class="col-md-4 col-sm-4 col-4 text-right font-bold">
								NIK &nbsp;&nbsp; :
							</div>
							<div class="col-md-8 col-sm-8 col-8">
								<input type="hidden" name="txtnik" id="txtnik" value="<?php echo $get_data_karyawan->NIK; ?>" />
								<?php echo field_set($get_data_karyawan->NIK); ?>
							</div>
							<div class="col-md-4 col-sm-4 col-4 text-right font-bold">
								Nama &nbsp;&nbsp; :
							</div>
							<div class="col-md-8 col-sm-8 col-8">
								<?php echo field_set($get_data_karyawan->Nama); ?>
							</div>
							<div class="col-md-4 col-sm-4 col-4 text-right font-bold">
								Department &nbsp;&nbsp; :
							</div>
							<div class="col-md-8 col-sm-8 col-8">
								<?php echo field_set($get_data_karyawan->Dept_Name); ?>
							</div>
							<div class="col-md-4 col-sm-4 col-4 text-right font-bold">
								Section &nbsp;&nbsp; :
							</div>
							<div class="col-md-8 col-sm-8 col-8">
								<?php echo $get_data_karyawan->Sect_Name; ?>
							</div>
							<div class="col-md-4 col-sm-4 col-4 text-right font-bold">
								Jabatan &nbsp;&nbsp; :
							</div>
							<div class="col-md-8 col-sm-8 col-8">
								<?php echo field_set($get_data_karyawan->Jabatan); ?>
							</div>
							<div class="col-md-4 col-sm-4 col-4 text-right font-bold">
								Tanggal Masuk &nbsp;&nbsp; :
							</div>
							<div class="col-md-8 col-sm-8 col-8">
								<?php echo field_set($get_data_karyawan->Tgl_Masuk, 'd', '-', $this->config->item("FORMAT_DATE_LONG_TO_DISPLAY")); ?>
							</div>
							<div class="col-md-4 col-sm-4 col-4 text-right font-bold">
								Masa Kerja &nbsp;&nbsp; :
							</div>
							<div class="col-md-8 col-sm-8 col-8">
								<?php
									if ((is_null($get_data_karyawan->Tgl_Masuk) || ($get_data_karyawan->Tgl_Masuk == '0000-00-00') || ($get_data_karyawan->Tgl_Masuk == '0000-00-00 00:00:00'))) {
										echo '-';
									} else {
										$masa = date('Y-m-d', strtotime($get_data_karyawan->Tgl_Masuk));
										$awal  = date_create($masa);
										$akhir = date_create();
										$diff  = date_diff( $awal, $akhir );
										echo $diff->y . ' Tahun ';
										echo $diff->m . ' Bulan ';
									}
								?>
							</div>
							<div class="col-md-4 col-sm-4 col-4 text-right font-bold">
								Email &nbsp;&nbsp; :
							</div>
							<div class="col-md-8 col-sm-8 col-8">				
								<a href="mailto:<?php echo field_set($get_data_karyawan->EMail); ?>"><?php echo field_set($get_data_karyawan->EMail); ?></a>				
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-sm-12 col-12 text-center">
						<img class="img-thumbnail img-fluid mt-3 mb-2" src="<?php echo image_exists($this->config->item('PATH_ASSET_FOTO_NIK').$get_data_karyawan->NIK.'.jpg'); ?>" style="width:40%">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form-horizontal" id="form_update">
					<input type="hidden" name="nik" id="nik" value="<?php echo field_set($get_data_karyawan->NIK); ?>">					
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="control-label text-right font-weight-bold col-md-2">Status perkawinan &nbsp;&nbsp;:</label>
									<div class="col-md-10">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<input type="radio" id="skawin-1" name="skawin" value="1" required <?php echo ($get_data_karyawan->skawin == '1' ? 'checked' : null); ?>> &nbsp;<label for="skawin-1">Kawin</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<input type="radio" id="skawin-0" name="skawin" value="2" required <?php echo ($get_data_karyawan->skawin == '2' ? 'checked' : null); ?>> &nbsp; <label for="skawin-0">Belum Kawin</label>
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												if ($get_data_karyawan->skawin == 0) {
													echo "-";
												} else if ($get_data_karyawan->skawin == 1) {
													echo "Kawin";
												} else if ($get_data_karyawan->skawin == 2) {
													echo "Belum Kawin";
												} else {
													echo "";
												}
											}
										?>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="control-label text-right font-weight-bold col-md-2">Nomor KTP &nbsp;&nbsp;:</label>
									<div class="col-md-10">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<input type="text" name="nomor-ktp" id="nomor-ktp" class="form-control" placeholder="Isi disini..." required value="<?php echo $get_data_karyawan->No_KTP; ?>">
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo field_set($get_data_karyawan->No_KTP);
											} else {
												echo "-";
											}
										?>												
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="control-label text-right font-weight-bold col-md-2">Nomor NPWP &nbsp;&nbsp;:</label>
									<div class="col-md-10">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<input type="text" name="nomor-npwp" id="nomor-npwp" class="form-control" placeholder="Isi disini..." required value="<?php echo $get_data_karyawan->NPWP; ?>">
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo field_set($get_data_karyawan->NPWP);
											} else {
												echo "-";
											}
										?>												
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="control-label text-right font-weight-bold col-md-2">Status PTKP &nbsp;&nbsp;:</label>
									<div class="col-md-10">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<select name="status-ptkp" id="status-ptkp" class="form-control select2" required>
                            						<option value="">-- Pilih Status PTKP --</option>
                            						<?php foreach ($ptkp as $res): ?>
	                            						<option value="<?php echo $res['SysId']; ?>" <?php echo ($res['SysId'] == $get_data_karyawan->PTKP_SysId ? 'selected' : null); ?>>
	                            							<?php echo $res['Kode_Status'].' - '.$res['Keterangan']; ?>
	                            						</option>
                            						<?php endforeach ?>
                        						</select>
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo $status_ptkp;
											} else {
												echo "-";
											}
										?>												
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="control-label text-right font-weight-bold col-md-2">Alamat sesuai KTP &nbsp;&nbsp;:</label>
									<div class="col-md-10">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<textarea name="alamat-ktp" id="alamat-ktp" rows="2" class="form-control" placeholder="Isi disini ..." required><?php echo field_set($get_data_karyawan->alamat_ktp, 's', ''); ?></textarea>
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo field_set($get_data_karyawan->alamat_ktp);
											} else {
												echo "-";
											}
										?>												
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-2">&nbsp;</div>
							<div class="col-sm-10">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="alamat-ktp-provinsi" class="text-right font-weight-bold col-xs-12">Provinsi :</label>
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<select name="alamat-ktp-provinsi" id="alamat-ktp-provinsi" class="form-control select2" required>
														<option value="">-- Pilih Provinsi --</option>
														<?php foreach ($data_provinsi_ktp_id as $row): ?>
															<option value="<?php echo $row['id']; ?>" <?php echo ($row['name'] == $get_data_karyawan->provinsi_ktp ? 'selected' : null) ?>><?php echo $row['name']; ?></option>
														<?php endforeach ?>
													</select>
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->provinsi_ktp);
												} else {
													echo "-";
												}
											?>													
										</div>
									</div>
									<div class="col-md-3">												
										<div class="form-group">
											<label for="alamat-ktp-kota" class="text-right font-weight-bold">Kota/Kab :</label>
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<select name="alamat-ktp-kota" id="alamat-ktp-kota" class="form-control select2" required <?php echo ($get_data_karyawan->kota_ktp == '' ? 'disabled' : null); ?>>
														<option value="">-- Pilih Kota/Kab --</option>
														<?php foreach ($data_kota_ktp_id as $row): ?>
															<option value="<?php echo $row['id']; ?>" <?php echo ($row['name'] == $get_data_karyawan->kota_ktp ? 'selected' : null); ?>><?php echo $row['name'] ?></option>
														<?php endforeach ?>
													</select>
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->kota_ktp);
												} else {
													echo "-";
												}
											?>													
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="alamat-ktp-kecamatan" class="text-right font-weight-bold">Kecamatan :</label>
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<select name="alamat-ktp-kecamatan" id="alamat-ktp-kecamatan" class="form-control select2" required <?php echo ($get_data_karyawan->kec_ktp == '' ? 'disabled' : null) ?>>
														<option value="">-- Pilih Kecamatan --</option>
														<?php foreach ($data_kec_ktp_id as $row): ?>
															<option value="<?php echo $row['id']; ?>" <?php echo ($row['name'] == $get_data_karyawan->kec_ktp ? 'selected' : null); ?>><?php echo $row['name']; ?></option>
														<?php endforeach ?>
													</select>
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->kec_ktp);
												} else {
													echo "-";
												}
											?>													
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="alamat-ktp-desa" class="text-right font-weight-bold">Kelurahan/Desa :</label>
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<select name="alamat-ktp-desa" id="alamat-ktp-desa" class="form-control select2" required <?php echo ($get_data_karyawan->desa_ktp == '' ? 'disabled' : null); ?>>
														<option value="">-- Pilih Kelurahan/Desa --</option>
														<?php foreach ($data_desa_ktp_id as $row): ?>
															<option value="<?php echo $row['id']; ?>" <?php echo ($row['name'] == $get_data_karyawan->desa_ktp ? 'selected' : null); ?>><?php echo $row['name']; ?></option>
														<?php endforeach ?>
													</select>
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->desa_ktp);
												} else {
													echo "-";
												}
											?>													
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="alamat-ktp-kode-pos" class="text-right font-weight-bold">Kode Pos :</label>
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<input type="number" name="alamat-ktp-kode-pos" id="alamat-ktp-kode-pos" class="form-control" required value="<?php echo field_set($get_data_karyawan->kd_pos_ktp, 's', ''); ?>">
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->kd_pos_ktp);
												} else {
													echo "-";
												}
											?>													
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label for="alamat-domisili" class="col-sm-2 text-right font-weight-bold">Alamat Domisili / Tinggal :</label>
									<div class="col-sm-10">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<textarea name="alamat-domisili" id="alamat-domisili" rows="3" class="form-control" placeholder="Isi disini ..." required><?php echo field_set($get_data_karyawan->alamat_domisili, 's', ''); ?></textarea>
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo field_set($get_data_karyawan->alamat_domisili);
											} else {
												echo "-";
											}
										?>												
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-2">&nbsp;</div>
							<div class="col-sm-10">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="alamat-dom-provinsi" class="text-right font-weight-bold">Provinsi :</label>
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<select name="alamat-dom-provinsi" id="alamat-dom-provinsi" class="form-control select2" required>
														<option value="">-- Pilih Provinsi --</option>
														<?php foreach ($data_provinsi_dom_id as $row): ?>
															<option value="<?php echo $row['id']; ?>" <?php echo ($row['name'] == $get_data_karyawan->provinsi_dom ? 'selected' : null); ?>><?php echo $row['name']; ?></option>
														<?php endforeach ?>
													</select>
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->provinsi_dom);
												} else {
													echo "-";
												}
											?>													
										</div>
									</div>
									<div class="col-md-3">												
										<div class="form-group">
											<label for="alamat-dom-kota" class="text-right font-weight-bold">Kota/Kab :</label>
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<select name="alamat-dom-kota" id="alamat-dom-kota" class="form-control select2" required <?php echo ($get_data_karyawan->kota_dom == '' ? 'disabled' : null); ?>>
														<option value="">-- Pilih Kota/Kab --</option>
														<?php foreach ($data_kota_dom_id as $row): ?>
															<option value="<?php echo $row['id']; ?>" <?php echo ($row['name'] == $get_data_karyawan->kota_dom ? 'selected' : null) ?>><?php echo $row['name']; ?></option>
														<?php endforeach ?>
													</select>
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->kota_dom);
												} else {
													echo "-";
												}
											?>													
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="alamat-dom-kecamatan" class="text-right font-weight-bold">Kecamatan :</label>
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<select name="alamat-dom-kecamatan" id="alamat-dom-kecamatan" class="form-control select2" required <?php echo ($get_data_karyawan->kec_dom == '' ? 'disabled' : null); ?>>
														<option value="">-- Pilih Kecamatan --</option>
														<?php foreach ($data_kec_dom_id as $row): ?>
															<option value="<?php echo $row['id']; ?>" <?php echo ($row['name'] == $get_data_karyawan->kec_dom ? 'selected' : null); ?>><?php echo $row['name']; ?></option>
														<?php endforeach ?>
													</select>
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->kec_dom);
												} else {
													echo "-";
												}
											?>													
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="alamat-dom-desa" class="text-right font-weight-bold">Kelurahan/Desa :</label>
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<select name="alamat-dom-desa" id="alamat-dom-desa" class="form-control select2" required <?php echo ($get_data_karyawan->desa_dom == '' ? 'disabled' : null); ?>>
														<option value="">-- Pilih Kelurahan/Desa --</option>
														<?php foreach ($data_desa_dom_id as $row): ?>
															<option value="<?php echo $row['id']; ?>" <?php echo ($row['name'] == $get_data_karyawan->desa_dom ? 'selected' : null); ?>><?php echo $row['name']; ?></option>
														<?php endforeach ?>
													</select>
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->desa_dom);
												} else {
													echo "-";
												}
											?>													
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="alamat-dom-kode-pos" class="text-right font-weight-bold">Kode Pos :</label>
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<input type="number" name="alamat-dom-kode-pos" id="alamat-dom-kode-pos" class="form-control" required value="<?php echo field_set($get_data_karyawan->kd_pos_dom, 's', ''); ?>">
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->kd_pos_dom);
												} else {
													echo "-";
												}
											?>													
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label for="no-hp" class="col-sm-2 text-right font-weight-bold">Nomor handphone :</label>
									<div class="col-sm-10">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<input type="text" name="no-hp" id="no-hp" class="form-control" placeholder="Isi disini..." required value="<?php echo field_set($get_data_karyawan->no_hp, 's', ''); ?>">
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo field_set($get_data_karyawan->no_hp);
											} else {
												echo "-";
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="table-responsive">
						<table class="table table-striped color-table info-table">
							<thead>
								<tr>
									<th class="text-center align-middle font-weight-bold">Status Hub. Keluarga</th>
									<th class="text-center align-middle font-weight-bold">Nama</th>
									<th class="text-center align-middle font-weight-bold">Jenis Kelamin</th>
									<th class="text-center align-middle font-weight-bold">Tempat / Tgl Lahir</th>
									<th class="text-center align-middle font-weight-bold">Pendidikan Terakhir</th>
								</tr>
							</thead>
							<tbody>
								<!-- Suami -->
								<tr>
									<td align="center" class="align-middle font-weight-bold text-danger">Suami</td>
									<td align="center" class="align-middle">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<input type="text" name="suami_nama" class="form-control" placeholder="Isi disini..." value="<?php echo field_set($get_data_karyawan->status_keluarga_nama, 's', ''); ?>">
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo field_set($get_data_karyawan->status_keluarga_nama);
											} else {
												echo "-";
											}
										?>												
									</td>
									<td align="center" class="align-middle">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<select class="form-control select2" id="status-keluarga-jk" name="status-keluarga-jk">
													<option value="">Pilih</option>
													<option value="1" <?php echo ($get_data_karyawan->status_keluarga_jk == '1' ? 'selected' : null); ?>>Laki - Laki</option>
													<option value="2" <?php echo ($get_data_karyawan->status_keluarga_jk == '2' ? 'selected' : null); ?>>Perempuan</option>
												</select>
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo ($get_data_karyawan->status_keluarga_jk == 1 ? "Laki - Laki" : null).''.($get_data_karyawan->status_keluarga_jk == 2 ? "Perempuan" : null);
											} else {
												echo "-";
											}
										?>												
									</td>
									<td align="center" class="row align-middle">
										<div class="col-sm-6">
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<input type="text" name="status-keluarga-tl" class="form-control" placeholder="Isi disini..." value="<?php echo field_set($get_data_karyawan->status_keluarga_tl, 's', ''); ?>">
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->status_keluarga_tl);
												} else {
													echo "-";
												}
											?>													
										</div>
										<div class="col-sm-6">
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<div class="input-group">
														<input type="text" name="status-keluarga-tgl" id="status-keluarga-tgl" class="form-control date" value="<?php echo field_set($get_data_karyawan->status_keluarga_tgl, 'd', ''); ?>">
														<div class="input-group-append">
															<span class="input-group-text"><i class="icon-calender"></i></span>
														</div>
													</div>													
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {	
													echo field_set($get_data_karyawan->status_keluarga_tgl, 'd', '-');
												} else {
													echo "-";
												}
											?>													
										</div>
									</td>
									<td align="center" class="align-middle">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<select class="form-control select2" id="status-keluarga-pendidikan" name="status-keluarga-pendidikan">
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan == "" ? 'selected' : null) ?> value="">Pilih</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan == "Belum Sekolah" ? 'selected' : null); ?> value="Belum Sekolah">Belum Sekolah</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan == "TK" ? 'selected' : null); ?> value="TK">TK</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan == "SD" ? 'selected' : null); ?> value="SD">SD</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan == "SMP" ? 'selected' : null); ?> value="SMP">SMP</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan == "SMA" ? 'selected' : null); ?> value="SMA">SMA</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan == "D1" ? 'selected' : null); ?> value="D1">D1</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan == "D3" ? 'selected' : null); ?> value="D3">D3</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan == "D4" ? 'selected' : null); ?> value="D4">D4</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan == "S1" ? 'selected' : null); ?> value="S1">S1</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan == "S2" ? 'selected' : null); ?> value="S2">S2</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan == "S3" ? 'selected' : null); ?> value="S3">S3</option>
												</select>
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo field_set($get_data_karyawan->status_keluarga_pendidikan);
											} else {
												echo "-";
											}
										?>																								
									</td>
								</tr>
								<!-- Istri -->
								<tr>
									<td align="center" class="align-middle font-weight-bold text-success"> Istri </td>
									<td align="center" class="align-middle">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<input type="text" name="istri_nama" class="form-control" placeholder="Isi disini..." value="<?php echo field_set($get_data_karyawan->status_keluarga_nama_istri); ?>">
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo field_set($get_data_karyawan->status_keluarga_nama_istri);
											} else {
												echo "-";
											}
										?>												
									</td>
									<td align="center" class="align-middle">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<select class="form-control select2" id="status-keluarga-jk-istri" name="status-keluarga-jk-istri">
													<option value="">Pilih</option>
													<option value="1" <?php echo ($get_data_karyawan->status_keluarga_jk_istri == '1' ? 'selected' : null); ?>>Laki - Laki</option>
													<option value="2" <?php echo ($get_data_karyawan->status_keluarga_jk_istri == '2' ? 'selected' : null); ?>>Perempuan</option>
												</select>
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo ($get_data_karyawan->status_keluarga_jk_istri == 1 ? "Laki - Laki" : null).''.($get_data_karyawan->status_keluarga_jk_istri == 2 ? "Perempuan" : null);
											} else {
												echo "-";
											}
										?>												
									</td>
									<td align="center" class="row align-middle">
										<div class="col-sm-6">
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<input type="text" name="status-keluarga-tl-istri" class="form-control" placeholder="Isi disini..." value="<?php echo field_set($get_data_karyawan->status_keluarga_tl_istri); ?>">
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->status_keluarga_tl_istri);
												} else {
													echo "-";
												}
											?>													
										</div>
										<div class="col-sm-6">
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<div class="input-group">
														<input type="text" name="status-keluarga-tgl-istri" id="status-keluarga-tgl-istri" class="form-control date" value="<?php echo field_set($get_data_karyawan->status_keluarga_tgl_istri, 'd', ''); ?>">
														<div class="input-group-append">
															<span class="input-group-text"><i class="icon-calender"></i></span>
														</div>
													</div>													
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->status_keluarga_tgl_istri, 'd', '-');
												} else {
													echo "-";
												}
											?>													
										</div>
									</td>
									<td align="center" class="align-middle">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<select class="form-control select2" id="status-keluarga-pendidikan-istri" name="status-keluarga-pendidikan-istri">
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan_istri == "" ? 'selected' : null) ?> value="">Pilih</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan_istri == "Belum Sekolah" ? 'selected' : null); ?> value="Belum Sekolah">Belum Sekolah</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan_istri == "TK" ? 'selected' : null); ?> value="TK">TK</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan_istri == "SD" ? 'selected' : null); ?> value="SD">SD</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan_istri == "SMP" ? 'selected' : null); ?> value="SMP">SMP</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan_istri == "SMA" ? 'selected' : null); ?> value="SMA">SMA</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan_istri == "D1" ? 'selected' : null); ?> value="D1">D1</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan_istri == "D3" ? 'selected' : null); ?> value="D3">D3</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan_istri == "D4" ? 'selected' : null); ?> value="D4">D4</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan_istri == "S1" ? 'selected' : null); ?> value="S1">S1</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan_istri == "S2" ? 'selected' : null); ?> value="S2">S2</option>
													<option <?php echo ($get_data_karyawan->status_keluarga_pendidikan_istri == "S3" ? 'selected' : null); ?> value="S3">S3</option>
												</select>
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo field_set($get_data_karyawan->status_keluarga_pendidikan_istri);
											} else {
												echo "-";
											}
										?>												
									</td>
								</tr>
								<?php
									for ($index=1; $index <= 5 ; $index++) { 
										$nmme  = 'keluarga_anak_nama_'.$index;
										$jkme  = 'keluarga_anak_jk_'.$index;
										$tlme  = 'keluarga_anak_tl_'.$index;
										$tglme = 'keluarga_anak_tgl_'.$index;
										$pdnme = 'keluarga_anak_pendidikan_'.$index;
								?>
								<!-- Anak -->
								<tr>
									<td align="center" class="align-middle font-weight-bold text-warning">Anak Ke-<?php echo $index; ?></td>
									<td align="center" class="align-middle">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<input type="text" name="keluarga-anak-nama-<?php echo $index; ?>" class="form-control" placeholder="Isi disini..." value="<?php echo field_set($get_data_karyawan->$nmme, 's'); ?>">
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo field_set($get_data_karyawan->$nmme);
											} else {
												echo "-";
											}
										?>												
									</td>
									<td align="center" class="align-middle">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<select class="form-control select2" id="keluarga-anak-jk-<?php echo $index; ?>" name="keluarga-anak-jk-<?php echo $index; ?>">
													<option value="">Pilih</option>
													<option value="1" <?php echo ($get_data_karyawan->$jkme == '1' ? 'selected' : null); ?>>Laki - Laki</option>
													<option value="2" <?php echo ($get_data_karyawan->$jkme == '2' ? 'selected' : null); ?>>Perempuan</option>
												</select>
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
												echo ($get_data_karyawan->$jkme == 1 ? "Laki - Laki" : ($get_data_karyawan->$jkme == 2 ? "Perempuan" : "-"));
											} else {
												echo "-";
											}
										?>												
									</td>
									<td align="center" class="row align-middle">
										<div class="col-sm-6">
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<input type="text" name="keluarga-anak-tl-<?php echo $index; ?>" class="form-control" placeholder="Isi disini..." value="<?php echo field_set($get_data_karyawan->$tlme, 's'); ?>">
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->$tlme);
												} else {
													echo "-";
												}
											?>													
										</div>
										<div class="col-sm-6">
											<?php 
												if ($get_data_karyawan->verified == 'N') {
											?>
													<div class="input-group">
														<input type="text" name="keluarga-anak-tgl-<?php echo $index; ?>" class="form-control date" value="<?php echo field_set($get_data_karyawan->$tglme, 'd', ''); ?>">
														<div class="input-group-append">
															<span class="input-group-text"><i class="icon-calender"></i></span>
														</div>
													</div>													
											<?php
												} else if ($get_data_karyawan->verified == 'Y') {
													echo field_set($get_data_karyawan->$tglme, 'd', '-');
												} else {
													echo "-";
												}
											?>													
										</div>
									</td>
									<td align="center" class="align-middle">
										<?php 
											if ($get_data_karyawan->verified == 'N') {
										?>
												<select class="form-control select2" id="keluarga-anak-pendidikan-<?php echo $index; ?>" name="keluarga-anak-pendidikan-<?php echo $index; ?>">
													<option <?php echo ($get_data_karyawan->$pdnme == "" ? 'selected' : null); ?> value="">Pilih</option>
													<option <?php echo ($get_data_karyawan->$pdnme == "Belum Sekolah" ? 'selected' : null); ?> value="Belum Sekolah">Belum Sekolah</option>
													<option <?php echo ($get_data_karyawan->$pdnme == "TK" ? 'selected' : null); ?> value="TK">TK</option>
													<option <?php echo ($get_data_karyawan->$pdnme == "SD" ? 'selected' : null); ?> value="SD">SD</option>
													<option <?php echo ($get_data_karyawan->$pdnme == "SMP" ? 'selected' : null); ?> value="SMP">SMP</option>
													<option <?php echo ($get_data_karyawan->$pdnme == "SMA" ? 'selected' : null); ?> value="SMA">SMA</option>
													<option <?php echo ($get_data_karyawan->$pdnme == "D1" ? 'selected' : null); ?> value="D1">D1</option>
													<option <?php echo ($get_data_karyawan->$pdnme == "D3" ? 'selected' : null); ?> value="D3">D3</option>
													<option <?php echo ($get_data_karyawan->$pdnme == "D4" ? 'selected' : null); ?> value="D4">D4</option>
													<option <?php echo ($get_data_karyawan->$pdnme == "S1" ? 'selected' : null); ?> value="S1">S1</option>
													<option <?php echo ($get_data_karyawan->$pdnme == "S2" ? 'selected' : null); ?> value="S2">S2</option>
													<option <?php echo ($get_data_karyawan->$pdnme == "S3" ? 'selected' : null); ?> value="S3">S3</option>
												</select>
										<?php
											} else if ($get_data_karyawan->verified == 'Y') {
										?>
												<?php echo field_set($get_data_karyawan->$pdnme); ?>
										<?php
											} else {
												echo "-";
											}
										?>												
									</td>
								</tr>
								<?php 
									} 
								?>
							</tbody>
						</table>
						
						<div class="form-group">
							<button type="button" class="btn btn-success" name="btn_update" id="btn_update">Simpan Perubahan</button>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form method="POST" id="form_submit">
					<div class="form-body">
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group text-center">
									<label for="img_kk" class="font-weight-bold">Kartu Keluarga (KK)</label>
									<?php
										$img_kk = image_exists($get_data_karyawan->file_kk);
										if ($get_data_karyawan->verified == 'N') { 
									?>
											<input type="file" id="img_kk" name="img_kk" class="dropify" data-height="350" data-default-file="<?php echo $img_kk; ?>" data-max-file-size="2M" />
									<?php 
										} elseif ($get_data_karyawan->verified == 'Y') {
									?>
											<img class="img-thumbnail img-fluid" src="<?php echo $img_kk; ?>" height="100%" width="100%">
									<?php
										}
									?>											
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group text-center">
									<label for="img_ktp" class="font-weight-bold">Kartu Tanda Penduduk (KTP)</label>
									<?php
										$img_ktp = image_exists($get_data_karyawan->file_ktp);
										if ($get_data_karyawan->verified == 'N') { 
									?>
											<input type="file" id="img_ktp" name="img_ktp" class="dropify" data-height="350" data-default-file="<?php echo $img_ktp; ?>" data-max-file-size="2M" />
									<?php 
										} elseif ($get_data_karyawan->verified == 'Y') {
									?>
											<img class="img-thumbnail img-fluid" src="<?php echo $img_ktp; ?>" height="100%" width="100%">
									<?php
										}
									?>
								</div>
							</div>
						</div>
						
						<br />
						
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<div class="form-group text-center">
									<label for="img_npwp" class="font-weight-bold">Nomor Pokok Wajib Pajak (NPWP)</label>
									<?php
										$img_npwp = image_exists($get_data_karyawan->file_npwp);
										if ($get_data_karyawan->verified == 'N') { 
									?>
											<input type="file" id="img_npwp" name="img_npwp" class="dropify" data-height="350" data-default-file="<?php echo $img_npwp; ?>" data-max-file-size="2M" />
									<?php 
										} elseif ($get_data_karyawan->verified == 'Y') {
									?>
											<img class="img-thumbnail img-fluid" src="<?php echo $img_npwp; ?>" height="100%" width="100%">
									<?php
										}
									?>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group text-center">
									<label for="img_ijazah" class="font-weight-bold">Ijazah</label><br>
									<?php
										$img_ijazah = image_exists($get_data_karyawan->file_ijazah);
										if ($get_data_karyawan->verified == 'N') { 
									?>
											<input type="file" id="img_ijazah" name="img_ijazah" class="dropify" data-height="350" data-default-file="<?php echo $img_ijazah; ?>" data-max-file-size="2M" />
									<?php 
										} elseif ($get_data_karyawan->verified == 'Y') {
									?>
											<img class="img-thumbnail img-fluid" src="<?php echo $img_ijazah; ?>" height="100%" width="100%">
									<?php
										}
									?>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<?php
									if ($get_data_karyawan->verified == 'N') { 
								?>
										<button type="button" class="btn btn-primary edit">Simpan Atatachment</button>										
								<?php
									}
								?>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>