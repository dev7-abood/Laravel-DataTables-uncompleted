<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Name;
use Yajra\DataTables\DataTables;
use Validator;

class NameController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $data = Name::query();
            return DataTables::of($data)
                ->addColumn('action' , function ($data){
                    $btn  =  '<button type="button" name="'.$data->id.'" id="edit" class="btn btn-info" value="'.$data->id.'">Edit</button><span>&nbsp;</span>';
                    $btn .=  '<button type="button" name="'.$data->id.'" id="del" class="btn btn-danger" value="'.$data->id.'">Delete</button>';
                    return $btn;
                })
                ->setRowAttr(['align' => 'center'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('home');
    }

    public function store(Name $name , Request $request)
    {
        $request->validate([
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
            ]);

        Name::create(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]
        );

        return response(['success' =>'success save record'] , 201);

    }

    public function edit($id)
    {
        if (Request()->ajax())
        {
            $data = Name::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }


    public function update(Request $request)
    {
         Name::whereId($request->hidden_id)->update($request->except('_token' , 'hidden_id'));


        return response()->json(['success' => 'Data is successfully updated']);
    }


}
