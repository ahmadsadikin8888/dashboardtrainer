<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generate_report_cache extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/Status_call_model', 'status_call');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
        $this->load->model('Custom_model/Report_cache_model', 'report_cache');
        $this->load->model('Custom_model/Migrasi_model', 'migrasi');
        $this->load->model('Custom_model/Payment_status_model', 'payment_status');
        $this->load->model('Custom_model/App_tam_data2_model', 'app_tam_data2');
        $this->load->model('Pract0_spd_bayar/Pract0_spd_bayar_model','pract0_spd_bayar');
    }
    public function payment_status($limit=100,$offset=0,$jumlah){
        $num_dapros=$this->migrasi->get_count();
        $jumlah_data=$limit+$jumlah;
        
        if($jumlah_data <= $num_dapros){
            $dapros=$this->app_tam_data2->get_results(array("fastel !="=>"","kategori"=>"Agree"),array("*"),array("limit"=>$limit,"offset"=>$offset),array("id"=>"ASC"));
            if($dapros['num'] > 0){
                foreach($dapros['results'] as $dp){
                    $payment=$this->pract0_spd_bayar->live_query("select *
                        from pract0_spd_bayar
                        where ct0 = 'Y'
                        and segment = 'DCS'
                        and (profile = 'ADA USAGE N-1 PERNAH BAYAR' or profile = 'ADA USAGE PERNAH BAYAR' or profile = 'ADA USAGE N-1 TIDAK PERNAH BAYAR')
                        and saldo_bln1 = 0
                        and bayar1 is not null 
                        AND SND = '$dp->fastel'
                        ");
                        $row=$payment->row();
                        if($row){
                            $num_payment_status=$this->payment_status->get_count(array("id"=>$dp->id));
                            if($num_payment_status == 0){
                                $this->payment_status->insert(array("id_app_tam_data2"=>$dp->id,"status"=>1,"update_status"=>date('Y-m-d H:i:s')));
                            }
                        }
                }
            }
        }
        $offset=$limit+$jumlah;
        $data['link'] = base_url() . "api/Generate_report_cache/payment_status/" . $limit . "/" . $offset . "/" . $jumlah_data;
       
        $this->load->view('Custom_view/count_down', $data);
    }
    public function generate_report($date)
    {
        $data = array();
        // $number_add=$this->input->get('number_add');
        $date_1 = $date.' 00:00:00';
        $date_2 = $date.' 23:59:59';
        if ($date) {
            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT veri_call,handphone,email,DATE(lup) as date_lup FROM trans_profiling WHERE lup BETWEEN '".$date_1."' AND '".$date_2."' ORDER BY lup ASC
                "
            );
            $data_input = array();
            $last_date = false;
            $n = 0;
            foreach ($query_trans_profiling->result_array() as $dl) {
                if ($last_date) {
                    if ($dl['date_lup'] != $last_date) {



                        $data_insert = $data_input[$last_date];
                        if ($this->report_cache->get_count(array('date' => $last_date)) == 0) {
                            $this->report_cache->add($data_insert);
                        } else {
                            $this->report_cache->edit(array('date' => $last_date), $data_insert);
                        }
                    }
                }
                $last_date = $dl['date_lup'];
                $data_input[$dl['date_lup']]['date'] = $last_date;
                $data_input[$dl['date_lup']]['total_order_call'] = $data_input[$dl['date_lup']]['total_order_call'] + 1;
                for ($status = 1; $status <= 16; $status++) {
                    if ($dl['veri_call'] == $status) {
                        $data_input[$dl['date_lup']]['status_' . $status] = $data_input[$dl['date_lup']]['status_' . $status] + 1;
                        if ($dl['veri_call'] == 13) {
                            if (stripos($dl['email'], "@") !== false) {
                                $email = 1;
                            }
                            if (stripos($dl['handphone'], "08") !== false) {
                                $handphone = 1;
                            }
                            if ($email == 1 && $handphone == 1) {
                                $data_input[$dl['date_lup']]['hp_email'] = $data_input[$dl['date_lup']]['hp_email'] + 1;
                            } else {
                                if ($handphone == 1) {
                                    $data_input[$dl['date_lup']]['hp_only'] = $data_input[$dl['date_lup']]['hp_only'] + 1;
                                }
                            }
                        }
                    }
                }
                $n++;
            }
            if($last_date == date('Y-m-d')){
                $data_insert = $data_input[$last_date];
                if ($this->report_cache->get_count(array('date' => $last_date)) == 0) {
                    $this->report_cache->add($data_insert);
                } else {
                    $this->report_cache->edit(array('date' => $last_date), $data_insert);
                    // echo "updating data";
                }
            }
            // echo $n;
            
        } else {
            echo "Please input YEAR AND MONTH AND DAY";
            exit;
        }


        $this->load->view('Custom_view/generate_report', $data);
    }
    public function get_datapros_telkom($tahun,$bulan,$day)
    {
        $this->load->model('Dbprofile_verified/Dbprofile_verified_model', 'dbprofile');
        $data = array();
        // $number_add=$this->input->get('number_add');
        if ($day) {
            $query_telkom_profile = $this->dbprofile->live_query(
                "SELECT DBPROFILE_VERIFIED.NCLI as NCLI,
                    DBPROFILE_VERIFIED.NO_PSTN as NO_PSTN,
                    DBPROFILE_VERIFIED.NO_SPEEDY as NO_SPEEDY,
                    DBPROFILE_VERIFIED.NAMA_PELANGGAN as NAMA_PELANGGAN,
                    DBPROFILE_VERIFIED.NO_HP as NO_HP,
                    DBPROFILE_VERIFIED.EMAIL as EMAIL,
                    DBPROFILE_VERIFIED.NAMA_PEMILIK as NAMA_PEMILIK,
                    DBPROFILE_VERIFIED.ALAMAT as ALAMAT,
                    DBPROFILE_VERIFIED.KOTA as KOTA,
                    DBPROFILE_VERIFIED.SUMBER as SUMBER,
                    DBPROFILE_VERIFIED.TGL_UPDATE as TGL_UPDATE,
                    DM_CUSTOMER_HVC_NEW_201912.PAY_COUNT
                FROM
                    DM_CUSTOMER_HVC_NEW_201912
                    INNER JOIN DBPROFILE_VERIFIED ON DM_CUSTOMER_HVC_NEW_201912.NCLI = DBPROFILE_VERIFIED.NCLI
                WHERE DM_CUSTOMER_HVC_NEW_201912.PAY_COUNT='0'
                AND TO_CHAR(DBPROFILE_VERIFIED.TGL_UPDATE, 'yyyy-mm') = TO_CHAR(TO_DATE('".$tahun."-".$bulan."-".$day."','yyyy-mm-dd'), 'yyyy-mm')
                AND ROWNUM <= 10 
                "
            );
            $n = 0;
            foreach ($query_telkom_profile->result_array() as $dl) {
                $data_insert=array(
                    'ncli'=>$dl['NCLI'],
                    'no_pstn'=>$dl['NO_PSTN'],
                    'no_speedy'=>$dl['NO_SPEEDY'],
                    'nama_pelanggan'=>$dl['NAMA_PELANGGAN'],
                    'no_handpone'=>$dl['NO_HP'],
                    'email'=>$dl['EMAIL'],
                    'nama_pastel'=>$dl['NAMA_PEMILIK'],
                    'alamat'=>$dl['ALAMAT'],
                    'KOTA'=>$dl['KOTA'],
                    'sumber'=>$dl['SUMBER'],
                    'status'=>0,
                    'status2'=>0,
                    'status3'=>0,
                );
                $insert = $this->trans_profiling->add($data_insert);
            }
            
        } else {
            echo "Please input YEAR AND MONTH AND DAY";
            exit;
        }


        $this->load->view('Custom_view/generate_report_telkom', $data);
    }
    function filter_by_value($array, $index, $value)
    {
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                $temp[$key] = $array[$key][$index];

                if ($temp[$key] == $value) {
                    $newarray[$key] = $array[$key];
                }
            }
        }
        return $newarray;
    }
    function filter_by_hp_email($array, $index, $value)
    {
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                if (is_array($index) && count($index) > 0) {
                    $email = 0;
                    $handphone = 0;
                    foreach ($index as $idx => $idv) {
                        $temp[$key] = $array[$key][$idv];

                        if ($idv == "email") {
                            if (stripos($temp[$key], $value[$idx]) !== false) {
                                // if (stripos($temp[$key], $value[$idx]) !== true) {
                                $email = 1;
                            }
                        }
                        if ($idv == "handphone") {
                            if (stripos($temp[$key], $value[$idx]) !== false) {
                                // if (stripos($temp[$key], $value[$idx]) !== true) {

                                $handphone = 1;
                            }
                        }
                        if ($email == 1 && $handphone == 1) {
                            $newarray[$key] = $array[$key];
                        }
                    }
                }
            }
        }
        return $newarray;
    }
    function filter_by_hp_only($array, $index, $value)
    {
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                if (is_array($index) && count($index) > 0) {
                    $email = 0;
                    $handphone = 0;
                    foreach ($index as $idx => $idv) {
                        $temp[$key] = $array[$key][$idv];

                        if ($idv == "email") {
                            if ($temp[$key] == '') {
                                // if (stripos($temp[$key], $value[$idx]) !== true) {
                                $email = 1;
                            }
                        }
                        if ($idv == "handphone") {
                            if (stripos($temp[$key], $value[$idx]) !== false) {
                                // if (stripos($temp[$key], $value[$idx]) !== true) {

                                $handphone = 1;
                            }
                        }
                        if ($email == 1 && $handphone == 1) {
                            $newarray[$key] = $array[$key];
                        }
                    }
                }
            }
        }
        return $newarray;
    }
};
