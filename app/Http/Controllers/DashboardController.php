<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function storing(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
            'category' => 'required',
            'type_of_fashion' => 'required',
            'size' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);
        $categories = new Categories();
        $categories->name = $req->input('name');
        $categories->category = $req->input('category');
        $categories->type_of_fashion = $req->input('type_of_fashion');
        $categories->size = $req->input('size');
        $categories->price = $req->input('price');
        $categories->image = $req->file('image');
        $categories->save();
        $categories->addMedia($req->file('image'))
            ->toMediaCollection();
        return "Category Added";
    }

    public function showing()
    {
        $Category = Categories::with('media')->get();
        return $Category;
    }


    public function numOfCategories()
    {
        $numOfData = Categories::count();
        return  $numOfData;
    }



    public function updating($id, Request $req)
    {
        $categories = Categories::find($id);
        $categories->name = $req->input('name');
        $categories->category = $req->input('category');
        $categories->type_of_fashion = $req->input('type_of_fashion');
        $categories->size = $req->input('size');
        $categories->price = $req->input('price');
        $categories->image = $req->file('image');
        print_r("hii");
        $categories->save();
        $categories->addMedia($req->file('image'))
            ->toMediaCollection();
        return "Category Updated";
    }


    public function deleting($id)
    {
        $data = Categories::find($id);
        if ($data) {
            $data->delete($id);
            $data->clearMediaCollection();
            return "Category Deleted";
        } else return "Category Not exist";
    }


    function search($name)
    {
        return Categories::where("name", "like", "%" . $name . "%")->take(10)->get();
    }
}
