<?php

namespace App\Repositories\Api;

use App\Http\Resources\Api\PopularRestaurantResource;
use App\Interfaces\Api\RestaurantInterface;
use App\Models\Category;
use App\Models\Food;
use App\Models\Restaurant;
use App\Modules\Core\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantRepository implements RestaurantInterface
{

    public function get_restaurant($zone_ids, $filter_data, $limit , $offset, $location)
    {

        // TODO: Implement get_restaurant() method.

        DB::enableQueryLog();
        $paginator = Restaurant::
            withOpen()->
             whereIn('zone_id', $zone_ids)
            ->Active();
          //  ->type($type)
        if($location!=[]) {
            $paginator = $paginator->WithLocation($location);
            if (($filter_data != []) && ($filter_data != "all")) {
                foreach ($filter_data as $filter_item => $value) {
                    $paginator=$paginator->where($filter_item, $value);

                }
            }
        }
         /* whereHas(function ($query) use($location){
              if($location['lat'] !== null && $location['lng'] !== null){

                  //$query->whereHas('address', function($query) use ($data) {

                  //  });
              }
          })*/
           // ->where('distance','<',10)
            //->orderBy('distance', 'desc')
           // ->orderBy('open', 'desc')
        $paginator=$paginator->orderBy('created_at', 'desc');
          $paginator1=  $paginator->paginate($limit, ['*'], 'page', $offset);

        $result1=Helper::restaurant_data_formatting($paginator1,true);
            //$query = DB::getQueryLog();
            //print_r($query);exit;
       // if(count($paginator->items())==0)
         //   return [];
        /*$paginator->count();*/
        return PopularRestaurantResource::collection($result1);
       /* return [
            'total_size' => $paginator1->total(),
            'limit' => $limit,
            'offset' => $offset,
            'restaurants' => $paginator1->items()
        ];*/
    }

    public function get_popular($zone_ids,$filter_data, $limit , $offset,$location)
    {
        // TODO: Implement get_popular() method.
     //   DB::enableQueryLog();
        $paginator = Restaurant::withOpen()
            /*->with(['discount'=>function($q){
                return $q->validate();
            }])*/->whereIn('zone_id', $zone_ids)

            ->Active();
        if($location!=[])
            $paginator->WithLocation($location);
           $result= $paginator->withCount('orders')
            ->orderBy('open', 'desc')
            ->orderBy('orders_count', 'desc')
            ->limit($limit)
            ->get();
        $result1=Helper::restaurant_data_formatting($result, true);
        return  PopularRestaurantResource::collection($result1);
      //  $query = DB::getQueryLog();
//print_r($query);exit;
        // ->paginate($limit, ['*'], 'page', $offset);
        /*$paginator->count();*/

    }
    public  function get_details($id)
    {
        // TODO: Implement get_details() method.
        $restaurant= Restaurant::with([/*'discount'=>function($q){
            return $q->validate();
        }, 'campaigns',*/ 'schedules'])->withOpen()->active()->whereId($id)->first();

        if($restaurant)
        {

            DB::enableQueryLog();
            $category_ids = DB::table('food')
                ->join('categories', 'food.category_id', '=', 'categories.id')
                ->selectRaw('IF((categories.position = "0"), categories.id, categories.parent_id) as categories')
                ->where('food.restaurant_id', $id)
                ->where('categories.status',1)
                ->groupBy('categories')
                ->get();

             //dd($category_ids->pluck('categories'));
            $restaurant = Helper::restaurant_data_formatting($restaurant);
            $restaurant['category_ids'] = array_map('intval', $category_ids->pluck('categories')->toArray());

        }
       // return($restaurant);
        return new PopularRestaurantResource($restaurant);
    }

    public function get_latest($zone_ids,$filter_data,$limit,$location)
    {

        // TODO: Implement get_latest() method.
        DB::enableQueryLog();
        $restaurants= Restaurant::
        //   withOpen()
        whereIn('zone_id', $zone_ids)
            ->Active()
            //  ->type($type)
            ->WithLocation($location)
            /* whereHas(function ($query) use($location){
                 if($location['lat'] !== null && $location['lng'] !== null){

                     //$query->whereHas('address', function($query) use ($data) {

                     //  });
                 }
             })*/
            // ->where('distance','<',10)
            ->limit($limit)
            ->orderBy('created_at', 'desc')
            // ->orderBy('open', 'desc')

            ->get();

            return($restaurants);
    }


}
