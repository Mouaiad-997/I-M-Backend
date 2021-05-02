<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Cat_Book;
use App\Models\Categories;
use App\Models\favourites;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoriesController extends Controller
{
  public function showing($category,$type_of_fashion)
  {
    $data = Categories::with('media')->where([
      ['category', '=', $category],
      ['type_of_fashion', '=', $type_of_fashion]

    ])->get();
    return $data;
  }
  public function showBookings($barrier_id)
  {
    $data =  Categories::with('media')
    ->join('Bookings','Categories.id','=','Bookings.category_id')
    ->where( 'Bookings.barrier_id',$barrier_id)
    ->get();
     return $data;
  }
  public function showFavourites($barrier_id)
  {
    $data =  Categories::with('media')
    ->join('favourites','Categories.id','=','favourites.category_id')
    ->where( 'favourites.barrier_id',$barrier_id)
    ->get();
    return $data;
  }
  public function addBooking($barrier_id,$category_id)
  {
    $booking = new Bookings();
    $booking->barrier_id = $barrier_id;
    $booking->booking_date = Carbon::now();
    $booking->category_id =$category_id;
    $booking->save();
    return "Added";
  }
  public function addFavourite($barrier_id,$category_id)
  {
    $favourites = new favourites();
    $favourites->barrier_id = $barrier_id;
    $favourites->favourite_date = Carbon::now();
    $favourites->category_id =$category_id;
    $favourites->save();
    return "Added";
  }
  function search($categoryName)
    {
        return Categories::where("name", "like", "%" . $categoryName . "%")->take(10)->get();
    }
}
