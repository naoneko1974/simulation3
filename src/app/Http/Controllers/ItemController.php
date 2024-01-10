<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Condition;
use App\Models\Category;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(){
        $items = Item::Paginate(12);
        $categories = Category::all();
        return view('index',compact('items','categories'));
    }

    public function sell(){
        $conditions = Condition::all();
        $categories = Category::all();
        return view('sell',compact('conditions','categories'));
    }

    public function search(Request $request){
        $items = Item::NameSearch($request->name_keyword)->Paginate(12);
        $categories = Category::all();
        return view('index', compact('items', 'categories'));
    }

    public function like_list(){
        $items = Auth::user()->likes()->Paginate(12);
        $categories = Category::all();
        return view('index', compact('items', 'categories'));
    }

    public function store(ItemRequest $request){
        $file_name = $request->file('img_url')->getClientOriginalName();
        $request->file('img_url')->storeAs('public/', $file_name);

        $items = New Item();
        $items->name = $request->name;
        $items->brand = $request->brand;
        $items->price = $request->price;
        $items->description = $request->description;
        $items->img_url = 'storage/' . $file_name;
        $items->user_id = Auth::user()->id;
        $items->condition_id = $request->condition_id;
        $items->save();

        $categories = Category::find($request->category_id);
        $categories->items()->sync($items->id);

        $items = Item::Paginate(12);
        return view('index',compact('items'));
    }

    public function item($id){
        $items = Item::find($id);
        $categories = $items->categories;
        return view('item',compact('items','categories'));
    }

}
