<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outcome;
use App\Models\OutcomeSource;
use Illuminate\Http\Request;

class OutcomeController extends Controller
{
    public function outcome_list(Request $request){
        $month = $request->month ?? date('m');
        $year  = $request->year ?? date('Y');
        $outcomes = Outcome::whereYear('outcome_date', $year)->whereMonth('outcome_date', $month)->get();
        return view('Admin.outcomes.outcome_list',compact('outcomes'));
    }


    public function outcome_add(){
        $sources = OutcomeSource::all();
        return view('Admin.outcomes.outcome_add',compact('sources'));
    }

    public function outcome_save(Request $request){
        $request->validate([
           'source_id' => ['required','exists:outcome_sources,id'], 
           'outcome_amount' =>['required','numeric'],
            'outcome_date' =>['required','date']
        ]);

        $outcome = new Outcome();
        $outcome->source_id = $request->source_id;
        $outcome->outcome_amount = $request->outcome_amount;
        $outcome->outcome_date = $request->outcome_date;
        $outcome->save();
        return redirect()->route('outcome_list')->with('success','Outcome Added Successfully!');


    }

    public function outcome_edit($id){
        $sources = OutcomeSource::all();
        $outcome = Outcome::find($id);
        return view('Admin.outcomes.outcome_edit',compact('sources','outcome'));
    }

    public function outcome_update(Request $request,$id){
            $request->validate([
               'source_id' => ['required','exists:outcome_sources,id'],
               'outcome_amount' =>['required','numeric'],
                'outcome_date' =>['required','date']

            ]);
            $outcome = Outcome::find($id);
            $outcome ->source_id = $request->source_id;
            $outcome->outcome_amount = $request->outcome_amount;
            $outcome->outcome_date = $request->outcome_date;
            $outcome->save();

            return redirect()->route('outcome_list')->with('success','Outcome Updated Successfully!');
    }



    public function outcome_delete($id){
        $outcome = Outcome::find($id);
        $outcome->delete();
        return redirect()->route('outcome_list')->with('success','Outcome Deleted Successfully!');
    }







    public function outcome_source_list(){

        $outcome_sources = OutcomeSource::all();
        return view('Admin.outcomes.outcome_source_list',compact('outcome_sources'));

    }

    public function outcome_source_add(){
        return view('Admin.outcomes.outcome_source_add');
    }


    public function outcome_source_save(Request $request){
        $request->validate([
           'source_name' =>['required','string','max:255'] 
        ]);

        $source = new OutcomeSource();
        $source->source_name = $request->source_name;
        $source->save();
        return redirect()->route('outcome_source_list')->with('success','Outcome Source Added Successfully!');
    }


    public function outcome_source_edit($id){
        $outcome_source = OutcomeSource::find($id);
        return view('Admin.outcomes.outcome_source_edit',compact('outcome_source'));
    }

    public function outcome_source_update(Request $request,$id){
        $request->validate([
            'source_name' =>['required','string','max:255'] 
         ]);
 
         $source = OutcomeSource::find($id);
         $source->source_name = $request->source_name;
         $source->save();
         return redirect()->route('outcome_source_list')->with('success','Outcome Source Updated Successfully!');
    }


    public function outcome_source_delete($id){
            $outcome_source = OutcomeSource::find($id);
            $outcome_source->delete();
            return redirect()->route('outcome_source_list')->with('success','Outcome Source Deleted Successfully!');
    }
    
}
