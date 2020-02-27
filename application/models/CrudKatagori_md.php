<?php

class CrudKatagori_md extends CI_Model
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
        $this->db->select('id_kategori,nama_kategori');
        $this->db->from('tbl_kategori');

        $query = $this->db->get()->result();
        return $query; // Eksekusi query sql sesuai kondisi diatas
    }

    function get_all_produk()
    {


        $this->datatables->select('id_kategori,nama_kategori');
        $this->datatables->from('tbl_kategori');

        $this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info" data-code="$1" data-name="$2">Edit</a> 
              <a href="javascript:void(0);" class="delete_record btn btn-danger" data-code="$1">Delete</a>', 'id_kategori,nama_kategori');



        return $this->datatables->generate();
    }

    public function insert()
    {


        $data_produk = array(
            'id_produk' => $this->input->post('id_produk'),
            'produk_id_kategori' => $this->input->post('kategori'),
            'nama_produk' => $this->input->post('nama_produk'),
            'kode_produk' => $this->input->post('kode_produk'),

            'tgl_register' => $this->input->post('tgl_register')
        );
        $result = $this->db->insert('tbl_produk', $data_produk);
        return $result;
    }

    public function delete()
    {

        $id_kategori = $this->input->post('id_kategori');
        $this->db->where('id_kategori', $id_kategori);
        $result = $this->db->delete('tbl_kategori');
        // if ($id_kategori) {
        // }
        return $result;
    }


    public function update()
    {
        $id_kategori = $this->input->post('id_kategori');
        $data = [



            'nama_kategori' => $this->input->post('nama_kategori'),



        ];

        $this->db->where('id_kategori', $id_kategori);
        $result = $this->db->update('tbl_kategori', $data);
        return $result;
    }
}
