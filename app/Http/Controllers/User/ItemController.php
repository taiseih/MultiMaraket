<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    public function index(){

        $stocks = DB::table('t_stocks')->select('product_id', DB::raw('sum(quantity) as quantity'))
        ->groupBy('product_id')->having('quantity', '>', 1);

        $products = DB::table('products')
        ->joinSub($stocks, 'stock', function($join){
            $join->on('products.id', '=', 'stock.product_id');
        })
        ->join('shops', 'products.shop_id', '=', 'shops.id')
        ->join('secondary_categories', 'products.secondary_category_id', '=', 'secondary_categories.id')
        ->join('images as image1', 'products.image1', '=', 'image1.id')
        ->where('shops.is_selling', true)//ショップが販売中かどうか
        ->where('products.is_selling', true) //商品が販売中かどうか
        ->select(
            'products.id as id',
            'products.name as name',
            'products.price',
            'products.sort_order as sort_order',
            'products.information',
            'secondary_categories.name as category',
            'image1.filename as filename'
        )
        ->paginate(20);
        
        return view('user.items.index', compact('products'));
    }

    public function show($id){
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');
        $itemLikes = Like::where('product_id', $id)->get();

        if (auth()->check()) {
            $userLike = $itemLikes->where('user_id', auth()->user()->id)->first();
        } else {
            $userLike = null;
        }

        if($quantity > 10){
            $quantity = 10;
        }

        return view('user.items.show', compact('product', 'quantity', 'itemLikes', 'userLike'));
    }
}
