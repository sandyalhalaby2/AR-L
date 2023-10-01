<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\Controller;
use App\Models\Exercise;
use App\Models\FillInTheBlank;
use App\Models\MatchThePair;
use App\Models\MultipleChoice;
use Illuminate\Http\Request;

class AnswerDetailsController extends Controller
{

    public function exercise_answer_details($exercise_id)
    {
        $exercise = Exercise::find($exercise_id);

        if($exercise->hasMultipleChoice())
        {
            $details = $exercise->multipleChoice()->first();
            return view('multiple_choice.index', compact(['details']));
        }
        if($exercise->hasFillInTheBlank())
        {
            $details =  $exercise->fillInTheBlank()->first() ;
            return view('fill_in_the_blanks.index',compact('details'));
        }
        if($exercise->hasMatchThePair())
        {
            $matchThePair = MatchThePair::where('exercise_id', $exercise_id)->firstOrFail();
            return view('match_the_pairs.index', ['matchThePair' => $matchThePair]);

        }

        return $this->create($exercise_id) ;
    }

    public function create($exercise_id)
    {
        return view('answer_details.create' , compact('exercise_id'));
    }

    public function store(Request $request , $exercise_id)
    {

        if($request->type == 'multiple_choice') {
            MultipleChoice::create([
                'exercise_id' => $exercise_id ,
                'question' => $request['question'],
                'option_1' => $request['option_1'],
                'option_2' => $request['option_2'],
                'option_3' => $request['option_3'],
                'option_4' => $request['option_4'],
                'option_5' => $request ['option_5'],
                'isCorrect' => $request['isCorrect'],
            ]);
        }elseif($request->type == 'fill_in_the_blanks')
        {
            FillInTheBlank::create([
                'exercise_id' => $exercise_id ,
                'question' => $request['question_fill'] ,
                'sentence_with_blank' => $request['sentence_with_blank'] ,
                'correct_answer'  => $request ['correct_answer']
            ]) ;
        }elseif($request->type == 'match_the_pairs') {
            MatchThePair::create([
                'exercise_id' => $exercise_id ,
                'question' =>$request['question_fill2'] ,
                'pair_1_item_a' => $request['pair_1_item_a'],
                'pair_1_item_b' => $request['pair_1_item_b'],
                'pair_2_item_a' => $request['pair_2_item_a'],
                'pair_2_item_b' => $request['pair_2_item_b'],
                'pair_3_item_a' => $request['pair_3_item_a'],
                'pair_3_item_b' => $request['pair_3_item_b'],
                'pair_4_item_a' => $request['pair_4_item_a'],
                'pair_4_item_b' => $request['pair_4_item_b'],
                'pair_5_item_a' => $request['pair_5_item_a'],
                'pair_5_item_b' => $request['pair_5_item_b']
            ]);
         }

         $exercisecon = new ExerciseController();
         $exercise = Exercise::find($exercise_id) ;

         return $exercisecon->sub_skill_exercise($exercise->sub_skill_id) ;
    }


    public function edit($id)
    {
        $exercises = Exercise::findOrFail($id);
        if($exercises['multiple_choices'] != null)
        {
            $details = $exercises->multipleChoice()->get() ;
            return view('multiple_choice.edit', compact('details'));
        }
        if($exercises->fill_in_the_blanks != null)
        {
            $details =  $exercises->fill_in_the_blanks()->get() ;
            return view('fill_in_the_blanks.edit',compact('details'));
        }
        if($exercises->match_the_pairs != null)
        {
            $details =  $exercises->match_the_pairs()->get() ;
            return view('match_the_pairs.edit', compact('details'));
        }
    }

    public function update(Request $request,  $exercise_id)
    {
        if($request->type == 'multiple_choice') {
            MultipleChoice::update($request->all());
        }elseif($request->type == 'fill_in_the_blanks')
        {
            FillInTheBlank::update($request->all()) ;
        }elseif($request->type == 'match_the_pairs') {
            MatchThePair::update($request->all());
        }
        $exercisecon = new ExerciseController();
        $exercise = Exercise::find($exercise_id) ;
        return $exercisecon->lesson_exercise($exercise->lesson_id) ;
    }

    public function destroy( $id)
    {
        $exercise = Exercise::findOrFail($id);
        $lesson_id = $exercise->lesson_id ;
        $exercise->delete();

        return $this->lesson_exercise($lesson_id);
    }

}
