<?php

namespace App\Http\Controllers;

use App\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class InstructionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructions = Instruction::where('is_approved', 1)->orderBy('id', 'DESC')->get();
        $instructions->load('author');
        return view('home', compact('instructions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instructions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:txt,docx,pdf'
        ]);
        if (Auth::check()) {
            $instruction = new Instruction();
            $instruction->author()->associate(Auth::user());
            $instruction->title = $validatedData['title'];
            $instruction->is_approved = 0;
            $path = $validatedData['file']->store('instructions');
            $instruction->instruction_path = $path;
            $instruction->save();
            return back()->with('success', 'Вы успешно добавили новую инструкцию');
        }
    }

    /**
     * Downloads a instruction file.
     *
     * @param  \App\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function download(Instruction $instruction)
    {
        return response()->download(storage_path('app/public/' . $instruction->instruction_path));
    }

    public function downloadAdmin(Instruction $instruction)
    {
        return response()->download(storage_path('app/public/' . $instruction->instruction_path));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function show(Instruction $instruction)
    {
        return view('instructions.instruction',compact('instruction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instruction = Instruction::find($id);
        if (!$instruction) {
            return abort(404);
        }
        $instruction->delete();
        return back();
    }

    public function state($id)
    {

        $instruction = Instruction::find($id);
        if (!$instruction) {
            return abort(404);
        }
        $instruction->is_approved = 1;
        $instruction->save();
        return back();
    }
}
