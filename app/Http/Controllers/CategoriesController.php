<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Categories;
use App\Models\favourites;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
  public function showBoys($type_of_fashion)
  {
    $data = Categories::select('*')->where([
      ['category', '=', 'boys'],
      ['type_of_fashion', '=', $type_of_fashion]

    ])->get();
    return $data;
  }
  public function showMen($type_of_fashion)
  {

    $data = Categories::select('*')->where([
      ['category', '=', 'men'],
      ['type_of_fashion', '=', $type_of_fashion]

    ])->get();


    return  $data;
  }
  public function showWomens($type_of_fashion)
  {
    $data = Categories::select('*')->where([
      ['category', '=', 'womens'],
      ['type_of_fashion', '=', $type_of_fashion]

    ])->get();
    return $data;
  }
  public function showGirls($type_of_fashion)
  {
    $data = Categories::select('*')->where([
      ['category', '=', 'girls'],
      ['type_of_fashion', '=', $type_of_fashion]

    ])->get();

    return $data;
  }
  public function showBookings($barrier_id)
  {
    $data = Bookings::select('*')->where([
      ['barrier_id', '=', $barrier_id]

    ])->get();
    return $data;
  }
  public function showFavourites($barrier_id)
  {
    $data = favourites::select('*')->where([
      ['barrier_id', '=', $barrier_id]

    ])->get();
    return $data;
  }
  public function addBooking(Request $req)
  {
    $this->validate($req, [
      'barrier_id' => 'required',
    ]);
    $this->validate($req, [
      'booking_date' => 'required',
    ]);
    $this->validate($req, [
      'name' => 'required',
    ]);
    $this->validate($req, [
      'category' => 'required',
    ]);
    $this->validate($req, [
      'type_of_fashion' => 'required',
    ]);
    $this->validate($req, [
      'size' => 'required',
    ]);
    $this->validate($req, [
      'price' => 'required',
    ]);
    $booking = new Bookings();
    $booking->barrier_id = $req->input('barrier_id');
    $booking->booking_date = $req->input('booking_date');
    $booking->name = $req->input('name');
    $booking->category = $req->input('category');
    $booking->type_of_fashion = $req->input('type_of_fashion');
    $booking->size = $req->input('size');
    $booking->price = $req->input('price');
    $booking->image = $req->input('image');

    $booking->save();


    return "Added";
  }
  public function addFavourite(Request $req)
  {
    $this->validate($req, [
      'barrier_id' => 'required',
    ]);
    $this->validate($req, [
      'name' => 'required',
    ]);
    $this->validate($req, [
      'category' => 'required',
    ]);
    $this->validate($req, [
      'type_of_fashion' => 'required',
    ]);
    $this->validate($req, [
      'size' => 'required',
    ]);
    $this->validate($req, [
      'price' => 'required',
    ]);
    $favourites = new favourites();
    $favourites->barrier_id = $req->input('barrier_id');
    $favourites->booking_date = $req->input('booking_date');
    $favourites->name = $req->input('name');
    $favourites->category = $req->input('category');
    $favourites->type_of_fashion = $req->input('type_of_fashion');
    $favourites->size = $req->input('size');
    $favourites->price = $req->input('price');
    $favourites->image = $req->input('image');

    $favourites->save();


    return "Added";
  }
}
