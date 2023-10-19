<?php

namespace App\Repositories\Api;


use App\Interfaces\Api\OrderInterface;
use App\Models\Coupon;
use App\Models\CustomerAddress;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Restaurant;
use App\Modules\Core\Helper;
use App\Modules\Core\HTTPResponseCodes;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Stripe\OrderItem;

class OrderRepository implements OrderInterface
{
    public function cart_order($request)
    {

        // TODO: Implement cart_order() method.

        $schedule_at = now();


        $restaurant = Restaurant::selectRaw('*, IF(((select count(*) from `restaurant_schedule` where `restaurants`.`id` = `restaurant_schedule`.`restaurant_id` and `restaurant_schedule`.`day` = '.$schedule_at->format('w').' and `restaurant_schedule`.`opening_time` < "'.$schedule_at->format('H:i:s').'" and `restaurant_schedule`.`closing_time` >"'.$schedule_at->format('H:i:s').'") > 0), true, false) as open')->where('id', $request->restaurant_id)->first();

       /* if($restaurant->open == false)
        {
            echo "kjkj"; exit;
            return response()->json([
                'status' =>HTTPResponseCodes::InvalidArguments['status'],
                'message' => trans('messages.restaurant_is_closed_at_order_time'),
                'errors' => [],

                'code'=>HTTPResponseCodes::InvalidArguments['code']
            ],HTTPResponseCodes::InvalidArguments['code']);

        }*/

             // start cupon
      /*  if ($request['coupon_code']) {
            $coupon = Coupon::active()->where(['code' => $request['coupon_code']])->first();
            if (isset($coupon)) {
                $staus = Helper::is_valide($coupon, $request->user()->id ,$request['restaurant_id']);
                if($staus==407)
                {
                    return response()->json([
                        'errors' => [
                            ['code' => 'coupon', 'message' => trans('messages.coupon_expire')]
                        ]
                    ], 407);
                }
                else if($staus==406)
                {
                    return response()->json([
                        'errors' => [
                            ['code' => 'coupon', 'message' => trans('messages.coupon_usage_limit_over')]
                        ]
                    ], 406);
                }
                else if($staus==404)
                {
                    return response()->json([
                        'errors' => [
                            ['code' => 'coupon', 'message' => trans('messages.not_found')]
                        ]
                    ], 404);
                }
                if($coupon->coupon_type == 'free_delivery')
                {
                    $delivery_charge = 0;
                    $coupon = null;
                    $free_delivery_by = 'admin';
                }
            } else {
                return response()->json([
                    'errors' => [
                        ['code' => 'coupon', 'message' => trans('messages.not_found')]
                    ]
                ], 401);
            }
        }*/
            // end cupon


        if($request['order_type'] == 'take_away')
        {
            $shipping_coast=0;
        }else{
            $shipping_coast=$restaurant->shipping_coast;
        }
        if(isset($request['address']))
        {
            $user_id=Auth('api')->user()->id;

            $address_data=json_decode($request['address']);
           $address_data->user_id= $user_id;//array('user_id'=>$user_id,'contact_person_number'=>'ahmed','address'=>'tiyleklj','contact_person_name'=>'contact_person_name','floor'=>'floor','road','house'=>'house');



            $order_address=CustomerAddress::insert((array)$address_data);


        } else
            {
            $order_address=$request->address_id;
        }
        $coupon_discount_amount=0;
        DB::beginTransaction();
        try {
            $order = new Order();
            $order->user_id = auth('api')->user()->id;
            $order->order_amount = $request['order_amount'];
            $order->coupon_discount_amount = $coupon_discount_amount;
            if (isset($request['address'])) {
                $order->delivery_address_id = $order_address->id;
            } else {
                $order->delivery_address_id = $order_address;
            }
            $order->order_note = $request->order_note;
            $order->restaurant_id = $request->restaurant_id;
            $order->delivery_charge = $shipping_coast;
            $order->payment_method = $request->payment_method;
            $order->save();

            $last_order = $order->id;


            $cart_items = (array) $request->cart_items;//array('food_id' => 1, 'quantity' => 2, 'price' => 80));

            foreach ($cart_items as $key => $value) {
                $food = food::where('id',$value['food_id'])->first();
                $order_item = new OrderDetail();
                $order_item->food_id=$food['id'];
                $order_item->food_details = json_encode($food);
                $order_item->quantity = $value['quantity'];
                $order_item->price = $value['price'];
                $order_item->order_id = $last_order;
                $order_item->save();
            }
            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' =>false,
                'errors'=>__('error when retrieve data'),
                'message' =>HTTPResponseCodes::BadRequest['message'],
                'code'=>HTTPResponseCodes::BadRequest['code']
            ],HTTPResponseCodes::Sucess['code']);
          //  return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            // something went wrong
        }
    }


    public function get_pervious_address($user_id)
    {
        // TODO: Implement get_pervious_address() method.

      return   CustomerAddress::where('user_id',$user_id)->get();
    }
    public function track_order($order_id,$user_id)
    {
        // TODO: Implement track_order() method.
        $order = Order::with(['restaurant'])->withCount('details')->where(['id' => $order_id, 'user_id' => $user_id])->first();
        if ($order) {
            $order['restaurant'] = $order['restaurant'] ? Helper::restaurant_data_formatting($order['restaurant']) : $order['restaurant'];
            $order['delivery_address'] = $order['delivery_address']?json_decode($order['delivery_address']):$order['delivery_address'];
        } else {
            return false;
        }

        return ($order);
    }


    public function list_($request, $user_id)
    {
        // TODO: Implement list() method.

        $order = Order::with(['restaurant'])->where (function ($query) use($request){
            if($request->has('current_order')&& ($request->current_order==1)){
                $query->whereIn('order_status',array('pending','processing','picked_up'));
            }else{
                $query->whereIn('order_status',array('delivered','canceled'));
            }


        })->where('user_id' , $user_id)
           -> withCount('details')
        ->paginate($request->limit, ['*'], 'page', $request->offset);

        return [
            'total_size' =>$order->total(),
            'limit' => $request->limit,
            'offset' =>  $request->offset,
            'restaurants' => $order->items()
        ];

    }

    public function cancel_order($order_id)
    {
        // TODO: Implement cancle_order() method.
           $order= Order::with(['restaurant'])->where(['id'=>$order_id,'order_status'=>'pending'])->first();
           if(!$order)
           return false;

          Order::where('id',$order_id)->update(['order_status'=>'canceled','canceled'=>now()]);
           return $order;
    }


}
