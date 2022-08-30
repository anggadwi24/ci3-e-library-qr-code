<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MX_Controller 
{

	public function __construct()
	{
        parent::__construct();
    	$this->load->model('model_app','',TRUE);
    	if($this->session->userdata('isLog')){
			
		}else{
			redirect('internal/auth');
		}
	}

	public function index()
	{
		// $data['title'] = 'Laporan';
		$data['page'] = 'Laporan';
		$data['title'] = 'Laporan - '.title();
		$data['siswa'] = $this->model_app->view_order('siswa','siswa_nama_lengkap','ASC');	
		$data['buku'] = $this->model_app->view_order('buku','buku_judul','ASC');
		$data['subtitle'] = ' Laporan';
		$data['breadcrumb'] = ' <span class="breadcrumb-item active">Laporan</span>';
		
		$data['js'] = base_url('template/admin/ajax/transaksi/ajax-laporan.js');
		$data['record'] = $this->model_app->view_order('buku','buku_id','DESC');	

		$this->template->load('template','laporan/laporan',$data);
	}
	public function pdf()
	{
		$no = $this->input->get('no');
		$cek = $this->model_app->view_where('transaksi',array('transaksi_no'=>$no));
		if($cek->num_rows() > 0){
			$row = $cek->row_array();
			$data['row'] = $row;
			$data['record'] = $this->model_app->join_where_order2('transaksi_detail','buku','td_buku_id','buku_id',array('td_transaksi_id'=>$row['transaksi_id']),'td_id','ASC');
			$data['siswa'] = $this->model_app->view_where('siswa',array('siswa_id'=>$row['transaksi_siswa_id']))->row_array();
			$title = $row['transaksi_no'];

			$html = $this->load->view('transaksi/pdf',$data,true);
			pdf_create($html, $title, 'A$', 'potraiet',TRUE);
		}else{
			$this->session->set_flashdata('error','Transaksi tidak ditemukan');
			redirect('internal/transaksi');
		}
	}
	function data(){
		if($this->input->method()  == 'post'){
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$siswa = $this->input->post('siswa');
			$buku = $this->input->post('buku');
			$status = $this->input->post('status');
			$output = '<table id="simpletable" class="table table-hover table-xl">
						<thead>
							<tr>
								<th>No Transaksi</th>
								<th>Nama Siswa</th>
								<th>Tanggal Transaksi</th>
								<th>Tanggal Peminjaman</th>
								<th>Status</th>
								<th>Denda</th>
								<th></th>
							</tr>
						</thead>
						<tbody>';
			$data = $this->model_app->view_booking($start,$end,$siswa,$buku,$status);
		
			
			if($data->num_rows() > 0){
				foreach($data->result_array() as $row){
					$pr = '';
					$produk = $this->db->query("SELECT *  FROM transaksi_detail a JOIN buku b ON a.td_buku_id = b.buku_id WHERE td_transaksi_id = '$row[transaksi_id]'");
					if($produk->num_rows() > 0){
						foreach($produk->result_array() as $pro){
							$pr .=$pro['buku_judul'].' x'.$pro['td_qty'].' item<br>';
						}
					}
					if($row['transaksi_status'] == 'pinjam'){
						$con = 'Belum selesai';
					}else if($row['transaksi_status'] == 'selesai'){
						$con = 'Selesai';
					}
					$output .= '<tr>
									<td>'.$row['transaksi_no'].'</td>
									<td>'.$row['siswa_nama_lengkap'].'</td>
									<td>'.tanggalwaktu($row['transaksi_created_on']).'</td>
									<td>'.tanggalwaktu($row['transaksi_tanggal_pinjam']).' - '.tanggalwaktu($row['transaksi_tanggal_kembali']).'</td>
									<td>'.$con.'</td>
									<td>'.idr($row['transaksi_total_denda']+$row['transaksi_denda_telat']).'</td>
									<td> <a class="text-gray m-r-15" href="'.base_url('internal/laporan/pdf?no='.$row['transaksi_no']).'" >
											<i class="mdi mdi-eye m-r-5"></i>
											<span>Download</span>
										</a>
									</td>


								</tr>';
				}
			}
			$output .= '</tbody>
					</table>';
			echo json_encode($output);
		}else{
			redirect('internal/transaksi');
		}
	}
	function excel(){
		$start = $this->input->get('start');
		$end = $this->input->get('end');
		$siswa = $this->input->get('siswa');
		$buku = $this->input->get('buku');
		$status = $this->input->get('status');
	
		$record = $this->model_app->view_booking($start,$end,$siswa,$buku,$status);
		
        if($buku == 'all'){
			$product = 'SEMUA BUKU';
		}else{
			$pro = $this->model_app->view_where('buku',array('buku_id' => $buku));
			if($pro->num_rows() > 0){
				$prs = $pro->row_array();
				$product = strtoupper($prs['buku_judul']);
			}else{
				$product = 'SEMUA BUKU';
			}
		}

		if($siswa == 'all'){
			$batch = 'SEMUA SISWA';
		}else{
			$bat = $this->model_app->view_where('siswa',array('siswa_id' => $siswa));
			if($bat->num_rows() > 0){
				$bts = $bat->row_array();
				$batch = strtoupper($bts['siswa_nama_lenkap']);
			}else{
				$batch = 'SEMUA SISWA';
			}
		}
		include APPPATH."third_party/PHPExcel/PHPExcel.php";
		// $objPHPExcel = new PHPExcel();	
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
                     ->setLastModifiedBy('My Notes Code')
                     ->setTitle("Data Siswa")
                     ->setSubject("Siswa")
                     ->setDescription("Laporan Semua Data Siswa")
                     ->setKeywords("Data Siswa");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
          'font' => array('bold' => true, 'color' => array('rgb' => 'FFFFFF'),),
          'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '1857fa')
            ), // Set font nya jadi bold
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );

		$style_row1 = array(
			'alignment' => array(
			  'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			   'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			
		  );
		

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA LAPORAN PERPUSTAKAAN MTS AL-MA`RUF"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:L1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		$title = strtoupper(fullDate($start).' - '.fullDate($end));

        $excel->setActiveSheetIndex(0)->setCellValue('A2', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A2:L2'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$title2 = ' BUKU : '.$product.'| SISWA : '.$batch;
        $excel->setActiveSheetIndex(0)->setCellValue('A3', $title2); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A3:L3'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A5', "NO"); // Set kolom A3 dengan tulisan "NO"
        
        $excel->setActiveSheetIndex(0)->setCellValue('B5', "NO. TRANSAKSI"); // Set kolom B3 dengan tulisan "NIS"
       
        $excel->setActiveSheetIndex(0)->setCellValue('C5', "NAMA SISWA"); // Set kolom C3 dengan tulisan "NAMA"
       
        $excel->setActiveSheetIndex(0)->setCellValue('D5', "TANGGAL"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
     
        $excel->setActiveSheetIndex(0)->setCellValue('E5', "BUKU"); // Set kolom E3 dengan tulisan "ALAMAT"
      
        $excel->setActiveSheetIndex(0)->setCellValue('F5', "TGL PINJAM");
        $excel->setActiveSheetIndex(0)->setCellValue('G5', "TGL KEMBALI");
    
        $excel->setActiveSheetIndex(0)->setCellValue('H5', "QTY");
    
  
     
        $excel->setActiveSheetIndex(0)->setCellValue('I5', "DENDA");
        $excel->setActiveSheetIndex(0)->setCellValue('J5', "DENDA TELAT");
        $excel->setActiveSheetIndex(0)->setCellValue('K5', "TOTAL DENDA");

        $excel->setActiveSheetIndex(0)->setCellValue('L5', "STATUS");


       
    
    
    
    
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
      
        $excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L5')->applyFromArray($style_col);
    


		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		$totalQty = 0;
		
		$totalDenda = 0;
		$totalTelat = 0;
		$totalSubTotal = 0;
		$transaksi = '';
        foreach($record->result_array() as $row){
		
			$produ = $this->model_app->join_where_order2('transaksi_detail','buku','td_buku_id','buku_id',array('td_transaksi_id'=>$row['transaksi_id']),'td_id','ASC');
			// $produ = $this->db->query("SELECT *  FROM transaksi_detail a JOIN produk b ON a.td_produk_id = b.produk_id JOIN produk_batch c ON a.td_pb_id = c.pb_id WHERE td_transaksi_id = '$row[transaksi_id]'");
					if($produ->num_rows() > 0){
						foreach($produ->result_array() as $pro){
					
							if($row['transaksi_status'] == 'pinjam'){
								$con = 'Belum selesai';
							
							}else if($row['transaksi_status'] == 'selesai'){
								$con = 'Selesai';
							}else{
								$con = 'Expired';
							}
							$totalQty=$totalQty+$pro['td_qty'];
							
							$totalDenda = $totalDenda+$row['transaksi_total_denda'];
							if($row['transaksi_no'] == $transaksi){
							

								$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
								$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, '');
								$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, '');
								$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, '');
								
								$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, strtoupper($pro['buku_judul']));
								$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, '');
								
								$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, '');
								$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $pro['td_qty']);

								$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, idr($pro['td_denda']));
								$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, idr($row['transaksi_denda_telat']));
								$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, '');
								
								$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, '');
							}else{
								$totalTelat = $totalTelat+$row['transaksi_denda_telat'];
							
								$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
								$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row['transaksi_no']);
								$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, strtoupper($row['siswa_nama_lengkap']));
								$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, strtoupper(tanggalwaktu($row['transaksi_tanggal'])));
								
								$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, strtoupper($pro['buku_judul']));
								$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, strtoupper(tanggalwaktu($row['transaksi_tanggal_pinjam'])));
								
								$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, strtoupper(tanggalwaktu($row['transaksi_tanggal_kembali'])));
								$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $pro['td_qty']);

								$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, idr($pro['td_denda']));
								$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, idr($row['transaksi_denda_telat']));
								$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, idr($row['transaksi_denda_telat']+$row['transaksi_total_denda']));
								
								$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, strtoupper($con));
							}
						
							


							$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
							$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
							$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
							$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
							$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
							$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
							$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
							$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
							$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
							$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
							$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
							$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
							
							
							$no++;
							$numrow++;
							
							$transaksi = $row['transaksi_no'];
						}
			}

			


		
		}
		

		$numrow1= $numrow+2;
		$numrow2= $numrow+1;
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow2,''); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A'.$numrow2.':G'.$numrow2.''); // Set Merge Cell pada kolom A1 sampai E1
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow2, 'TOTAL QTY');

		$margin = ($totalSubTotal-$totalOngkir)-$totalKeuntungan;
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow2, 'TOTAL DENDA');
		$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow2, 'TOTAL DENDA TELAT');
		$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow2, 'TOTAL');
		

		


	
		$excel->getActiveSheet()->getStyle('H'.$numrow2)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$numrow2)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$numrow2)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$numrow2)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('L'.$numrow2)->applyFromArray($style_row);



		$excel->getActiveSheet()->getStyle('A'.$numrow2.':G'.$numrow2.'')->applyFromArray($style_row);

		$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow1,''); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A'.$numrow1.':G'.$numrow1.''); // Set Merge Cell pada kolom A1 sampai E1
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow1, $totalQty);

		$subtotal = $totalDenda+$totalTelat;
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow1, idr($totalDenda));
		$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow1, idr($totalTelat));
		$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow1, idr($subtotal));
		

		


	
		$excel->getActiveSheet()->getStyle('H'.$numrow1)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('I'.$numrow1)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('J'.$numrow1)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('K'.$numrow1)->applyFromArray($style_row);
		$excel->getActiveSheet()->getStyle('L'.$numrow1)->applyFromArray($style_row);

		// $excel->getActiveSheet()->getStyle('M'.$numrow1)->applyFromArray($style_row);

		$excel->getActiveSheet()->getStyle('A'.$numrow1.':G'.$numrow1.'')->applyFromArray($style_row);


		




		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(50); // Set width kolom E

        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);


		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle('LAPORAN');
        $excel->setActiveSheetIndex(0);
        // Proses file excel
    
        $name =  'LAPORAN PERPUSTAKAAN MTS MA`RUF'.date('d-m-Y',strtotime($start)).'-'.date('d-m-Y',strtotime($end));
		ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$name.'".xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');

	}
	
}
