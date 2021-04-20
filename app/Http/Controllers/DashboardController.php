<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    
    public function store(Request $req)
    {  
            $this->validate($req,[
                'name' => 'required',
            ]);
            $this->validate($req,[
                'categorie' => 'required',
            ]);
            $this->validate($req,[
                'type_of_fashion' => 'required',
            ]);$this->validate($req,[
                'size' => 'required',
            ]);
            $this->validate($req,[
                'price' => 'required',
            ]);
             
            // if ($req->hasfile('photo')) {
            //     print_r("hii");
            //     $file = $req->file('photo');
            //     $extension = $file->getClientOriginalExtension();
            //     $filename = time() . '.' . $extension;
            //     // $file->move('images/', $filename);
            //     $req->image = $filename;
            // } else {
                
            //     return $req;
            //     $req->image = '';
            // }
            
            $categories = new Categories();
            $categories->name = $req->input('name');
            $categories->categorie = $req->input('categorie');
            $categories->type_of_fashion = $req->input('type_of_fashion');
            $categories->size = $req->input('size');
            $categories->price = $req->input('price');
            $categories->image = $req->input('image');
        
        $categories->save();
    
    
            return "Added";
        } 
    
    public function show()
    {
        $data = Categories::all();
        $numOfData = count($data);
        return ['data' => $data];
    }
    public function numOfCategories()
    {
        $data = Categories::all();
        $numOfData = count($data);
        return  $numOfData;
    }

    public function edit($id)
    {
        //
    }

   
    public function update($id)
    {
        $data = Categories::find($id);
        $data->name=request('name');
        $data->categorie=request('categorie');
        $data->type_of_fashion=request('type_of_fashion');
        $data->size=request('size');
        $data->price=request('price');
        $data->image = request('image');
        $data->save();
        return "Updated";
      
    }

   
    public function destroy($id)
    {
        $data=Categories::where('id',$id)->delete();
        // $data=Categories::find($id);
        // $data->delete();
        if($data){
            return "Deleted";
        }
        else return "Not exist";
        
    }


    function search($name){
        return Categories::where("name","like","%".$name."%")->get();
    }
}
