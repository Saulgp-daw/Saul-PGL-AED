<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(){
        $imagenesHubble = ["img/hubble-1.webp", "img/hubble-2.webp","img/hubble-3.webp","img/hubble-4.webp","img/hubble-5.webp"];
        return view("hubble", compact("imagenesHubble"));
    }
}
