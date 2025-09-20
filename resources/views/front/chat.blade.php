@extends('front.master')

@section('content')
    <div class="chat-container">
        @include('front.aside')
        <livewire:chat-messages :friendId="$friend->id" />
    </div>
@endsection
