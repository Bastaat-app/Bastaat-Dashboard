<?php

namespace App\Repositories\Api;
use App\CentralLogics\Helpers;
use App\Interfaces\Api\BannerInterface;
use App\Interfaces\Api\CategoryInterface;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CategoryRepository implements CategoryInterface
{

    public function list_cats(Request $request)
    {
        // TODO: Implement list_cats() method.
            $categories = Category::where(['position'=>0,'status'=>1])->orderBy('priority','desc')->get();
            return $categories;

    }


    public function get_cat($id)
    {
        // TODO: Implement get_cat() method.
        $category = Category::where('id',$id)->where(['position'=>0,'status'=>1])->orderBy('priority','desc')->get();
        return $category;
    }


}
