
<?php
class Kot_model extends CI_Model {

    public function get_active_kot($table_id) {
        $this->db->where('table_id', $table_id);
        $this->db->where_in('status', ['pending', 'preparing']);
        $query = $this->db->get('kot_orders');
        return $query->row();
    }

    public function add_item($data) {
        $kot = $this->get_active_kot($data['table_id']);
        if (!$kot) {
            $this->db->insert('kot_orders', ['table_id' => $data['table_id']]);
            $kot_id = $this->db->insert_id();
        } else {
            $kot_id = $kot->id;
        }
        $item = [
            'kot_order_id' => $kot_id,
            'item_id' => $data['item_id'],
            'variant_id' => $data['variant_id'],
            'qty' => $data['qty']
        ];
        $this->db->insert('kot_items', $item);
    }

    public function get_kot_items($table_id) {
        $this->db->select('k.id as kot_id, mi.name as item, mv.name as variant, ki.qty, ki.status, mc.name as category');
        $this->db->from('kot_orders k');
        $this->db->join('kot_items ki', 'ki.kot_order_id = k.id');
        $this->db->join('menu_items mi', 'mi.id = ki.item_id');
        $this->db->join('menu_variants mv', 'mv.id = ki.variant_id');
        $this->db->join('menu_categories mc', 'mc.id = mi.category_id');
        $this->db->where('k.table_id', $table_id);
        $this->db->order_by('mc.name, mi.name');
        return $this->db->get()->result();
    }
}
