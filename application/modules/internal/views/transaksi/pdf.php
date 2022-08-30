<?php 
    $kelas = $this->model_app->view_where('kelas',array('kelas_id'=>$siswa['siswa_kelas']))->row_array();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?= $row['transaksi_no'] ?></title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				/* line-height: inherit; */
				text-align: left !important;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right !important;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 30px;
				line-height: 45px;
				color: #333;
				text-align: left !important;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									MTS AL-MA`RUF
								</td>

								<td>
									No. Transaksi #: <?= $row['transaksi_no'] ?><br />
									Tanggal: <?= tanggalwaktu($row['transaksi_tanggal']) ?><br />
								
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td style="text-align:left !important;">
									Durasi Pinjam<br />
                                    <?= tanggalwaktu($row['transaksi_tanggal_pinjam']) ?> - <?= tanggalwaktu($row['transaksi_tanggal_kembali']) ?>
									<br />
									Status <br>
									<?php  if($row['transaksi_status'] == 'pinjam'){echo "Belum Selesai";}else{echo "Selesai";}?>
								</td>

								<td>
									<?= $siswa['siswa_nama_lengkap'] ?> (<?= $siswa['siswa_nisn'] ?>)<br />
									<?= $kelas['kelas_nama'] ?>
									<br />
									<?= $siswa['siswa_email'] ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				

				<tr class="heading">
					<td>Buku</td>

					<td>Kondisi</td>
					<td></td>

				</tr>
				<?php 
				
					if($record->num_rows() > 0){
						foreach($record->result_array() as $rows){
							echo '<tr class="item">
							<td>'.$rows['buku_judul'].'</td>
							
						
							<td>'.ucfirst($rows['td_kondisi']).'</td>

						</tr>';
						}
					}
				?>
			

				<tr class="total">
					<td></td>

					<td>Denda Telat: <?= rp($row['transaksi_denda_telat']) ?></td>
					

				</tr>
				<tr class="total">
					<td></td>
					<td>Denda Rusak/Hilang: <?= rp($row['transaksi_total_denda']) ?></td>
					

				</tr>
				<tr class="total">
					<td></td>
					<td>Total: <?= rp($row['transaksi_total_denda']+$row['transaksi_denda_telat']) ?></td>
					

				</tr>
				
			</table>
		</div>
	</body>
</html>