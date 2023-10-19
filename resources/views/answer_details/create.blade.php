@extends('layouts.app')

@section('title', 'Answer Details')

@section('contents')

    <h1 class="mb-0">Answer Details</h1>
    <hr />
    <form action="{{ route('answer_details.store', ['exercise_id' => $exercise_id]) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
        @csrf
        {{--        select correct type         --}}
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

        $letter = [
           'ا'=>[
            'ا' => [] ,
            'أ' => [] ,
            'إ' => [] ,
            'آ' => [],
           ],
           'ب' => [
               'ب' => [
                   'بَ',
                   'بُ',
                   'بِ',
                   'بً',
                   'بٌ',
                   'بٍ'
               ],
               'ـب' => [
                   'ـبَ',
                   'ـبُ',
                   'ـبِ',
                   'ـبً',
                   'ـبٌ',
                   'ـبٍ'
               ],
               'ـبـ' => [
                   'ـبَـ',
                   'ـبُـ',
                   'ـبِـ',
                   'ـبّـ'
               ],
               'بـ' => [
                   'بَـ',
                   'بُـ',
                   'بِـ'
               ]
           ],
           'ت' => [
               'ت' => [
                   'تَ',
                   'تُ',
                   'تِ',
                   'تً',
                   'تٌ',
                   'تٍ'
               ],
               'ـت' => [
                   'ـتَ',
                   'ـتُ',
                   'ـتِ',
                   'ـتً',
                   'ـتٌ',
                   'ـتٍ'
               ],
               'ـتـ' => [
                   'ـتَـ',
                   'ـتُـ',
                   'ـتِـ',
                   'ـتّـ'
               ],
               'تـ' => [
                   'تَـ',
                   'تُـ',
                   'تِـ'
               ]
           ],
           'ث' => [
               'ث' => [
                   'ثَ',
                   'ثُ',
                   'ثِ',
                   'ثً',
                   'ثٌ',
                   'ثٍ'
               ],
               'ـث' => [
                   'ـثَ',
                   'ـثُ',
                   'ـثِ',
                   'ـثً',
                   'ـثٌ',
                   'ـثٍ'
               ],
               'ـثـ' => [
                   'ـثَـ',
                   'ـثُـ',
                   'ـثِـ',
                   'ـثّـ'
               ],
               'ثـ' => [
                   'ثَـ',
                   'ثُـ',
                   'ثِـ'
               ]
           ],
           'ج' => [
               'ج' => [
                   'جَ',
                   'جُ',
                   'جِ',
                   'جً',
                   'جٌ',
                   'جٍ'
               ],
               'ـج' => [
                   'ـجَ',
                   'ـجُ',
                   'ـجِ',
                   'ـجً',
                   'ـجٌ',
                   'ـجٍ'
               ],
               'ـجـ' => [
                   'ـجَـ',
                   'ـجُـ',
                   'ـجِـ',
                   'ـجّـ'
               ],
               'جـ' => [
                   'جَـ',
                   'جُـ',
                   'جِـ'
               ]
           ],
           'ح' => [
               'ح' => [
                   'حَ',
                   'حُ',
                   'حِ',
                   'حً',
                   'حٌ',
                   'حٍ'
               ],
               'ـح' => [
                   'ـحَ',
                   'ـحُ',
                   'ـحِ',
                   'ـحً',
                   'ـحٌ',
                   'ـحٍ'
               ],
               'ـحـ' => [
                   'ـحَـ',
                   'ـحُـ',
                   'ـحِـ',
                   'ـحّـ'
               ],
               'حـ' => [
                   'حَـ',
                   'حُـ',
                   'حِـ'
               ]
           ],
           'خ' => [
               'خ' => [
                   'خَ',
                   'خُ',
                   'خِ',
                   'خً',
                   'خٌ',
                   'خٍ'
               ],
               'ـخ' => [
                   'ـخَ',
                   'ـخُ',
                   'ـخِ',
                   'ـخً',
                   'ـخٌ',
                   'ـخٍ'
               ],
               'ـخـ' => [
                   'ـخَـ',
                   'ـخُـ',
                   'ـخِـ',
                   'ـخّـ'
               ],
               'خـ' => [
                   'خَـ',
                   'خُـ',
                   'خِـ'
               ]
           ],
           'د' => [
               'د' => [
                   'دَ',
                   'دُ',
                   'دِ',
                   'دً',
                   'دٌ',
                   'دٍ'
               ],
               'ـد' => [
                   'ـدَ',
                   'ـدُ',
                   'ـدِ',
                   'ـدً',
                   'ـدٌ',
                   'ـدٍ'
               ]
           ],
           'ذ' => [
               'ذ' => [
                   'ذَ',
                   'ذُ',
                   'ذِ',
                   'ذً',
                   'ذٌ',
                   'ذٍ'
               ],
               'ـذ' => [
                   'ـذَ',
                   'ـذُ',
                   'ـذِ',
                   'ـذً',
                   'ـذٌ',
                   'ـذٍ'
               ]
           ],
           'ر' => [
               'ر' => [
                   'رَ',
                   'رُ',
                   'رِ',
                   'رً',
                   'رٌ',
                   'رٍ'
               ],
               'ـر' => [
                   'ـرَ',
                   'ـرُ',
                   'ـرِ',
                   'ـرً',
                   'ـرٌ',
                   'ـرٍ'
               ]
           ],
           'ز' => [
               'ز' => [
                   'زَ',
                   'زُ',
                   'زِ',
                   'زً',
                   'زٌ',
                   'زٍ'
               ],
               'ـز' => [
                   'ـزَ',
                   'ـزُ',
                   'ـزِ',
                   'ـزً',
                   'ـزٌ',
                   'ـزٍ'
               ]
           ],
           'س' => [
               'س' => [
                   'سَ',
                   'سُ',
                   'سِ',
                   'سً',
                   'سٌ',
                   'سٍ'
               ],
               'ـس' => [
                   'ـسَ',
                   'ـسُ',
                   'ـسِ',
                   'ـسً',
                   'ـسٌ',
                   'ـسٍ'
               ],
               'ـسـ' => [
                   'ـسَـ',
                   'ـسُـ',
                   'ـسِـ',
                   'ـسّـ'
               ],
               'سـ' => [
                   'سَـ',
                   'سُـ',
                   'سِـ'
               ]
           ],
           'ش' => [
               'ش' => [
                   'شَ',
                   'شُ',
                   'شِ',
                   'شً',
                   'شٌ',
                   'شٍ'
               ],
               'ـش' => [
                   'ـشَ',
                   'ـشُ',
                   'ـشِ',
                   'ـشً',
                   'ـشٌ',
                   'ـشٍ'
               ],
               'ـشـ' => [
                   'ـشَـ',
                   'ـشُـ',
                   'ـشِـ',
                   'ـشّـ'
               ],
               'شـ' => [
                   'شَـ',
                   'شُـ',
                   'شِـ'
               ]
           ],
           'ص' => [
               'ص' => [
                   'صَ',
                   'صُ',
                   'صِ',
                   'صً',
                   'صٌ',
                   'صٍ'
               ],
               'ـص' => [
                   'ـصَ',
                   'ـصُ',
                   'ـصِ',
                   'ـصً',
                   'ـصٌ',
                   'ـصٍ'
               ],
               'ـصـ' => [
                   'ـصَـ',
                   'ـصُـ',
                   'ـصِـ',
                   'ـصّـ'
               ],
               'صـ' => [
                   'صَـ',
                   'صُـ',
                   'صِـ'
               ]
           ],
           'ض' => [
               'ض' => [
                   'ضَ',
                   'ضُ',
                   'ضِ',
                   'ضً',
                   'ضٌ',
                   'ضٍ'
               ],
               'ـض' => [
                   'ـضَ',
                   'ـضُ',
                   'ـضِ',
                   'ـضً',
                   'ـضٌ',
                   'ـضٍ'
               ],
               'ـضـ' => [
                   'ـضَـ',
                   'ـضُـ',
                   'ـضِـ',
                   'ـضّـ'
               ],
               'ضـ' => [
                   'ضَـ',
                   'ضُـ',
                   'ضِـ'
               ]
           ],
           'ط' => [
               'ط' => [
                   'طَ',
                   'طُ',
                   'طِ',
                   'طً',
                   'طٌ',
                   'طٍ'
               ],
               'ـط' => [
                   'ـطَ',
                   'ـطُ',
                   'ـطِ',
                   'ـطً',
                   'ـطٌ',
                   'ـطٍ'
               ],
               'ـطـ' => [
                   'ـطَـ',
                   'ـطُـ',
                   'ـطِـ',
                   'ـطّـ'
               ],
               'طـ' => [
                   'طَـ',
                   'طُـ',
                   'طِـ'
               ]
           ],
           'ظ' => [
               'ظ' => [
                   'ظَ',
                   'ظُ',
                   'ظِ',
                   'ظً',
                   'ظٌ',
                   'ظٍ'
               ],
               'ـظ' => [
                   'ـظَ',
                   'ـظُ',
                   'ـظِ',
                   'ـظً',
                   'ـظٌ',
                   'ـظٍ'
               ],
               'ـظـ' => [
                   'ـظَـ',
                   'ـظُـ',
                   'ـظِـ',
                   'ـظّـ'
               ],
               'ظـ' => [
                   'ظَـ',
                   'ظُـ',
                   'ظِـ'
               ]
           ],
           'ع' => [
               'ع' => [
                   'عَ',
                   'عُ',
                   'عِ',
                   'عً',
                   'عٌ',
                   'عٍ'
               ],
               'ـع' => [
                   'ـعَ',
                   'ـعُ',
                   'ـعِ',
                   'ـعً',
                   'ـعٌ',
                   'ـعٍ'
               ],
               'ـعـ' => [
                   'ـعَـ',
                   'ـعُـ',
                   'ـعِـ',
                   'ـعّـ'
               ],
               'عـ' => [
                   'عَـ',
                   'عُـ',
                   'عِـ'
               ]
           ],
           'غ' => [
               'غ' => [
                   'غَ',
                   'غُ',
                   'غِ',
                   'غً',
                   'غٌ',
                   'غٍ'
               ],
               'ـغ' => [
                   'ـغَ',
                   'ـغُ',
                   'ـغِ',
                   'ـغً',
                   'ـغٌ',
                   'ـغٍ'
               ],
               'ـغـ' => [
                   'ـغَـ',
                   'ـغُـ',
                   'ـغِـ',
                   'ـغّـ'
               ],
               'غـ' => [
                   'غَـ',
                   'غُـ',
                   'غِـ'
               ]
           ],
           'ف' => [
               'ف' => [
                   'فَ',
                   'فُ',
                   'فِ',
                   'فً',
                   'فٌ',
                   'فٍ'
               ],
               'ـف' => [
                   'ـفَ',
                   'ـفُ',
                   'ـفِ',
                   'ـفً',
                   'ـفٌ',
                   'ـفٍ'
               ],
               'ـفـ' => [
                   'ـفَـ',
                   'ـفُـ',
                   'ـفِـ',
                   'ـفّـ'
               ],
               'فـ' => [
                   'فَـ',
                   'فُـ',
                   'فِـ'
               ]
           ],
           'ق' => [
               'ق' => [
                   'قَ',
                   'قُ',
                   'قِ',
                   'قً',
                   'قٌ',
                   'قٍ'
               ],
               'ـق' => [
                   'ـقَ',
                   'ـقُ',
                   'ـقِ',
                   'ـقً',
                   'ـقٌ',
                   'ـقٍ'
               ],
               'ـقـ' => [
                   'ـقَـ',
                   'ـقُـ',
                   'ـقِـ',
                   'ـقّـ'
               ],
               'قـ' => [
                   'قَـ',
                   'قُـ',
                   'قِـ'
               ]
           ],
           'ك' => [
               'ك' => [
                   'كَ',
                   'كُ',
                   'كِ',
                   'كً',
                   'كٌ',
                   'كٍ'
               ],
               'ـك' => [
                   'ـكَ',
                   'ـكُ',
                   'ـكِ',
                   'ـكً',
                   'ـكٌ',
                   'ـكٍ'
               ],
               'ـكـ' => [
                   'ـكَـ',
                   'ـكُـ',
                   'ـكِـ',
                   'ـكّـ'
               ],
               'كـ' => [
                   'كَـ',
                   'كُـ',
                   'كِـ'
               ]
           ],
           'ل' => [
               'ل' => [
                   'لَ',
                   'لُ',
                   'لِ',
                   'لً',
                   'لٌ',
                   'لٍ'
               ],
               'ـل' => [
                   'ـلَ',
                   'ـلُ',
                   'ـلِ',
                   'ـلً',
                   'ـلٌ',
                   'ـلٍ'
               ],
               'ـلـ' => [
                   'ـلَـ',
                   'ـلُـ',
                   'ـلِـ',
                   'ـلّـ'
               ],
               'لـ' => [
                   'لَـ',
                   'لُـ',
                   'لِـ'
               ]
           ],
           'م' => [
               'م' => [
                   'مَ',
                   'مُ',
                   'مِ',
                   'مً',
                   'مٌ',
                   'مٍ'
               ],
               'ـم' => [
                   'ـمَ',
                   'ـمُ',
                   'ـمِ',
                   'ـمً',
                   'ـمٌ',
                   'ـمٍ'
               ],
               'ـمـ' => [
                   'ـمَـ',
                   'ـمُـ',
                   'ـمِـ',
                   'ـمّـ'
               ],
               'مـ' => [
                   'مَـ',
                   'مُـ',
                   'مِـ'
               ]
           ],
           'ن' => [
               'ن' => [
                   'نَ',
                   'نُ',
                   'نِ',
                   'نً',
                   'نٌ',
                   'نٍ'
               ],
               'ـن' => [
                   'ـنَ',
                   'ـنُ',
                   'ـنِ',
                   'ـنً',
                   'ـنٌ',
                   'ـنٍ'
               ],
               'ـنـ' => [
                   'ـنَـ',
                   'ـنُـ',
                   'ـنِـ',
                   'ـنّـ'
               ],
               'نـ' => [
                   'نَـ',
                   'نُـ',
                   'نِـ'
               ]
           ],
           'ه' => [
               'ه' => [
                   'هَ',
                   'هُ',
                   'هِ',
                   'هً',
                   'هٌ',
                   'هٍ'
               ],
               'ـه' => [
                   'ـهَ',
                   'ـهُ',
                   'ـهِ',
                   'ـهً',
                   'ـهٌ',
                   'ـهٍ'
               ],
               'ـهـ' => [
                   'ـهَـ',
                   'ـهُـ',
                   'ـهِـ',
                   'ـهّـ'
               ],
               'هـ' => [
                   'هَـ',
                   'هُـ',
                   'هِـ'
               ]
           ],
           'و' => [
               'و' => [
                   'وَ',
                   'وُ',
                   'وِ',
                   'وً',
                   'وٌ',
                   'وٍ'
               ],
               'ـو' => [
                   'ـوَ',
                   'ـوُ',
                   'ـوِ',
                   'ـوً',
                   'ـوٌ',
                   'ـوٍ'
               ],

           ],
           'ي' => [
               'ي' => [
                   'يَ',
                   'يُ',
                   'يِ',
                   'يً',
                   'يٌ',
                   'يٍ'
               ],
               'ـي' => [
                   'ـيَ',
                   'ـيُ',
                   'ـيِ',
                   'ـيً',
                   'ـيٌ',
                   'ـيٍ'
               ],
               'ـيـ' => [
                   'ـيَـ',
                   'ـيُـ',
                   'ـيِـ',
                   'ـيّـ'
               ],
               'يـ' => [
                   'يَـ',
                   'يُـ',
                   'يِـ'
               ] ,
           ],'ى' => [
            'ى' => [] ,
            'ئ' => []
           ], 'ؤ' => [
            'ؤ' => []
           ] , 'ء' => [
            'ء' => []
           ]
       ];

    @endphp
        <!-- Complete the Letter Fields (Hidden initially) -->
        <div id="completeTheLetterFields" style="display: none;">

            <!-- Question Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Question</h2>
                </div>
                <div class="card-body">
                    <textarea name="question_complete" class="form-control" placeholder="Type your question here..."></textarea>
                </div>
            </div>

            <!-- Sentence with Blank Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Sentence with Blank</h2>
                </div>
                <div class="card-body">
                    <textarea name="sentence_with_blank1" class="form-control" placeholder="Type your sentence with a blank here..."></textarea>
                </div>
            </div>

            <!-- Select Letters Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Select Letters</h2>
                </div>
                <div class="card-body" style="direction: rtl">
                    <div class="arabic-letters">
                        <ul class="letter-list">
                            @foreach($letter as $key => $value)
                                <li class="letter-box" data-letter="{{ $key }}">
                                    {{ $key }}
                                    <ul class="shapes-list">
                                        @foreach($value as $shape => $formats)
                                            <li class="shape-box"  data-shape="{{ $shape }}">
                                                {{ $shape }}
                                                <ul class="formats-list">
                                                    @foreach($formats as $format)
                                                        <li class="format" data-format="{{ $format }}">
                                                            {{ $format }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <input type="hidden" name="letters" id="lettersInput">
                </div>
            </div>

            <!-- choosen Letters Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2>The letters that will choose from</h2>
                </div>
                <!-- choosen Letters Container -->
                <div id="choosenLettersContainer" class="choosen-letters-container">
                    <input type="hidden" name="chosen_letters" id="chosenLettersInput">
                </div>
            </div>

            <!-- Sorted Letters Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Correct Sorted letter</h2>
                </div>
                <!-- choosen Letters Container -->
                <div id="sortedLettersContainer" class="sorted-letters-container">
                    <input type="hidden" name="sorted_letters" id="sortedLettersInput">
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

        <!---Submit--->
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>


    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Scripts -->
    <script>

        $(document).ready(function() {
            // to generate element for every question
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

            // Single-click on a letter box to open shapes list
            $('.letter-box').on('click', function () {
                // Hide all other shapes-list
                $('.shapes-list').css('display', 'none');
                $(this).find('.shapes-list').toggle();
            });

            let doubleClick = false; // Variable to track double-click


            // Single-click on each element inside the shape list to open the format list
            $('.shape-box').on('click', function () {
                if (doubleClick) {
                    doubleClick = false;
                    return;
                }
                // Hide all other formats-list
                $('.formats-list').css('display', 'none');
                $(this).find('.formats-list').toggle();
            });


            // Double-click inside shapes list to add it to choosen letter
            $('.shape-box').on('dblclick', function (event) {
                if (doubleClick) {
                    return;
                }
                doubleClick = true;

                const shape = $(this).data('shape');
                addLetterToChoosen(shape);

                // Hide the shapes list and formats list
                $('.shapes-list').css('display', 'none');
                $('.formats-list').css('display', 'none');


                event.stopPropagation(); // Stop event propagation here
            });


            // Double-click inside format list to add the format to choosen letter
            $('.format').on('dblclick', function (event) {
                const format = $(this).data('format');
                addFormatToChoosen(format);

                // Hide the formats list
                $(this).closest('.formats-list').css('display', 'none'); // hides the parent formats-list of the clicked format
                $('.shapes-list').css('display', 'none'); // hides all shapes-lists

                event.stopPropagation();

            });

            let  index = 0 ;

            function addRemoveButton(parentElement, className) {
                const removeBtn = document.createElement('button');
                removeBtn.classList.add('remove-btn', className);
                parentElement.appendChild(removeBtn);
            }

            function addLetterToChoosen(letter) {
                index ++ ;
                const choosenLettersContainer = document.getElementById('choosenLettersContainer');
                const newLetterBox = document.createElement('div');
                newLetterBox.classList.add('sortable-letter-box');
                newLetterBox.setAttribute('data-index', index.toString()); // Store the index for synchronization
                newLetterBox.textContent = letter;
                choosenLettersContainer.appendChild(newLetterBox);
                addRemoveButton(newLetterBox, 'remove-sortable');
            }

            function addFormatToChoosen(format) {
                index ++ ;
                const choosenLettersContainer = document.getElementById('choosenLettersContainer');
                const newFormatBox = document.createElement('div');
                newFormatBox.classList.add('sortable-letter-box');
                newFormatBox.setAttribute('data-index', index.toString()); // Store the index for synchronization
                newFormatBox.textContent = format;
                choosenLettersContainer.appendChild(newFormatBox);
                addRemoveButton(newFormatBox, 'remove-sortable');
            }

            function addCorrectLetterBox(letter, index) {
                const sortedLettersContainer = document.getElementById('sortedLettersContainer');
                const newLetterBox = document.createElement('div');
                newLetterBox.classList.add('correct-letter-box');
                newLetterBox.textContent = letter;
                newLetterBox.setAttribute('data-index', index); // Store the index for synchronization
                sortedLettersContainer.appendChild(newLetterBox);
                addRemoveButton(newLetterBox, 'remove-correct');
            }

            $(document).on('click', '.sortable-letter-box', function () {
                if(!$(this).hasClass('selected')) {
                    $(this).addClass('selected');
                    addCorrectLetterBox($(this).text(), $(this).attr('data-index'));
                }
            });

            $(document).on('click', '.remove-sortable', function (event) {
                event.stopPropagation(); // Prevents triggering the click event of the parent box
                const index = $(this).parent().data('index');
                $(`#sortedLettersContainer [data-index='${index}']`).remove(); // Remove the corresponding correct-letter-box
                $(this).parent().remove(); // Remove the sortable-letter-box
            });

            $(document).on('click', '.remove-correct', function (event) {
                event.stopPropagation(); // Prevents triggering the click event of the parent box
                const index = $(this).parent().data('index');
                const sortableBox = $(`#choosenLettersContainer [data-index='${index}']`);
                sortableBox.removeClass('selected');
                $(this).parent().remove(); // Remove the correct-letter-box
            });
        });

        function getChoosenLetters() {
            var letters = [];
            $('#choosenLettersContainer .sortable-letter-box').each(function() {
                letters.push($(this).text().trim());
            });
            return letters;
        }

        function getSortedLetters() {
            var letters = [];
            $('#sortedLettersContainer .correct-letter-box').each(function() {
                letters.push($(this).text().trim());
            });
            return letters;
        }

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
            }else if (selectedType === 'complete_the_letter')
            {
                var choosenLetters = getChoosenLetters();
                var sortedLetters = getSortedLetters();

                // Set the data in the hidden inputs
                $('#chosenLettersInput').val(JSON.stringify(choosenLetters));
                $('#sortedLettersInput').val(JSON.stringify(sortedLetters));
            }
            return true;
        }


    </script>

    <style>
        .remove-btn {
            cursor: pointer;
            background-color: #e74c3c; /* Red color */
            border: none;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            outline: none;
            transition: background-color 0.3s;
        }

        .remove-btn:hover {
            background-color: #c0392b; /* Darker red on hover */
        }


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

        .correct-letter-box {
            position: relative;
            display: inline-block;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 30px;
            padding-left: 15px;
            margin: 2px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer; /* Change cursor style to indicate draggability */
        }
        .sortable-letter-box {
            position: relative;
            display: inline-block;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 30px ;
            padding-left: 15px ;
            margin: 2px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer; /* Change cursor style to indicate draggability */
        }
        .sortable-letter-box.selected {
            background-color: #3498db; /* for example, a blue background to indicate selection */
            color: white;
        }

        .letter-box.clicked {
            background-color: #ffcccb; /* Or any color you prefer */
        }

        /* Additional styles for sortable letter boxes */
        #choosenLettersContainer {
            margin-top: 5px;
            direction: rtl;
        }

        #sortedLettersContainer {
            margin-top: 5px;
            direction: rtl;
        }

        /* Style the first-level ul */
        .arabic-letters ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        /* Style the second-level ul, initially hidden */
        .arabic-letters ul ul {
            display: none;
            margin-left: 20px; /* Adjust the indentation as needed */
        }

        /* Style the li elements */
        .arabic-letters li {
            cursor: pointer;
            white-space: nowrap; /* Prevent line breaks */
        }

        /* Add styles for selectable elements */
        .arabic-letters .letter-box, .arabic-letters .shape-box {
            user-select: none;
            padding: 0px 8px !important;
        }

        /* Style the selected elements */
        .arabic-letters .selected {
            background-color: #e0e0e0; /* Add your desired background color */
            color: #333; /* Add your desired text color */
            font-weight: bold;
        }

        .shapes-list,
        .formats-list {
            display: none;
            position: absolute; /* Position the sub-elements absolutely */
            background-color: #f9f9f9; /* Add a background color */
            padding: 5px ;
            border: 1px solid #ccc;
            border-radius: 4px;

            z-index: 1; /* Ensure sub-elements appear above other content */
        }
        .formats-list{
            height: 200px !important;
            overflow: auto;
            left: -65px;
            top: 5px;
        }

        .shapes-list li,
        .formats-list li{
            padding: 0px 8px !important;
        }

    </style>

@endsection
