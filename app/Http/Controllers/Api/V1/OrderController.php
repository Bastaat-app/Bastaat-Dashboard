<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CancleOrderRequest;
use App\Http\Requests\Api\ListOrderRequest;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Requests\Api\TrackOrderRequest;
use App\Modules\Core\HTTPResponseCodes;
use App\Repositories\Api\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function cart_order(OrderRequest $request)
    {


        try {
            $cart=new OrderRepository();
            $cart = $cart->cart_order($request);
            if($cart==true)
            return response()->json([
                'status' => HTTPResponseCodes::Sucess['status'],
                'message'=>HTTPResponseCodes::Sucess['message'],
                'errors' => [],
                'data' => [],
                'code'=>HTTPResponseCodes::Sucess['code']
            ],HTTPResponseCodes::Sucess['code']);

       } catch (\Exception $e) {
            return response()->json([
                'status' =>false,
                'errors'=>__('error when retrieve data'),
                'message' =>HTTPResponseCodes::BadRequest['message'],
                'code'=>HTTPResponseCodes::BadRequest['code']
            ],HTTPResponseCodes::Sucess['code']);
        }
    }

     public function get_pervious_address(Request $request){

         $user_id=Auth('api')->user()->id;


       //  try {
             $pervious_add=new OrderRepository();
             $address=$pervious_add->get_pervious_address($user_id);
             return response()->json([
                 'status' => HTTPResponseCodes::Sucess['status'],
                 'message'=>HTTPResponseCodes::Sucess['message'],
                 'errors' => [],
                 'data' => $address,
                 'code'=>HTTPResponseCodes::Sucess['code']
             ],HTTPResponseCodes::Sucess['code']);

        /* } catch (\Exception $e) {
             return response()->json([
                 'status' =>false,
                 'errors'=>__('error when retrieve data'),
                 'message' =>HTTPResponseCodes::BadRequest['message'],
                 'code'=>HTTPResponseCodes::BadRequest['code']
             ],HTTPResponseCodes::Sucess['code']);
         }*/
     }
     public function track_order(TrackOrderRequest $request){


        $order_id=$request->order_id;
        $user_id=$request->user_id;
       // try {
            $track = new OrderRepository();
            $order_track = $track->track_order($order_id, $user_id);
            if ($order_track == false) {
                return response()->json([
                    'status' => false,
                    'errors' => __('error when retrieve data'),
                    'message' => HTTPResponseCodes::BadRequest['message'],
                    'code' => HTTPResponseCodes::BadRequest['code']
                ], HTTPResponseCodes::Sucess['code']);
            }

            return response()->json([
                'status' => HTTPResponseCodes::Sucess['status'],
                'message' => HTTPResponseCodes::Sucess['message'],
                'errors' => [],
                'data' => $order_track,
                'code' => HTTPResponseCodes::Sucess['code']
            ], HTTPResponseCodes::Sucess['code']);
        //}
        /* } catch (\Exception $e) {
             return response()->json([
                 'status' =>false,
                 'errors'=>__('error when retrieve data'),
                 'message' =>HTTPResponseCodes::BadRequest['message'],
                 'code'=>HTTPResponseCodes::BadRequest['code']
             ],HTTPResponseCodes::Sucess['code']);
         }*/

     }

     public function list_(ListOrderRequest $request){

        $user_id=auth('api')->user()->id;
        try {
            $list_obj = new OrderRepository();
            $list = $list_obj->list_($request, $user_id);
            return response()->json([
                'status' => HTTPResponseCodes::Sucess['status'],
                'message' => HTTPResponseCodes::Sucess['message'],
                'errors' => [],
                'data' => $list,
                'code' => HTTPResponseCodes::Sucess['code']
            ], HTTPResponseCodes::Sucess['code']);
       } catch (\Exception $e) {
             return response()->json([
                 'status' =>false,
                 'errors'=>__('error when retrieve data'),
                 'message' =>HTTPResponseCodes::BadRequest['message'],
                 'code'=>HTTPResponseCodes::BadRequest['code']
             ],HTTPResponseCodes::Sucess['code']);
         }

     }

     public function cancel_order(CancleOrderRequest $request){
        try {
            $obj = new OrderRepository();
            $cancle = $obj->cancel_order($request->order_id);
            if ($cancle == false)
                return response()->json([
                    'status' => false,
                    'errors' => __('order is procced'),
                    'message' => HTTPResponseCodes::InvalidArguments['message'],
                    'code' => HTTPResponseCodes::InvalidArguments['code']
                ], HTTPResponseCodes::Sucess['code']);
            return response()->json([
                'status' => HTTPResponseCodes::Sucess['status'],
                'message' => HTTPResponseCodes::Sucess['message'],
                'errors' => [],
                'data' => $cancle,
                'code' => HTTPResponseCodes::Sucess['code']
            ], HTTPResponseCodes::Sucess['code']);
        } catch (\Exception $e) {
            return response()->json([
                'status' =>false,
                'errors'=>__('error when retrieve data'),
                'message' =>HTTPResponseCodes::BadRequest['message'],
                'code'=>HTTPResponseCodes::BadRequest['code']
            ],HTTPResponseCodes::Sucess['code']);
        }
     }


}

