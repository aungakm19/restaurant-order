<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{   
    public function index()
    {   
        $dishes = Dish::orderBy('id', 'desc')->get();
        $tables = Table::all();
        $raw_status = config('restaurant.order_status');
        $status = array_flip($raw_status);
        $orders = Order::where('status', [4])->get();
        return view('order_form', compact('dishes', 'tables', 'orders', 'status' ));
    }

    public function submit(Request $request)
    {
        $data = array_filter($request->except('_token', 'table'));
        $orderId = rand();

        foreach ($data as $key => $value) {
            if ($value > 1) {
                for ($i = 0; $i < $value; $i++) { 
                    $this->saveOrder($key, $request, $orderId);
                }
            }
            else{
                $this->saveOrder($key, $request, $orderId);
            }
        }
        return redirect('/')->with('message' , 'Order Submitted');
    }

    public function saveOrder($dish_id, $request, $orderId)
    {
        $order = new Order();
        $order->order_id = $orderId;
        $order->dish_id = $dish_id;
        $order->table_id = $request->table;
        $order->status = config('restaurant.order_status.new');

        $order->save();
    }

    public function serve(Order $order)
    {
        $order->status = config('restaurant.order_status.done');
        $order->save();
        return redirect('/')->with('message', 'Order Served To Customer!');
    }
}
