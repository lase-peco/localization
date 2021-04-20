<?php


namespace LasePeco\Localization\Http\Controllers;


use Illuminate\Http\Request;

class SetLocaleController extends Request
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, $locale)
    {
        $request->session()->put('locale', $locale);

        if (request()->fullUrl() === redirect()->back()->getTargetUrl()) {
            return redirect('/');
        }

        return redirect()->back();
    }
}
