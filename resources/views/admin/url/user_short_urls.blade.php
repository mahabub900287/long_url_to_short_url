@extends('admin.layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="row">
            <div class="col-lg-12">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Your Short URLs</h1>
                    </div>

                    @if($userShortUrls->isEmpty())
                        <p>You haven't created any short URLs yet.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Short URL</th>
                                        <th>Click Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userShortUrls as $shortUrl)
                                        <tr>
                                            <td>
                                                <a href="{{ route('shortner.show', ['shortUrl' => $shortUrl->short_url]) }}" target="_blank">
                                                    {{ $shortUrl->short_url }}
                                                </a>
                                            </td>
                                            <td>{{ $shortUrl->click_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
