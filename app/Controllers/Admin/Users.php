<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        helper("Admin/admin");
        $users = $this->userModel->orderBy('created_at','ASC')->paginate(3);

        return view('Admin\Users\index', [
            'users' => $users,
            'pager' => $this->userModel->pager,
        ]);
    }

    public function show($id)
    {
        $user = $this->getUserOr404($id);

        return view('Admin\Users\show', [
            'user' => $user,
        ]);
    }

    public function toggleBan($id)
    {
        $user = $this->getUserOr404($id);

        $user->isBanned() ? $user->unBan() : $user->ban();

        return redirect()->back()->with('message', 'User has been change ban status');
    }

    public function groups($id)
    {
        $user = $this->getUserOr404($id);

        if ($this->request->is('post')) {
            $groups = $this->request->getPost('groups') ?? [];
            $user->syncGroups(...$groups);
            return redirect()->to("admin/users/$id")->with('message', 'User groups have been updated');
        }

        return view('Admin\Users\groups', [
            'user' => $user,
        ]);
    }

    public function permissions($id)
    {
        $user = $this->getUserOr404($id);

        if ($this->request->is('post')) {
            $permissions = $this->request->getPost('permissions') ?? [];
            $user->syncPermissions(...$permissions);
            return redirect()->to("admin/users/$id")->with('message', 'User permnissions have been updated');
        }

        return view('Admin\Users\permissions', [
            'user' => $user,
        ]);
    }

    private function getUserOr404($id): User
    {
        $user = $this->userModel->find($id);

        if ($user === null) {
            throw new PageNotFoundException("Cannot find the user: $id");
        }

        return $user;
    }
}
