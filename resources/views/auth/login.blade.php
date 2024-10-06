@extends('admin.header')

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                    @if ($errors->any())
                                    <div class="alert alert-error">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li style="color:red">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>

                                <form action="{{ route('login') }}" method="post" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" value="{{old('email')}}" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." />
                                        <font style="color: red">
                                            {{ ($errors->has('email'))?($errors->first('email')):'' }}
                                        </font>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" />
                                        <font style="color: red">
                                            {{ ($errors->has('password'))?($errors->first('password')):'' }}
                                        </font>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                    <hr />
                                </form>
                                <hr />
                         
                                <div class="text-center">
                                    <a class="small" href="{{ url('registration') }}">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@extends('admin.footer')