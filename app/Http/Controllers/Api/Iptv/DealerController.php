<?php

namespace App\Http\Controllers\Api\Iptv;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Iptv\DealerRequest;
use App\Repositories\Iptv\DealerRepository;
use Illuminate\Http\Request;

class DealerController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return DealerRepository::class;
    }

    public function getRequestClass(): string
    {
        return DealerRequest::class;
    }

    public function addAmount(Request $request, int $dealer)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        $dealer = $this->getRepository()->addAmount($dealer, $request->amount);


        return $this->success($dealer);
    }

    public function invoices(int $dealer)
    {
        return $this->success($this->getRepository()->invoices($dealer));
    }
}
