<?php

class Produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('datatables');
        $this->load->library('session');
        $this->load->model('ProdukModel'); // Load model SiswaModel.php yang ada di folder models

    }
    public function index()
    {
        $data['produk'] = $this->ProdukModel->view();
        $data['kategori'] = $this->ProdukModel->get_category();
        // Get files data from the database
        $data['files'] = $this->ProdukModel->getRows();





        $getidproduk = $this->ProdukModel->idproduk();
        $noid = $getidproduk;
        $kodeidsekarang = $noid + 1;
        $data['idproduk'] = array('id_produk' => $kodeidsekarang);
        $dariDB = $this->ProdukModel->cekkodeproduk();
        // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
        $nourut = substr($dariDB, 7, 3);
        $kodeBarangSekarang = $nourut + 1;
        $data['kodeproduk'] = array('kode_barang' => $kodeBarangSekarang);

        $this->load->view('index', $data);
    }

    public function insert_dummy()
    {
        $jumlah_data = 10;
        for ($i = 0; $i <= $jumlah_data; $i++) {

            if ($i % 2 == 0) {
                $data = [
                    "id_kategori" => 2,
                    "nama_produk" => "nama produk ke - " . $i,
                    "kode_produk" => "pdk202000" . $i,
                    "foto_produk" => "foto-produk-" . $i . ".jpg"

                ];
            } else {
                $data = [
                    "id_kategori" => 1,
                    "nama_produk" => "nama produk ke - " . $i,
                    "kode_produk" => "pdk202000" . $i,
                    "foto_produk" => "foto-produk-" . $i . ".jpg"
                ];
            }

            $this->db->insert('tbl_produk', $data);
        }
        echo 'selesai';
    }


    // $this->datatables->select('product_code,product_name,product_price,category_id,category_name');
    // $this->datatables->from('product');
    // $this->datatables->join('categories', 'product_category_id=category_id');


    public function view()
    {
        $search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
        $limit = $_POST['length']; // Ambil data limit per page
        $start = $_POST['start']; // Ambil data start
        $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

        $sql_total = $this->ProdukModel->count_all(); // Panggil fungsi count_all pada ProdukModel
        $sql_data = $this->ProdukModel->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada ProdukModel
        $sql_filter = $this->ProdukModel->count_filter($search); // Panggil fungsi count_filter pada ProdukModel
        $callback = array(
            'draw' => $_POST['draw'], // Ini dari datatablenya
            'recordsTotal' => $sql_total,
            'recordsFiltered' => $sql_filter,
            'data' => $sql_data
        );

        header('Content-Type: application/json');
        echo json_encode($callback); // Convert array $callback ke json
    }

    public function export_excel()
    {

        //load plugin phpexcel
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        // require_once '../third_party/PHPExcel/PHPExcel/Autoloader.php';
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Laporan Data Stock")
            ->setSubject("Laporan Data stock")
            ->setDescription("Laporan Semua Data Produk")
            ->setKeywords("Data Produk");


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


        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA Produk"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "id_produk"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "kategori"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "nama Produk"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "kode_produk"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "stock"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "Foto Produk"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "tgl register"); // S
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $produk = $this->ProdukModel->view();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($produk as $data) { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->id_produk);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->kategori);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->nama_produk);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->kode_produk);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->stok);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->foto_produk);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->tgl_register);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Produk");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Produk.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
    //export to pdf

    function export_pdf()
    {
        include_once APPPATH . '/third_party/fpdf182/fpdf.php';
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'Data Produk', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(27, 6, 'kodeProduk', 1, 0);
        $pdf->Cell(27, 6, 'Kategori', 1, 0);
        $pdf->Cell(50, 6, 'Nama Produk', 1, 0);
        $pdf->Cell(15, 6, 'stock', 1, 0);
        $pdf->Cell(27, 6, 'Tangga Regis', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $produk = $this->ProdukModel->view();
        foreach ($produk as $row) {
            $pdf->Cell(27, 6, $row->kode_produk, 1, 0);
            $pdf->Cell(27, 6, $row->kategori, 1, 0);
            $pdf->Cell(50, 6, $row->nama_produk, 1, 0);
            $pdf->Cell(15, 6, $row->stok, 1, 0);

            $pdf->Cell(27, 6, $row->tgl_register, 1, 1);
        }
        $pdf->Output();
    }

    function save()
    {
        $this->ProdukModel->insert_product();
        $stok = [
            'stock_id_produk' => $this->input->post('id_produk'),
            'jumlah_barang' => $this->input->post('stok'),
            'tgl_update' => $this->input->post('tgl_register')
        ];

        $this->db->insert('tbl_stock', $stok);

        redirect('Produk');
    }



    public function tambah()
    {
        $data = array();

        if ($this->input->post('submit')) { // Jika user menekan tombol Submit (Simpan) pada form
            // lakukan upload file dengan memanggil function upload yang ada di GambarModel.php
            $upload = $this->ProdukModel->upload_produk();

            if ($upload['result'] == "success") { // Jika proses upload sukses
                // Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
                $this->ProdukModel->save($upload);
                echo 'berhasil';

                redirect('Produk/'); // Redirect kembali ke halaman awal / halaman view data
            } else { // Jika proses upload gagal
                $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
                echo 'gagal';
            }
        }
    }

    function upload()
    {


        // If file upload form submitted

        $filesCount = count($_FILES['files']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['file']['name']     = $_FILES['files']['name'][$i];
            $_FILES['file']['type']     = $_FILES['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['file']['error']     = $_FILES['files']['error'][$i];
            $_FILES['file']['size']     = $_FILES['files']['size'][$i];

            // File upload configuration
            $uploadPath = './uploads/files/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            // Upload file to server
            if ($this->upload->do_upload()) {
                // Uploaded file data
                $fileData = $this->upload->data();
                $uploadData[$i]['file_name'] = $fileData['file_name'];
            }
        }

        if (!empty($uploadData)) {
            // Insert files data into the database

            $stok = [
                'stock_id_produk' => $this->input->post('id_produk'),
                'jumlah_barang' => $this->input->post('stok'),
                'tgl_update' => $this->input->post('tgl_register')
            ];

            $this->db->insert('tbl_stock', $stok);
            $insert = $this->ProdukModel->insert($uploadData);
            $this->ProdukModel->tambahProduk();

            // Upload status message
            $statusMsg = $insert ? 'Files uploaded successfully.' : 'Some problem occurred, please try again.';
            $this->session->set_flashdata('statusMsg', $statusMsg);

            redirect('Produk/');
        }
    }
}
