<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_bahan extends CI_Model {

     // start datatables
     var $column_order = array('bahan_id', 'b_stock.nama', 'j_bahan_nama', 'satuan_nama', 'total_harga', 'harga', 'stock'); //set column field database for datatable orderable
     var $column_search = array('barcode', 'b_stock.nama', 'r_jenis_bahan.nama', 'price'); //set column field database for datatable searchable
     var $order = array('bahan_id' => 'asc'); // default order 
  
     private function _get_datatables_query() {
         $this->db->select('b_stock.*, r_jenis_bahan.nama as j_bahan_nama, r_satuan.nama as satuan_nama');
         $this->db->from('b_stock');
         $this->db->join('r_jenis_bahan', 'b_stock.j_bahan_id = r_jenis_bahan.j_bahan_id');
         $this->db->join('r_satuan', 'b_stock.satuan_id = r_satuan.satuan_id');
         $i = 0;
         foreach ($this->column_search as $bahan) { // loop column 
             if(@$_POST['search']['value']) { // if datatable send POST for search
                 if($i===0) { // first loop
                     $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                     $this->db->like($bahan, $_POST['search']['value']);
                 } else {
                     $this->db->or_like($bahan, $_POST['search']['value']);
                 }
                 if(count($this->column_search) - 1 == $i) //last loop
                     $this->db->group_end(); //close bracket
             }
             $i++;
         }
          
         if(isset($_POST['order'])) { // here order processing
             $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
         }  else if(isset($this->order)) {
             $order = $this->order;
             $this->db->order_by(key($order), $order[key($order)]);
         }
     }
     function get_datatables() {
         $this->_get_datatables_query();
         if(@$_POST['length'] != -1)
         $this->db->limit(@$_POST['length'], @$_POST['start']);
         $query = $this->db->get();
         return $query->result();
     }
     function count_filtered() {
         $this->_get_datatables_query();
         $query = $this->db->get();
         return $query->num_rows();
     }
     function count_all() {
         $this->db->from('b_stock');
         return $this->db->count_all_results();
     }
     
     // end datatables

    public function get($id = null)
    {
        $this->db->select('b_stock.*, r_jenis_bahan.nama as nama_j_bahan, r_satuan.nama as nama_satuan');
        $this->db->from('b_stock');
        $this->db->join('r_jenis_bahan', 'r_jenis_bahan.j_bahan_id = b_stock.j_bahan_id');
        $this->db->join('r_satuan', 'r_satuan.satuan_id = b_stock.satuan_id');
        if($id != null) {
            $this->db->where('bahan_id', $id);

        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'nama' => $post['nama'],
            'j_bahan_id' => $post['j_bahan'],
            'satuan_id' => $post['satuan'],
        ];
        $this->db->insert('b_stock', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama' => $post['nama'],
            'j_bahan_id' => $post['j_bahan'],
            'satuan_id' => $post['satuan'],
            'modified' => date('Y-m-d H:i:s')
        ];
        $this->db->where('bahan_id', $post['id']);
        $this->db->update('b_stock', $params);
    }

    public function check_bahan($code, $id = null){
        $this->db->from('b_stock');
        $this->db->where('nama', $code);
        if($id != null) {
            $this->db->where('bahan_id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del($id)
	{
        $this->db->where('bahan_id', $id);
        $this->db->delete('b_stock');
    }

    function update_purchase_in($data)
    {
        $jumlah = $data['jumlah'];
        $qty = $data['qty'];
        $id = $data['bahan_id'];
        $sql = "UPDATE b_stock SET stock = stock + ('$jumlah'*'$qty') WHERE bahan_id = '$id'";
        $this->db->query($sql);
    }

    function update_purchase_out($data)
    {
        $jumlah = $data['jumlah'];
        $qty = $data['qty'];
        $id = $data['bahan_id'];
        $sql = "UPDATE b_stock SET stock = stock - ('$jumlah'*'$qty') WHERE bahan_id = '$id'";
        $this->db->query($sql);
    }
    
    function update_harga_out($data)
    {
        $harga = $data['harga'];
        $qty = $data['qty'];
        $id = $data['bahan_id'];
        $sql = "UPDATE b_stock SET total_harga = total_harga - ('$harga'*'$qty') WHERE bahan_id = '$id'";
        $this->db->query($sql);
    }

    function update_harga_in($data)
    {
        $harga = $data['harga'];
        $qty = $data['qty'];
        $id = $data['bahan_id'];
        $sql = "UPDATE b_stock SET total_harga = total_harga + ('$harga'*'$qty') WHERE bahan_id = '$id'";
        $this->db->query($sql);
    }

    function update_purchase_indel($data)
    {
        $jumlah = $data['jumlah'];
        $id = $data['bahan_id'];
        $sql = "UPDATE b_stock SET stock = stock + '$jumlah' WHERE bahan_id = '$id'";
        $this->db->query($sql);
    }

    function update_harga_indel($data)
    {
        $harga = $data['harga'];
        $id = $data['bahan_id'];
        $sql = "UPDATE b_stock SET total_harga = total_harga + '$harga' WHERE bahan_id = '$id'";
        $this->db->query($sql);
    }

    function update_purchase_outdel($data)
    {
        $jumlah = $data['jumlah'];
        $id = $data['bahan_id'];
        $sql = "UPDATE b_stock SET stock = stock - '$jumlah' WHERE bahan_id = '$id'";
        $this->db->query($sql);
    }

    function update_harga_outdel($data)
    {
        $harga = $data['harga'];
        $jumlah = $data['jumlah'];
        $id = $data['bahan_id'];
        $sql = "UPDATE b_stock SET total_harga = total_harga - ('$harga'*'$jumlah') WHERE bahan_id = '$id'";
        $this->db->query($sql);
    }

    function update_harga($data)
    {
        $id = $data['bahan_id'];
        $sql = "UPDATE b_stock SET harga = total_harga / stock WHERE bahan_id = '$id'";
        $this->db->query($sql);
    }

}