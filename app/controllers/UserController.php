<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UserController
 */
class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function UsersData()
    {
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10;

        $users = $this->UsersModel->page($q, $records_per_page, $page);
        $data['users'] = $users['records'];
        $total_rows = $users['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap'); 
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);
        $data['page'] = $this->pagination->paginate();

        // ✅ Pass logged in user to view
        $data['logged_in_user'] = $this->UsersModel->get_logged_in_user();

        $this->call->view('users/UsersData', $data);
    }

    function create(){
        if($this->io->method() == 'post'){
            $first_name = $this->io->post('first_name');
            $last_name = $this->io->post('last_name');
            $email = $this->io->post('email');
            $password = password_hash($this->io->post('password'), PASSWORD_BCRYPT);
            $role = $this->io->post('role'); // ✅ choose admin/user

            $data = [
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'email'      => $email,
                'password'   => $password,
                'role'       => $role
            ];

            if($this->UsersModel->insert($data)){
                redirect(site_url('users'));
            }else{
                echo "Error in creating user.";
            }
        }else{
            $this->call->view('users/create');
        }
    }

function update($id)
{
    // Fetch the user to be edited
    $user = $this->UsersModel->find($id);
    if (!$user) {
        echo "User not found.";
        return;
    }

    // Get logged-in user from session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $logged_in_user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

    if ($this->io->method() === 'post') {
        $first_name = $this->io->post('first_name');
        $last_name  = $this->io->post('last_name');
        $email      = $this->io->post('email');

        // Default data (for all users)
        $data = [
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'email'      => $email
        ];

        // Only allow admin to update role + password
        if (!empty($logged_in_user) && $logged_in_user['role'] === 'admin') {
            $role = $this->io->post('role');
            $data['role'] = $role;

            if (!empty($this->io->post('password'))) {
                $data['password'] = password_hash($this->io->post('password'), PASSWORD_BCRYPT);
            }
        }

        if ($this->UsersModel->update($id, $data)) {
            redirect('users');
        } else {
            echo "Error in updating user.";
        }
    } else {
        // Pass both the user being edited and the logged-in user to the view
        $data['user'] = $user;
        $data['logged_in_user'] = $logged_in_user;
        $this->call->view('users/update', $data);
    }
}

    
    function delete($id){
        if($this->UsersModel->delete($id)){
            redirect('users');
        }else{
            echo "Error in deleting user.";
        }
    }

    public function register()
    {
        $this->call->model('UsersModel'); 

        if ($this->io->method() == 'post') {
            $first_name = $this->io->post('first_name');
            $last_name  = $this->io->post('last_name');
            $email      = $this->io->post('email');
            $password   = password_hash($this->io->post('password'), PASSWORD_BCRYPT);
            $role       = $this->io->post('role'); // ✅ choose admin/user

            $data = [
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'email'      => $email,
                'password'   => $password,
                'role'       => $role
            ];

            if ($this->UsersModel->insert($data)) {
                redirect('/auth/login');
            } else {
                echo "Error in registration.";
            }
        }

        $this->call->view('auth/register');
    }

    public function login() {
        if ($this->io->method() === 'post') {
            $email    = $this->io->post('email');
            $password = $this->io->post('password');

            $this->call->model('UsersModel');
            $user = $this->UsersModel->get_user_by_email($email);

            if ($user && isset($user['password'])) {
                if (password_verify($password, $user['password'])) {
                    // Save session
                    $_SESSION['user'] = [
                        'id'         => $user['id'],
                        'first_name' => $user['first_name'],
                        'last_name'  => $user['last_name'],
                        'email'      => $user['email'],
                        'role'       => $user['role']
                    ];
                    redirect('users'); // success
                } else {
                    $error = "Incorrect password!";
                }
            } else {
                $error = "User not found!";
            }
        }

        $this->call->view('auth/login', isset($error) ? ['error' => $error] : []);
    }

    public function dashboard()
    {
        $this->call->model('UsersModel');
        $data['user'] = $this->UsersModel->get_all_users();

        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10;
        $user = $this->UsersModel->page($q, $records_per_page, $page);
        $data['user'] = $user['records'];
        $total_rows = $user['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/dashboard', $data);
    }

    public function logout()
    {
        $this->call->library('auth');
        $this->auth->logout();
        redirect('auth/login');
    }
}
