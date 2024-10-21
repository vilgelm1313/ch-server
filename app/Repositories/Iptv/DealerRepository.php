<?php

namespace App\Repositories\Iptv;

use App\Models\BaseModel;
use App\Models\Iptv\Dealer;
use App\Models\Iptv\DealerInvoice;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class DealerRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return Dealer::class;
    }

    public function update(int $id, array $data): BaseModel
    {
        unset($data['video_server_id']);
        return parent::update($id, $data);
    }

    public function addAmount(int $dealer, float $amount): Dealer
    {
        DB::beginTransaction();
        try {

            $invoice = new DealerInvoice();
            $invoice->dealer_id = $dealer;
            $invoice->amount = $amount;
            $invoice->save();
            Dealer::where('id', $dealer)->increment('balance', $amount);

            DB::commit();

            return Dealer::find($dealer);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function invoices(int $dealer)
    {
        return DealerInvoice::where('dealer_id', $dealer)
            ->orderBy('created_at', 'desc')
            ->paginate();
    }

    protected function getWith(): array
    {
        return ['videoServer'];
    }
}
