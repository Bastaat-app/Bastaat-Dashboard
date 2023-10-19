<?php

namespace App\Repositories\Api;



use App\Interfaces\Api\ReviewInterface;
use App\Models\Restaurant;
use App\Models\Review;
use App\Modules\Core\Helper;

class ReviewRepository implements ReviewInterface
{

  public function review($restaurant_id)
  {
      // TODO: Implement Review() method.
      $reviews = Review::with(['customer', 'food'])
          ->whereHas('food', function($query)use($restaurant_id){
              return $query->where('restaurant_id', $restaurant_id);
          })->active()->latest()->get();

      $storage = [];
      foreach ($reviews as $item) {
          $item['attachment'] = json_decode($item['attachment']);
          $item['food_name'] = null;
          $item['food_image'] = null;
          $item['customer_name'] = null;
          if($item->food)
          {
              $item['food_name'] = $item->food->name;
              $item['food_image'] = $item->food->image;

          }
          if($item->customer)
          {
              $item['customer_name'] = $item->customer->f_name.' '.$item->customer->l_name;
          }

          unset($item['food']);
          unset($item['customer']);
          array_push($storage, $item);
      }

      return response()->json($storage, 200);

  }
  public function add_restaurant_review($request)
  {
      // TODO: Implement add_restaurant_review() method.
       $restaurant_id=$request->restaurant_id;

       $restaurant_old_rating=Restaurant::where('id',$request->restaurant_id)->value('rating');
       $user_rating=$request->rating;
       $update_rate=Helper::update_restaurant_rating($restaurant_old_rating,$user_rating);
        Restaurant::where('id',$request->restaurant_id)->update(['rating'=>$update_rate]);

     /* $update_rate_toarray =(json_decode(json_encode(json_decode($update_rate)), true));

       $cal_data=Helper::calculate_restaurant_rating($update_rate_toarray);

       print_r($cal_data); exit;*/
  }

  public function get_restaurant_review($request)
  {
      // TODO: Implement get_restaurant_review() method.
      $restaurant_old_rating=Restaurant::where('id',$request->restaurant_id)->value('rating');

        $cal_data=Helper::calculate_restaurant_rating( $restaurant_old_rating);

        return($cal_data);
  }


}
