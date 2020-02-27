<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProdukModel extends CI_Model
{

    public function filter($search, $limit, $start, $order_field, $order_ascdesc)
    {
        $this->db->like('nama_kategori', $search); // Untuk menambahkan query where LIKE
        $this->db->or_like('nama_produk', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('kode_produk', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('foto_produk', $search); // Untuk menambahkan query where OR LIKE
        $this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
        $this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
        $this->db->select('tbl_produk.id_produk,tbl_kategori.nama_kategori as kategori,tbl_produk.nama_produk,tbl_produk.kode_produk,tbl_stock.jumlah_barang as stok,tbl_produk.foto_produk,tbl_produk.tgl_register');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_kategori', 'tbl_produk.produk_id_kategori = tbl_kategori.id_kategori');
        $this->db->join('tbl_stock', 'tbl_produk.id_produk = tbl_stock.stock_id_produk');
        $query = $this->db->get()->result_array();
        return $query; // Eksekusi query sql sesuai kondisi diatas
    }

    public function count_all()
    {
        return $this->db->count_all('tbl_produk'); // Untuk menghitung semua data siswa
    }

    public function count_filter($search)
    {
        $this->db->like('produk_id_kategori', $search); // Untuk menambahkan query where LIKE
        $this->db->or_like('nama_produk', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('kode_produk', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('foto_produk', $search); // Untuk menambahkan query where OR LIKE

        return $this->db->get('tbl_produk')->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
    }

    function insert_produk()
    {
        $data_produk = array(
            'id_produk' => $this->input->post('id_produk'),
            'id_kategori' => $this->input->post('id_kategori'),
            'nama_produk' => $this->input->post('nama_produk'),
            'kode_produk' => $this->input->post('kode_produk'),
            'foto_produk' => $this->input->post('foto_produk'),
            'tgl_register' => $this->input->post('tgl_register')
        );
        $result = $this->db->insert('tbl_produk', $data_produk);
        return $result;
    }

    public function view()
    {
        $this->db->select('tbl_produk.id_produk,tbl_kategori.nama_kategori as kategori,tbl_produk.nama_produk,tbl_produk.kode_produk,tbl_stock.jumlah_barang as stok,tbl_produk.foto_produk,tbl_produk.tgl_register');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_kategori', 'tbl_produk.produk_id_kategori = tbl_kategori.id_kategori');
        $this->db->join('tbl_stock', 'tbl_produk.id_produk = tbl_stock.stock_id_produk');
        $query = $this->db->get()->result();
        return $query; // Eksekusi query sql sesuai kondisi diatas
    }

    public function get_category()
    {
        $result = $this->db->get('tbl_kategori');
        return $result;
    }


    public function cekkodeproduk()
    {
        $query = $this->db->query("SELECT MAX(kode_produk) as kodeproduk from tbl_produk");
        $hasil = $query->row();
        return $hasil->kodeproduk;
    }

    public function idproduk()
    {
        $query = $this->db->query("SELECT MAX(id_produk) as idproduk from tbl_produk");
        $hasil = $query->row();
        return $hasil->idproduk;
    }

    public function getRows($id = '')
    {
        $this->db->select('id_produk,nama_produk,tgl_register');
        $this->db->from('tbl_produk');
        if ($id) {
            $this->db->where('id_produk', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            $this->db->order_by('tgl_register', 'desc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result) ? $result : false;
    }

    /*
     * Insert file data into the database
     * @param array the data for inserting into the table
     */
    public function insert($data = array())
    {
        $insert = $this->db->insert_batch('tgl_produk', $data);
        return $insert ? true : false;
    }

    public function upload_produk()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']  = '2048';
        $config['remove_space'] = TRUE;

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('file')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }

    public function save($upload_produk)
    {
        $data = array(
            'produk_id_kategori'        => $this->input->post('kategori'),
            'nama_produk'        => $this->input->post('nama_produk'),
            'kode_produk'       => $this->input->post('kode_produk'),
            'foto_produk' => $upload_produk['files']['file_name'],

            'tgl_register' => $this->input->post('tgl_register')
        );

        $this->db->insert('tbl_produk', $data);
    }


    function insert_product()
    {
        $data = array(
            'produk_id_kategori'        => $this->input->post('kategori'),
            'nama_produk'        => $this->input->post('nama_produk'),
            'kode_produk'       => $this->input->post('kode_produk'),

            'tgl_register' => $this->input->post('tgl_register')
        );


        // $config['upload_path'] = './uploads/files';
        // $config['allowed_types'] = 'pdf';
        // $config['max_size']  = '32000';
        // $config['remove_space'] = TRUE;



        // // $this->load->library('upload', $config); // Load konfigurasi uploadnya
        // // if ($this->upload->do_upload('files')) { // Lakukan upload dan Cek jika proses upload berhasil
        // //     // Jika berhasil :
        // //     $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
        // //     return $return;
        // // } else {
        // //     // Jika gagal :
        // //     $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
        // //     return $return;
        // // }
        $result = $this->db->insert('tbl_produk', $data);
        return $result;
    }

    //delete data method
    function delete_produk()
    {
        $product_code = $this->input->post('id_produk');
        $this->db->where('id_produk', $product_code);
        $result = $this->db->delete('tbl_produk');
        return $result;
    }
}
