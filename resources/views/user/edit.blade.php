@extends('layouts.menu')
@section('styles')
    <link rel="stylesheet" href="{{asset('/css/myStyle/account-info.css')}}">
@endsection
@section('content')


    <div class="container emp-profile">
        <form id = "deleteAvatar" action="{{route('users.deleteAvatar',['user'=>$user->id])}}" method="POST">
            @csrf
            @if($user->thumbnail)
            <input type="hidden" value="{{$user->thumbnail}}" name="thumbnail">
            @endif
        </form>


        <form method="post" action="{{route('users.update',['user'=>$user->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        @if($user->thumbnail)
                        <img src="/uploads/thumbnails/{{$user->thumbnail}}" alt ="#"/>
                        @endif

                            <br>
                            <br>

                            <div class="custom-file w-75 text-left">
                                <input type="file" class="custom-file-input" id="customFile" name="photo">
                                <label class="custom-file-label" for="customFile">Выберите файл</label>
                            </div>

                            <br>
                            <br>

                            @if($user->thumbnail)
                            <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteAvatar').submit()">Удалить Аватар</button>
                            @endif


                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                           {{$user->name}}
                        </h5>
                        <h6>
                            Роль:
                            @role('driver')
                            Перевозчик
                            @endrole
                            @role('customer')
                            Заказчик
                            @endrole
                            @role('admin')
                            Администратор
                            @endrole
{{--                            @foreach($user->roles as $role)--}}
{{--                                <li> {{$role->ru}}</li>--}}
{{--                            @endforeach--}}
                        </h6>
                        <p class="proile-rating">Рейтинг: <span>8/10</span></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                        </ul>
                    </div>

                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="form-group row">
                                    <label  class="col-md-3 col-form-label">Name</label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-md-3 col-form-label">Email*</label>
                                    <div class="col-md-9">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-md-3 col-form-label">Phone</label>
                                    <div class="col-md-9">
                                        <input  type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone_number }}">

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="password" class="col-md-3 col-form-label">{{ __('Password') }}</label>

                                    <div class="col-md-9">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-3 col-form-label">Confirm Password</label>

                                    <div class="col-md-9">

                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">

                                    </div>
                                </div>
                            </div>


                        </div>

                </div>
                <div class="col-md-2">
                    <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Сохранить"/>
                </div>
            </div>
        </form>
    </div>



@endsection
@section('scripts')
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName.slice(0,20));
        });
    </script>
    @endsection

