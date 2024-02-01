@extends('layout.main')

@section('title', 'Dashborad | Ideas')

@section('content')

    {{-- Left side section --}}
    <div class="col-3">
        @include('layout.left-side')
    </div>
    {{-- Left side section --}}

        <div class="col-6">
            {{-- Success message section --}}
            @include('shared.success-message')
            {{-- Success message section --}}

            
                {{-- Idea card section --}}
                @include('users.shared.user-card')
                {{-- Idea card section --}}
            
            
            {{-- Loop ideas section --}}
            @forelse ($ideas as $idea)
                <div class="mt-3">
                    {{-- Idea card section --}}
                    @include('ideas.shared.idea-card')
                    {{-- Idea card section --}}
                </div>
            @empty
                <p class="text-center my-3">No results Found.</p>
            @endforelse
            {{-- Loop ideas section --}}

            {{-- Pagination ideas section --}}
            <div class="mt-3">
                {{ $ideas->withQueryString()->links() }}
            </div>
            {{-- Pagination ideas section --}}

        </div>

        {{-- Right side section --}}
        <div class="col-3">
            @include('shared.search-box')
            @include('shared.follow-box')
        </div>
        {{-- Right side section --}}
    

@endsection
