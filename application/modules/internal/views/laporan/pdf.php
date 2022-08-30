<?php
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

</head>
<body>
	<style type="text/css" >
		h4{
			margin: 0px;
		}
		h6{
			margin: 0px;
		}
		/*design table 1*/
		.table1 {
		    color: #232323;
		    border-collapse: collapse;
		}
		 
		.BO {
		    border: 1px solid #999;
		    padding: 8px 20px;
		}
	</style>
	<table width="100%"  >
		<tr >
			<td align="center">
				<h4>LAPORAN</h4>
				<h4>TOKO ILOVEKPOP_ID</h4>
				<i>Jl.Drupadi Gg Jempiring Br Tangkeban Sukawati, Gianyar, Bali</i>
			</td>
		</tr>
	
		<tr><td colspan="2"><hr></td></tr>
		<tr><td><br></td></tr>
	</table>
	<table width="100%">
    <tr><td colspan="4" align="center"><b style="margin:0px;"><u>Laporan Transaksi</u></b></td></tr>
		<tr><td><br></td></tr>
	</table>

    <table width="100%">
        <tr>
            <td width="20%"><b>No Transaksi</b></td>
            <td>: <?= $row['transaksi_no']?></td>
        </tr>
        <tr>
            <td width="20%"><b>Tgl Pemesanan</b></td>
            <td>:<?= tanggalwaktu($row['transaksi_created_on']) ?></td>
        </tr>
		<tr><td colspan="4"><hr></td></tr>

    </table>

    <table width="100%">
        <tr>
            <td><b>Detail Pemesan</b></td>
        </tr>
    </table>
    <table width="100%" class="table1">
        <tr>
            <td class="BO">
                <b>Nama</b><br>
                <?= $row['transaksi_member_nama']?>
            </td>
            <td class="BO">
                <b>No Telp</b><br>
                <?= $row['transaksi_member_no_telp']?>
            </td>
            <td class="BO">
                <b>Email</b><br>
                <?= $row['transaksi_member_email']?>
            </td>
        </tr>
        <tr>
            <td class="BO" colspan="2">
                <b>Alamat</b><br>
                <?= $row['transaksi_member_alamat'] ?><br>
                <?= $asal['kota_nama']?>, <?= $asal['provinsi_nama'] ?> (<?= $row['transaksi_member_kode_pos']?>)
            </td>
            <td class="BO">
                <b>Pengiriman</b><br>
                <?= strtoupper($row['transaksi_ekspedisi'].' - '.$row['transaksi_service'])?>
            </td>
        </tr>

    </table>
    
    <br>

    <table width="100%">
        <tr>
            <td><b>Detail Produk</b></td>
        </tr>
    </table>
    <table width="100%" class="table1">
        <thead>
            <tr>
                <th scope="col" class="BO">Produk</th>
                <th scope="col" class="BO">Batch</th>

                <th scope="col" class="BO">Harga</th>
                <th scope="col" class="BO">Jumlah</th>
                <th scope="col" class="BO">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $produk = $this->db->query("SELECT *  FROM transaksi_detail a JOIN produk b ON a.td_produk_id = b.produk_id JOIN produk_batch c ON a.td_pb_id = c.pb_id WHERE td_transaksi_id = '$row[transaksi_id]'");
                if($produk->num_rows() > 0){
                    foreach($produk->result_array() as $pro){
                        echo ' <tr>
                        <td class="BO">'.$pro['produk_nama'].'</td>
                        <td class="BO">'.$pro['pb_batch'].'</td>

                        <td class="BO" align="center">'.idr($pro['produk_harga_jual']).'</td>
                        <td class="BO" align="center">'.$pro['td_qty'].'</td>
                        <td class="BO" align="center">'.idr($pro['td_subtotal']).'</td>
                    </tr>';
                    }
                }
            ?>
           
            <tr>
                <td class="BO" colspan="4" align="right">Total</td>
                <td class="BO" align="center"><?= idr($row['transaksi_total'])?></td>
            </tr>
        </tbody>
    </table>

    <br>

    <table width="100%">
        <tr>
            <td><b>Detail Pembayaran</b></td>
        </tr>
    </table>
    <table width="100%" class="table1">
        <tr>
            <td class="BO" width="30%"><b>Total</b></td>
            <td class="BO" align="right"><?= idr($row['transaksi_total'])?></td>
        </tr>
        <tr>
            <td class="BO"><b>Ongkos Kirim</b></td>
            <td class="BO" align="right"><?= idr($row['transaksi_ongkir'])?></td>
        </tr>
        <tr>
            <td class="BO"><b>Sub Total</b></td>
            <td class="BO" align="right"><?= idr($row['transaksi_subtotal'])?></td>
        </tr>
        <tr>
            <td class="BO"><b>Pembayaran Via</b></td>
            <td class="BO" align="right"><?= ucwords(str_replace('_',' ',$pay['pay_channel']))?></td>
        </tr>
        <tr>
            <td class="BO"><b>Tgl Pembayaran</b></td>
            <td class="BO" align="right"><?= tanggalwaktu($pay['pay_date'])?></td>
        </tr>
        <tr>
            <td class="BO"><b>Jumlah Dibayarkan</b></td>
            <td class="BO" align="right"><?= idr($pay['pay_amount']) ?></td>
        </tr>
    </table>


</body>
</html>