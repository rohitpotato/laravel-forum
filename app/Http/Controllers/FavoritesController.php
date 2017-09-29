<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
class FavoritesController extends Controller
{
    public function store(Reply $reply)
    {
    	//	$reply = Reply::find($reply);
    	$reply->favorite();
    	return back();
    }

    public function delete(Reply $reply)
    {
    	$reply->unFavorite();
    	return back();
    }
}
