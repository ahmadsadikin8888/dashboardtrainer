<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mycx extends CI_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Custom_model/History_from_mycx_model', 'history_from_mycx');
        $this->load->model('Custom_model/Dim_customer_model', 'Dim_customer');
        // $this->load->database();
    }
    public function get_data()
    {
        $customer = $this->Dim_customer->get_results();
        if ($customer['num'] > 0) {
            foreach ($customer['results'] as $cs) {
                $this->history_addon($cs->snd, $cs);
            }
        }
    }
    public function get_token()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apigwsit.telkom.co.id:7777/invoke/pub.apigateway.oauth2/getAccessToken",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                "grant_type":"client_credentials",
                "client_id":"e43a7f6c-0377-4aad-be98-3f4bfad70424",
                "client_secret":"9df65a56-f426-4abc-82f9-cbe51477f155"
                }',
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                'Content-Type: application/json',
                "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        return $response->access_token;
    }

    public function history_addon($snd = '131183144870', $data)
    {
        $curl = curl_init();
        $token = $this->get_token();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apigwsit.telkom.co.id:7777/gateway/telkom-mycx-singleWindow/1.0/get_item_dossier_inquery",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                "IN_ND":"' . $snd . '"
                }',
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                'Content-Type: application/json',
                "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc",
                "Authorization: Bearer $token"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        if ($response->OUT_MESS == 'Data ditemukan') {
            foreach ($response->OUT_CUR_ITEM_DOSSIER as $dt) {
                $data_insert = (array) $dt;
                $data_insert['snd'] = $data->snd;
                $data_insert['customer_key'] = $data->customer_key;
                $cek = $this->history_from_mycx->get_count($data_insert);
                if ($cek == 0) {
                    $this->history_from_mycx->add($data_insert);
                }
            }
        }
    }
}
