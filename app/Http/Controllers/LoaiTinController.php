<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    //Lay danh sach Loai Tin         
    public function getDanhSach()
    {	
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.danhsach', ['loaitin'=>$loaitin]);

    }

    // Them loại tin voi get
    public function getThem()
    {
    	//thêm thể loại
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.them', ['theloai'=>$theloai]);
    }

    // Them loại tin => với post
    public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
    			'TheLoai'=>'required',
    		],
    		[
    			'Ten.required'=>'Bạn chưa nhập tên Loại tin',
    			'Ten.unque'=>'Tên Loại tin đã tồn tại',
    			'Ten.min'=>'Tên Loại tin phải có độ dài từ 3 -> 100',
    			'Ten.max'=>'Tên Loại tin phải có độ dài từ 3 ->100',
    			'TheLoai'=>'Bạn chưa chọn Thể loại',
    		]);

    	$loaitin = new LoaiTin();
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);

    	$loaitin->idTheLoai = $request->TheLoai;


    	$loaitin->save();
    	return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công loại tin');    	 
    }

    //Sua loai tin => với get
    public function getSua($id)
    {
 		$theloai = TheLoai::all();
 		$loaitin = LoaiTin::find($id);

 		return view('admin.loaitin.sua', ['loaitin'=>$loaitin, 'theloai'=>$theloai]);
    }

    //Sua loai tin => với post
    public function postSua(Request $request, $id)
    {
    	$this->validate($request,
		[
			'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
			'TheLoai'=>'required',
		],
		[
			'Ten.required'=>'Bạn chưa nhập tên Loại tin',
			'Ten.unque'=>'Tên Loại tin đã tồn tại',
			'Ten.min'=>'Tên Loại tin phải có độ dài từ 3 -> 100',
			'Ten.max'=>'Tên Loại tin phải có độ dài từ 3 ->100',
			'TheLoai'=>'Bạn chưa chọn Thể loại',
		]);	 

		$loaitin = LoaiTin::find($id);
		$loaitin->Ten = $request->Ten;
		$loaitin->TenKhongDau = changeTitle($request->Ten);
		$loaitin->idTheLoai = $request->TheLoai;

		$loaitin->save();
		return redirect('admin/loaitin/sua/'.$id)->with('thongbao', 'Bạn đã sửa thành công');
    }

    // Xoa loại tin
    public function getXoa($id)
    {
     	$loaitin = LoaiTin::find($id);
    	$loaitin->delete();
    	return redirect('admin/loaitin/danhsach')->with('thongbao', 'Bạn đã xóa thành công');
    }
}
