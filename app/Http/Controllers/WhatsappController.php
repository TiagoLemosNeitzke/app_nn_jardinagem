<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class WhatsappController extends Controller
{
    public function setWhatsappLink(Request $request)
    {
        $phone = '67996636340'; //$request->phone; //Esta fixo porque os números do banco não estão padronizados
        $phoneDDD = substr($phone, 0,2);
        $phonePayload = substr($phone, 3);
        $message = $request->message;
        $messages = explode(' ', $message);
        $formattedMessage = implode('%20', $messages);
        $whatsappLink = 'https://wa.me/55'.$phoneDDD.$phonePayload.'?text='.$formattedMessage;
        return $whatsappLink;
    }

    public function getWhatsappLink(Request $request)
    {
       return response($this->setWhatsappLink($request));
    }

    public function sendMessage(Request $request){
        return redirect()->away($this->getWhatsappLink($request)->content());
    }
}
