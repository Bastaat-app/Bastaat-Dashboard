<?php

namespace App\Repositories\Api;

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
          //   withOpen()
             whereIn('zone_id', $zone_ids)
            ->Active();
          //  ->type($type)
        if($location!=[])
         $paginator->WithLocation($location);
         /* whereHas(function ($query) use($location){
              if($location['lat'] !== null && $location['lng'] !== null){

                  //$query->whereHas('address', function($query) use ($data) {

                  //  });
              }
          })*/
           // ->where('distance','<',10)
            //->orderBy('distance', 'desc')
           // ->orderBy('open', 'desc')

          $paginator1=  $paginator->paginate($limit, ['*'], 'page', $offset);

           // $query = DB::getQueryLog();
//print_r($query);exit;
       // if(count($paginator->items())==0)
         //   return [];
        /*$paginator->count();*/
        return [
            'total_size' => $paginator1->total(),
            'limit' => $limit,
            'offset' => $offset,
            'restaurants' => $paginator1->items()
        ];
    }

    public function get_popular($zone_ids,$filter_data, $limit , $offset,$location)
    {
        // TODO: Implement get_popular() method.

        $paginator = Restaurant::withOpen()
            /*->with(['discount'=>function($q){
                return $q->validate();
            }])*/->whereIn('zone_id', $zone_ids)

            ->Active();
        if($location!=[])
            $paginator->WithLocation($location);
            $paginator->withCount('orders')
            ->orderBy('open', 'desc')
            ->orderBy('orders_count', 'desc')
            ->limit($limit)
            ->get();
        // ->paginate($limit, ['*'], 'page', $offset);
        /*$paginator->count();*/
        return [
            'total_size' => $paginator->count(),
            'limit' => $limit,
            'offset' => $offset,
            'restaurants' => $paginator
        ];
    }
    public  function get_details($id)
    {
        // TODO: Implement get_details() method.
        $restaurant= Restaurant::with([/*'discount'=>function($q){
            return $q->validate();
        }, 'campaigns',*/ 'schedules'])->active()->whereId($id)->first();
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
        return($restaurant);
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
