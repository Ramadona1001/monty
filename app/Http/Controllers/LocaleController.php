<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request, string $locale): RedirectResponse
    {
        $supported = config('locales.supported', ['en']);

        if (! in_array($locale, $supported, true)) {
            abort(404);
        }

        $target = $request->query('redirect', route('home', ['locale' => $locale]));

        return redirect()->to($target);
    }
}
