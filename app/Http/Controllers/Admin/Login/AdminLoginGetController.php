<?php

namespace App\Http\Controllers\Admin\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Traits\BaseTrait;

//vpx_imports
class AdminLoginGetController extends Controller
{
    use BaseTrait;
    public function __construct()
    {
        $this->middleware(['guest:admin']);
        $this->lang = 'admin.login';
    }

    /**
     * View login page
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {   $data = [];
        if(isset($_GET['pass_changed']) && $_GET['pass_changed']) {
            $data = [
                "success" => [ "Your password changed succesfully, please login to continue"]
            ];
        }
        $data['lang'] = $this->lang;
        return view('admin.pages.login.index')->with('data',$data)->withErrors($data);
    }

    //vpx_attach
}
