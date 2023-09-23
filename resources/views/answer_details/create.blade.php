@extends('layouts.app')

@section('title', 'Answer Details')

@section('contents')
    <h1 class="mb-0">Answer Details</h1>
    <hr />
    <form action="{{ route('answer_details.store', ['exercise_id' => $exercise_id]) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
        @csrf
        <div class="row mb-3">
            <div class="col mb-3">
                <label for="questionType">Select Type:</label>
                <select name="type" id="questionType" class="form-control">
                    <option value="" disabled selected>Select Type</option>
                    <option value="multiple_choice">Multiple Choice</option>
                    <option value="fill_in_the_blanks">Fill In the blanks</option>
                    <option value="match_the_pairs">Match the pairs</option>
                </select>
            </div>
        </div>

        <!-- Multiple Choice Fields (Hidden initially) -->
        <div id="multipleChoiceFields" style="display: none;">
            <div class="row mb-3">
                <div class="col">
                    <label for="question">Question:</label>
                    <textarea name="question" class="form-control"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <!-- Options Input Fields Here -->
                <div class="col">
                    <label for="option_1">Option 1:</label>
                    <input type="text" name="option_1" class="form-control">
                </div>
                <div class="col">
                    <label for="option_2">Option 2:</label>
                    <input type="text" name="option_2" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="option_3">Option 3:</label>
                    <input type="text" name="option_3" class="form-control">
                </div>
                <div class="col">
                    <label for="option_4">Option 4 (Optional):</label>
                    <input type="text" name="option_4" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="option_5">Option 5 (Optional):</label>
                    <input type="text" name="option_5" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="isCorrect">Correct Answer:</label>
                    <select name="isCorrect" class="form-control">
                        <option value="option_1">Option 1</option>
                        <option value="option_2">Option 2</option>
                        <option value="option_3">Option 3</option>
                        <option value="option_4">Option 4</option>
                        <option value="option_5">Option 5</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Fill In the Blanks Fields (Hidden initially) -->
        <div id="fillInTheBlanksFields" style="display: none;">
            <div class="row mb-3">
                <div class="col">
                    <label for="question">Question:</label>
                    <textarea name="question_fill" class="form-control"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="sentence_with_blank">Sentence with blank:</label>
                    <textarea name="sentence_with_blank" class="form-control"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="correct_answer">Correct Answer:</label>
                    <input type="text" name="correct_answer" class="form-control" id="correctAnswerInput">
                </div>
            </div>
        </div>

        <div id="matchThePairsFields" style="display: none;">
            <div class="row mb-3">
                <div class="col">
                    <label for="question_fill2">Question:</label>
                    <textarea name="question_fill2" class="form-control"></textarea>
                </div>
            </div>

            @for($i = 1; $i <= 5; $i++)
                <div class="row mb-3">
                    <div class="col">
                        <label for="pair_{{ $i }}_item_a">Pair {{ $i }} - Item A:</label>
                        <input type="text" name="pair_{{ $i }}_item_a" class="form-control">
                    </div>
                    <div class="col">
                        <label for="pair_{{ $i }}_item_b">Pair {{ $i }} - Item B:</label>
                        <input type="text" name="pair_{{ $i }}_item_b" class="form-control">
                    </div>
                </div>
            @endfor
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            $('#questionType').change(function() {
                const selectedType = $(this).val();

                // Hide all dynamic fields first
                $('#multipleChoiceFields').hide();
                $('#fillInTheBlanksFields').hide();
                $('#matchThePairsFields').hide();

                // Then show the fields corresponding to the selected type
                if (selectedType === 'multiple_choice') {
                    $('#multipleChoiceFields').show();
                } else if (selectedType === 'fill_in_the_blanks') {
                    $('#fillInTheBlanksFields').show();
                }else if (selectedType === 'match_the_pairs') {
                    $('#matchThePairsFields').show();
                }
            });
        });

        function validateForm() {
            const selectedType = document.getElementById('questionType').value;

            if (selectedType === 'multiple_choice') {
                const question = document.querySelector('textarea[name="question"]').value;
                const option1 = document.querySelector('input[name="option_1"]').value;
                const option2 = document.querySelector('input[name="option_2"]').value;
                const option3 = document.querySelector('input[name="option_3"]').value;
                const correctAnswer = document.querySelector('select[name="isCorrect"]').value;

                if (!option1 || !option2 || !option3 || !question) {
                    alert('Please fill in Question and at least Option 1, Option 2, and Option 3.');
                    return false;
                }

                if (![option1, option2, option3].includes(correctAnswer)) {
                    alert('The correct answer must be among the options entered.');
                    return false;
                }

            } else if (selectedType === 'fill_in_the_blanks') {
                const question = document.querySelector('textarea[name="question_fill"]').value;
                const sentence = document.querySelector('textarea[name="sentence_with_blank"]').value;
                const correctAnswer = document.querySelector('input[name="correct_answer"]').value;

                if (!question || !sentence || !correctAnswer) {
                    alert('Please fill in all fields for Fill In the Blanks.');
                    return false;
                }

            } else if (selectedType === 'match_the_pairs') {
                let completePairs = 0;

                for (let i = 1; i <= 5; i++) {
                    const itemA = document.querySelector('input[name="pair_' + i + '_item_a"]').value;
                    const itemB = document.querySelector('input[name="pair_' + i + '_item_b"]').value;

                    if (itemA && itemB) {
                        completePairs++;
                    } else if ((itemA && !itemB) || (!itemA && itemB)) {
                        alert('Please complete both Item A and Item B for Pair ' + i);
                        return false;
                    }
                }

                if (completePairs < 3) {
                    alert('Please fill in at least 3 complete pairs.');
                    return false;
                }
            }

            return true;
        }
    </script>
@endsection
