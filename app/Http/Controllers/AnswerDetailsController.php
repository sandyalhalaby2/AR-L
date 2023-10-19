<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;
use App\Models\CompleteTheLetter;
use App\Models\Exercise;
use App\Models\FillInTheBlank;
use App\Models\MatchThePair;
use App\Models\MultipleChoice;
use App\Models\TrueorFalse;
use Illuminate\Http\Request;

class AnswerDetailsController extends Controller
{
    /**
     * Display the answer details for a specific exercise.
     *
     * @param  int  $exercise_id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function exercise_answer_details($exercise_id)
    {
        // Find the exercise by ID
        $exercise = Exercise::find($exercise_id);

        // Check the type of exercise and return the corresponding view with details
        if($exercise->hasMultipleChoice())
        {
            $details = $exercise->multipleChoice()->first();
            return view('multiple_choice.index', compact(['details']));
        }
        if($exercise->hasFillInTheBlank())
        {
            $details =  $exercise->fillInTheBlank()->first();
            return view('fill_in_the_blanks.index',compact('details'));
        }
        if($exercise->hastrueOrFalse())
        {
            $details =  $exercise->trueOrFalse()->first();
            return view('true_or_false.index',compact('details'));
        }
        if($exercise->hasMatchThePair())
        {
            $matchThePair = MatchThePair::where('exercise_id', $exercise_id)->firstOrFail();
            return view('match_the_pairs.index', ['matchThePair' => $matchThePair]);
        }if($exercise->hascompletetheletter())
        {
                $data = $exercise->completetheletter()->first() ;
                return view('complete_the_letter.index' , compact('data')) ;
        }

        // If none of the above, redirect to the create method
        return $this->create($exercise_id);
    }

    /**
     * Show the form for creating a new answer detail.
     *
     * @param  int  $exercise_id
     * @return \Illuminate\View\View
     */
    public function create($exercise_id)
    {
        // Return the answer details creation view with the exercise ID
        return view('answer_details.create', compact('exercise_id'));
    }

    /**
     * Store a newly created answer detail in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $exercise_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $exercise_id)
    {
        $data = $request->all();
        $data['exercise_id'] = $exercise_id;
        // Check the type of exercise and create the corresponding answer detail
        if($request->type == 'multiple_choice') {
            foreach(['1', '2', '3', '4', '5'] as $num) {
                $optionData = [];
                if($request->hasFile('option_' . $num . '_images')) {
                    $files = $request->file('option_' . $num . '_images');
                    foreach($files as $file) {
                        $path = $file->store('images', 'public'); // Store images in the 'images' directory in 'storage/app/public'
                        $optionData['images'][] = $path;
                    }
                }
                $optionData['text'] = $request->input('option_' . $num . '_text');
                $data['option_' . $num] = json_encode($optionData); // Ensure the option data is stored as a JSON string
            }

            MultipleChoice::create($data);
        }
        elseif($request->type == 'fill_in_the_blanks') {
            $data['question'] = $data['question_fill'];
            FillInTheBlank::create($data);
        }
        elseif($request->type == 'match_the_pairs') {
            $data['question'] = $data['question_fill2'];
            MatchThePair::create($data);
        }
        elseif($request->type == 'true_or_false')
        {
            $data['question'] = $data['question_fill3'] ;
            TrueorFalse::create($data) ;
        }
        elseif($request->type == 'complete_the_letter')
        {
            $chosen_letters = json_decode($request->input('chosen_letters'), true);
            $sorted_letters = json_decode($request->input('sorted_letters'), true);
            $data['letters'] =  implode(' , ' , $chosen_letters);
            $data['sorted_letters'] =   implode(' , ' , $sorted_letters);
            $data['question'] = $data['question_complete'] ;
            $data['sentence_with_blank'] = $request['sentence_with_blank1'] ;
            CompleteTheLetter::create($data);
        }

        // Instantiate ExerciseController and find the exercise by ID
        $exercisecon = new ExerciseController();
        $exercise = Exercise::find($exercise_id);

        // Redirect to the sub_skill_exercise method in ExerciseController with the sub_skill_id
        return $exercisecon->sub_skill_exercise($exercise->sub_skill_id);
    }



}
