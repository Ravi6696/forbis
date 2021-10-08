<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class CardController extends BaseController
{
    public function saveCard(Request $request)
    {
        $request->validate([
            'card_number' => 'required|digits:16',
            'card_expiry_month' => 'required',
            'card_expiry_year' => 'required',
            'card_cvc' => 'required',
        ]);
        try {
            $this->CardDetail->updateOrCreate(['id' => $request->card_id], [
                'user_id' => auth()->user()->id,
                'card_number' => $request->card_number,
                'expires_on' => $request->card_expiry_month . '/' . $request->card_expiry_year,
                'cvv' => $request->card_cvc,
            ]);
            return getResponse(1, __('message.saved', ['attribute' => 'Card']));
        } catch (Exception $e) {
            return $this->getResponse(0, __($e->getMessage(), ['attribute' => 'Pro-User']), []);
        }
    }

    public function editCard(Request $request)
    {
        $cardData = $this->CardDetail->find($request->id);
        return getResponse(1, null, $cardData);
    }
    
    public function deleteCard(Request $request)
    {
        $cardData = $this->CardDetail->where('id', $request->id)->delete();
        return getResponse(1, __('message.deleted', ['attribute' => 'Card']), $cardData);
    }

    public function getAnnouncesCardList(Request $request)
    {
        try {
            $cardDetails = Auth::user()->cardDetails;
            $html = view('components.pro-user.announces-card-list', compact('cardDetails'))->render();
            return getResponse(1, __('message.details', ['attribute' => 'Cards']), $html);
        } catch (Exception $e) {
            //throw $th;
        }
    }
    public function getDasboardCardList(Request $request)
    {
        try {
            $cardDetails = Auth::user()->cardDetails;
            $html = view('components.pro-user.card-list', compact('cardDetails'))->render();
            return getResponse(1, __('message.details', ['attribute' => 'Cards']), $html);
        } catch (Exception $e) {
            //throw $th;
        }
    }
}
