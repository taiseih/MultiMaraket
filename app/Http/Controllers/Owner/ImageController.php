<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadImageRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
       $this->middleware('auth:owners');  

       $this->middleware(function($request, $next){
        $id = $request->route()->parameter('image'); 
        if(!is_null($id)){ // null判定
        $imagesOwnerId = Image::findOrFail($id)->owner->id;
            $shopId = (int)$imagesOwnerId; 
            if($shopId !== Auth::id()){ 
                abort(404); 
                }
            }
            return $next($request);
       });
    }


    public function index()
    {
        //
        $images = Image::where('owner_id', Auth::id())->orderBy('updated_at', 'desc')->paginate(20);
        return view('owner.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        //

        $imageFiles = $request->file('files');
        if(!is_null($imageFiles)){
            foreach($imageFiles as $imageFile){
                $fileName = uniqid(rand().'_'); 
                $file = $imageFile['image'];//元の配列のままだと使えないのでキーを指定してる
            $extension = $file->extension(); 
            $fileNameStore = $fileName.'.'.$extension;
            $resizedImage = InterventionImage::make($file)->resize(1920,1080)->encode();
            Storage::put('public/products/' . $fileNameStore, $resizedImage);
            Image::create([
                'owner_id' => Auth::id(),
                'filename' => $fileNameStore,
            ]);
            }
            return redirect()->route('owner.images.index')->with('imageStore', '画像を登録しました');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $image = Image::findOrFail($id);

        return view('owner.images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $image = Image::findOrFail($id);
       $image->title = $request->title;
       $image->save();
       return redirect()->route('owner.images.index')->with('imageUpdate', '画像情報を更新しました');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        $imageInProducts = Product::where('image1', $image->id)
            ->orWhere('image2', $image->id)
            ->orWhere('image3', $image->id)
            ->orWhere('image4', $image->id)
            ->get();

        $deleteImage = true;//初期値はtrue

        if (!is_null($imageInProducts)) {
            $imageInProducts->each(function ($product) use ($image, &$deleteImage) {
                for ($i = 1; $i <= 4; $i++) {
                    if ($product->{"image{$i}"} === $image->id) {
                        $deleteImage = false;
                        break;
                    }
                }
            });

            if (!$deleteImage) {
                return redirect()->route('owner.images.index')->with('alert', '商品情報が残っています。');
            }
        }

        $filePath = 'public/products/' . $image->filename;
        Storage::delete($filePath);

        Image::findOrFail($id)->delete();

        return redirect()
            ->route('owner.images.index')
            ->with('alert', '画像を削除しました');
    }
}
