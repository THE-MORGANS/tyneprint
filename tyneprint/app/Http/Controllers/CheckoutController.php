<?php
namespace App\Http\Controllers;

use App\AdminNotify;
use App\User;
use App\Shipping;
use App\Product;
use App\Category;
use App\Http\Requests\CheckoutRequest;
use App\Traits\CheckoutStore;
use App\Traits\decryptId;
use App\Order;
use App\Mail\UserMail;
use App\Mail\OrderMail;
use App\Mail\PaymentMail;
use App\Delivery;
use App\Notification;
use Illuminate\Support\Facades\Mail;
use App\Transaction;
use App\OrderItem;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\notifications;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    use CheckoutStore;
    use decryptId;
    private $user;
    private $OrderItem;
    private $Order;
    private $Shipping;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function send($data){
     //  dd($data);
        Mail::to($data['email'])->send(new UserMail($data));
    }
    
    public function sendMail($data){
        Mail::to($data['email'],  'orders@tyneprints.com')->send(new PaymentMail($data));
    }
     public function OrderMail($data){
        Mail::to($data['email'], 'orders@tyneprints.com')->send(new OrderMail($data));
    }

     public function __construct()
     {
         $this->User = new User();
         $this->OrderItem = new OrderItem();
         $this->Order = new Order();
         $this->Shipping = new Shipping();
         $this->API_Token = 'FLWSECK_TEST-b754b22c91f541503f75b0d74d29a034-X';
     }
     public function getCustomerLocation($address){
        $key = 'AIzaSyCHsIJX1EHXN_tLXbQ75pMHcB60L3XVOeU';
        $url = "https://maps.google.com/maps/api/geocode/json?key=$key&address=".urlencode($address);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
        $responseJson = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($responseJson, true);
      //  dd($response);
        if ($response['status'] == 'OK') {
            $res['lat'] = $response['results']['0']['geometry']['location']['lat'];
            $res['lng'] = $response['results']['0']['geometry']['location']['lng'];
            return $res;
        }


     }

     public function getShippingPrice($lan, $lng){

        $shipping =  Shipping::where('user_id', auth()->user()->id)->latest()->first();
       // dd($shipping);
        $host = "https://api.gokada.ng/api/developer/order_create/";
        $data = array(
            'api_key' => "HJqbXNrycOO8tgehrmWqKrTOUKg65njvF6NDfd385TwGtvpq60CuGwelSRBt_test",
            'delivery_latitude' => '6.594770',
            'delivery_longitude' => '3.344280',
            'delivery_name' => 'Tyneprints',
            'delivery_phone' => '+2348039366207',
            'delivery_address' => '1 adeolad adeoye street ikeja',
            'pickup_address' => $shipping->address.','.$shipping->city,
            'pickup_name' => $shipping->receiver_name,
            'pickup_phone' => '+234'.$shipping->receiver_phone,
            'pickup_latitude' => $lan,
            'pickup_longitude' => $lng,
        );
        $curl  = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $host,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
        ));
        $response = curl_exec($curl);
        
        $res  = json_decode($response,true);
      //  dd($res);
        if($res['order_id']){
        
     $delivery = Delivery::create([
            'delivery_id' => $res['order_id'],
            'user_id' => auth()->user()->id,
            'shipping_id' => $shipping->id,
            'delivery_fee' => $res['fare'],
            'distance' => $res['distance'],
            'time' => $res['time'],
            'status' => 'pending'
            ]);
     }else{

    return redirect()->back();
     }
    }
    public function index()
    {  
       // $user = User::where('id', auth()->user()->id)->first();
       // $address= shipping::where(['user_id'=> $user->id])->get();
       /// if(!$address){
            //$data['user'] = $user;
        //}else{
            //$data['user'] = $address;
        //}
        if(count(\Cart::content())> 0){ 
            if(auth()->user()){
            $address = Shipping::where('user_id', auth()->user()->id)->latest()->first();
           $geo = $this->getCustomerLocation($address->address.','.$address->city);
          // dd($geo);
            Shipping::where('user_id', auth()->user()->id)->latest()
                      ->update([
                      'lat' => $geo['lat'],
                       'lng' => $geo['lng']
                     ]);
            
        }else{
            $address = '';
        }
        return view('users.products.checkout')
                ->with('title', 'Checkout')
                ->with('address', $address)
                ->with('carts', \Cart::content());
        }else{
            return view('users.products.carts')
                ->with('title', 'Cart')
                ->with('carts', \Cart::content());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function generatePassword($request){
        $pp = substr($request,0,5);
        $nm = rand(1111,9999).rand(1111,9999);
        $password = $pp.$nm;
        return $password;
     }
    public function store(CheckoutRequest $request)
    {
    if(count(\Cart::content())>0){
        $valid = $request->validated();   
       if(!auth()->user()){
        DB::beginTransaction();
        try{
            $user = User::where('email', $request->email)->first();
            if($user){
                Session()->flash('alert', 'danger');
                Session()->flash('reset');
                Session()->flash('message', 'Opps!, The Customer email already exist on our System, Did you forget your Password?');
                return redirect()->back()->withInput($valid);
            }else{
                
                #================== CREATE NEW USER ACCOUNT================
                $pass = $this->generatePassword($request->name);
                $request['pass'] = hash::make($pass);
               $uu = $this->createUser($request);
               
              #============= LOGIN USER =========================
              
               Auth::login($user = $this->User->create($uu));    
              if($uu){
            $title = 'New Customer Registered';
            $message = 'Thanks for registrating on our system, do enjoy our services.';
            #============== SEND REGISTRATION DETAILS TO USE =======================
            $this->sendNotify($title, $message);
             $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone'=>$request->phone,
                'password'=> $pass,
             ];
             $this->send($data);
        }
    }    DB::commit();
         }catch(\Exception $e){
            DB::rollBack();
            throw $e;
            }
       }
       DB::beginTransaction();
       $user = User::where('id', auth()->user()->id)->first();
        try{
            $order_No = rand(1111111,9999999).rand(1111111,9999999);
            $cart = \Cart::content();
            foreach($cart as $carts){
                $order_item = new OrderItem;
                $order_item ->user_id = $user->id;
                $order_item ->product_name = $carts->model->name;
                $order_item ->order_No = $order_No;
                $order_item ->price = $carts->price;
                $order_item ->qty = $carts->qty;
                $order_item ->image = $carts->model->image;
                $order_item->design_image = json_encode($carts->options->images);
                $order_item->design_fee = $carts->options->design_fee;
                $order_item->description = $carts->options->description;
                $order_item->save(); 
            }
            $address = Shipping::where('user_id', $user->id)->latest()->first();
            if(!$address){
              //  dd($request);
            $user_address =  $this->StoreShippingAddress($request);
             $ss= $this->Shipping->create($user_address); 
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            throw $e;

        }       
           // dd($ss);
           $address = Shipping::where('user_id', $user->id)->latest()->first();
           $address = Shipping::where('user_id', auth()->user()->id)->latest()->first();
           $geo = $this->getCustomerLocation($address->address.','.$address->city);
           $shipping_price = $this->getShippingPrice($geo['lat'], $geo['lng']);
           $fare = Delivery::where('user_id', auth()->user()->id)->latest()->first();
           // dd($fare);
           Shipping::where('user_id', auth()->user()->id)->latest()
           ->update([
           'lat' => $geo['lat'],
            'lng' => $geo['lng']
          ]);
        return view('users.products.payment')
            ->with('user', $user)
            ->with('address', $address)
            ->with('carts', $cart)
            ->with('fare', $fare)
            ->with('title', 'Checkout Payment');
    }else{

        return redirect()->route('carts.index');
    }
        }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    public function addNew(){
        //dd('aj jere');
        return view('users.products.edit')
                ->with('title', 'Checkout')
                ->with('user', User::where('id', auth()->user()->id)->first())
                ->with('carts', \Cart::content());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function Add(CheckoutRequest $request){
       //  dd($request);
        $user_address =  $this->StoreShippingAddress($request);
        $ss= $this->Shipping->create($user_address);
        if(count(\Cart::content())>0){
        $address = Shipping::where('user_id', auth()->user()->id)->latest()->first();
            return view('users.products.payment')
                ->with('title', 'Checkout')
                ->with('address', $address)
                ->with('user', User::where('id', auth()->user()->id)->first())
                ->with('carts', \Cart::content());
        }else{

            return redirect()->route('carts.index');
        }
     }
    public function update(Request $request, $id)
    {
        $id = $this->decryptId($id);
        $address = Shipping::where('id', $id)->first();
        $address->receiver_name = $request->receiver_name;
        $address->receiver_phone = $request->receiver_phone;
        $address->receiver_email = $request->receiver_email;
        $address->address = $request->address;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->zip_code = $request->zip_code;
        $address->save();
        Session()->flash('message', 'Address Updated');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function verify($trxref){
        $trnx_ref_exists = Transaction::where(['external_ref' => $trxref])->first();
        if ($trnx_ref_exists) {
      ;      return redirect()->route('my_wallet')->with('error', 'Transaction Already Exist');
            exit();
        }

        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.flutterwave.com/v3/transactions/'.$trxref.'/verify/');
        curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$this->API_Token
        ));
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true); 
        $se = curl_exec($cURLConnection);
        curl_close($cURLConnection);  
        $resp = json_decode($se, true);

      // dd($resp);
        if ($resp['status'] == 'error') {
            \Session::flash('flash_message', 'Transaction not found, Please contact support');
            $message = 'Transaction not found, Please contact support';
          
        }
        $chargeResponsecode = $resp['status'];
        $chargeAmount = $resp['data']['amount'];
       // $chargeCurrency = $resp['data']['currency'];
        $custemail = $resp['data']['customer']['email'];
        $payment_id = $resp['data']['tx_ref'];
        $external_ref = $resp['data']['flw_ref'];
       

        if (($chargeResponsecode == "success")) {     
            //Give Value and return to Success page
            $transactionRef = 'TNE-'.rand(1111111, 9999999);
            $getUser = User::where('email', $custemail)->first();
            $ownerNewBalance = $getUser->wallet + $chargeAmount;
            User::where(['id' => $getUser->id])->update(['wallet' => $ownerNewBalance]);
           Transaction::create([
                'user_id' => $getUser->id,
                'payment_ref'=>$transactionRef,
                'type'=>'credit',
                'payment_method' => 'card',
                'external_ref'=>$external_ref,
                'amount'=>$chargeAmount,
                'prev_balance' =>$getUser->wallet,
                'avail_balance' => $ownerNewBalance 
            ]);
            return response()->json($se);
          
        } else {
            return response()->json($se);
        }
    }


    public function storeOrder(Request $request)
    {    
        $order_list= DB::table('order_items')->where(['user_id'=> auth()->user()->id])->orderBy('created_at', 'desc')->first();
        $transactions = Transaction::where('user_id', auth()->user()->id)->latest()->first();
        if(count(\Cart::content()) == null){
            Session()->flash('alert','danger');
            Session()->flash('message', 'Order Expired');
            return redirect()->back()->with('error', 'Order Expired');
        }
        $dd = Order::where('order_No', $order_list->order_No)->first();

            if($dd){ 
               Session()->flash('alert','danger');
              Session()->flash('message', 'Order Already Exist, close window');
              return redirect()->route('checkout.index');
           }
        
        $order = new order;
        $order->user_id = auth()->user()->id;
        $order->order_No = $order_list->order_No;
        $order->payment_ref = $transactions->payment_ref;
        $order->payment_method = 'Card Payment';
        $order->amount = $transactions->amount;
       // $order->payable = $order_list->payable;
        $order->is_paid = 0;
        $order->is_delivered = 0;
        $ship= Shipping::where(['user_id' => auth()->user()->id])->latest()->first();
        $order->shipping_id = $ship->id;
        if($order->save()){
           # ===============Charge User ========================
           $this->chargeUser($transactions->amount ,$transactions->external_ref, $order_list->order_No, $transactions->payment_ref);
           \Cart::destroy();

           $order_items = OrderItem::where(['user_id' => auth()->user()->id, 'order_No' => $order_list->order_No])->first();
           $order = Order::where('order_No', $order_items->order_No)->first();
           Session()->flash('message', 'Thank you!, Payment Completed and Your order has been received');
        
           $title = 'New Order Received';
           $message = 'You order is received, thanks for choosing us.';
           $this->sendNotify($title, $message);
           $title = 'New Payment Received';
           $message = 'You Payment is received successfully, thanks for choosing us.';
           $this->sendNotify($title, $message);
           
           #============================ SEND PAYMENT RECEIVED MAIL ======================
            $data = [
               'order_No' => $order->order_No,
                'payment_ref' => $transactions->payment_ref,
                'external_ref' => $transactions->external_ref,
                'amount' => $transactions->amount,
               'email' => auth()->user()->email,
                ];
            
            $this->sendMail($data);
    
            #===================== Send order Mail =========================
            $order_mail = OrderItem::where('order_No', $order->order_No )->get();
            $shipping = Shipping::where('order_No', $order->order_No )->first();
            $datas = [
                'order_No' => $order->order_No,
                'name' => auth()->user()->name,
                'amount' => $transactions->amount,
                'email' => auth()->user()->email,
                'receiver_name' => $shipping->receiver_name,
                'phone' => $shipping->receiver_phone,
                'address' => $shipping->address,
                'delivery_method' => $shipping->delivery_method,
                'order_items' => $order_mail,
                
                ];
              
              //  dd($datas);
                $this->OrderMail($datas);
             
           return view('users.products.completed')
           ->with('order',$order )
           ->with('shipping', Shipping::where('order_No', $order->order_No)->latest()->first())
           ->with('order_items', OrderItem::where('order_No',$order->order_No)->latest()->get())
           ->with('transaction', Transaction::where(['order_No' => $order_items->order_No, 'type' => 'debit'])->latest()->first())
           ->with('title', 'Payment Completed');
          
           
           
        }else{
            return redirect()->back();
        }
        
    }


    public function chargeUser($amount,$external_ref, $order_No,  $transaction_ref){
       // dd($amount);
        $user = User::where(['id' => auth()->user()->id])->first();
        $new_wallet = $user->wallet - $amount;
        User::where('id', $user->id)->update(['wallet' => $new_wallet]);
        Transaction::create([
        'user_id' => $user->id,
        'payment_ref'=>$transaction_ref,
        'external_ref'=>$external_ref,
        'payment_method' => 'Wallet',
        'order_No' => $order_No,
        'type'=>'debit',
        'amount'=>$amount,
        'prev_balance' =>$user->wallet,
        'avail_balance' => $new_wallet
        ]);
    
        $orders = order::where(['order_No' => $order_No])
                      ->update([
                    'is_paid' => 1
                    ]);
               $yx = Transaction::where('user_id', auth()->user()->id)->latest()->first();
                Transaction::where('user_id', $yx->user_id)
                            ->update([
                            'order_No' => $order_No
                            ]);
             $yy = Shipping::where('user_id', auth()->user()->id)->latest()->first();
                 Shipping::where('user_id', $yy->user_id)
                                        ->update([
                                        'order_No' => $order_No
                                        ]);
    }


    public function test(){
        $order = Order::latest()->first();
        Session()->flash('message', 'Thank you!, Your order has been received');
        return view('users.products.completed')
        ->with('order',$order )
        ->with('shipping', Shipping::where('order_No', $order->order_No)->latest()->first())
        ->with('order_items', OrderItem::where('order_No',$order->order_No)->latest()->get())
        ->with('transaction', Transaction::where(['order_No' => $order->order_No, 'type' => 'debit'])->first());
    }

    public function sendNotify($title, $message){
        $getUser = User::where('id', auth()->user()->id)->first();
        $notify = new Notification;
        $notify->user_id = $getUser->id;
        $notify->title = $title;
        $notify->message = 'Dear '.$getUser->name. ', <br>'.$message;
        $notify->save();
        $admin = new AdminNotify;
        $admin->message = $title;
        $admin->save();

}
}
