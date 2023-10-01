@extends('layouts.app')

@section('title', 'Create Exercise')

@section('contents')
    <h1 class="mb-0">Add exercise</h1>
    <hr />
    <form action="{{ route('exercises.store', ['id' => $id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col mb-3">
                <input type="text" class="form-control"  name="xp" placeholder="XP" pattern="\d+" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col mb-3">
                <textarea type="text" required name="content" class="form-control" placeholder="Content"></textarea>
            </div>
        </div>

        <!-- Custom Image Upload Input -->
        <div class="row mb-3">
            <div class="col mb-3">
                <label for="imageFile">Attach an image</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="imageFile" name="image_link" accept="image/*">
                    <label class="custom-file-label" for="image_link">Choose image</label>
                </div>
            </div>
        </div>

        <!-- Custom Sound Upload Input -->
        <div class="row mb-3">
            <div class="col mb-3">
                <label for="soundFile">Attach a sound file</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="soundFile" name="audio_link" accept="audio/*">
                    <label class="custom-file-label" for="audio_link">Choose sound file</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.custom-file-input').forEach(function(input) {
                input.addEventListener('change', function() {
                    var fileName = input.files[0].name;
                    var nextSibling = input.nextElementSibling;
                    nextSibling.innerText = fileName;
                });
            });
        });
    </script>
@endsection
