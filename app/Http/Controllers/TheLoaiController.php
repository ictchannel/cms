<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    //Lay danh sach the loai
    public function getDanhSach()
    {	
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach', ['theloai'=>$theloai]);

    }

    // Them the loai => với get
    public function getThem()
    {
    	return view('admin.theloai.them');
    }

    // Them the loai => với post
    public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100',
    		],
    		[
    			'Ten.required' => 'Bạn chưa nhập tên thể loại',
    			'Ten.unique'=>'Tên thể loại đã tồn tại',
    			'Ten.min' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
    			'Ten.max' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
    		]);

    	$theloai = new TheLoai;
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	 //$theLoai->TenKhongDau = str_slug($request->Ten,'-'); 

    	$theloai ->save();

    	return redirect('admin/theloai/them')->with('thongbao', 'Thêm Thành công!');
    }

    //Sua the loai => với get
    public function getSua($id)
    {
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    //Sua the loai => với post
    public function postSua(Request $request, $id)
    {
    	$theloai = TheLoai::find($id);
    	$this->validate($request,
    		[
    				'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
    		],
    		[
    				'Ten.required'=>'Bạn chưa nhập tên thể loại',
    				'Ten.unique'=>'Tên thể loại đã tồn tại',
    				'Ten.min'=>'Tên thể loại phải có độ dài từ 3->100 ký tự',
    				'Ten.max'=>'Tên thể loại phải có độ dài từ 3->100 ký tự'
    		]
    	);
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai ->save() ;

    	return redirect('admin/theloai/sua/'.$id)->with('thongbao', 'Sưa Thành công !');
    }

    // Xoa the loai
    public function getXoa($id)
    {
    	$theloai = TheLoai::find($id);
    	$theloai->delete();
    	return redirect('admin/theloai/danhsach')->with('thongbao', 'Bạn đã xóa thành công');
    }


}
