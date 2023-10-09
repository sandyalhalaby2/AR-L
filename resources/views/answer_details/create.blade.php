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
                    <option value="true_or_false">True or False</option>
                    <option value="complete_the_letter">Complete the Letter</option>
                </select>
            </div>
        </div>
    @php
        $arabic_lines = [
            ['ض', 'ص', 'ث', 'ق', 'ف', 'غ', 'ع', 'ه', 'خ', 'ح', 'ج', 'د'],
            ['ش', 'س', 'ي', 'ب', 'ل', 'ا', 'ت', 'ن', 'م', 'ك', 'ط'],
            ['ئ', 'ء', 'ؤ', 'ر', 'ى', 'ة', 'و', 'ز', 'ظ']
        ];
    @endphp
        <!-- Complete the Letter Fields (Hidden initially) -->
        <div id="completeTheLetterFields" style="display: none;">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Question</h2>
                </div>
                <div class="card-body">
                    <textarea name="question_complete" class="form-control" placeholder="Type your question here..."></textarea>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h2>Sentence with Blank</h2>
                </div>
                <div class="card-body">
                    <textarea name="sentence_with_blank1" class="form-control" placeholder="Type your sentence with a blank here..."></textarea>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h2>Select Letters</h2>
                </div>
                <div class="card-body">
                    <div class="arabic-letters">
                        @foreach($arabic_lines as $line)
                            @foreach($line as $letter)
                                <div class="letter-box" data-letter="{{ $letter }}">
                                    {{ $letter }}
                                </div>
                            @endforeach
                            <br/>
                        @endforeach
                    </div>
                    <input type="hidden" name="letters" id="lettersInput">
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Sorted Letters</h2>
                    </div>
                    <div class="card-body">
                        <input type="text" name="sorted_letters" id="sortedLettersInput" class="form-control" placeholder="Sorted letters separated by comma">
                    </div>
                </div>
            </div>
        </div>






        <!-- Multiple Choice Fields (Hidden initially) -->
        <div id="true_or_false" style="display: none;">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Question</h2>
                </div>
                <div class="card-body">
                    <textarea name="question_fill3" id="question" class="form-control" required placeholder="Type your question here..."></textarea>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h2>Select the Correct Option</h2>
                </div>
                <div class="card-body" id="cardBody">
                    <select name="is_true" id="is_true" class="form-select" required onchange="changeColor()">
                        <option value="" disabled selected>Select an option</option>
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Multiple Choice Fields (Hidden initially) -->
        <div id="multipleChoiceFields" style="display: none;">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Question</h2>
                </div>
                <div class="card-body">
                    <textarea name="question" id="question" class="form-control" required placeholder="Type your question here..."></textarea>
                </div>
            </div>

            @foreach(['1', '2', '3', '4', '5'] as $num)
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h3>Option {{ $num }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="option_{{ $num }}_text" class="form-label">Text:</label>
                            <input type="text" name="option_{{ $num }}_text" id="option_{{ $num }}_text" class="form-control" placeholder="Text Option">
                        </div>
                        <div class="mb-3">
                            <label for="option_{{ $num }}_images" class="form-label">Or Upload Images:</label>
                            <input type="file" class="form-control" name="option_{{ $num }}_images[]" id="option_{{ $num }}_images" multiple>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h2>Select the Correct Option</h2>
                </div>
                <div class="card-body">
                    <select name="isCorrect" id="isCorrect" class="form-select" required>
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
                $('#true_or_false, #multipleChoiceFields, #fillInTheBlanksFields, #matchThePairsFields, #completeTheLetterFields')
                    .hide()
                    .find('textarea, input, select').removeAttr('required');

                // Then show the fields corresponding to the selected type
                if (selectedType === 'complete_the_letter') {
                    $('#completeTheLetterFields').show();
                } else if (selectedType === 'multiple_choice') {
                    $('#multipleChoiceFields').show();
                } else if (selectedType === 'fill_in_the_blanks') {
                    $('#fillInTheBlanksFields').show();
                } else if (selectedType === 'match_the_pairs') {
                    $('#matchThePairsFields').show();
                } else if (selectedType === 'true_or_false') {
                    $('#true_or_false').show();
                }
                $('#' + selectedType).find('textarea, input, select').attr('required', 'required');
            });
        });

        // Additional JS for letter selection
        document.addEventListener('DOMContentLoaded', function () {
            let selectedLetters = [];
            document.querySelectorAll('.letter-box').forEach(box => {
                box.addEventListener('click', function () {
                    const letter = box.dataset.letter;
                    if (selectedLetters.includes(letter)) {
                        selectedLetters = selectedLetters.filter(l => l !== letter);
                        box.classList.remove('selected');
                    } else {
                        selectedLetters.push(letter);
                        box.classList.add('selected');
                    }
                    document.getElementById('lettersInput').value = selectedLetters.join(',');
                });
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
                const selectedCorrectOption = document.querySelector('input[name="' + correctAnswer + '"]').value;

                if (![option1, option2, option3].includes(selectedCorrectOption)) {
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
            }    if (selectedType === 'complete_the_letter') {
                const sentenceWithBlank = document.querySelector('textarea[name="sentence_with_blank1"]').value;
                const sortedLetters = document.querySelector('input[name="sorted_letters"]').value;
                const selectedLetters = document.getElementById('lettersInput').value.split(',');

                if (!sentenceWithBlank || !sortedLetters) {
                    alert('Please fill in all fields for Complete the Letter.');
                    return false;
                }

                // Validate that the sorted letters are separated by a comma without spaces
                // and are Arabic letters
                const sortedLettersArray = sortedLetters.split(',');
                const sortedLettersRegex = /^[\u0621-\u064A](,[\u0621-\u064A])*$/;
                if (!sortedLettersRegex.test(sortedLetters)) {
                    alert('Sorted letters must be Arabic letters separated by a comma without spaces.');
                    return false;
                }

                // Validate that the sorted letters are from the selected letters
                for (let letter of sortedLettersArray) {
                    if (!selectedLetters.includes(letter)) {
                        alert('All sorted letters must be from the selected letters.');
                        return false;
                    }
                }
            }

            return true;
        }
        // script.js
        function changeColor() {
            var selectBox = document.getElementById('is_true');
            var cardBody = document.getElementById('cardBody');

            // Check the selected value and change the background color accordingly
            if (selectBox.value == "1") {
                cardBody.style.backgroundColor = "#d4edda"; // Light Green
            } else if (selectBox.value == "0") {
                cardBody.style.backgroundColor = "#f8d7da"; // Light Red
            } else {
                cardBody.style.backgroundColor = ""; // Default
            }
        }

    </script>
    <style>
        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }
        .custom-file-input::before {
            content: 'Choose files';
            display: inline-block;
            background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3);
            border: 1px solid #999;
            border-radius: 3px;
            padding: 5px 8px;
            outline: none;
            white-space: nowrap;
            -webkit-user-select: none;
            cursor: pointer;
            text-shadow: 1px 1px #fff;
            font-weight: 700;
            font-size: 10pt;
        }
        .custom-file-input:hover::before {
            border-color: black;
        }
        .custom-file-input:active::before {
            background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
        }
        /* Custom styling for file input */
        .input-group-text {
            cursor: pointer;
        }
        .input-group-text:hover,
        .input-group-text:active,
        .input-group-text:focus {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        /* styles.css */
        .card-body {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.5s ease; /* Smooth transition */
        }

        .form-select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            appearance: none;
        }
        .letter-box {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            background-color: white;
            border: 1px solid #ccc;
            cursor: pointer;
            user-select: none;
            margin: 2px;
            font-size: 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s; /* Smooth transition */
        }

        .selected {
            background-color: #4CAF50; /* Green */
            color: white;
        }

        .arabic-letters {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 4px;
            margin-bottom: 20px;
        }


    </style>

@endsection
