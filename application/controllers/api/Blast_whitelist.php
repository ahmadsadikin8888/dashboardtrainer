<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Blast extends CI_Controller
{

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Custom_model/Dapros_model', 'Dapros');
        $this->load->model('Custom_model/Fact_interaction_model', 'Fact_interaction');
        $this->load->model('Custom_model/Dim_status_model', 'Dim_status');
        $this->load->model('Custom_model/Dim_customer_model', 'Dim_customer');
        $this->load->model('Custom_model/Dim_date_model', 'Dim_date');
        $this->load->model('Custom_model/Dim_time_model', 'Dim_time');
        $this->load->model('Custom_model/Dim_periode_model', 'Dim_periode');
        // $this->load->database();
    }

    public function send_get()
    {
        $whitelist_hp = array(
            '081221609591',
            // '081384311543',
            // '08112207004',
            // '082226333733'
        );

        $whitelist_email = array(
            'ahmadsadikin8888@gmail.com',
            // '9nd.priatna@gmail.com',
            // 'benny.ipb45@gmail.com'
        );

        $date_now = date('Y-m-d');
        $date_key = $this->Dim_date->get_row(array("date_value" => $date_now));
        $dapros = $this->Dapros->get_results(array("status_send" => '0', "date_key <=" => $date_key->date_key), array("*"));
        // $dapros = $this->Dapros->get_results(array("status_send" => '0', "date_key <=" => $date_key->date_key), array("*"), array("limit" => 1, "offset" => 0));
        // $dapros = $this->Dapros->get_results(array("status_send" => '0', "channel_key" => 3), array("*"), array("limit" => 1, "offset" => 0));

        //$hasil = $this->db->get()->result();
        //$rows = $this->db->affected_rows();

        $return = 'Dapros 0';
        if ($dapros['num'] > 0) {
            foreach ($dapros['results'] as $row) {
                $id_campaign = $row->campaign_id;
                $campaign = $this->Dapros->live_query("SELECT * FROM trx_campaign WHERE id=$id_campaign ")->row();
                // $produk = $this->Dapros->live_query("SELECT * FROM dim_produk WHERE produk_key=$campaign->id_produk ")->row();

                $konten_email = $campaign->email_content;
                $email_image = $campaign->email_image;
                $konten_wa = $campaign->wa_des;
                $konten_sms = $campaign->sms_desc;
                $customer = $this->Dim_customer->get_row(array("customer_key" => $row->customer_key));
                $return = 'TIDAK DIKIRIM';
                $return_2 = 'TIDAK DIKIRIM';
                $return_3 = 'TIDAK DIKIRIM';

                $data_cus = array(
                    "no_internet" => $row->snd,
                    "no_hp" => $row->gsm,
                    "produk" => $campaign->id_produk
                );
                $failover = array(
                    "channel_key" => $row->channel_key,
                    "status_send" => "TIDAK DIKIRIM",
                    "channel_key_2" => "",
                    "status_send_2" => "TIDAK DIKIRIM",
                    "channel_key_3" => "",
                    "status_send_3" => "TIDAK DIKIRIM",
                );
                if ($customer) {
                    switch ($row->channel_key) {
                        case 1:
                            if ($row->gsm) {
                                if (in_array($row->gsm, $whitelist_hp)) {
                                    $return = $this->blast_wa($row->id, $row->gsm, $customer->nama, $konten_wa, $data_cus);
                                }
                            }
                            if ($return != 'sent') {
                                $failover['channel_key_2'] = 2;
                                if ($row->gsm) {
                                    if (in_array($row->gsm, $whitelist_hp)) {
                                        $return_2 = $this->blast_smsturbo($row->id, $row->gsm, $customer->nama, $konten_sms, $data_cus);
                                    }
                                }
                            }
                            if ($return_2 != 'SUCCESS' && $return != 'sent') {
                                $failover['channel_key_3'] = 3;
                                if ($row->email) {
                                    if (in_array($row->email, $whitelist_email)) {
                                        $return_3 = $this->blast_email($row->id, $row->email, $konten_email, $email_image, $data_cus);
                                    }
                                }
                            }
                            $kontak = $konten_wa;
                            break;
                        case 2:
                            if ($row->gsm) {
                                if (in_array($row->gsm, $whitelist_hp)) {
                                    $return = $this->blast_smsturbo($row->id, $row->gsm, $customer->nama, $konten_sms, $data_cus);
                                }

                                // $return = 'Gagal Proses';
                            }
                            if ($return != 'SUCCESS') {
                                $failover['channel_key_2'] = 3;
                                if ($row->email) {
                                    if (in_array($row->email, $whitelist_email)) {
                                        $return_2 = $this->blast_email($row->id, $row->email, $konten_email, $email_image, $data_cus);
                                    }
                                }
                            }
                            $kontak = $konten_sms;
                            break;
                        case 3:
                            if ($row->email) {
                                if (in_array($row->email, $whitelist_email)) {
                                    $return = $this->blast_email($row->id, $row->email, $konten_email, $email_image, $data_cus);
                                }
                            }
                            if ($return != 'Message has been sent') {
                                $failover['channel_key_2'] = 1;
                                if ($row->gsm) {
                                    if (in_array($row->gsm, $whitelist_hp)) {
                                        $return_2 = $this->blast_wa($row->id, $row->gsm, $customer->nama, $konten_wa, $data_cus);
                                    }
                                }
                            }
                            if ($return_2 != 'sent' && $return != 'Message has been sent') {
                                $failover['channel_key_3'] = 2;
                                if ($row->gsm) {
                                    if (in_array($row->gsm, $whitelist_hp)) {
                                        $return_3 = $this->blast_smsturbo($row->id, $row->gsm, $customer->nama, $konten_sms, $data_cus);
                                    }
                                }
                            }
                            $kontak = $konten_email;
                            break;
                    }
                    // $data_update = array("status_send" => $return);
                    $get_status = $this->Dim_status->get_row(array("status_value" => $return));
                    $get_status_2 = $this->Dim_status->get_row(array("status_value" => $return_2));
                    $get_status_3 = $this->Dim_status->get_row(array("status_value" => $return_3));


                    $data_update = array("status_send" => $get_status->status_key);
                    $param_update = array("id" => $row->id);
                    $update_status = $this->Dapros->edit($param_update, $data_update);
                    if ($update_status) {


                        $data_input = array(
                            'cat_key' => 3,
                            'customer_key' => $row->customer_key,
                            'channel_key_2' => $failover['channel_key_2'],
                            'channel_key_3' => $failover['channel_key_3'],
                            'channel_key' => $row->channel_key,
                            'status_key' => $get_status->status_key,
                            'status_key_2' => $get_status_2->status_key,
                            'status_key_3' => $get_status_3->status_key,
                            'layanan_key' => '4',
                            'regional_key' => $customer->regional_key,
                            'date_key' => $this->Dim_date->get_row(array('date_value' => date("Y-m-d")))->date_key,
                            // 'category_produk_key' => $produk->category_produk_key,
                            'produk_key' => $campaign->id_produk,
                            'interaction_value' => $kontak,
                        );
                        $this->Fact_interaction->add($data_input);
                        $return = $row->customer_key . ' : Interaction Success!' . $row->id;
                    }
                } else {
                    $this->Dim_customer->add(array("snd" => $row->snd, "no_gsm" => $row->gsm, "email" => $row->email));
                    $customer = $this->Dim_customer->get_row(array("snd" => $row->snd));
                    $update_status = $this->Dapros->edit(array("snd" => $row->snd, "gsm" => $row->gsm, "email" => $row->email), array("customer_key" => $customer->customer_key));
                    switch ($row->channel_key) {
                        case 1:
                            if ($row->gsm) {
                                if (in_array($row->gsm, $whitelist_hp)) {
                                    $return = $this->blast_wa($row->id, $row->gsm, $customer->nama, $konten_wa, $data_cus);
                                }
                            }
                            if ($return != 'sent') {
                                $failover['channel_key_2'] = 2;
                                if ($row->gsm) {
                                    if (in_array($row->gsm, $whitelist_hp)) {
                                        $return_2 = $this->blast_smsturbo($row->id, $row->gsm, $customer->nama, $konten_sms, $data_cus);
                                    }
                                }
                            }
                            if ($return_2 != 'SUCCESS' && $return != 'sent') {
                                $failover['channel_key_3'] = 3;
                                if ($row->email) {
                                    if (in_array($row->email, $whitelist_email)) {
                                        $return_3 = $this->blast_email($row->id, $row->email, $konten_email, $email_image, $data_cus);
                                    }
                                }
                            }
                            $kontak = $konten_wa;
                            break;
                        case 2:
                            if ($row->gsm) {
                                if (in_array($row->gsm, $whitelist_hp)) {
                                    $return = $this->blast_smsturbo($row->id, $row->gsm, $customer->nama, $konten_sms, $data_cus);
                                }

                                // $return = 'Gagal Proses';
                            }
                            if ($return != 'SUCCESS') {
                                $failover['channel_key_2'] = 3;
                                if ($row->email) {
                                    if (in_array($row->email, $whitelist_email)) {
                                        $return_2 = $this->blast_email($row->id, $row->email, $konten_email, $email_image, $data_cus);
                                    }
                                }
                            }
                            $kontak = $konten_sms;
                            break;
                        case 3:
                            if ($row->email) {
                                if (in_array($row->email, $whitelist_email)) {
                                    $return = $this->blast_email($row->id, $row->email, $konten_email, $email_image, $data_cus);
                                }
                            }
                            if ($return != 'Message has been sent') {
                                $failover['channel_key_2'] = 1;
                                if ($row->gsm) {
                                    if (in_array($row->gsm, $whitelist_hp)) {
                                        $return_2 = $this->blast_wa($row->id, $row->gsm, $customer->nama, $konten_wa, $data_cus);
                                    }
                                }
                            }
                            if ($return_2 != 'sent' && $return != 'Message has been sent') {
                                $failover['channel_key_3'] = 2;
                                if ($row->gsm) {
                                    if (in_array($row->gsm, $whitelist_hp)) {
                                        $return_3 = $this->blast_smsturbo($row->id, $row->gsm, $customer->nama, $konten_sms, $data_cus);
                                    }
                                }
                            }
                            $kontak = $konten_email;
                            break;
                    }
                    $get_status = $this->Dim_status->get_row(array("status_value" => $return));
                    $get_status_2 = $this->Dim_status->get_row(array("status_value" => $return_2));
                    $get_status_3 = $this->Dim_status->get_row(array("status_value" => $return_3));
                    $data_update = array("status_send" => $get_status->status_key);
                    $param_update = array("id" => $row->id);
                    $update_status = $this->Dapros->edit($param_update, $data_update);
                    if ($update_status) {
                        $data_input = array(
                            'cat_key' => 3,
                            'customer_key' => $customer->customer_key,
                            'channel_key' => $row->channel_key,
                            'channel_key_2' => $failover['channel_key_2'],
                            'channel_key_3' => $failover['channel_key_3'],
                            'status_key' => $get_status->status_key,
                            'status_key_2' => $get_status_2->status_key,
                            'status_key_3' => $get_status_3->status_key,
                            'layanan_key' => '4',
                            'regional_key' => $customer->regional_key,
                            'date_key' => $this->Dim_date->get_row(array('date_value' => date("Y-m-d")))->date_key,
                            // 'category_produk_key' => $produk->category_produk_key,
                            'produk_key' => $campaign->id_produk,
                            'interaction_value' => $kontak,
                        );
                        $this->Fact_interaction->add($data_input);
                        $return = $row->customer_key . ' : Interaction Success!' . $row->id;
                    }
                }
            }
        }
        $response = json_encode($return);
        echo $response;
    }
    function blast_email($id = false, $email = false, $message = "", $image = "", $data = array())
    {
        // $uri_image=base_url().'images/campaign_image/'.$image;
        $uri_image = base_url() . 'images/campaign_image/' . $image;
        $message = '<img src="' . $uri_image . '" alt="" >' . $message;
        $link_lp = $this->get_lplink($data['no_internet'], $data['no_hp'], $data['produk']);
        $message = str_replace("{link}", $link_lp, $message);
        $return = 'EMAIL GAGAL';
        if ($id) {
            $curl = curl_init();
            $url = "http://10.194.194.251/digital_media_profiling/index.php/api/send/email";
            $arr = array(
                // "email" => 'ahmadsadikin8888@gmail.com',
                "email" => $email,
                "subject" => "Digital Sales",
                "message" => $message
            );
            $data = http_build_query($arr);

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);

            if (isset($response->sts)) {
                $return = $response->message;
            }
        }
        return $return;
    }
    function blast_wa($id = false, $number = false, $nama, $link, $data = array())
    {
        $return = 'fail';
        $link_lp = $this->get_lplink($data['no_internet'], $data['no_hp'], $data['produk']);
        $message = str_replace("{link}", $link_lp, $link);
        if ($id) {
            $curl = curl_init();
            $url = "http://10.194.194.251/digital_media_profiling/index.php/api/send/whatsapp";
            $arr = array(
                "number" => $this->hp($number),
                // "number" => '081221609591',
                "template" => "billco_7",
                "param1" => $nama,
                "param2" => $message
            );
            $data = http_build_query($arr);

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);

            if (isset($response->sts)) {
                $return = $response->sts_msg;
                //echo $response->sts_msg;
            }
        }
        return $return;
    }

    public function get_tokensms()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://10.194.178.199/HERMES.1/Service/TokenRequest",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                "username": "profiling",
                "password": "mPFGs79MeUaZBq64"
                }',
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                'Content-Type: application/json',
                "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        return $response->data->token;
    }
    public function blast_smsturbo($id = false, $number = false, $nama = "", $link = "Mari Berlangganan Minipack", $data = array())
    {
        $msisdn = $this->hp($number);
        $curl = curl_init();
        $token = $this->get_tokensms();
        $link_lp = $this->get_lplink($data['no_internet'], $data['no_hp'], $data['produk']);
        $message = str_replace("{link}", $link_lp, $link);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://10.194.178.199/HERMES.1/Message/restSaveSend",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                "message": [
                    {
                        "content": "' . $message . '", 
                        "phone": "' . $msisdn . '", 
                        "schedule": "' . date('Y-m-d H:i:s') . '", 
                        "uid": "' . $msisdn . date('Y-m-d H:i:s') . '" 
                    }
                ]
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
        if ($response->success) {
            return 'SUCCESS';
        } else {
            return 'cURL Error';
        }
    }
    public function test_smsturbo($id = false, $number = false, $nama = "", $link = "Mari Berlangganan Minipack", $data = array())
    {
        $msisdn = $this->hp('081221609591');
        $curl = curl_init();
        $token = $this->get_tokensms();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://10.194.178.199/HERMES.1/Message/restSaveSend",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                "message": [
                    {
                        "content": "TEST Engine SMS", 
                        "phone": "' . $msisdn . '", 
                        "schedule": "' . date('Y-m-d H:i:s') . '", 
                        "uid": "' . $msisdn . date('Y-m-d H:i:s') . '" 
                    }
                ]
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
        if ($response->success) {
            return 'SUCCESS';
        } else {
            return 'cURL Error';
        }
    }

    function hp($nohp)
    {
        $hp = $nohp;
        // kadang ada penulisan no hp 0811 239 345
        $nohp = str_replace(" ", "", $nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(", "", $nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")", "", $nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".", "", $nohp);

        // cek apakah no hp mengandung karakter + dan 0-9
        if (!preg_match('/[^+0-9]/', trim($nohp))) {
            // cek apakah no hp karakter 1-3 adalah +62
            if (substr(trim($nohp), 0, 3) == '+62') {
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif (substr(trim($nohp), 0, 1) == '0') {
                $hp = '62' . substr(trim($nohp), 1);
            }
        }
        return $hp;
    }
    function test_wa()
    {
        $return = 'Gagal';
        // if ($id) {
        $link_lp = $this->get_lplink();
        $msg = str_replace("{link}", $link_lp, 'Blast Digital Sales link : {link}');
        $curl = curl_init();
        $url = "http://10.194.194.251/digital_media_profiling/index.php/api/send/whatsapp";
        $arr = array(
            // "number" => $number,
            "number" => '6281221609591',
            "template" => "billco_7",
            "param1" => 'Ahmad Sadikin',
            "param2" => $link_lp
        );
        $data = http_build_query($arr);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);

        if (isset($response->sts)) {
            $return = $response->sts_msg;
            echo $response->sts_msg;
        }
        // }
        echo $return;
    }

    function test_email()
    {
        // $uri_image=base_url().'images/campaign_image/'.$image;
        $msg = '<p style="text-align: center;"><img src="https://subsystem.indihome.co.id/uploads/banner/Berkah_Promo-IndiHome_D_D.jpg" style="width: 100%;"></p>
        <p>Halo, Pelanggan Setia IndiHome </p><p>Mau tetap update nonton film-film unggulan sekaligus dapat kecepatan internet yang makin cepat? Bisa! Berlangganan Minipack Channel TV dan Upgrade Speed dengan kecepatan 20 Mbps bisa Sobat dapatkan hanya dengan Rp45.000 per bulan! </p><p><span style="font-size: 0.9375rem;">Tunggu apa lagi? Yuk, raih promo spesial bundling Minipack Channel TV dan Upgrade Speed sekarang juga! Klik: </span></p><p style="text-align: center; "><a href="{link}" target="_blank">BERLANGGANAN SEKARANG</a><span style="font-size: 0.9375rem;"><br></span></p>';
        $return = 'Gagal';
        // if ($id) {
        $link_lp = $this->get_lplink();
        $msg = str_replace("{link}", $link_lp, $msg);
        $curl = curl_init();
        $url = "http://10.194.194.251/digital_media_profiling/index.php/api/send/email";
        $arr = array(
            "email" => 'ahmadsadikin8888@gmail.com',
            // "email" => $email,
            "subject" => "Digital Sales",
            "message" => $msg
        );
        $data = http_build_query($arr);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);

        if (isset($response->sts)) {
            $return = $response->message;
        }
        // }
        echo $return;
    }
    public function get_lplink($no_internet = '11', $no_hp = '11', $produk = 'ESSENTIAL')
    {
        // if ($id) {
        $curl = curl_init();
        $url = "https://subsystem.indihome.co.id/dashboard-ultra/api/insertAddon";
        $arr = array(
            "noinet" => $no_internet,
            "msisdn" => $no_hp,
            "produk" => $produk,
            "source" => 'DSI',
            "type" => 'minipack'
        );
        $data = http_build_query($arr);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        if (isset($response->data->link)) {
            return $response->data->link;
        }
    }
}
