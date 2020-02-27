<?php

class CrudProduk_md extends CI_Model
{


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

    public function view()
    {
        $this->db->select('tbl_produk.id_produk,tbl_kategori.nama_kategori as kategori,tbl_produk.nama_produk,tbl_produk.kode_produk,tbl_stock.jumlah_barang as stok,tbl_produk.foto_produk,tbl_produk.tgl_register');
        $this->db->from('tbl_produk');
        $this->db->join('tbl_kategori', 'tbl_produk.produk_id_kategori = tbl_kategori.id_kategori');
        $this->db->join('tbl_stock', 'tbl_produk.id_produk = tbl_stock.stock_id_produk');
        $query = $this->db->get()->result();
        return $query; // Eksekusi query sql sesuai kondisi diatas
    }

    function get_all_produk()
    {


        $this->datatables->select('tbl_produk.id_produk,produk_id_kategori,tbl_kategori.nama_kategori as kategori,tbl_produk.nama_produk,tbl_produk.kode_produk,tbl_stock.jumlah_barang as stok,tbl_produk.foto_produk,tbl_produk.tgl_register,tbl_stock.tgl_update');
        $this->datatables->from('tbl_produk');
        $this->datatables->join('tbl_kategori', 'tbl_produk.produk_id_kategori = tbl_kategori.id_kategori');
        $this->datatables->join('tbl_stock', 'tbl_produk.id_produk = tbl_stock.stock_id_produk');
        $this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info" data-code="$1" data-name="$2"
          	data-kodeproduk="$3"
          	data-kategori="$4"
          	 data-stok="$5"
             data-foto="$6"
             data-register="$7">Edit</a> 
              <a href="javascript:void(0);" class="delete_record btn btn-danger" data-code="$1">Delete</a>', 'id_produk,nama_produk,kode_produk,produk_id_kategori,stok,foto_produk,tbl_produk.tgl_register');



        return $this->datatables->generate();
    }



    public function get_category()
    {
        $result = $this->db->get('tbl_kategori');
        return $result;
    }

    public function insert($filename)
    {

        $data_produk = array(
            'id_produk' => $this->input->post('id_produk'),
            'produk_id_kategori' => $this->input->post('kategori'),
            'nama_produk' => $this->input->post('nama_produk'),
            'kode_produk' => $this->input->post('kode_produk'),
            'foto_produk' => $filename,

            'tgl_register' => $this->input->post('tgl_register')
        );
        $result = $this->db->insert('tbl_produk', $data_produk);
        return $result;
    }

    public function delete_produk()
    {

        $id_produk = $this->input->post('id_produk');
        $this->db->where('id_produk', $id_produk);
        $result = $this->db->delete('tbl_produk');
        return $result;
    }

    public function delete_stock()
    {
        $id_stock = $this->input->post('id_produk');
        $this->db->where('stock_id_produk', $id_stock);
        $result = $this->db->delete('tbl_stock');
        return $result;
    }

    public function update_produk()
    {
        $id_produk = $this->input->post('id_produk');
        $data = [


            'produk_id_kategori' => $this->input->post('kategori'),
            'nama_produk' => $this->input->post('nama_produk'),



        ];

        $this->db->where('id_produk', $id_produk);
        $result = $this->db->update('tbl_produk', $data);
        return $result;
    }


    public function update_stock()
    {
        $id_produk = $this->input->post('id_produk');
        $data = [


            'jumlah_barang' => $this->input->post('stock'),

            'tgl_update' => $this->input->post('tgl_update')


        ];

        $this->db->where('stock_id_produk', $id_produk);
        $result = $this->db->update('tbl_stock', $data);
        return $result;
    }
}
