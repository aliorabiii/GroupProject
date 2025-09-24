@extends('layouts.app')

@section('title', 'Edit About Page')

@section('content')
<div class="container py-5">
    <h1 class="custom-title">Edit About Page</h1>

    @if(session('success'))
        <div class="custom-alert success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="custom-alert error">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('about.update') }}" method="POST" class="custom-form">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $about->title ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" rows="5" class="form-control">{{ old('content', $about->content ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">CTA Text</label>
            <input type="text" name="cta_text" class="form-control" value="{{ old('cta_text', $about->cta_text ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">CTA Link</label>
            <input type="text" name="cta_link" class="form-control" value="{{ old('cta_link', $about->cta_link ?? '') }}">
        </div>

        <h4>Accordion Items</h4>
        <div id="accordion-items">
            @php
                $accordion = json_decode($about->accordion_json ?? '[]', true) ?? [];
            @endphp

            @foreach($accordion as $index => $item)
                <div class="accordion-item">
                    <label>Question</label>
                    <input type="text" name="accordion[{{ $index }}][question]" class="form-control" value="{{ old("accordion.$index.question", $item['question'] ?? '') }}">
                    <label>Answer</label>
                    <textarea name="accordion[{{ $index }}][answer]" rows="3" class="form-control">{{ old("accordion.$index.answer", $item['answer'] ?? '') }}</textarea>
                    <button type="button" class="remove-accordion">Remove</button>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-accordion">+ Add Item</button>
        <br>

        <button type="submit" class="submit-btn">Save Changes</button>
    </form>
</div>

<!-- Custom Styles -->
<style>
    body {
        background-color: #1a1a1a;
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }

    .custom-title {
        color: #FFC107;
        margin-bottom: 2rem;
    }

    .custom-alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .custom-alert.success {
        background-color: #d4edda;
        color: #155724;
    }

    .custom-alert.error {
        background-color: #f8d7da;
        color: #721c24;
    }

    .custom-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #FFC107;
    }

    .custom-form .form-control {
        width: 100%;
        padding: 10px 15px;
        border-radius: 6px;
        border: 2px solid #FFC107;
        background-color: #f1f1f1;
        color: #333;
        margin-bottom: 15px;
        font-size: 1rem;
    }

    .accordion-item {
        background-color: #333;
        border: 2px solid #FFC107;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 8px;
    }

    .accordion-item input,
    .accordion-item textarea {
        border: 1px solid #FFC107;
        background-color: #f1f1f1;
        color: #333;
        border-radius: 5px;
        padding: 8px;
    }

    #add-accordion {
        background-color: #FFC107;
        color: #1a1a1a;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        margin-bottom: 15px;
    }

    #add-accordion:hover {
        background-color: #e0a800;
    }

    .remove-accordion {
        background-color: #dc3545;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 5px 12px;
        cursor: pointer;
        font-weight: bold;
        margin-top: 5px;
    }

    .remove-accordion:hover {
        background-color: #c82333;
    }

    .submit-btn {
        background-color: #FFC107;
        color: #1a1a1a;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #e0a800;
    }
</style>

<!-- Scripts -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let accordionContainer = document.getElementById('accordion-items');
        let addBtn = document.getElementById('add-accordion');
        let index = {{ count($accordion) }};

        addBtn.addEventListener('click', function() {
            let html = `
                <div class="accordion-item">
                    <label>Question</label>
                    <input type="text" name="accordion[${index}][question]" placeholder="Question">
                    <label>Answer</label>
                    <textarea name="accordion[${index}][answer]" rows="3" placeholder="Answer"></textarea>
                    <button type="button" class="remove-accordion">Remove</button>
                </div>
            `;
            accordionContainer.insertAdjacentHTML('beforeend', html);
            index++;
        });

        accordionContainer.addEventListener('click', function(e) {
            if(e.target.classList.contains('remove-accordion')) {
                e.target.closest('.accordion-item').remove();
            }
        });
    });
</script>
@endpush
@endsection
