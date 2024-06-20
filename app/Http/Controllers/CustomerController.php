<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;

class CustomerController extends Controller
{
   
    public function showMenu()
    {
        $categories = Category::all();
        
        return view('customer.menu', compact('categories'));
    }
    
    
    public function createOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'table_id' => 'required|exists:tables,id',
        ]);
        
        $order = Order::create([
            'user_id' => null, 
            'order_date' => now(),
            'order_status' => 'pending',
            'total_amount' => 0, 
        ]);
        

        $totalAmount = 0;
        
        foreach ($request->items as $item) {
            $menuItem = MenuItem::findOrFail($item['menu_item_id']);
            
        OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $menuItem->id,
                'quantity' => $item['quantity'],
                'unit_price' => $menuItem->price,
            ]);
        $totalAmount += $menuItem->price * $item['quantity'];
        }
        
        $order->update(['total_amount' => $totalAmount]);
        
        return redirect()->back()->with('success', 'Orden creada exitosamente.');
    }
}
