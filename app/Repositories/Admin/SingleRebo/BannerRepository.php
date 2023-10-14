<?php

namespace App\Repositories\Admin\SingleRebo;

//use App\Http\Requests\Admin\CityRequest;
use App\Models\Banner;

use App\Repositories\Admin\BaseRepository;
use Illuminate\Http\Request;

class BannerRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new Banner());
    }

    function setDataPayload(Request $request = null, $type = 'store')
    {
       /* $validate = new CityRequest();
        $request->validate($validate->rules(), [], $validate->attributes());

        return $request->all();*/
    }
}
