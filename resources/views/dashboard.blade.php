@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-center justify-center">
                <x-admin.create_story_form/>
            </div>

        </div>
    </div>

@endsection
