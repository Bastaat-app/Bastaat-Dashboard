<?php

namespace App\Repositories\Api;



use App\Interfaces\Api\ReviewInterface;
use App\Models\Review;

class ReviewRepository implements ReviewInterface
{

  public function review($restaurant_id)
  {
      // TODO: Implement Review() method.
      $reviews = Review::with(['customer', 'food'])
          ->whereHas('food', function($query)use($id){
              return $query->where('restaurant_id', $id);
          })
          ->active()->latest()->get();

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


}
