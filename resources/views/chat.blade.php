@extends('layouts.app')

@section('content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Admins</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><span>Chat</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('layouts.partials.logout')
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        @include('layouts.partials.messages')
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> Chats </div>

                <div class="panel-body">
                    <chat-messages :messages="messages" :user="{{ Auth::user() }}" :reciever ="{{$reciever}}" ></chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                        :reciever="{{$reciever}}"
                    ></chat-form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .chat-body .clearfix{
        margin-left:300px;
    }
</style>
@endsection