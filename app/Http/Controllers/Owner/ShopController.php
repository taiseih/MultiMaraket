<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    //
    public function __construct()
    {
       $this->middleware('auth:owners');  

       $this->middleware(function($request, $next){
        $id = $request->route()->parameter('shop'); //route型のparameterから取得（parameterは連想配列で'shop' => 'id(任意の数字)'になっててshopに数字が代入されている状態でshopを引数に指定することによって任意のidを取得することができる）
        if(!is_null($id)){ // null判定
        $shopsOwnerId = Shop::findOrFail($id)->owner->id;
            $shopId = (int)$shopsOwnerId; // キャスト 文字列→数値に型変換
            $ownerId = Auth::id();
            if($shopId !== $ownerId){ // ログインユーザーとshopIdを比較
                abort(404); // 404画面表示
                }
            }
            return $next($request);
       });
    }

    public function index()
    {
        $ownerId = Auth::id();
        $shops = Shop::where('owner_id', $ownerId)->get();

        return view('owner.shops.index', compact('shops'));
    }

    public function edit($id)
    {
        dd(Shop::findOrFail($id));
    }
    
    public function update(Request $request, $id)
    {

    }


}
