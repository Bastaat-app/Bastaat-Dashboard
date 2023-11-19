<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Compilation;
use App\Models\Zone;

use App\Repositories\Admin\SingleRebo\CustomerRepository;


use App\Traits\UploadAttachTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Restaurant;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;

class CustomerController extends BaseController
{

    protected $view;
    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        parent::__construct($repository);
        $this->view = 'admin-views.customer';

    }
    public function index(Request $request, $with = [], $withCount = [], $filter = '', $paginate = 10, $whereHas = [])
    {


       $users= parent::index($request,[], ['orders'], '', 10, []);

        return view($this->view . '.index', compact('users'));
    }



    public  function details(Request $request,$id){

       $user= parent::index($request,['orders'=>function ($query) use($id) {$query->with('restaurant');},'addresses'],['orders'],'id|' . $id . '|=','');
        if(isset($user[0]))
        $user=$user[0];
//print_r($user);exit;
       return view($this->view . '.view', compact('user'));
    }

}
