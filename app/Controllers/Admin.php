<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use App\Libraries\Email;
use App\Libraries\Slug;
use App\Libraries\Maintenance;
use App\Models\BoardModel;
use App\Models\AdminModel;
use App\Models\ReportedPostsModel;
use App\Models\BannedModel;
use App\Models\UserModel;

$session = \Config\Services::session();
helper('form');
helper('text');
helper('array');
helper('url');
class Admin extends BaseController

{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            echo view('admin/header/index');
            echo view('admin/dashboard/index');
            echo view('footer/index');
        }
    }

    public function reportedPosts()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {

            echo view('admin/header/index');
            echo view('admin/reportedposts/index');
            echo view('footer/index');
        }
    }
    public function actionReportedPost()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            $ReportedPostsModel = new ReportedPostsModel;
            $data = [
                'report_id' => $this->request->getVar('report_id'),
                'post_id' => $this->request->getVar('post_id'),
                'length' => $this->request->getVar('length'),
                'action' => $this->request->getVar('action'),
                'count' => $ReportedPostsModel->select('COUNT(*) as count')->where('action', 'o')->findAll(),

            ];
            echo view('admin/header/index', $data);
            echo view('admin/reportedposts/action', $data);
            echo view('footer/index');
        }
    }

    public function resolveReportedPost()
    {

        $ReportedPostsModel = new ReportedPostsModel();
        $BoardModel = new BoardModel();
        $BannedModel = new BannedModel();
        $report_id = $this->request->getVar('report_id');
        $post_id = $ReportedPostsModel->getPostID($report_id);
        $ban_text = $this->request->getVar('ban_text');

        if ($_POST['length'] == 'null') {

            if ($_POST['action'] == 'y') {
                $ReportedPostsModel->closeReport($post_id);
                $BoardModel->deleteReportedPost($post_id);

                return redirect()->to('/admin/reportedPosts');
            } else {
                $ReportedPostsModel->closeReport($post_id);
                return redirect()->to('/admin/reportedPosts');
            }
        } elseif ($_POST['length'] == 'day') {
            if ($_POST['action'] == 'y') {
                $length = ' +1 day';
                $ip_address = $BoardModel->getIPAddress($post_id);
                $BannedModel->banClient($ip_address, $ban_text, $length);
                $ReportedPostsModel->closeReport($post_id);
                $BoardModel->deleteReportedPost($post_id);

                return redirect()->to('/admin/reportedPosts');
            } else {

                $ReportedPostsModel->closeReport($post_id);
                return redirect()->to('/admin/reportedPosts');
            }
        } elseif ($_POST['length'] == 'week') {
            if ($_POST['action'] == 'y') {
                $ip_address = $BoardModel->getIPAddress($post_id);
                $length = ' +7 days';
                $BannedModel->banClient($ip_address, $ban_text, $length);
                $ReportedPostsModel->closeReport($post_id);
                $BoardModel->deleteReportedPost($post_id);

                return redirect()->to('/admin/reportedPosts');
            } else {
                $ReportedPostsModel->closeReport($post_id);
                return redirect()->to('/admin/reportedPosts');
            }
        } elseif ($_POST['length'] == 'month') {
            if ($_POST['action'] == 'y') {
                $ip_address = $BoardModel->getIPAddress($post_id);
                $length = ' +30 days';
                $$BannedModel->banClient($ip_address, $ban_text, $length);
                $ReportedPostsModel->closeReport($post_id);
                $BoardModel->deleteReportedPost($post_id);

                return redirect()->to('/admin/reportedPosts');
            } else {
                $ReportedPostsModel->closeReport($post_id);
                return redirect()->to('/admin/reportedPosts');
            }
        } elseif ($_POST['length'] == 'permanent') {
            if ($_POST['action'] == 'y') {
                $ip_address = $BoardModel->getIPAddress($post_id);
                $length = ' +99 years';
                $BannedModel->banClient($ip_address, $ban_text, $length);
                $ReportedPostsModel->closeReport($post_id);
                $BoardModel->deleteReportedPost($post_id);

                return redirect()->to('/admin/reportedPosts');
            } else {
                $ReportedPostsModel->closeReport($post_id);
                return redirect()->to('/admin/reportedPosts');
            }
        }
    }

    public function users()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            echo view('admin/header/index');
            echo view('admin/users/index');
            echo view('footer/index');
        }
    }


    public function boards()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            echo view('admin/header/index');
            echo view('admin/boards/index');
            echo view('footer/index');
        }
    }
    public function addUser()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            $options =
                [
                    'cost' => 12,
                ];
            $boards = implode(", ", $this->request->getVar('boards'));
            $UserModel = new UserModel();
            $data = [
                'admin_email' => $this->request->getVar('admin_email'),
                'admin_username' => $this->request->getVar('admin_username'),
                'admin_first_name' => $this->request->getVar('admin_first_name'),
                'admin_last_name' => $this->request->getVar('admin_last_name'),
                'admin_rights' => $boards,
                'admin_password' => password_hash($this->request->getVar('admin_password'), PASSWORD_BCRYPT, $options),
                'active' => 'y'
            ];
            $UserModel->insert($data);
            return redirect()->to('/admin/users');
        }
    }
    public function permissions()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            $options =
                [
                    'cost' => 12,
                ];
            $AdminModel = new AdminModel();
            $BoardModel = new BoardModel();
            $board_ids = $BoardModel->pullAdditionalBoard();
            $board_ids = json_decode(json_encode($board_ids), true);
            $users = $AdminModel->pullUsers();

            if ($this->request->getMethod() == 'post') {
                $rules = [
                    'admin_email' => 'required|valid_email',
                    'admin_username' => 'required|max_length[255]',
                    'admin_first_name' => 'required|max_length[255]',
                    'admin_last_name' => 'required|max_length[255]',
                    'admin_password' => 'required|max_length[255]',
                ];

                if ($this->validate($rules)) {
                    $data = [
                        'admin_email' => $this->request->getVar('admin_email'),
                        'admin_username' => $this->request->getVar('admin_username'),
                        'admin_first_name' => $this->request->getVar('admin_first_name'),
                        'admin_last_name' => $this->request->getVar('admin_last_name'),
                        'admin_rights' => $this->request->getVar('admin_rights'),
                        'admin_password' => password_hash($this->request->getVar('admin_password'), PASSWORD_BCRYPT, $options),
                        'active' => 'y'
                    ];
                    $AdminModel->insert($data);
                    return redirect()->to('/admin/users');
                } else {

                    $data = [
                        'boards' => $board_ids,
                        'users' => $users,
                        'validator' => $this->validator,

                    ];
                    echo view('admin/header/index');
                    echo view('admin/users/index', $data);
                    echo view('footer/index');
                }
            }
        }
    }

    public function addBoard()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            helper(['form']);
            //Slug config
            $config = array(
                'field' => 'board_slug',
                'title' => 'board_title',
                'table' => 'boards',
                'id' => 'board_id',
            );
            $Slug = new Slug($config);
            $AdminModel = new AdminModel();
            if ($this->request->getMethod() == 'post') {
                $rules = [
                    'board_name' => 'required|max_length[3]',
                    'board_title' => 'required|max_length[255]',
                ];

                if ($this->validate($rules)) {
                    $data = [
                        'board_name' => $this->request->getVar('board_name'),
                        'board_title' => $this->request->getVar('board_title'),
                        'board_slug' => $Slug->create_uri(['board_title' => $this->request->getVar('board_title')])
                    ];

                    $AdminModel->insert($data);
                    return redirect()->to('/admin/boards');
                }
            }
        }
    }

    public function modifyBoard()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            $AdminModel = new AdminModel();
            //Slug config
            $config = array(
                'field' => 'board_slug',
                'title' => 'board_title',
                'table' => 'boards',
                'id' => 'board_id',
            );
            $Slug = new Slug($config);
            $data = [
                'board_title' => $this->request->getPost('board_title'),
                'board_slug' => $Slug->create_uri(['board_title' => $this->request->getVar('board_title')])
            ];
            $board_id = $this->request->getPost('board_id');
            $AdminModel->update($board_id, $data);
            return redirect()->to('/admin/boards');
        }
    }


    public function deleteBoard()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {

            $AdminModel = new AdminModel();
            $BoardModel = new BoardModel();
            $board_id = $this->request->getVar('board_id');
            if ($this->request->getPost('purge') == 'true') {
                $maintenance = new Maintenance();
                $maintenance->cleanUpAdmin($board_id);
            }

            $AdminModel->delete($board_id);
            return redirect()->to('/admin/boards');
        }
    }

    public function reported_posts_ajax()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('login/index');
            echo view('footer/index');
        } else {
            if ($this->request->isAJAX()) {
                $ReportedPostsModel = new ReportedPostsModel();

                $reported_posts = $ReportedPostsModel->select('reported_posts.report_id, reported_posts.post_id, reported_posts.board_id, reported_posts.action, reported_posts.ip_address, reported_posts.created_at, op_posts.post_title, op_posts.post_text')->join('op_posts', 'reported_posts.post_id = op_posts.post_id', 'left');
                return json_encode($reported_posts);
            }
        }
    }
    public function boardsAjax()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('login/index');
            echo view('footer/index');
        } else {
            if ($this->request->isAJAX()) {
                $AdminModel = new AdminModel();
                $data = [
                    'boards' => $AdminModel->select('board_name, board_id, board_title')->orderBy('boards.board_name ASC')->findAll(),
                ];
                return json_encode($data);
            }
        }
    }
    public function UsersAjax()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            if ($this->request->isAJAX()) {
                $UserModel = new UserModel;
                $AdminModel = new AdminModel();
                $users = $UserModel->select('*')->findAll();
                $counter = count($users);
                for ($c = 0; $c < $counter; $c++) {
                    $users[$c]['permissions'] = explode(', ', $users[$c]['mod_permissions']);
                    $users[$c]['board'] = $AdminModel->select('*')->whereIn('board_id', $users[$c]['permissions'])->findAll();
                }
                $data = [
                    'users' => $users
                ];
                return json_encode($data);
            } else {
                echo 'direct access forbidden';
            }
        }
    }


    public function modal()
    {
        if (session()->get('isLoggedIn')) {
            $AdminModel = new AdminModel();
            if ($this->request->getGet('action') == 'add') {
                echo view('modals/add-board');
            } else {
                $data = [
                    'details' => $AdminModel->asObject()->select('boards.board_id, boards.board_name, boards.board_title, categories.category_name')->join('categories', 'categories.category_id = boards.category_id', 'left')->orderBy('categories.category_name ASC')->findAll(),
                ];
                echo view('modals/' . $this->request->getGet('action') . '-board', $data);
            }
        }
    }

    public function modalUsers()
    {
        if (session()->get('isLoggedIn')) {
            $AdminModel = new AdminModel();
            $BoardModel = new BoardModel();
            $UserModel = new UserModel;
            $data = array();

            if ($this->request->getGet('action') == 'info') {
                $data = [
                    'details' => $UserModel->select('*')->where('admin_id', $this->request->getGet('id'))->findAll(),
                ];
            } elseif ($this->request->getGet('action') == 'add') {
                $data = [
                    'boards' => $AdminModel->select(['board_id', 'board_name'])->findAll(),
                ];
            } elseif ($this->request->getGet('action') == 'edit') {
                $data = [
                    'details' => $UserModel->select('*')->findAll(),
                    'boards' => $AdminModel->select('*')->findAll(),
                ];
            } elseif ($this->request->getGet('action') == 'delete') {
                $data = [
                    'details' => $UserModel->select('*')->findAll(),
                ];
            }
            echo view('modals/' . $this->request->getGet('action') . '-user', $data);
        }
    }
    public function modifyUser()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            $UserModel = new UserModel();
            $admin_id = $this->request->getPost('admin_id');
            $boards = [
                'mod_permissions' => implode(", ", $this->request->getPost('boards'))
            ];
            $UserModel->update($admin_id, $boards);
            return redirect()->to('/admin/users');
        }
    }


    public function logout()
    {
        session_destroy();
        return redirect()->to('/admin');
    }

    public function ajaxReportedPosts()
    {
        if (!session()->get('isLoggedIn')) {
            echo view('header/index');
            echo view('admin/login/index');
            echo view('footer/index');
        } else {
            if ($this->request->isAJAX()) {
                $board_ids = explode(", ", session()->mod_permissions);
                $ReportedPostsModel = new ReportedPostsModel;
                $data = [
                    'count' => $ReportedPostsModel->select('*')->whereIn('board_id', $board_ids)->where('action', 'o')->findAll()
                ];
                return json_encode($data);
            } else {
                echo 'direct access forbidden';
            }
        }
    }
}
