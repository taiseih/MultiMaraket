<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\PrimaryCategory;
use App\Models\SecondaryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $primeCategories = PrimaryCategory::select('id', 'name', 'sort_order')->get();
        $secondCategories = SecondaryCategory::with('primary')->get();

        return view('owner.categories.index', compact('primeCategories', 'secondCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prime_create()
    {
        return view('owner.categories.prime.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function second_create()
    {
        $primary = PrimaryCategory::all();

        return view('owner.categories.second.create', compact('primary'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function prime_store(Request $request)
    {
        PrimaryCategory::create([
            'name' => $request->name,
            'sort_order' => $request->sort,
        ]);

        return redirect()->route('owner.categories.index');
        
    }

    public function second_store(Request $request)
    {
        SecondaryCategory::create([
            'name' => $request->name,
            'sort_order' => $request->sort,
            'primary_category_id' => $request->category,
        ]);

        return redirect()->route('owner.categories.index');
    }


    public function destroy($id)
    {
        //
    }
}
