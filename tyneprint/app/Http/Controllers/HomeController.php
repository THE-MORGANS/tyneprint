<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\OrderItem;
use Illuminate\Support\Carbon;
use App\Notification;
use App\User;
use App\Menu;
use App\Shipping;
use App\Traits\decryptid;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    use decryptid;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('users.home')
            ->with('title', 'Index')
            ->with('products', Product::where('status', '!=', '1')->simplePaginate(20));
    }

    public function productDetails($id){
        $id = $this->decryptId($id);
        $product = Product::where('id', $id)->first();
                Product::where('id', $id)
                ->update(['views' => $product->views + 1]);
      
        return view('users.products.products')
                ->with('title', $product->name)
                ->with('product', $product)
                ->with('breadcrumb', $product->name)
                ->with('category', $product->category->name);
        }

        public function AccountIndex(){
          return view('users.accounts.index')
                    ->with('orders', count(Order::where('user_id', auth()->user()->id)->get()))
                    ->with('order', Order::where('user_id', auth()->user()->id)->first())
                    ->with('user', User::where('id', auth()->user()->id)->first())
                    ->with('address', Shipping::where('user_id', auth()->user()->id)->first())
                    ->with('pending', count(Order::where(['user_id'=> auth()->user()->id, 'is_delivered'=> 0])->get()))
                    ->with('completed', count(Order::where(['user_id'=> auth()->user()->id, 'is_delivered'=> 1])->get()));
        }


        public function myAccount(){
            return view('users.accounts.profile')
                    ->with('orders', Order::where('user_id', auth()->user()->id)->latest()->get())
                    ->with('transactions', Transaction::where('user_id', auth()->user()->id)->simplePaginate(5))
                    ->with('user', User::where('id', auth()->user()->id)->first());
        }

        public function myOrders(){
            return view('users.accounts.orders')
            ->with('orders', Order::where('user_id', auth()->user()->id)->latest()->simplePaginate(10))
            ->with('user', User::where('id', auth()->user()->id)->first());

        }

        
        public function myTransactions(){
            return view('users.accounts.transactions')
            ->with('transactions', Transaction::where(['user_id' =>auth()->user()->id,'type' => 'debit'])->latest()->simplePaginate(10))
            ->with('user', User::where('id', auth()->user()->id)->first());

        }

public function OrderDetails($id){
            $order = Order::where('order_No', $id)->first();
            return view('users.accounts.orderDetails')
            ->with('order',$order )
            ->with('shipping', Shipping::where('order_No', $order->order_No)->latest()->first())
            ->with('order_items', OrderItem::where('order_No',$order->order_No)->latest()->get())
            ->with('transaction', Transaction::where(['order_No' => $order->order_No, 'type' => 'debit'])->latest()->first());
        }

public function notifications(){
            $notify = Notification::where('user_id', auth()->user()->id)->latest()->simplePaginate(7);
            return view('users.accounts.notify', compact('notify'));
        }
public function notificationDel($id){
            $del = Notification::where('id', decrypt($id))->first();
            $del->delete();
            return redirect()->back();
        }

 public function updateDetails(Request $request){

   // dd($request->all());
            if($request->name){
             $update_user = [
                 'name' => $request->name,
             ];
    
             DB::table('users')
              ->where('id', auth()->user()->id)
               ->update($update_user);
    
               if(!isset($request->password)){
                Session()->flash('message', 'Details Updated Successfully');
                Session()->flash('alert', 'success');
               return redirect()->back()->with('success', 'Details Updated Successfully');
            }
        }
    
            if($request->password){
             $this->validate($request, [
            'oldPassword' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation'=>'required'
            ]);
     
           $hashedPassword = auth()->user()->password;
            
            if (\Hash::check($request->oldPassword , $hashedPassword)) {
            if (!\Hash::check($request->password , $hashedPassword)) {
                  $users =user::find(Auth()->user()->id);
                  $users->password = bcrypt($request->password);
                  user::where( 'id' , auth()->user()->id)->update( array( 'password' =>  $users->password));
                  Session()->flash('message', 'Details/Pass Updated Successfully');
                  Session()->flash('alert', 'success');
                  return redirect()->back()->with('success', 'Details/Pass Updated Successfully');
                }
                else{
                    Session()->flash('message', 'Old Password / New Password Cannot be the Same');
                    Session()->flash('alert', 'danger');
                    return redirect()->back()->with('error', 'Old Password / New Password Cannot be the Same');}
            } else{
                Session()->flash('message', 'Old Password is Incorrect');
                Session()->flash('alert', 'danger');
                return redirect()->back()->with('error', 'Old Password is Incorrect');
            }
        }else{
            return back();
        }
    }


    public function Categories($id){
        $id = decrypt($id);
        return view('users.shops.category')
            ->with('products',  Product::where('category_id', $id)->where('status', '!=', '1')->simplePaginate(20));
    }

    public function Pages($id){
        $id = decrypt($id);
        $menu = Menu::where('id', $id)->first();
        $menus = preg_replace("/\s+/", "",$menu->name);
        $product = Product::where('id', 19)->first();
        return view('users.pages'.".".$menus, compact('product'));
    }
    
    
    public function search(Request $request)
{
    if(isset($request->search)){
    $search = $request->get('search');
     $product['products'] = Product::where( 'name', 'LIKE', "%$search%" )->simplePaginate(18);
    }
    return view ( 'users.shops.category',$product);
    }
}
