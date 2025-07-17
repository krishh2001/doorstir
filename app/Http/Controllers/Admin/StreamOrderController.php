<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StreamOrder;
use App\Models\User;
use App\Models\Service;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class StreamOrderController extends Controller
{
    public function index()
    {   
        $streamOrder = StreamOrder::with(['user:id,name','service'])->get();
        $ServiceProvider = ServiceProvider::all();

        return view('admin.stream_order.index', compact('streamOrder','ServiceProvider'));
    }

     public function userRequestList()
    {
        $user = Auth::user();
        $orders = StreamOrder::where('user_id', $user->id)->get();
    return response()->json([
            'status'=>200,
            'message' => 'Stream Order Request List',
            'streamOrder' => $orders,
        ], 200);

        
    }

    public function userRequestStreamOrder(Request $request)
    {
        $user_id = Auth::id();

        $validated = $request->validate([
            'service_id' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        // Generate unique order ID
        // $orderId = '#ORD' . strtoupper(uniqid());

        $streamOrder = StreamOrder::create([
            // 'order_id'   => $orderId,
            'user_id'    => $user_id,
            'service_id'    => $request->service_id,
            'date_time'  => $request->date, // make sure your DB column is named 'date_time'
        ]);
        $streamOrder->order_id = '#ORD' . str_pad($streamOrder->id, 3, '0', STR_PAD_LEFT);
        $streamOrder->save();
        return response()->json([
            'message' => 'Stream Order Request Successful',
            'streamOrder' => $streamOrder,
        ], 200);
    }

    public function create()
    {   
        return view('admin.stream_order.create');
    }
  public function edit()
    {
        return view('admin.stream_order.edit');
    }
  public function view()
    {
        return view('admin.stream_order.view');
    }


public function show($id)
    {
        $order = StreamOrder::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service_id' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date',
        ]);

        $order = StreamOrder::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->update([
            'service_id' => $request->service ?? $order->service,
            'date_time' => $request->date ?? $order->date_time,
        ]);

        return response()->json([
            'message' => 'Order updated successfully',
            'order' => $order
        ]);
    }

    public function destroy($id)
    {
        $order = StreamOrder::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}