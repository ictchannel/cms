<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
 

class SlideController extends Controller
{
    //Lay danh sach Loai Tin         
    public function getDanhSach()
    {	
    	 $slide = Slide::all();
         return view('admin.slide.danhsach', ['slide'=>$slide]);

    }

    // Them loại tin voi get
    public function getThem()
    {
    	 
    }

    // Them loại tin => với post
    public function postThem(Request $request)
    {
    	  	 
    }

    //Sua loai tin => với get
    public function getSua($id)
    {
 		 
    }

    //Sua loai tin => với post
    public function postSua(Request $request, $id)
    {
 
    }

    // Xoa loại tin
    public function getXoa($id)
    {
 
    }
}
