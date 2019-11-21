<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-sm-3 col-md-2 col-xs-2">
		<div class="card border border-info">
			<a href="biodata">
				<img class="card-img-top" src="<?php echo $this->config->item('PATH_ASSET_IMAGE'); ?>card/biodata.png" alt="Card image cap">
				<div class="card-body bg-info">
					<h4 class="card-title text-center text-white"><a>BIODATA</a></h4>
				</div>
			</a>
		</div>
	</div>
	<div class="col-sm-3 col-md-2 col-xs-2">
		<div class="card border border-info">
			<a href="attendance">
				<img class="card-img-top" src="<?php echo $this->config->item('PATH_ASSET_IMAGE'); ?>card/attendance.png" alt="Card image cap">
				<div class="card-body bg-info">
					<h4 class="card-title text-center text-white"><a>ATTENDANCE</a></h4>
				</div>
			</a>
		</div>
	</div>		
	<div class="col-sm-3 col-md-2 col-xs-2">
		<div class="card border border-info">
			<img class="card-img-top" src="<?php echo $this->config->item('PATH_ASSET_IMAGE'); ?>card/eslip.png" alt="Card image cap">
			<div class="card-body bg-info">
				<h4 class="card-title text-center text-white"><a>E-SLIP</a></h4>
			</div>
		</div>
	</div>		
	<div class="col-sm-3 col-md-2 col-xs-2">
		<div class="card border border-info">
			<img class="card-img-top" src="<?php echo $this->config->item('PATH_ASSET_IMAGE'); ?>card/calender.png" alt="Card image cap">
			<div class="card-body bg-info">
				<h4 class="card-title text-center text-white"><a>CALENDER</a></h4>
			</div>
		</div>
	</div>		
	<div class="col-sm-3 col-md-2 col-xs-2">
		<div class="card border border-info">
			<img class="card-img-top" src="<?php echo $this->config->item('PATH_ASSET_IMAGE'); ?>card/ecuti.png" alt="Card image cap">
			<div class="card-body bg-info">
				<h4 class="card-title text-center text-white"><a>E-CUTI</a></h4>
			</div>
		</div>
	</div>		
	<div class="col-sm-3 col-md-2 col-xs-2">
		<div class="card border border-info">
			<img class="card-img-top" src="<?php echo $this->config->item('PATH_ASSET_IMAGE'); ?>card/epkb.png" alt="Card image cap">
			<div class="card-body bg-info">
				<h4 class="card-title text-center text-white"><a>E-PKB</a></h4>
			</div>
		</div>
	</div>
	
	<div class="col-sm-3 col-md-2 col-xs-2">
		<div class="card border border-info">
			<img class="card-img-top" src="<?php echo $this->config->item('PATH_ASSET_IMAGE'); ?>card/mybpjs.png" alt="Card image cap">
			<div class="card-body bg-info">
				<h4 class="card-title text-center text-white"><a>MY BPJS</a></h4>
			</div>
		</div>
	</div>		
	<div class="col-sm-3 col-md-2 col-xs-2">
		<div class="card border border-info">
			<img class="card-img-top" src="<?php echo $this->config->item('PATH_ASSET_IMAGE'); ?>card/mycareer.png" alt="Card image cap">
			<div class="card-body bg-info">
				<h4 class="card-title text-center text-white"><a>MY CAREER</a></h4>
			</div>
		</div>
	</div>
</div>

<?php
	$kelompok_shift = '';
	$jam_kerja_in = '';
	$jam_kerja_out = '';
	if (!empty($get_shift)) {
		foreach ($get_shift as $row) {
			$kelompok_shift = $row['Kelompok_Shift'];
			$jam_kerja_in = $row['jam_kerja_in'];
			$jam_kerja_out = $row['jam_kerja_out'];
		}
	}

	$sect_alias = '';
	$sect_name = '';
	$subsect_alias = '';
	$subsect_name = '';
	if (!empty($get_section)) {
		foreach ($get_section as $row) {
			$sect_alias = $row['Sect_Alias'];
			$sect_name = $row['Sect_Name'];
			$subsect_alias = $row['SubSect_Alias'];
			$subsect_name = $row['SubSect_Name'];
		}
	}
?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-10">
						<h3 class="font-weight-bold text-danger"><u>TODAY</u></h3>
						<div class="input-group">
							<h4 class="font-weight-bold text-success">SHIFT :</h4>&nbsp;<h4 class="font-weight-bold text-warning"><?php echo $kelompok_shift; ?></h4>
						</div>
						<div class="input-group">
							<h4 class="font-weight-bold text-success">SECTION :</h4>&nbsp;<h4 class="font-weight-bold text-warning"><?php echo $sect_alias.' - '.$sect_name; ?></h4>
						</div>
						<div class="input-group">
							<h4 class="font-weight-bold text-success">LINE :</h4>&nbsp;<h4 class="font-weight-bold text-warning"><?php echo $subsect_alias.' - '.$subsect_name; ?></h4>
						</div>
					</div>
					<div class="col-md-2">
						<img class="card-img-top" src="<?php echo $this->config->item('PATH_ASSET_IMAGE'); ?>card/calender.png" alt="Card image cap">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12 col-md-6 col-lg-6">
		<div class="card card-primary">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<h5 class="font-weight-bold text-white"><u>Clock In</u></h5>
						<div class="input-group">
							<h5 class="font-weight-bold text-warning"><?php echo $jam_kerja_in; ?></h5>
						</div>
						<div class="input-group">
							<h5 class="font-weight-bold text-warning">Masuk Bekerja</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-sm-12 col-md-6 col-lg-6">
		<div class="card card-danger">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<h5 class="font-weight-bold text-white"><u>Clock Out</u></h5>
						<div class="input-group">
							<h5 class="font-weight-bold text-warning"><?php echo $jam_kerja_out; ?></h5>
						</div>
						<div class="input-group">
							<h5 class="font-weight-bold text-warning">Pulang Bekerja</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-body bg-info">
		<h4 class="text-white card-title">Monthly Summary <?php echo set_to_nama_bulan_indonesia(date('m')). ' ' .date('Y'); ?></h4>
		<h6 class="card-subtitle text-white">Monthly Attendance Summary</h6>
	</div>
    <div class="card-body">
		<div class="message-box contact-box">
			<div class="message-widget contact-widget">
				<a>
					<div class="user-img">
						<span class="round bg-warning"><?php echo $get_total_data_terlambat; ?></span>
					</div>
                    <div class="mail-contnet">
						<h5>COD001</h5> 
						<span>Datang Terlambat ( T )</span>
					</div>
                </a>	
                <a>
					<div class="user-img">
						<span class="round bg-primary"><?php echo $get_total_data_ijin; ?></span>
					</div>
                    <div class="mail-contnet">
						<h5>COD004</h5> 
						<span>Izin ( I )</span>
					</div>
                </a>			
				<a>
					<div class="user-img">
						<span class="round bg-danger"><?php echo $get_total_data_alpa; ?></span>
					</div>
                    <div class="mail-contnet">
						<h5>COD003</h5> 
						<span>Alpha ( A )</span>
					</div>
                </a>				
				<a>
					<div class="user-img">
						<span class="round bg-success"><?php echo $get_total_data_sakit; ?></span>
					</div>
                    <div class="mail-contnet">
						<h5>COD005</h5> 
						<span>Sakit ( S )</span>
					</div>
                </a>
                <a>
					<div class="user-img">
						<span class="round bg-info"><?php echo $get_total_data_skd; ?></span>
					</div>
                    <div class="mail-contnet">
						<h5>COD002</h5> 
						<span>Sakit Keterangan Dokter ( SKD )</span>
					</div>
                </a>
			</div>
		</div>
	</div>
</div>