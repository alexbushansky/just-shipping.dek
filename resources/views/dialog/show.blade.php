@extends('layouts.menu')

@section('styles')
    <link rel="stylesheet" href="{{asset('/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/myStyle/dialog.css')}}">
@endsection

@section('content')

    <div class="container py-2 px-4 message-box">
        <h3 class="text-center">Ваш чат c {{route('dialogs.store')}}</h3>
        <div class="row shadow">
            <!-- Chat Box-->
            <div class="col-12 px-0">
                <div class="px-3 py-5 chat-box bg-white overflow-auto my-container">

                    @if($messages)
                        @foreach($messages as $message)

                            @if($message->user_id == auth()->user()->id)
                                <div class="media w-50 ml-auto mb-3">
                                    <div class="media-body">
                                        <div class="bg-info rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-white"> {{$message->message_text}}</p>
                                        </div>
                                        <p class="small text-muted">{{$message->created_at->format('Y-m-d | h:m')}}</p>

                                    </div>
                                </div>
                            @else
                                <div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                    <div class="media-body ml-3">
                                        <div class="bg-light rounded py-2 px-3 mb-2">
                                            <p class="text-small mb-0 text-muted">{{$message->message_text}}</p>
                                            <p class="small text-muted"> <strong>{{$message->user->name}}</strong></p>
                                        </div>

                                        <p class="small text-muted">{{$message->created_at->format('Y-m-d | h:m')}}</p>


                                    </div>
                                </div>

                        @endif
                        @endforeach
                        @endif

                </div>

                <!-- Typing area -->
                <form action="{{route('dialog-messages.store')}}" class="bg-light" method="post">
                    @csrf
                    <input name="dialog_id" type="hidden" value="{{$dialog->id}}">

                    <div class="input-group">
                        <input type="text" name="message_text" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light @error('message_text') is-invalid @enderror">
                        @error('message_text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-link"> Отправить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
