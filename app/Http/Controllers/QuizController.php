<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class QuizController extends Controller
{
    public function index()
    {
        return view('quiz');
    }

    public function saveAnswer(Request $request)
    {
        $answer = new Answer();
        $answer->question = $request->input('question');
        $answer->selected_option = $request->input('selectedOption');
        $answer->correct = $request->input('correct');
        $answer->save();

        return response()->json(['message' => 'Answer saved'], 200);
    }
}
