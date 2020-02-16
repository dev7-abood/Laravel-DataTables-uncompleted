<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PaginationController extends Controller
{
    public function index()
    {

        $data = DB::table('person_names')->paginate(5);

        return view('pagination' , compact('data'))->render();
    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('person_names')->paginate(5);
            return view('pagination_data', compact('data'))->render();
        }
    }


}
