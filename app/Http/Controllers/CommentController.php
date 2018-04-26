<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Comment;

class CommentController extends Controller
{
    
    // Xoa the loai
    public function getXoa($id,$idTinTuc)
    {
    	$comment = Comment::find($id);
    	$comment->delete();
    	return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao', 'Bạn đã xóa comment thành công');
    }


}
