<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/App_tam_data2_model', 'app_tam_data2');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $this->load->model('Custom_model/Tahun_model', 'tahun');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $this->load->model('Custom_model/Monthly_report_cache_model', 'monthly_report');
        $this->load->model('Custom_model/Migrasi_model', 'migrasi');
        $this->load->model('Custom_model/Payment_status_model', 'payment_status');
    }
    public function get_data_cto()
    {
        $start = $_GET['start'];
        $end = $_GET['end'];
        $jenis = $_GET['jenis'];
        
        $where = array();
        if (isset($start) && isset($end)) {
            $where['DATE(tgl) >='] = $start;
            $where['DATE(tgl) <='] = $end;
        }
        if($jenis != "ALL"){
            $where['jenis'] =$jenis;
        }
        $where_contacted = $where;
        $where_notcontacted = $where;
        $where_contacted['status'] = 'Contacted';
        $where_notcontacted['status'] = 'Not Contacted';
        $where_agree = $where_contacted;
        $where_agree['kategori'] = 'Agree';
        $where_followup = $where_contacted;
        $where_followup['kategori'] = 'Follow UP';
        $where_decline = $where_contacted;
        $where_decline['kategori'] = 'Decline';
        $contacted_all = $this->app_tam_data2->get_count(array("status"=>'Contacted'));
        $notcontacted_all = $this->app_tam_data2->get_count(array("status"=>'Not Contacted'));
        $contacted = $this->app_tam_data2->get_count($where_contacted);
        $notcontacted = $this->app_tam_data2->get_count($where_notcontacted);
        $agree = $this->app_tam_data2->get_count($where_agree);
        $followup = $this->app_tam_data2->get_count($where_followup);
        $decline = $this->app_tam_data2->get_count($where_decline);
        $wo = $this->migrasi->get_count();
        $payment_status = $this->payment_status->get_count();
        
        $agent_online = $this->app_tam_data2->live_query("select count(*) as num_row FROM app_tam_data2 WHERE DATE(tgl) >= '" . $start . "' AND DATE(tgl) <= '" . $end . "'  GROUP BY login ORDER BY login DESC")->num_rows();
        $json = array(
            'oc' => number_format($contacted + $notcontacted),
            'contacted' => number_format($contacted),
            'contacted_rate' => number_format(($contacted / ($contacted + $notcontacted)) * 100),
            'notcontacted' => number_format($notcontacted),
            'notcontacted_rate' => number_format(($notcontacted / ($contacted + $notcontacted)) * 100),
            'agree' => number_format($agree),
            'convention_rate' => number_format(($agree / ($contacted)) * 100),
            'followup' => number_format($followup),
            'decline' => number_format($decline),
            'agent_online' => number_format($agent_online),
            'payment_status' => number_format($payment_status),
            'wo' => number_format($wo-($contacted_all+$notcontacted_all)),
        );
        echo json_encode($json);
    }

    function get_grafik()
    {

        $start = $_GET['start'];
        $end = $_GET['end'];
        $jenis = $_GET['jenis'];
        $filter_jenis="";
        $now = new DateTime( "6 days ago", new DateTimeZone('America/New_York'));
        $interval = new DateInterval( 'P1D'); // 1 Day interval
        $period = new DatePeriod( $now, $interval, 7); // 7 Days
        foreach( $period as $day) {
            $dt = $day->format( 'Y-m-d');
            $where = array();
            if (isset($start) && isset($end)) {
                $where['DATE(tgl)'] =$dt;
            }
            $where_contacted = $where;
            $where_notcontacted = $where;
            $where_contacted['status'] = 'Contacted';
            $where_notcontacted['status'] = 'Not Contacted';
            $where_agree = $where_contacted;
            $where_agree['kategori'] = 'Agree';
            $where_followup = $where_contacted;
            $where_followup['kategori'] = 'Follow UP';
            $where_decline = $where_contacted;
            $where_decline['kategori'] = 'Decline';
            $total['data']['Contacted'][] = intval($this->app_tam_data2->get_count($where_contacted));
            // $total['data']['Not Contacted'][] = intval($this->app_tam_data2->get_count($where_notcontacted));
            $total['data_agree']['Agree'][] = intval($this->app_tam_data2->get_count($where_agree));
            $total['data']['Follow UP'][] = intval($this->app_tam_data2->get_count($where_followup));
            $total['data']['Decline'][] = intval($this->app_tam_data2->get_count($where_decline));
        }
       
        // $query_trans_profiling = $this->app_tam_data2->live_query(
        //     "SELECT DATE(tgl) as tgl_na,count(*) as numna FROM app_tam_data2 WHERE DATE(tgl) >= CURDATE() - INTERVAL 7 DAY  AND kategori ='Agree' GROUP BY DATE(tgl) ORDER BY tgl ASC"
        // );

        // $total['data']['Agree'][0] =12;
        echo json_encode($total);
    }
    function get_daily_performance()
    {
        $start = $_GET['start'];
        $end = $_GET['end'];
        $jenis = $_GET['jenis'];
        $filter_jenis="";
        if($jenis != "ALL"){
            $filter_jenis="AND jenis='".$jenis."' ";
        }
        $data_agent = $this->app_tam_data2->live_query("select login,count(*) as num_row FROM app_tam_data2 WHERE DATE(tgl) >= '" . $start . "' AND DATE(tgl) <= '" . $end . "' AND kategori='Agree' ".$filter_jenis." GROUP BY login")->result_array();
        if(count($data_agent) > 0){
            foreach($data_agent as $da){
                $ag = $this->sys_user->get_row_array(array("login" => $da['login']));
                $value_agent[$ag['agentid']]=$da['num_row'];
            }
        }
        arsort($value_agent);
        $rating_agent = array_slice($value_agent, 0, 6);
        $n = 1;
        foreach ($rating_agent as $k => $v) {
            // echo $k."<br>";
            // echo $v;
           
            $json['agent'][$n] = $this->sys_user->get_row_array(array("agentid" => $k));
            $json['agent'][$n]['num'] = $v;
            $n++;
        }
        // echo $json;
        echo json_encode($json);
    }
    function get_grafik_verified_yearly()
    {
        $tahun = $this->tahun->get_results();
        $now = date('Y-m-d');
        if ($tahun['num'] > 0) {
            foreach ($tahun['results'] as $th) {

                for ($i = 0; $i <= 11; $i++) {
                    ////check report cache//
                    $monthly_report = $this->monthly_report->get_count(array("tahun" => $th->tahun, "bulan" => $i + 1));
                    if ($monthly_report > 0) {

                        $report_cache = $this->monthly_report->get_row(array("tahun" => $th->tahun, "bulan" => $i + 1), array("verified,DATE_FORMAT(last_update ,'%Y-%m-%d') as last_update_date"));
                        if ($report_cache->last_update_date == $now) {
                            $data['data'][$th->tahun][$i] = intval($report_cache->verified);
                        } else {
                            $data['data'][$th->tahun][$i] = $this->app_tam_data2->get_count(array("YEAR(tgl)" => $th->tahun, "MONTH(tgl)" => $i + 1,"kategori"=>"Agree"));
                            $data_update = array(
                                'verified' => $data['data'][$th->tahun][$i],
                                'last_update' => date("Y-m-d h:i:sa")
                            );
                            $this->monthly_report->edit(array("tahun" => $th->tahun, "bulan" => $i + 1), $data_update);
                        }
                    } else {
                        $data['data'][$th->tahun][$i] = $this->app_tam_data2->get_count(array("YEAR(tgl)" => $th->tahun, "MONTH(tgl)" => $i + 1,"kategori"=>"Agree"));
                        $data_insert = array(
                            'tahun' => $th->tahun,
                            'bulan' => $i + 1,
                            'verified' => $data['data'][$th->tahun][$i],
                            'last_update' => date("Y-m-d h:i:sa")
                        );
                        $this->monthly_report->add($data_insert);
                    }
                }
            }
        }

        echo json_encode($data);
    }
    function get_data_list()
    {
        $data['controller'] = $this;
        $start_filter = date('Y-m-d');
        $end_filter = date('Y-m-d');
        // if (isset($_GET['start']) && isset($_GET['end'])) {
        // $start_filter = $_GET['start'];
        // $end_filter = $_GET['end'];
        // $agentid = $_GET['agentid'];

        $where_agent_reg = array("opt_level" => 8);
        $where_agent_moss = array("opt_level" => 8);

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);

        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $data['userdata'] = $userdata;

        if ($userdata->opt_level == 8) {
            // $where_agent['agentid'] =$userdata->agentid;

        }

        if ($userdata->opt_level == 9) {
            $where_agent_moss['tl'] = $userdata->agentid;
            $where_agent_reg['tl'] = $userdata->agentid;
        }
        if ($userdata->opt_level == 7) {
            $where_agent_reg = array("opt_level" => 8);
            $where_agent_moss = array("opt_level" => 8);
        }
        $data['agent_reg'] = $this->sys_user->get_results($where_agent_reg, array("*"));
        $data['agent_moss'] = $this->sys_user->get_results($where_agent_moss, array("*"));

        $filter = array();
        $start = $_GET['start'];
        $end = $_GET['end'];
        if ($userdata->opt_level == 8) {
            $data['query_trans_profiling_ct0']  = $this->app_tam_data2->live_query(
                "SELECT * FROM app_tam_data2 WHERE DATE(tgl) = '" . $start . "' AND jenis = 'CT0' "
            );
            $data['query_trans_profiling_pranpc']  = $this->app_tam_data2->live_query(
                "SELECT * FROM app_tam_data2 WHERE DATE(tgl) = '" . $start . "' AND jenis='PRA NPC' "
            );
        } else {
            if ($start == date('Y-m-d') && $end == date('Y-m-d')) {
                $data['query_trans_profiling_ct0']  = $this->app_tam_data2->live_query(
                    "SELECT * FROM app_tam_data2 WHERE DATE(tgl) = '" . $start . "'  AND jenis = 'CT0' "
                );
                $data['query_trans_profiling_pranpc']  = $this->app_tam_data2->live_query(
                    "SELECT * FROM app_tam_data2 WHERE DATE(tgl) = '" . $start . "'  AND jenis = 'PRA NPC' "
                );
            } else {
                $data['query_trans_profiling_ct0']  = $this->app_tam_data2->live_query(
                    "SELECT * FROM app_tam_data2 WHERE DATE(tgl) >= '" . $start . "' AND DATE(tgl) <= '" . $end . "' AND jenis = 'CT0' "
                );
                $data['query_trans_profiling_pranpc']  = $this->app_tam_data2->live_query(
                    "SELECT * FROM app_tam_data2 WHERE DATE(tgl) >= '" . $start . "' AND DATE(tgl) <= '" . $end . "' AND jenis = 'PRA NPC' "
                );
            }
        }

        $this->load->view('front-end/landing-page/dashboard_v2/list_area', $data);
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
}
