<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Full_text_search;

class Full_text_searchController extends Controller
{
    public function index()
    {
        return view('full_search_field');
    }


    public function action(Request $request)
    {
        if ($request->ajax())
        {
            $data = Full_text_search::search($request->get('full_text_search_query'))->get();
            return $data;
        }
    }

}
