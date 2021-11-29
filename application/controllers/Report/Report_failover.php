<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_failover extends CI_Controller
{
    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Custom_model/Fact_interaction_model', 'Fact_interaction');
        // $this->load->database();
    }
    public function index()
    {
        $data = array();

        $data["controller"] = $this;
        $opsi_channel_1 = $this->Fact_interaction->live_query(
            "SELECT fact_interaction.channel_key as channelna,ds.flaging as flagingna,count(fi_key) as numna FROM fact_interaction 
            JOIN dim_status ds ON ds.status_key = fact_interaction.status_key
              GROUP BY fact_interaction.channel_key,ds.flaging"
        )->result();
        $data['opsi_channel']["channel_1"]['failed']['numna'] = 0;
        $data['opsi_channel']["channel_1"]['success']['numna'] = 0;
        $data['opsi_channel_2']["channel_2"]['failed']['numna'] = 0;
        $data['opsi_channel_2']["channel_2"]['success']['numna'] = 0;
        $data['opsi_channel_3']["channel_3"]['failed']['numna'] = 0;
        $data['opsi_channel_3']["channel_3"]['success']['numna'] = 0;
        if (count($opsi_channel_1) > 0) {
            foreach ($opsi_channel_1 as $oc1) {
                // if ($oc1->flagingna < 2) {
                $data['opsi_channel']["channel_" . $oc1->channelna . $oc1->flagingna] = $oc1->numna;
                // } else {
                // $data['opsi_channel']["channel_" . $oc1->channelna]['failed'] = $oc1->numna;
                // }


                $opsi_channel_2_1 = $this->Fact_interaction->live_query(
                    "SELECT fact_interaction.channel_key_2,ds.flaging as flagingna,count(*) as numna FROM fact_interaction 
                    JOIN dim_status ds ON ds.status_key = fact_interaction.status_key_2
                    JOIN dim_status ds2 ON ds2.status_key = fact_interaction.status_key
                     WHERE ds.flaging = '$oc1->flagingna' AND ds2.flaging != '1' AND fact_interaction.channel_key = '$oc1->channelna' GROUP BY fact_interaction.channel_key_2,ds.flaging"
                )->result();
                if (count($opsi_channel_2_1) > 0) {
                    foreach ($opsi_channel_2_1 as $oc21) {
                        $data['opsi_channel_2']["channel_" . $oc1->channelna . $oc21->channel_key_2 . $oc21->flagingna] = $oc21->numna;
                    }
                }

                $opsi_channel_3_1 = $this->Fact_interaction->live_query(
                    "SELECT fact_interaction.channel_key_3,ds.flaging as flagingna,count(*) as numna FROM fact_interaction 
                    JOIN dim_status ds ON ds.status_key = fact_interaction.status_key
                    JOIN dim_status ds2 ON ds2.status_key = fact_interaction.status_key_2
                    JOIN dim_status ds3 ON ds3.status_key = fact_interaction.status_key_3
                    -- JOIN dim_channel ch ON ch.channel_key = fact_interaction.channel_key_3
                     WHERE ds.flaging = '$oc1->flagingna' AND ds2.flaging != '1' AND ds.flaging != '1' AND fact_interaction.channel_key = '$oc1->channelna'  GROUP BY fact_interaction.channel_key,fact_interaction.channel_key_2,ds.flaging"
                )->result();
                if (count($opsi_channel_3_1) > 0) {
                    foreach ($opsi_channel_3_1 as $oc31) {
                        // echo  $oc1->channelna . "-" . $oc31->channel_key_3 . "-" . $oc31->flagingna . "<br>";
                        // $data['opsi_channel_3']["channel_" . $oc1->channelna]['success']['channel'] = $oc31->channel_value;
                        $data['opsi_channel_3']["channel_" .  $oc1->channelna . $oc31->channel_key_3 . $oc31->flagingna] =  $oc31->numna;
                    }
                }
            }
        }
        // $opsi_channel_0 = $this->Fact_interaction->live_query(
        //     "SELECT fact_interaction.channel_key,count(*) as numna FROM fact_interaction 
        //     JOIN dim_status ds ON ds.status_key = fact_interaction.status_key
        //      WHERE ds.flaging <> 1   GROUP BY fact_interaction.channel_key "
        // )->result();;
        // if (count($opsi_channel_0) > 0) {
        //     foreach ($opsi_channel_0 as $oc0) {
        //     }
        // }


        $this->template->load('Report/Report_failover', $data);
    }
}
