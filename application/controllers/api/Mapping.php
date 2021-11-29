<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mapping extends CI_Controller
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
        $this->load->model('Custom_model/Dim_cat_model', 'Dim_cat');
        $this->load->model('Custom_model/Lake_on4_model', 'Lake_on4');
        // $this->load->database();
    }

    public function proses_mapping()
    {
        $dapros = $this->Dapros->get_results(array("status_mapping" => '0'), array("*"));
        if ($dapros['num'] > 0) {
            foreach ($dapros['results'] as $row) {
                $data_customer = array(
                    'snd' => $row->snd,
                    'no_gsm' => $row->gsm,
                    'email' => $row->email,
                    'opsi_channel' => $row->channel_key
                );
                $cek_pelanggan = $this->Dapros->live_query("SELECT * FROM dim_customer WHERE snd='" . $row->snd . "'")->num_rows();
                if ($cek_pelanggan == 0) {
                    $this->Dim_customer->Add($data_customer);
                    $cek_pelanggan = $this->Dim_customer->get_row($data_customer);
                } else {
                    $cek_pelanggan = $this->Dapros->live_query("SELECT * FROM dim_customer WHERE snd='" . $row->snd . "'")->row();
                }
                ///cek interaction 147
                $update_dapros = array(
                    "status_mapping" => 1
                );
                $data147 = $this->Dapros->live_query("select * FROM lake_147 WHERE FASTEL='" . $row->snd . "' ")->result();
                if (count($data147) > 0) {
                    $update_dapros['interaction_147'] = 1;
                    foreach ($data147 as $r147) {
                        $data_customer = array(
                            'snd' => $r147->FASTEL,
                            'no_gsm' => $r147->PHONE_NUMBER_AKUN,
                            'nama' => $r147->CALLER_NAME
                        );
                        $cek_pelanggan = $this->Dapros->live_query("SELECT * FROM dim_customer WHERE snd='" . $r147->FASTEL . "'")->num_rows();
                        if ($cek_pelanggan == 0) {
                            $this->Dim_customer->Add($data_customer);
                            $cek_pelanggan = $this->Dim_customer->get_row($data_customer);
                        } else {
                            $cek_pelanggan = $this->Dapros->live_query("SELECT * FROM dim_customer WHERE snd='" . $r147->FASTEL . "'")->row();
                        }
                        $date_key = $this->Dim_date->get_row(array("DATE(date_value)" => $r147->TANGGAL));
                        $data_insert = array(
                            'cat_key' => 1,
                            'customer_key' => $cek_pelanggan->customer_key,
                            'channel_key' => 4,
                            'status_key' => 25,
                            'layanan_key' => 2,
                            'regional_key' => $this->romawi_to_num($r147->REGIONAL),
                            'witel_key' => '',
                            'agent_key' => '',
                            'date_key' => $date_key->date_key,
                            'time_key' => '',
                            'category_produk_key' => '',
                            'produk_key' => '',
                            'interaction_value' => $r147->INTERACTION_SUMMARY
                        );
                        $cek = $this->Fact_interaction->get_count($data_insert);
                        if ($cek == 0) {
                            $this->Fact_interaction->add($data_insert);
                        }
                    }
                }

                ///cek interaction sosmed
                $data147 = $this->Dapros->live_query("select * FROM lake_socmed WHERE NO_TELP_OR_INET='" . $row->snd . "' ")->result();
                if (count($data147) > 0) {
                    $update_dapros['interaction_socmed'] = 1;
                    foreach ($data147 as $r147) {
                        $data_customer = array(
                            'snd' => $r147->NO_TELP_OR_INET,
                            'no_gsm' => $r147->PHONE_NUMBER_AKUN,
                            'nama' => $r147->CALLER_NAME
                        );
                        $cek_pelanggan = $this->Dapros->live_query("SELECT * FROM dim_customer WHERE snd='" . $r147->NO_TELP_OR_INET . "'")->num_rows();
                        if ($cek_pelanggan == 0) {
                            $this->Dim_customer->Add($data_customer);
                            $cek_pelanggan = $this->Dim_customer->get_row($data_customer);
                        } else {
                            $cek_pelanggan = $this->Dapros->live_query("SELECT * FROM dim_customer WHERE snd='" . $r147->NO_TELP_OR_INET . "'")->row();
                        }
                        $date_key = $this->Dim_date->get_row(array("DATE(date_value)" => $r147->TANGGAL));
                        $data_insert = array(
                            'cat_key' => 1,
                            'customer_key' => $cek_pelanggan->customer_key,
                            'channel_key' => 5,
                            'status_key' => 25,
                            'layanan_key' => 3,
                            'regional_key' => $this->romawi_to_num($r147->REGIONAL),
                            'witel_key' => '',
                            'agent_key' => '',
                            'date_key' => $date_key->date_key,
                            'time_key' => '',
                            'category_produk_key' => '',
                            'produk_key' => '',
                            'interaction_value' => $r147->INTERACTION_SUMMARY
                        );
                        $cek = $this->Fact_interaction->get_count($data_insert);
                        if ($cek == 0) {
                            $this->Fact_interaction->add($data_insert);
                        }
                    }
                }


                /// cek interaction on4
                $data147 = $this->Dapros->live_query("select * FROM lake_on4 WHERE p_service_number='" . $row->snd . "' ")->result();
                if (count($data147) > 0) {
                    $update_dapros['interaction_socmed'] = 1;
                    foreach ($data147 as $r147) {
                        $data_customer = array(
                            'snd' => $r147->p_service_number,
                            'no_gsm' => $r147->cust_hp,
                            'nama' => $r147->cust_name,
                            'email' => $r147->cust_email
                        );
                        $cek_pelanggan = $this->Dapros->live_query("SELECT * FROM dim_customer WHERE snd='" . $r147->p_service_number . "'")->num_rows();
                        if ($cek_pelanggan == 0) {
                            $this->Dim_customer->Add($data_customer);
                            $cek_pelanggan = $this->Dim_customer->get_row($data_customer);
                        } else {
                            $cek_pelanggan = $this->Dapros->live_query("SELECT * FROM dim_customer WHERE snd='" . $r147->p_service_number . "'")->row();
                        }
                        $date_key = $this->Dim_date->get_row(array("DATE(date_value)" => $r147->tanggal));
                        $cat_key = $this->Dim_cat->get_row(array("other_value" => $r147->category));
                        $data_insert = array(
                            'cat_key' => $cat_key->cat_key,
                            'customer_key' => $cek_pelanggan->customer_key,
                            'channel_key' => 5,
                            'status_key' => 25,
                            'layanan_key' => 3,
                            // 'regional_key' => $this->romawi_to_num($r147->REGIONAL),
                            'witel_key' => '',
                            'agent_key' => '',
                            'date_key' => $date_key->date_key,
                            'time_key' => '',
                            'category_produk_key' => '',
                            'produk_key' => '',
                            'interaction_value' => $r147->remark
                        );
                        $cek = $this->Fact_interaction->get_count($data_insert);
                        if ($cek == 0) {
                            $this->Fact_interaction->add($data_insert);
                        }
                    }
                }
                ////end cek interaction on4

                ///cek interaction profiling

                $data147 = $this->Dapros->live_query("select *,DATE(lup) as TANGGAL FROM trans_profiling WHERE no_speedy='" . $row->snd . "' AND veri_call=13")->result();
                if (count($data147) > 0) {
                    $update_dapros['interaction_profiling'] = 1;
                    foreach ($data147 as $r147) {
                        $channel = $this->Dapros->live_query(array("channel_profiling" => $r147->opsi_call))->row();
                        $data_customer = array(
                            'snd' => $r147->no_speedy,
                            'no_gsm' => $r147->handphone,
                            'email' => $r147->email,
                            'opsi_channel' => $channel->channel_key
                        );
                        $cek_pelanggan = $this->Dapros->live_query("SELECT * FROM dim_customer WHERE snd='" . $r147->no_speedy . "'")->num_rows();
                        if ($cek_pelanggan == 0) {
                            $this->Dim_customer->Add($data_customer);
                            $cek_pelanggan = $this->Dim_customer->get_row($data_customer);
                        } else {
                            $this->Dim_customer->edit(array("snd" => $r147->no_speedy), $data_customer);
                            $cek_pelanggan = $this->Dapros->live_query("SELECT * FROM dim_customer WHERE snd='" . $r147->no_speedy . "'")->row();
                        }
                        $date_key = $this->Dim_date->get_row(array("DATE(date_value)" => $r147->TANGGAL));
                        $data_insert = array(
                            'cat_key' => 1,
                            'customer_key' => $cek_pelanggan->customer_key,
                            'channel_key' => 4,
                            'status_key' => 25,
                            'layanan_key' => 6,
                            'regional_key' => $r147->regional,
                            'witel_key' => '',
                            'agent_key' => '',
                            'date_key' => $date_key->date_key,
                            'time_key' => '',
                            'category_produk_key' => '',
                            'produk_key' => '',
                            'interaction_value' => ''
                        );
                        $cek = $this->Fact_interaction->get_count($data_insert);
                        if ($cek == 0) {
                            $this->Fact_interaction->add($data_insert);
                        }
                    }
                }
                ///cek interaction moss
                $data147 = $this->Dapros->live_query("select *,DATE(lup) as TANGGAL FROM trans_profiling_moss WHERE no_speedy='" . $row->snd . "' ")->result();
                if (count($data147) > 0) {
                    $update_dapros['interaction_moss'] = 1;
                    foreach ($data147 as $r147) {
                        $channel = $this->Dapros->live_query(array("channel_profiling" => $r147->opsi_call))->row();
                        $data_customer = array(
                            'snd' => $r147->no_speedy,
                            'no_gsm' => $r147->handphone,
                            'email' => $r147->email,
                            'opsi_channel' => $channel->channel_key
                        );
                        $cek_pelanggan = $this->Dapros->live_query("SELECT * FROM dim_customer WHERE snd='" . $r147->no_speedy . "'")->num_rows();
                        if ($cek_pelanggan == 0) {
                            $this->Dim_customer->Add($data_customer);
                            $cek_pelanggan = $this->Dim_customer->get_row($data_customer);
                        } else {
                            $this->Dim_customer->edit(array("snd" => $r147->no_speedy), $data_customer);
                            $cek_pelanggan = $this->Dapros->live_query("SELECT * FROM dim_customer WHERE snd='" . $r147->no_speedy . "'")->row();
                        }
                        $date_key = $this->Dim_date->get_row(array("DATE(date_value)" => $r147->TANGGAL));
                        $data_insert = array(
                            'cat_key' => 5,
                            'customer_key' => $cek_pelanggan->customer_key,
                            'channel_key' => 4,
                            'status_key' => 25,
                            'layanan_key' => 5,
                            'regional_key' => $r147->regional,
                            'witel_key' => '',
                            'agent_key' => '',
                            'date_key' => $date_key->date_key,
                            'time_key' => '',
                            'category_produk_key' => '',
                            'produk_key' => '',
                            'interaction_value' => ''
                        );
                        $cek = $this->Fact_interaction->get_count($data_insert);
                        if ($cek == 0) {
                            $this->Fact_interaction->add($data_insert);
                        }
                    }
                }
                $update_dapros['customer_key'] = $cek_pelanggan->customer_key;
                $this->Dapros->edit(array("id" => $row->id), $update_dapros);
            }
        }
    }
    function romawi_to_num($romawi)
    {
        $data = array(
            "I" => "1",
            "II" => "2",
            "III" => "3",
            "IV" => "4",
            "V" => "5",
            "VI" => "6",
            "VII" => "7"
        );
        return $data[$romawi];
    }
    function get_data_socmed()
    {
        $return = 0;
        $date = '2021-07-01';
        $now = DATE('Y-m-d');
        $last = $this->Lake_on4->get_row(array(), array("*"), array("id" => "DESC"))->tanggal;
        $date = strtotime($last);
        $date = strtotime("+1 day", $date);
        $date = date('Y-m-d', $date);
        $i = 0;
        $d = 0;
        if ($date < $now) {
            $curl = curl_init();
            $url = "https://apion4nas.infomedia.co.id/api/v2/internal_tcare/report/cwc_addon";

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => 'date=' . $date,
                CURLOPT_HTTPHEADER =>  array(
                    'authorization: Basic b2N0X3RlbGtvbWNhcmVAaW5mb21lZGlhLmNvLmlkOjFuZm9tZWRpQDIwMTg=',
                    'x-dreamfactory-api-key: f18adc021d480b5c451e22e3e6fbfc8f455a54b1c8b0eb2f8072eb0412487710',
                    'Accept: application/json',
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            ));

            $response = curl_exec($curl);
            $response = json_decode($response);
            $data = $response;

            if (count($data) > 0) {
                foreach ($data as $row) {
                    $data_insert = (array) $row;
                    $cek = $this->Lake_on4->get_count(array("p_service_number" => $data_insert['p_service_number'], "date_submit" => $data_insert['date_submit']));
                    if ($cek == 0) {
                        $this->Lake_on4->add($data_insert);
                        $i++;
                    }
                    $d++;
                }
            }
        }

        echo "Data : " . $d . " Insert : " . $i;
    }
}
