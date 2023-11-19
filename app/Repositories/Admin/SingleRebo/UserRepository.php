<?php

namespace App\Repositories\Admin\SingleRebo;

//use App\Http\Requests\Admin\CityRequest;


use App\Http\Requests\Admin\PlaceEditRequest;
use App\Http\Requests\Admin\PlaceRequest;
use App\Models\Compilation;
use App\Models\Message;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\RestaurantWallet;
use App\Models\Review;
use App\Models\Vendor;
use App\Models\WithdrawRequest;
use App\Modules\Core\Helper;
use App\Repositories\Admin\BaseRepository;
use App\Traits\UploadAttachTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;

class  UserRepository extends BaseRepository
{


    public function __construct()
    {
        parent::__construct(new Order());

    }

  /*  public function change_status($id,$status){
        $this->model->where('id',$id)->update(['status'=>$status]);
    }*/


}
