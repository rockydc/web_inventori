<?php

class CrudStock_md extends CI_Model
{

    function get_all()
    {
        $this->datatables->select('id_stock,stock_id_produk,jumlah_barang,tgl_update,tbl_produk.nama_produk as nama_produk,tbl_produk.kode_produk');
        $this->datatables->from('tbl_stock');
        $this->datatables->join('tbl_produk', 'tbl_stock.stock_id_produk = tbl_produk.id_produk');
        // $this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info" data-code="$1" data-stock="$2"
        // data-jml="$3"
        // data-update="$4"
        // data-nama="$5">Edit</a> 
        // <a href="javascript:void(0);" class="delete_record btn btn-danger" data-code="$1">Delete</a>', 'id_stock,stock_id_produk,jumlah_barang,tgl_update,nama_produk');
        return $this->datatables->generate();
    }

    public function insert()
    {


        $data_produk = array(
            'id_stock' => $this->input->post('id_stock'),
            'stock_id_produk' => $this->input->post('id_produk'),
            'nama_produk' => $this->input->post('nama_produk'),


            'tgl_update' => $this->input->post('tgl_update')
        );
        $result = $this->db->insert('tbl_produk', $data_produk);
        return $result;
    }
    public function view()
    {
        $this->db->select('id_stock,stock_id_produk,jumlah_barang,tgl_update,tbl_produk.nama_produk as nama_produk,tbl_produk.kode_produk');
        $this->db->from('tbl_stock');
        $this->db->join('tbl_produk', 'tbl_stock.stock_id_produk = tbl_produk.id_produk');

        $query = $this->db->get()->result();
        return $query; // Eksekusi query sql sesuai kondisi diatas
    }
}
