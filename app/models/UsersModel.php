<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersModel extends Model {
    protected $table = 'information'; // your table name
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_by_id($id)
    {
        return $this->db->table('information')
                        ->where('id', $id)
                        ->get();
    }

    public function get_user_by_name($first_name, $last_name)
    {
        return $this->db->table('information')
                        ->where('first_name', $first_name)
                        ->where('last_name', $last_name)
                        ->get();
    }

    public function get_user_by_email($email)
    {
        return $this->db->table('information')
                        ->where('email', $email)
                        ->get();
    }

    public function update_password($user_id, $new_password) 
    {
        return $this->db->table('information')
                        ->where('id', $user_id)
                        ->update([
                            'password' => password_hash($new_password, PASSWORD_DEFAULT)
                        ]);
    }

    public function get_all_users()
    {
        return $this->db->table('information')->get_all();
    }

    public function get_logged_in_user()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user']['id'])) {
            return $this->get_user_by_id($_SESSION['user']['id']);
        }

        return null;
    }

    public function page($q, $records_per_page = null, $page = null) {
        if (is_null($page)) {
            return $this->db->table('information')->get_all();
        } else {
            $query = $this->db->table('information');

            // Build LIKE conditions
            $query->like('id', '%'.$q.'%')
                ->or_like('first_name', '%'.$q.'%')
                ->or_like('last_name', '%'.$q.'%')
                ->or_like('email', '%'.$q.'%');

            // Clone before pagination
            $countQuery = clone $query;

            $data['total_rows'] = $countQuery->select_count('*', 'count')
                                            ->get()['count'];

            $data['records'] = $query->pagination($records_per_page, $page)
                                    ->get_all();

            return $data;
        }
    }
}
