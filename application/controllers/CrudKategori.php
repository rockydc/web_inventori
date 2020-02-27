<?php

class CrudKategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
        $this->load->library('session');
        $this->load->model('CrudKatagori_md');
        $this->load->model('CrudProduk_md');
        $this->load->helper(array('form', 'url'));
    }
    public function index()
    {

        $getidproduk = $this->CrudProduk_md->idproduk();
        $noid = $getidproduk;
        $kodeidsekarang = $noid + 1;
        $data['idproduk'] = array('id_produk' => $kodeidsekarang);
        $dariDB = $this->CrudProduk_md->cekkodeproduk();
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($dariDB, 7, 3);
        $kodeBarangSekarang = $nourut + 1;
        $data['kodeproduk'] = array('kode_barang' => $kodeBarangSekarang);
        $data['kategori'] = $this->CrudProduk_md->get_category();

        $data['judul'] = "Kategori";
        $this->load->view('templates/navbar', $data);
        $this->load->view('kategori');
        $this->load->view('templates/footer', $data);
    }
    function get_produk_json()
    {


        header('Content-Type: application/json');
        echo $this->CrudKatagori_md->get_all_produk();
    }

    function insert_kategori()
    {

        $data = [
            'nama_kategori' => $this->input->post('Nama_Kategori')
        ];
        $this->db->insert('tbl_kategori', $data);
        redirect('CrudKategori/');
    }

    function delete_kategori()
    {

        $this->CrudKatagori_md->delete();
        redirect('CrudKategori/');
    }

    function edit()
    {
        $this->CrudKatagori_md->update();

        redirect('CrudKategori');
    }
    public function export_excel()
    {

        //load plugin phpexcel
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        // require_once '../third_party/PHPExcel/PHPExcel/Autoloader.php';
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        $excel->getProperties()->setCreator('Rocky')
            ->setLastModifiedBy('Rocky')
            ->setTitle("Laporan Data Stock")
            ->setSubject("Laporan Data stock")
            ->setDescription("Laporan Semua Data Kategori")
            ->setKeywords("Data Kategori");


        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
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
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );


        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA KATAGORI"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:C1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "ID KATAGORI"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA KATAGORI"); // Set kolom C3 dengan tulisan "NAMA"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $produk = $this->CrudKatagori_md->view();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($produk as $data) { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->id_kategori);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->nama_kategori);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);


            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C


        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Katagori");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Katagori.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
    function export_pdf()
    {
        include_once APPPATH . '/third_party/fpdf182/fpdf.php';
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'Master Kategori', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(27, 6, 'id kategori', 1, 0);
        $pdf->Cell(100, 6, 'Nama Kategori', 1, 1);

        $pdf->SetFont('Arial', '', 10);
        $produk = $this->CrudKatagori_md->view();
        foreach ($produk as $row) {
            $pdf->Cell(27, 6, $row->id_kategori, 1, 0);
            $pdf->Cell(100, 6, $row->nama_kategori, 1, 1);
        }
        $pdf->Output();
    }
}
