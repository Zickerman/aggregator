<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiProxyService;

class ApiProxyController extends Controller
{
    protected $apiProxyService;

    public function __construct(ApiProxyService $apiProxyService)
    {
        $this->apiProxyService = $apiProxyService;
    }

    public function getNumber(Request $request)
    {
        // в зависимости от возможных параметров добавить валидацию на:
        $country = $request->query('country', 'se');
        $service = $request->query('service', 'wa');
        $rentTime = $request->query('rent_time', null);

        return response()->json($this->apiProxyService->getNumber($country, $service, $rentTime));
    }

    public function getSms(Request $request)
    {
        $validatedData = $request->validate(['activation' => 'required|string']);
        return response()->json($this->apiProxyService->getSms($validatedData['activation']));
    }

    public function cancelNumber(Request $request)
    {
        $validatedData = $request->validate(['activation' => 'required|int']);
        return response()->json($this->apiProxyService->cancelNumber($validatedData['activation']));
    }

    public function getStatus(Request $request)
    {
        $validatedData = $request->validate(['activation' => 'required|string']);
        return response()->json($this->apiProxyService->getStatus($validatedData['activation']));
    }
}
