<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_General
 *
 * @author Dhiya
 */
class Dc extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('Custom_model/Trainer_model', 'Trainer');
  }
  public function dashboard()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Dc/dashboard';
    $data['agent'] = $this->Trainer->live_query("SELECT status,count(*) as jumlah FROM agent GROUP BY status")->result();
    $data['tl'] = $this->Trainer->live_query("SELECT tl,count(*) as jumlah FROM agent GROUP BY tl")->result();
    $data['kandidat'] = $this->Trainer->live_query("SELECT status,count(*) as jumlah FROM kandidat GROUP BY status")->result();
    $data['kelulusan'] = $this->Trainer->live_query("SELECT kelulusan,count(*) as jumlah FROM kandidat GROUP BY kelulusan")->result();
    $data['total_agent'] = $this->Trainer->live_query("SELECT count(*) as jumlah FROM agent")->row()->jumlah;
    $data['caplan'] = $this->Trainer->live_query("SELECT caplan FROM caplan ORDER BY id DESC LIMIT 1")->row()->caplan;
    $data['status_agent'] = array();

    if (count($data['agent']) > 0) {
      foreach ($data['agent'] as $ag) {
        $data['status_agent'][$ag->status] = $ag->jumlah;
      }
    }

    $data['status_tl'] = array();
    if (count($data['tl']) > 0) {
      foreach ($data['tl'] as $ag) {
        $data['status_tl'][$ag->tl] = $ag->jumlah;
      }
    }
    $data['status_kandidat'] = array();
    if (count($data['kandidat']) > 0) {
      foreach ($data['kandidat'] as $ag) {
        $data['status_kandidat'][$ag->status] = $ag->jumlah;
      }
    }
    $data['status_kelulusan'] = array();
    if (count($data['kelulusan']) > 0) {
      foreach ($data['kelulusan'] as $ag) {
        $data['status_kelulusan'][$ag->kelulusan] = $ag->jumlah;
      }
    }
    $data['controller'] = $this;
    $this->load->view($view, $data);
  }
  public function agent()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Dc/agent';
    $data['agent'] = $this->Trainer->live_query("SELECT * FROM agent ")->result();
   
    $data['controller'] = $this;
    $this->load->view($view, $data);
  }
  public function kandidat()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Dc/kandidat';
    $data['kandidat'] = $this->Trainer->live_query("SELECT * FROM kandidat ")->result();
   
    $data['controller'] = $this;
    $this->load->view($view, $data);
  }
}
