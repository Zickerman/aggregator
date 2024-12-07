<?php

namespace App\Http\Controllers;

use App\Jobs\SendToRabbitMQ;
use Illuminate\Http\Request;
use App\Services\LinksChecker;

class CheckLinkController extends Controller
{
    public function store(Request $request, LinksChecker $linkCheker)
    {
        $request->validate([
            'url' => 'required|url',
            'frequency' => 'required|int',
            'retries' => 'required|integer|min:0',
            'delay' => 'required|integer|min:0',
        ]);

		try {
            $linkCheker->storeLink($request->toArray());
            return response()->json(['message' => 'Send to check'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

	public function getLinks(LinksChecker $linkCheker)
    {
		$links = $linkCheker->getLinks()->toArray(request());
		return view('admin', ['links' => $links]);
    }
}
