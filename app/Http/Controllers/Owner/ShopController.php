<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Facade\FlareClient\Truncation\TruncationStrategy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use App\Http\Requests\UploadImageRequest;

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
        $shops = Shop::where('owner_id', Auth::id())->get();

        return view('owner.shops.index', compact('shops'));
    }

    public function edit($id)
    {
        $shop = Shop::findOrFail($id);

        return view('owner.shops.edit', compact('shop'));

    }
    
    public function update(UploadImageRequest $request, $id)
    {
       $imageFile = $request->image;// formのnameが渡ってくる
       if(!is_null($imageFile) && $imageFile->isValid()){ //isValid()存在してるかどうか
            // Storage::putFile('public/shops', $imageFile); リサイズ無しVer.
            $fileName = uniqid(rand().'_'); //ランダムなidを生成
            $extension = $imageFile->extension(); //保存された画像ファイルの拡張子を取得するメソッド
            $fileNameStore = $fileName.'.'.$extension;//ファイル名＋拡張子

            $resizedImage = InterventionImage::make($imageFile)->resize(1920,1080)->encode();//リサイズ

            Storage::put('public/shops/' . $fileNameStore, $resizedImage);
       }

       $shop = Shop::findOrFail($id);
       $shop->name = $request->name;
       $shop->information = $request->information;
       $shop->is_selling = $request->is_selling;
       if(!is_null($imageFile) && $imageFile->isValid()){
            $shop->filename = $fileNameStore;//DBに保存するのはファイル名のみ
       }

       $shop->save();

       return redirect()->route('owner.shops.index')->with('shopUpdate', 'ショップ情報を更新しました');
    }


}
