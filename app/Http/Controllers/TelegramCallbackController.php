<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use pschocke\TelegramLoginWidget\Facades\TelegramLoginWidget;

class TelegramCallbackController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!$telegramUser = TelegramLoginWidget::validate($request)) {
            return redirect()->back()->with('warn', 'error');
        }

        auth()->user()->update([
            'telegram_id' => $telegramUser->get('id')
        ]);

        return redirect()->back()->with('success', 'Cool');
    }
}
