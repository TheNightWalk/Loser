<?php
namespace app\Http\Controllers\Index;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Category;

class RecorddetailController extends Controller
{
    public function recorddetail()
    {
        return view('recorddetail');
    }
}