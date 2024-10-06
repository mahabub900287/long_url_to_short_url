@extends('admin.layout')
@section('content')

<div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
          
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                    
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {!! session('message') !!}
                                    </div>
                                    @endif
                                </div>

                                <form action="{{ route('shortner.store') }}" method="post" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="original_url" name="original_url" value="{{old('original_url')}}"
                                         class="form-control @error('original_url') is-invalid @enderror form-control-user" id="exampleInputoriginal_url" 
                                        aria-describedby="original_urlHelp" placeholder="Enter Long url" />
                                        <font style="color: red">
                                            {{ ($errors->has('original_url'))?($errors->first('original_url')):'' }}
                                        </font>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Shortner
                                    </button>
                                </form>

                            </div>
                        </div>
            </div>
        </div>
    </div>
@endsection