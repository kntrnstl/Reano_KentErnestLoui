<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Library: Auth
 * 
 * Modified to use `information` table with first_name and last_name.
 */
class Auth {
    protected $_lava;

    public function __construct()
    {
        // Library initialized
        $this->_lava = lava_instance();
        $this->_lava->call->database();
        $this->_lava->call->library('session');
    }

    /*
     * Register a new user
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $password
     * @param string $role
     * @return bool
     */
    public function register($first_name, $last_name, $email, $password, $role = 'user')
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $this->_lava->db->table('information')->insert([
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'email'      => $email,
            'password'   => $hash,
            'role'       => $role,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /*
     * Login user
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $password
     * @return bool
     */
    public function login($first_name, $last_name, $password)
    {
        $user = $this->_lava->db->table('information')
                         ->where('first_name', $first_name)
                         ->where('last_name', $last_name)
                         ->get();

        if ($user && password_verify($password, $user['password'])) {
            $this->_lava->session->set_userdata([
                'id'         => $user['id'],
                'first_name' => $user['first_name'],
                'last_name'  => $user['last_name'],
                'role'       => $user['role'],
                'logged_in'  => true
            ]);
            return true;
        }

        return false;
    }

    /*
     * Check if user is logged in
     *
     * @return bool
     */
    public function is_logged_in()
    {
        return (bool) $this->_lava->session->userdata('logged_in');
    }

    /*
     * Check user role
     *
     * @param string $role
     * @return bool
     */
    public function has_role($role)
    {
        return $this->_lava->session->userdata('role') === $role;
    }

    /*
     * Logout user
     *
     * @return void
     */
    public function logout()
    {
        $this->_lava->session->unset_userdata(['id','first_name','last_name','role','logged_in']);
    }
}
