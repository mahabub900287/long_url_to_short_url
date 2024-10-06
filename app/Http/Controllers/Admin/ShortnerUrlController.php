<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShortUrlRequest;
use App\Repository\ShortnerRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;

class ShortnerUrlController extends Controller
{
    
    private ShortnerRepository $shorterer;

    public function __construct(ShortnerRepository $shorterer)
    {
        $this->shorterer = $shorterer;
    }

    /**
     * @return /AllShortUrl
     */
    public function index()
    {
        $userShortUrls = $this->shorterer->allShortner();

        return view('admin.url.user_short_urls', ['userShortUrls' => $userShortUrls]);
    }

    /**
     * Summary of shortnerForm
     */
    public function create()
    {
        return view('admin.url.create');
    }

     /**
      * Summary of short
      * @param \Illuminate\Http\Request $request
      * @return void
      */
    public function store(ShortUrlRequest $request)
    {
        $originalUrl = $request->original_url;
        $userId = Auth::id();
    
        $existShortUrl = $this->shorterer->findByOriginalUrlAndUserId($originalUrl, $userId);
    
        if ($existShortUrl) {
            return redirect()->back()->with('message', new HtmlString('Already have Short url by this Original url: <a href="' . route('shortner.show', ['shortUrl' => $existShortUrl->short_url]) . '">' . route('shortner.show', ['shortUrl' => $existShortUrl->short_url]) . '</a>'));
        }

        $shortUrl = Str::random(8);
    
        $this->shorterer->create([
            'original_url' => $originalUrl,
            'short_url'    => $shortUrl,
            'user_id'      => $userId,
        ]);
    
        $message = new HtmlString('Your short URL: <a href="' . route('shortner.show', ['shortUrl' => $shortUrl]) . '">' . route('shortner.show', ['shortUrl' => $shortUrl]) . '</a>');
    
        return redirect()->back()->with('message', $message);
    }
    

    /**
     * Summary of shortUrlRedirect
     * @return void
     */
    public function show($shortUrl)
    {
        $shortUrl = $this->shorterer->firstOrFail($shortUrl);

        $shortUrl->increment('click_count');
    
        return redirect($shortUrl->original_url);
    }
}
