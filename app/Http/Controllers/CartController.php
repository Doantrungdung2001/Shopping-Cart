<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Cart;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\DB;
use Session;

class CartController extends Controller
{
    public function Index(){
        $product = DB::table('product')->get();
        return view('home',compact('product'));
        //dd($product);
    }

    public function AddCart(Request $req,$id){
        $product = DB::table('product')->where('id',$id)->first();
        if($product != null){
            if(Session('Cart') != null){
                $oldcart = Session('Cart');//oldcart la gio hang hien tai
            }else{
                $oldcart = null;
            }
            //Gio hang moi
            $newcart = new Cart($oldcart); //tao mot doi tuong gio hang moi tu lop Cart    
            $newcart->AddCart($product,$id);

            $req->session()->put('Cart',$newcart);
           // dd($new_cart);   
        }
        return view('item');
        //dd($product);
    }

    public function DeleteItemCart(Request $req,$id){
        if(Session('Cart') != null){
            $oldcart = Session('Cart');
        }else{
            $oldcart = null;
        }
        $newcart = new Cart($oldcart); //tao mot doi tuong gio hang moi tu lop Cart    
        $newcart->DeleteItemCart($id);
        if(Count($newcart->product) > 0){
            $req->Session()->put('Cart',$newcart);
        }else{
            $req->Session()->forget('Cart');
        }
        return view('item');
    }

    public function ViewCart(){
        return view('cart');
    }
    
    public function DeleteItemListCart(Request $req,$id){
        # code...
        if(Session('Cart') != null){
            $oldcart = Session('Cart');
        }else{
            $oldcart = null;
        }
        $newcart = new Cart($oldcart); //tao mot doi tuong gio hang moi tu lop Cart    
        $newcart->DeleteItemCart($id);
        if(Count($newcart->product) > 0){
            $req->Session()->put('Cart',$newcart);
        }else{
            $req->Session()->forget('Cart');
        }
        return view('list-cart');
    }

    public function SaveItemListCart(Request $req,$id,$quanty){
        # code...
        if(Session('Cart') != null){
            $oldcart = Session('Cart');
        }else{
            $oldcart = null;
        }
        $newcart = new Cart($oldcart); //tao mot doi tuong gio hang moi tu lop Cart    
        $newcart->UpdateItemCart($id,$quanty);

        $req->Session()->put('Cart',$newcart);

        return view('list-cart');
    }
}
