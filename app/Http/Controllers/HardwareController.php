<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hardware;

class HardwareController extends Controller
{
    //
    public function view()
    {
        $data=Hardware::all();

        return view('hardwareView')->with('datas',$data);
    }
    public function addView()
    {
        return view('hardwareAdd');
    }
    public function add(Request $request)
    {
        $task=new Hardware;
        $this -> validate($request,[
            'itemname'=>'required',
          
        ]);
        $task->itemname=$request->itemname;
        $task->price=$request->price;
        $task->company=$request->company;
        $task->haveornot=$request->process_status;
        $task->save();
        $data=Hardware::all();
       return redirect()->back()->with('datas',$data);
     

    }

    public function getItemById(Request $request)
    {
        $task=Hardware::find($request->id);
        if($task!=null){
            return response()->json(['status'=>'200', 'message'=>'Found Item', 'data'=>$task]);
        }else{
            return response()->json(['status'=>'204', 'message'=>'No such Item in database',]);
        }

    }


    public function updateItem(Request $request){
        
        

        try {
            $task = Hardware::findOrFail($request->id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status'=>'204', 'message'=>'No such Item in database',]);
        }
        $task->itemname=$request->itemname;
        $task->price=$request->price;
        $task->company=$request->company;
        $task->haveornot=$request->process_status;

        $task->save();
        return response()->json(['status'=>'200', 'message'=>'Item updated.', 'data'=>$task]);

    }

    public function deleteItem(Request $request){
        $task = Hardware::find($request->id);
        if($task!=null){
            $task->delete();
            return response()->json(['status'=>'200', 'message'=>'Item successfully deleted.', 'data'=>$task]);
        }else{
            return response()->json(['status'=>'204', 'message'=>'No such Item in database',]);
        }
    }

}
