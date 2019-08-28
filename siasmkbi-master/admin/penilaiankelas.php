<?php
	session_start();
	include('../config.php');
	$kode=$_GET['kk'];
	$smt=$_GET['smt'];

	if($_SESSION['status']!="administrator"){
		header("location:../loginadm.php");
	}

	$user=$_SESSION['user'];
	$query="select nama_admin from administrator where user='$user'";
	$result=mysqli_query($koneksi,$query) or die(mysqli_error());
	while($data=mysqli_fetch_array($result)){
		$nama=$data['nama_admin'];
	}

	$queryta="select tahun_ajar from kelas order by kode_kelas desc limit 1";
	$ta=mysqli_query($koneksi,$queryta);
	$data=mysqli_fetch_array($ta);
	$tampilta=$data['tahun_ajar'];

	$query2="select * from kelas where kelas.tahun_ajar='$tampilta' order by kelas.kelas";
	$result2=mysqli_query($koneksi,$query2);

	$query3="select * from kelas where kode_kelas='$kode'";
	$result3=mysqli_query($koneksi,$query3);
	$data3=mysqli_fetch_array($result3);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>SIASMKBI - Administrator</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!--basic styles-->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
		<link rel="shortcut icon" href="../assets/images/logobi-10.png" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="../assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->
		<link rel="stylesheet" href="../assets/css/ace-fonts.css" />

		<!--ace styles-->
		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	</head>
	<body>
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<img src="../assets/images/logobi-25.png" width="15%">SIA SMK BI
						</small>
					</a><!--/.brand-->
					<ul class="nav ace-nav pull-right">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="user-info">
									<small>Selamat Datang,</small>
									<?php 
										echo $nama; 
									?>
								</span>
								<i class="icon-caret-down"></i>
							</a>
							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="../logoutadm.php"  title="keluar dari akun ini" class="logout">
										<i class="icon-off"></i>Logout
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>
		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>
			<div class="sidebar" id="sidebar">
				<ul class="nav nav-list">
					<li>
						<a href="admin.php">
							<i class="icon-home"></i>
							<span class="menu-text"> Beranda </span>
						</a>
					</li>
					<li>
						<a href="#" class="dropdown-toggle">
							<i class="icon-folder-close "></i>
							<span class="menu-text"> Data Sekolah </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
							<li>
								<a href="admin-kelas.php">
									<i class="icon-double-angle-right"></i>Kelas
								</a>
							</li>
							<li>
								<a href="admin-guru.php">
									<i class="icon-double-angle-right"></i>Guru
								</a>
							</li>
							<li>
								<a href="admin-pel.php">
									<i class="icon-double-angle-right"></i>Pelajaran
								</a>
							</li>
							<li>
								<a href="admin-wk.php">
									<i class="icon-double-angle-right"></i>Wali Kelas
								</a>
							</li>
							<li>
								<a href="admin-siswa.php">
									<i class="icon-double-angle-right"></i>Siswa
								</a>
							</li>
							<li>
								<a href="admin-ekskul.php">
									<i class="icon-double-angle-right"></i>Ekskul
								</a>
							</li>
						</ul>
					</li>
					<li class="active open">
						<a href="#" class="dropdown-toggle">
							<i class="icon-book "></i>
							<span class="menu-text"> Data Penilaian </span>
							<b class="arrow icon-angle-down"></b>
						</a>
						<ul class="submenu">
						<?php
							while ($datakls=mysqli_fetch_array($result2)) {
								if ($kode==$datakls['kode_kelas']) {
									echo '<li class="active open">
										<a href="#" class="dropdown-toggle">
											<i class="icon-double-angle-right"></i>';
									echo $datakls['kelas']." <br>".$datakls['peminatan'];
									echo '<b class="arrow icon-angle-down"></b></a>
										<ul class="submenu">';
									if ($smt==01) {
										echo '<li class="active">
											<a href="penilaiankelas.php?kk='.$datakls['kode_kelas'].'&&smt=01">
												<i class="icon-adjust"></i>
												Semester Ganjil
											</a>
										</li>
										<li>
											<a href="penilaiankelas.php?kk='.$datakls['kode_kelas'].'&&smt=11">
												<i class="icon-circle"></i>
												Semester Genap
											</a>
										</li>';
									}else{
										echo '<li>
											<a href="penilaiankelas.php?kk='.$datakls['kode_kelas'].'&&smt=01">
												<i class="icon-adjust"></i>
												Semester Ganjil
											</a>
										</li>
										<li class="active">
											<a href="penilaiankelas.php?kk='.$datakls['kode_kelas'].'&&smt=11">
												<i class="icon-circle"></i>
												Semester Genap
											</a>
										</li>';
									}
									echo '</ul>
										</li>';
								}else{
									echo '<li>
										<a href="#" class="dropdown-toggle">
											<i class="icon-double-angle-right"></i>';
									echo $datakls['kelas']." <br>".$datakls['peminatan'];
									echo '<b class="arrow icon-angle-down"></b></a>
										<ul class="submenu">';
									echo '<li>
											<a href="penilaiankelas.php?kk='.$datakls['kode_kelas'].'&&smt=01">
												<i class="icon-adjust"></i>
												Semester Ganjil
											</a>
										</li>
										<li>
											<a href="penilaiankelas.php?kk='.$datakls['kode_kelas'].'&&smt=11">
												<i class="icon-circle"></i>
												Semester Genap
											</a>
										</li>
									</ul>
								</li>';
								}
							}
						?>
						</ul>
					</li>
				</ul>
				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>
			<div class="main-content">
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
							<div class="table-header">
					      	<?php
								echo "<b>Tahun Ajaran :</b> $tampilta | ";
								echo "<b>Kelas :</b> ".$data3['kelas']." ".$data3['peminatan']." | ";
								if ($smt==01) {
									$kodesmt="Ganjil";
								}else{
									$kodesmt="Genap";
								}
								echo "<b>Semester : </b>".$kodesmt;
						    ?>
						    </div>
							<table id="tabel1" class="table table-striped table-bordered table-hover ">
								<thead>
									<tr>
										<th>NIS</th>
										<th>NISN</th>
										<th>Nama</th>
										<th>JK</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
									<!--tabel-->
									<?php
									    include '../config.php';
									    $querytbl="select * from siswa, kelas_siswa where siswa.kode_siswa=kelas_siswa.kode_siswa and kelas_siswa.kode_kelas='$kode'";
								    	$resulttbl=mysqli_query($koneksi,$querytbl);

								    	while ($datatbl=mysqli_fetch_array($resulttbl)) {
								    		echo "<td>".$datatbl['nis']."</td>
								    		<td>".$datatbl['nisn']."</td>
								    		<td>".$datatbl['nama_siswa']."</td>
								    		<td>".$datatbl['jk']."</td>";
											echo '<td class="td-actions">
												<div class="hidden-phone visible-desktop action-buttons">
													<a class="green" href="detailnilaia.php?ks='.$datatbl["kode_siswa"].'&&smt='.$smt.'" >
														<i class="icon-pencil bigger-130"> </i> akademik
													</a>
													<a class="green" href="detailnilaib.php?ks='.$datatbl["kode_siswa"].'&&smt='.$smt.'">
														<i class="icon-group bigger-130"> </i> lainnya
													</a>
												</div>
												<div class="hidden-desktop visible-phone">
													<div class="inline position-relative">
														<button class="btn btn-minier btn-green dropdown-toggle" data-toggle="dropdown">
															<i class="icon-caret-down icon-only bigger-120"></i>
														</button>
														<ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
															<li>
																<a href="detailnilaia.php?ks='.$datatbl["kode_siswa"].'&&smt='.$smt.'" class="tooltip-success" data-rel="tooltip" title="akademik">
																	<span class="green">
																		<i class="icon-edit bigger-120"></i>
																	</span>
																</a>
															</li>
															<li>
																<a href="detailnilaib.php?ks='.$datatbl["kode_siswa"].'&&smt='.$smt.'" class="tooltip-success" data-rel="tooltip" title="lainnya">
																	<span class="green">
																		<i class="icon-group bigger-120"></i>
																	</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
											</td>
										</tr>';
										}
									?>
									</tbody>
								</table>
							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					
						<div class="ace-settings-container" id="ace-settings-container">
							<div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="icon-cog bigger-150"></i>
							</div>
							<div class="ace-settings-box" id="ace-settings-box">
								<div>
									<div class="pull-left">
										<select id="skin-colorpicker" class="hide">
											<option data-class="default" value="#438EB9">#438EB9</option>
											<option data-class="skin-1" value="#222A2D">#222A2D</option>
											<option data-class="skin-2" value="#C6487E">#C6487E</option>
											<option data-class="skin-3" value="#D0D0D0">#D0D0D0</option>
										</select>
									</div>
									<span>&nbsp; Choose Skin</span>
								</div>
								<div>
									<input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
									<label class="lbl" for="ace-settings-header"> Fixed Header</label>
								</div>
								<div>
									<input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
									<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
								</div>
								<div>
									<input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
									<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
								</div>
								<div>
									<input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
									<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
								</div>
							</div>
						</div><!--/#ace-settings-container-->
					</div><!--/.main-content-->
				</div><!--/.main-container-->
			<div>
		<div>
		
		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<script type="text/javascript">
				$('.logout').on('click', function(){
				return confirm('Anda Yakin?');
			});
		</script>
		<script type="text/javascript">
			$(function() {
				var oTable1 = $('#tabel1').dataTable( {
				"aoColumns": [
			     null, null, null, null, 
				{ "bSortable": false }				  
				] } );
														
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
			})
				$('[data-rel=tooltip]').tooltip();
				$('[data-rel=popover]').popover({html:true});
		</script>

		<!--<![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		window.jQuery || document.write("<script src='../assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.js"></script>

		<!--ace scripts-->
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

	</body>
</html>