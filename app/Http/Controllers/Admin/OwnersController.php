<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Shop;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Throwable;

class OwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('auth:admin');  
     }


    public function index()
    {
        // $date_now = Carbon::now();
        // $date_parse = Carbon::parse();

        // echo $date_now;
        // echo "<br>";
        // echo $date_parse;

        // $e_all = Owner::all();
        // $q_get = DB::table('owners')->select('name', 'created_at')->get();

        $owners = Owner::select('id', 'name', 'email', 'created_at')->paginate(3);

        return view('admin.owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.owners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try{
            DB::transaction(function() use($request){//DBのtransactionでrequestを使うにはuse文を使用して読み込ませる必要がある
                $owner = Owner::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                
                Shop::create([  //Owner情報が作成されたときに一緒にshopも作成する。
                    'owner_id' => $owner->id,
                    'name' => '店名を決めてください',
                    'information' => '',
                    'filename' => '',
                    'is_selling' => true,
                ]);
        
            }, 2);//第二引数で繰り返し回数を指定する

        }catch(Throwable $e){
             Log::error($e);
             throw $e;
        }

        return redirect()
        ->route('admin.owners.index')
        ->with('message', 'オーナー情報を登録しました');

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
       $owner =  Owner::findOrFail($id);
        
       return view('admin.owners.edit', compact('owner'));
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
        $owner = Owner::findOrFail($id);
        $owner->name = $request->name;
        $owner->email = $request->email;
        $owner->password = Hash::make($request->password);
        $owner->save();

        return redirect()
        ->route('admin.owners.index')
        ->with('message', 'オーナー情報を更新しました');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Owner::findOrFail($id)->delete();

        return redirect()
        ->route('admin.owners.index')
        ->with('alert', 'オーナー情報を削除しました');
    }

    public function expiredOwnerIndex(){
        $expiredOwners = Owner::onlyTrashed()->get();
        return view('admin.expired-owners', compact('expiredOwners'));
    }
    public function expiredOwnerDestroy($id){
        Owner::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.expired-owners.index');    
    }

    public function expiredOwnerRestore($id){
        $restoreOwner = Owner::onlyTrashed()->find($id)->restore();
        return redirect()->route('admin.expired-owners.index', compact('restoreOwner'))
        ->with('recovery', 'オーナー情報を復旧しました');
    }

}
