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
                $campaign = $this->Dapros->live_query("SELECT * FROM trx_campaign WHERE id=$id_campaign AND status = 'Online' AND DATE(date_online) <= '$date_now' ")->row();
                // $produk = $this->Dapros->live_query("SELECT * FROM dim_produk WHERE produk_key=$campaign->id_produk ")->row();
                if ($campaign->status_approve == 1) {


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
                        "produk" => $campaign->id_produk,
                        "wa_image" => $campaign->wa_image,
                        "wa_video" => $campaign->wa_video,
                        "type_content_wa" => $campaign->type_content_wa
                    );
                    $failover = array(
                        "channel_key" => $row->channel_key,
                        "status_send" => "TIDAK DIKIRIM",
                        "channel_key_2" => "",
                        "status_send_2" => "TIDAK DIKIRIM",
                        "channel_key_3" => "",
                        "status_send_3" => "TIDAK DIKIRIM",
                    );
                    $message_id = '';
                    if ($customer) {
                        switch ($row->channel_key) {
                            case 1:
                                if ($row->gsm) {
                                    // if (in_array($row->gsm, $whitelist_hp)) {
                                    $return = $this->blast_wa($row->id, $row->gsm, $customer->nama, $konten_wa, $data_cus);
                                    // }
                                }
                                if ($return['status'] != 'sent') {
                                    $return = $return['status'];
                                    $failover['channel_key_2'] = 2;
                                    if ($row->gsm) {
                                        // if (in_array($row->gsm, $whitelist_hp)) {
                                        $return_2 = $this->blast_smsturbo($row->id, $row->gsm, $customer->nama, $konten_sms, $data_cus);
                                        // }
                                    }
                                } else {
                                    $message_id = $return['message_id'];
                                    $return = $return['status'];
                                }

                                if ($return_2 != 'SUCCESS' && $return != 'sent') {
                                    $failover['channel_key_3'] = 3;

                                    if ($row->email) {
                                        // if (in_array($row->email, $whitelist_email)) {
                                        $return_3 = $this->blast_email($row->id, $row->email, $konten_email, $email_image, $data_cus);
                                        // }
                                    }
                                }
                                $kontak = $konten_wa;
                                break;
                            case 2:
                                if ($row->gsm) {
                                    // if (in_array($row->gsm, $whitelist_hp)) {
                                    $return = $this->blast_smsturbo($row->id, $row->gsm, $customer->nama, $konten_sms, $data_cus);
                                    // }

                                    // $return = 'Gagal Proses';
                                }
                                if ($return != 'SUCCESS') {
                                    $failover['channel_key_2'] = 3;
                                    if ($row->email) {
                                        // if (in_array($row->email, $whitelist_email)) {
                                        $return_2 = $this->blast_email($row->id, $row->email, $konten_email, $email_image, $data_cus);
                                        // }
                                    }
                                }
                                $kontak = $konten_sms;
                                break;
                            case 3:
                                if ($row->email) {
                                    // if (in_array($row->email, $whitelist_email)) {
                                    $return = $this->blast_email($row->id, $row->email, $konten_email, $email_image, $data_cus);
                                    // }
                                }
                                if ($return != 'SUCCESS_EMAIL') {
                                    $failover['channel_key_2'] = 1;
                                    if ($row->gsm) {
                                        // if (in_array($row->gsm, $whitelist_hp)) {
                                        $return_2 = $this->blast_wa($row->id, $row->gsm, $customer->nama, $konten_wa, $data_cus);
                                        // }
                                    }
                                }
                                if ($return_2['status'] != 'sent' && $return != 'SUCCESS_EMAIL') {
                                    $return_2 = $return_2['status'];
                                    $failover['channel_key_3'] = 2;
                                    if ($row->gsm) {
                                        // if (in_array($row->gsm, $whitelist_hp)) {
                                        $return_3 = $this->blast_smsturbo($row->id, $row->gsm, $customer->nama, $konten_sms, $data_cus);
                                        // }
                                    }
                                } else {
                                    $message_id = $return_2['message_id'];
                                    $return_2 = $return_2['status'];
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
                                'campaign_id' => $id_campaign,
                                'produk_key' => $campaign->id_produk,
                                'interaction_value' => $kontak,
                                'message_id' => $message_id
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
                                    // if (in_array($row->gsm, $whitelist_hp)) {
                                    $return = $this->blast_wa($row->id, $row->gsm, $customer->nama, $konten_wa, $data_cus);
                                    // }
                                }
                                if ($return['status'] != 'sent') {
                                    $failover['channel_key_2'] = 2;
                                    $return = $return['status'];
                                    if ($row->gsm) {
                                        // if (in_array($row->gsm, $whitelist_hp)) {
                                        $return_2 = $this->blast_smsturbo($row->id, $row->gsm, $customer->nama, $konten_sms, $data_cus);
                                        // }
                                    }
                                } else {
                                    $message_id = $return['message_id'];
                                    $return = $return['status'];
                                }
                                if ($return_2 != 'SUCCESS' && $return != 'sent') {
                                    $failover['channel_key_3'] = 3;
                                    if ($row->email) {
                                        // if (in_array($row->email, $whitelist_email)) {
                                        $return_3 = $this->blast_email($row->id, $row->email, $konten_email, $email_image, $data_cus);
                                        // }
                                    }
                                }
                                $kontak = $konten_wa;
                                break;
                            case 2:
                                if ($row->gsm) {
                                    // if (in_array($row->gsm, $whitelist_hp)) {
                                    $return = $this->blast_smsturbo($row->id, $row->gsm, $customer->nama, $konten_sms, $data_cus);
                                    // }

                                    // $return = 'Gagal Proses';
                                }
                                if ($return != 'SUCCESS') {
                                    $failover['channel_key_2'] = 3;
                                    if ($row->email) {
                                        // if (in_array($row->email, $whitelist_email)) {
                                        $return_2 = $this->blast_email($row->id, $row->email, $konten_email, $email_image, $data_cus);
                                        // }
                                    }
                                }
                                $kontak = $konten_sms;
                                break;
                            case 3:
                                if ($row->email) {
                                    // if (in_array($row->email, $whitelist_email)) {
                                    $return = $this->blast_email($row->id, $row->email, $konten_email, $email_image, $data_cus);
                                    // }
                                }
                                if ($return != 'SUCCESS_EMAIL') {
                                    $failover['channel_key_2'] = 1;
                                    if ($row->gsm) {
                                        // if (in_array($row->gsm, $whitelist_hp)) {
                                        $return_2 = $this->blast_wa($row->id, $row->gsm, $customer->nama, $konten_wa, $data_cus);
                                        // }

                                    }
                                }
                                if ($return_2['status'] != 'sent' && $return != 'SUCCESS_EMAIL') {
                                    $return_2 = $return_2['status'];
                                    $failover['channel_key_3'] = 2;
                                    if ($row->gsm) {
                                        // if (in_array($row->gsm, $whitelist_hp)) {
                                        $return_3 = $this->blast_smsturbo($row->id, $row->gsm, $customer->nama, $konten_sms, $data_cus);
                                        // }
                                    }
                                } else {
                                    $message_id = $return_2['message_id'];
                                    $return_2 = $return_2['status'];
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
                                'campaign_id' => $id_campaign,
                                'date_key' => $this->Dim_date->get_row(array('date_value' => date("Y-m-d")))->date_key,
                                // 'category_produk_key' => $produk->category_produk_key,
                                'produk_key' => $campaign->id_produk,
                                'interaction_value' => $kontak,
                                'message_id' => $message_id,
                            );
                            $this->Fact_interaction->add($data_input);
                            $return = $row->customer_key . ' : Interaction Success!' . $row->id;
                        }
                    }
                }
            }
        }
        $response = json_encode($return);
        echo $response;
    }
    function minifier($code)
    {
        $search = array(

            // Remove whitespaces after tags
            '/\>[^\S ]+/s',

            // Remove whitespaces before tags
            '/[^\S ]+\</s',

            // Remove multiple whitespace sequences
            '/(\s)+/s',

            // Removes comments
            '/<!--(.|\s)*?-->/'
        );
        $replace = array('>', '<', '\\1');
        $code = preg_replace($search, $replace, $code);
        return $code;
    }
    function blast_email($id = false, $email = false, $message = "", $image = "", $data = array())
    {
        // $uri_image=base_url().'images/campaign_image/'.$image;
        $return['status'] = 'EMAIL GAGAL';
        $msg = "
<tr style='border-collapse:collapse'>
  <td align='left' style='padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;padding-bottom:20px'>
    <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
      <tbody>
        <tr style='border-collapse:collapse'>
          <td width='560' align='center' valign='top' style='padding:0;Margin:0'>
            <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
              <tbody>
                <tr style='border-collapse:collapse'>
                  <td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'>
                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>Halo, Pelanggan Setia IndiHome!</p>
                  </td>
                </tr>
                <tr style='border-collapse:collapse'>
                  <td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'>
                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>$message</p>
                  </td>
                </tr>

                <tr style='border-collapse:collapse'>
                  <td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'>
                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>Untuk berlangganan <a class='' target='_blank' href='{link}'>klik di sini</a>
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </td>
</tr>
        ";
        $return = 'Gagal';
        // if ($id) {
        $link_lp = $this->get_lplink($data['no_internet'], $data['no_hp'], $data['produk']);
        if ($image != "") {
            $msg = "<tr style='border-collapse:collapse'>
            <td align='left' style='padding:0;Margin:0'>
              <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
                <tbody>
                  <tr style='border-collapse:collapse'>
                    <td width='600' valign='top' align='center' style='padding:0;Margin:0'>
                      <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
                        <tbody>
                          <tr style='border-collapse:collapse'>
                            <td align='center' style='padding:0;Margin:0;font-size:0'>
                              <a href='$link_lp'><img class='adapt-img' src='{img_url}' alt='indihome' style='display:block;border:0;outline:0;text-decoration:none;-ms-interpolation-mode:bicubic' width='100%' title='indihome'></a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>" . $msg;
            $uri_image = "https://sy-anida.com/YbsService/get_image_public/" . $id . "/" . $image;
            $msg = str_replace("{img_url}", $uri_image, $msg);
        }
        $msg = str_replace("{link}", $link_lp, $msg);

        // $message="asd";
        $msg = $this->minifier($msg);
        $arr = array(
            "guid" => "3d64acfb017d0529b72",
            "code" => "",
            "data" => '{"key":"INF","email":"' . $email . '","label":"INDIHOME","subject":"DIGITAL SALES","konten":"' . $msg . '"}'
        );
        $return = 'EMAIL GAGAL';

        if ($id) {
            $curl = curl_init();
            $url = "https://subsystem.indihome.co.id/myiapi/api/senderEmail";

            $arr = http_build_query($arr);
            // $data = 'guid=3d64acfb017d0529b72&code=&data={"key":"INF","email":"' . $email . '","label":"INDIHOME","subject":"Digital Sales","konten":"' . $message . '"}';
            // echo $data;
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $arr,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);
            // echo var_dump($response);
            if (isset($response->msg)) {
                $return = "SUCCESS_EMAIL";
            }
        }
        return $return;
    }
    function blast_wa($id = false, $number = false, $nama, $link, $data = array())
    {
        $return['status'] = 'fail';
        switch ($data['type_content_wa']) {
            case 1;
                $return = $this->blast_wa_text($id, $number, $nama, $link, $data);
                break;
            case 2;
                $return = $this->blast_wa_image($id, $number, $nama, $link, $data);
                break;
            case 3;
                $return = $this->blast_wa_video($id, $number, $nama, $link, $data);
                break;
        }
        return $return;
    }
    function blast_wa_text($id = false, $number = false, $nama, $link, $data = array())
    {
        $return['status'] = 'fail';
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
                $return['status'] = $response->sts_msg;
                $return['message_id'] = $response->message_id;
                //echo $response->sts_msg;
            }
        }
        return $return;
    }
    function blast_wa_image($id = false, $number = false, $nama, $link, $data = array())
    {
        $return['status'] = 'fail';
        $link_lp = $this->get_lplink($data['no_internet'], $data['no_hp'], $data['produk']);
        $message = str_replace("{link}", $link_lp, $link);
        if ($id) {
            $curl = curl_init();
            $url = "https://webhook.infomedia.co.id/whatsapp_v2/sendHSM";
            $url_img = "https://sy-anida.com/image_public/" . $data['wa_image'];
            $no_hp = $this->hp($number);
            //echo $url_img;
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => '{
                    "account_id": "6281292929947",
                    "to": "' . $no_hp . '",
                    "element_name": "test_image_3",
                    "data": [
                        {"1":"' . $message . '"},
                        {"2":"' . $link_lp . '"}
                    ],
                    "header"  : {
                        "type":"image", 
                        "data": "' . $url_img . '"
                    }
                }',
                CURLOPT_HTTPHEADER => array(
                    'partner_token: d9dd329ce2d1d4047275c1251aa6c1eb18adcc9c43395af6ae776dddbd21a0b493fb728d61107438c0ea052b45507195',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);
            if (isset($response->sts)) {
                $return['status'] = $response->sts_msg;
                $return['message_id'] = $response->message_id;
                //echo $response->sts_msg;
            }
        }
        return $return;
    }
    function blast_wa_video($id = false, $number = false, $nama, $link, $data = array())
    {
        $return['status'] = 'fail';
        $link_lp = $this->get_lplink($data['no_internet'], $data['no_hp'], $data['produk']);
        $message = str_replace("{link}", $link_lp, $link);
        if ($id) {
            $curl = curl_init();
            $url = "https://webhook.infomedia.co.id/whatsapp_v2/sendHSM";
            $url_img = "https://sy-anida.com/image_public/" . $data['wa_video'];
            $no_hp = $this->hp($number);

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => '{
                    "account_id": "6281292929947",
                    "to": "6281221609591",
                    "element_name": "test_video_3",
                    "data": [
                        {"1":"' . $message . '"},
                        {"2":"' . $link_lp . '"}
                    ],
                    "header"  : {
                        "type":"video", 
                        "data": "' . $url_img . '"
                    }
                }',
                CURLOPT_HTTPHEADER => array(
                    'partner_token: d9dd329ce2d1d4047275c1251aa6c1eb18adcc9c43395af6ae776dddbd21a0b493fb728d61107438c0ea052b45507195',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);

            if (isset($response->sts)) {
                $return['status'] = $response->sts_msg;
                $return['message_id'] = $response->message_id;
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
                "username": "profiling_indihome_reguler",
                "password": "wBbqP4aNNf"
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
    function test_email_indihome()
    {
        // $uri_image=base_url().'images/campaign_image/'.$image;
        // $msg = "<table width='900' border='0'><tbody><tr><th scope='col'><a href='{link}' target='_blank'><img src='{img_url}' border='0' align='absmiddle' style='width:100%;border:1px solid #ccc;border-radius:10px'></a></th></tr><tr><td width='800' valign='top'><div class='m_-2059370859787904988div_outer_ln' align='left'><table width='800' border='0'><tbody><tr><td width='14' height='565'>&nbsp; </td><td width='791' valign='top'><p align='justify'></p></td></tr></tbody></table><br><br></div></td></tr></tbody></table>";
        // // $msg = "ini email";
        // $msg = "<tr style='border-collapse:collapse'><td align='left' style='padding:0;Margin:0'><table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'><tbody><tr style='border-collapse:collapse'><td width='600' valign='top' align='center' style='padding:0;Margin:0'><table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'><tbody><tr style='border-collapse:collapse'><td align='center' style='padding:0;Margin:0;font-size:0'><img class='adapt-img' src='https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png' alt='indihome' style='display:block;border:0;outline:0;text-decoration:none;-ms-interpolation-mode:bicubic' width='100%' title='indihome'></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr style='border-collapse:collapse'><td align='left' style='padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;padding-bottom:20px'><table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'><tbody><tr style='border-collapse:collapse'><td width='560' align='center' valign='top' style='padding:0;Margin:0'><table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'><tbody><tr style='border-collapse:collapse'><td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>Halo, Pelanggan Setia IndiHome!</p></td></tr><tr style='border-collapse:collapse'><td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p></td></tr><tr style='border-collapse:collapse'><td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p></td></tr><tr style='border-collapse:collapse'><td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></td></tr><tr style='border-collapse:collapse'><td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>Untuk berlangganan <a class='' target='_blank' href='https://www.google.com/'>klik di sini</a></p></td></tr></tbody></table></td></tr></tbody></table></td></tr>";
        $link_lp = $this->get_lplink();
        $msg = "
        <tr style='border-collapse:collapse'>
  <td align='left' style='padding:0;Margin:0'>
    <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
      <tbody>
        <tr style='border-collapse:collapse'>
          <td width='600' valign='top' align='center' style='padding:0;Margin:0'>
            <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
              <tbody>
                <tr style='border-collapse:collapse'>
                  <td align='center' style='padding:0;Margin:0;font-size:0'>
                  <a href='$link_lp'><img class='adapt-img' src='{img_url}' alt='indihome' style='display:block;border:0;outline:0;text-decoration:none;-ms-interpolation-mode:bicubic' width='100%' title='indihome'></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </td>
</tr>
<tr style='border-collapse:collapse'>
  <td align='left' style='padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;padding-bottom:20px'>
    <table cellpadding='0' cellspacing='0' width='100%' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
      <tbody>
        <tr style='border-collapse:collapse'>
          <td width='560' align='center' valign='top' style='padding:0;Margin:0'>
            <table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='mso-table-lspace:0;mso-table-rspace:0;border-collapse:collapse;border-spacing:0'>
              <tbody>
                <tr style='border-collapse:collapse'>
                  <td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'>
                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>Halo, Pelanggan Setia IndiHome!</p>
                  </td>
                </tr>
                <tr style='border-collapse:collapse'>
                  <td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'>
                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>
                    </p>
                  </td>
                </tr>

                <tr style='border-collapse:collapse'>
                  <td align='left' class='es-m-txt-c' style='Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px'>
                    <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Cocogoose-Pro-Light;line-height:24px;color:#000'>Untuk berlangganan <a class='' target='_blank' href='{link}'>klik di sini</a>
                    </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </td>
</tr>
        ";
        $return = 'Gagal';
        // if ($id) {

        $uri_image = "https://sy-anida.com/image_public/image_banner.jpg";
        $msg = str_replace("{link}", $link_lp, $msg);
        $msg = str_replace("{img_url}", $uri_image, $msg);
        $curl = curl_init();
        $return = 'EMAIL GAGAL';
        // $msg = str_replace('"', "'", $msg);


        $url = "https://subsystem.indihome.co.id/myiapi/api/senderEmail";
        // $message="asd";
        $msg = $this->minifier($msg);
        $arr = array(
            "guid" => "3d64acfb017d0529b72",
            "code" => "",
            "data" => '{"key":"INF","email":"ahmadsadikin8888@gmail.com","label":"INDIHOME","subject":"DIGITAL SALES","konten":"' . $msg . '"}'
        );
        $data = http_build_query($arr);
        // $data = 'guid=3d64acfb017d0529b72&code=&data={"key":"INF","email":"ahmadsadikin8888@gmail.com","label":"INDIHOME","subject":"Digital Sales","konten":"' . $message . '"}';
        echo $data;
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
        echo var_dump($response);
        if (isset($response->sts)) {
            $return = $response->message;
        }

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
    public function status_blasting()
    {
        $this->status_email();
        $this->status_wa();
        $this->get_status_lp();
    }
    public function status_email()
    {
        $dapros = $this->Dapros->live_query("
        SELECT d.id,t.email_image,d.campaign_id,d.customer_key FROM dapros d 
        LEFT JOIN fact_interaction f ON  d.campaign_id = f.campaign_id AND d.customer_key = f.customer_key
        LEFT JOIN trx_campaign t ON  d.campaign_id = t.id
        LEFT JOIN dim_status ds ON  ds.status_key = f.status_key
        WHERE  
        ((f.channel_key = '3' ) OR
        (f.channel_key_2 = '3') OR
        (f.channel_key_3 = '3') ) AND ds.flaging = '1'
        ")->result();
        ///get status lp
        ///get status read

        if (count($dapros) > 0) {
            foreach ($dapros as $dt) {
                $status_email = $this->get_status_email($dt->id, $dt->email_image);
                $data_update = array(
                    "status_read" => $status_email
                );
                $this->Fact_interaction->edit(array("campaign_id" => $dt->campaign_id, "customer_key" => $dt->customer_key), $data_update);
            }
        }
    }
    public function get_status_email($id, $data)
    {
        $curl = curl_init();
        $url = "https://sy-anida.com/api/Public_Access/status_read/" . $id . "/" . $data;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        return $response;
    }
    public function status_wa()
    {
        $dapros = $this->Dapros->live_query("
        SELECT d.id,t.email_image,d.campaign_id,d.customer_key,f.message_id FROM dapros d 
        LEFT JOIN fact_interaction f ON  d.campaign_id = f.campaign_id AND d.customer_key = f.customer_key
        LEFT JOIN trx_campaign t ON  d.campaign_id = t.id
        LEFT JOIN dim_status ds ON  ds.status_key = f.status_key
        WHERE  
        ((f.channel_key = '1' ) OR
        (f.channel_key_2 = '1') OR
        (f.channel_key_3 = '1') ) AND ds.flaging = '1'
        ")->result();
        ///get status lp
        ///get status read
        if (count($dapros) > 0) {
            foreach ($dapros as $dt) {
                $status_wa = $this->get_status_wa($dt->message_id);

                $data_update = array(
                    "status_read" => $status_wa
                );
                $this->Fact_interaction->edit(array("campaign_id" => $dt->campaign_id, "customer_key" => $dt->customer_key), $data_update);
            }
        }
    }
    public function get_status_wa($message_id)
    {
        $return = 0;
        $curl = curl_init();
        $url = "https://whatsapp.infomedia.co.id/wa_blast_947/status";

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{
                "message_id" : "' . $message_id . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic ZmF1bHRfaGFuZGxpbmc6ZmF1bHRfaGFuZGxpbmdfIUAj'
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        $data = $response->data;
        $status = $data[0]->status_blast;
        if ($status == 'read') {
            $return = 1;
        }
        return $return;
    }
    public function get_status_lp()
    {
        $return = 0;
        $curl = curl_init();
        $url = "https://subsystem.indihome.co.id/dashboard-ultra/api/getData";

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => 'type=minipack',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);
        $data = $response->data;
        $datana = $data->leads;
        if (count($datana) > 0) {
            foreach ($datana as $raw) {
                $tgl_insert = explode(' ', $raw->insert_time);
                $gsm = $raw->handphone_prospect;
                $snd = $raw->nomor_indihome;
                $date_key = $this->Dim_date->get_row(array('date_value' => $tgl_insert[0]));

                $dapros = $this->Dapros->live_query("
                SELECT f.fi_key FROM fact_interaction f 
                LEFT JOIN dim_date dt ON dt.date_key = f.date_key
                LEFT JOIN dapros dc ON dc.customer_key = f.customer_key AND dc.campaign_id = f.campaign_id
                WHERE dc.snd='$snd' AND dt.date_key = '$date_key->date_key' AND dc.gsm='$gsm'
                ")->result();
                $data_update = array();
                if ($raw->open_time != "") {
                    $data_update['status_click'] = 1;
                }
                if ($raw->api_aktivasi != "") {
                    $data_update['status_activated'] = 1;
                }
                if ($raw->ps_time != "") {
                    $data_update['status_ps'] = 1;
                }
                if (count($data_update) > 0) {
                    if (count($dapros) > 0) {
                        foreach ($dapros as $dp) {
                            $where = array(
                                'fi_key' => $dp->fi_key
                            );
                            $this->Fact_interaction->edit($where, $data_update);
                        }
                    }
                }
            }
        }
    }
}
