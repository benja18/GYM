<?php

class Expenses extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {

        $data['status'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'expenses/create');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('value', 'Value', 'required');
            $this->form_validation->set_rules('date', 'Date', 'required');
            

            if ($this->form_validation->run() === FALSE) {

                $data['status'] = 'ValidationError';

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('expenses/create', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['name'] = $_POST['name'];
                $data['value'] = $_POST['value'];                
                $data['date'] = $_POST['date'];                

                if (ctype_digit($data['value'])) {
                    $this->load->model('expense');
                    $this->expense->insert($data);

                    $data['status'] = 'ExpenseInserted';
                } else {
                    $data['status'] = 'PriceError';
                }

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('expenses/create', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {
            
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('expenses/create', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function update() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'expenses/update');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('value', 'Value', 'required');
            $this->form_validation->set_rules('date', 'Date', 'required');

            if ($this->form_validation->run() === FALSE) {

                $this->load->model('expense');
                $data['expense'] = $this->expense->getById($_POST['expense_id']);

                $data['status'] = 'ValidationError';                
                $data['expense_id'] = $_POST['expense_id'];

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('expenses/update', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['name'] = $_POST['name'];
                $data['value'] = $_POST['value'];                
                $data['date'] = $_POST['date'];

                if (ctype_digit($data['value'])) {

                    $this->load->model('expense');
                    $this->expense->update($_POST['expense_id'], $data);
                    $data['status'] = 'ExpenseUpdated';
                } else {
                    $data['status'] = 'PriceError';
                    $this->load->model('expense');
                    $data['expense'] = $this->expense->getById($_POST['expense_id']);                 
                }                                
                
                $data['expense_id'] = $_POST['expense_id'];
                
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('expenses/update', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $data['status'] = '';

            $this->load->model('expense');
            $data['expense'] = $this->expense->getById($_GET['expense_id']);
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('expenses/update', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function delete() {

        $data['status'] = '';

        $id = $_GET['expense_id'];

        $this->load->model('expense');
        $this->expense->delete($id);

        $expenses = $this->expense->getData();

        $data['expenses'] = $expenses;
        
        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('expenses/listExpenses', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function listExpenses() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('start_date', 'Start_date', 'required');
            $this->form_validation->set_rules('end_date', 'End_date', 'required');            

            if ($this->form_validation->run() === FALSE) {

                $data['status'] = '';
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form', 'expenses/listExpenses');
                $this->load->view('expenses/listExpenses', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['start_date'] = $_POST['start_date'];
                $data['end_date'] = $_POST['end_date'];
                
                $this->load->model('expense');
                $expenses = $this->expense->getData($data['start_date'],$data['end_date']);

                $data['expenses'] = $expenses;
                $data['status'] = 'ShowTable';
                
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('expenses/listExpenses', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $data['status'] = '';
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('expenses/listExpenses', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }
    
    public function earnings() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('start_date', 'Start_date', 'required');
            $this->form_validation->set_rules('end_date', 'End_date', 'required');            

            if ($this->form_validation->run() === FALSE) {

                $data['status'] = '';
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form', 'expenses/listExpenses');
                $this->load->view('expenses/earnings', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['start_date'] = $_POST['start_date'];
                $data['end_date'] = $_POST['end_date'];
                
                $this->load->model('expense');
                $expensesLosses = $this->expense->lossesList($data['start_date'],$data['end_date']);
                $losses = $this->expense->losses($data['start_date'],$data['end_date']);
                
                $this->load->model('subscription');
                $subscriptionWinnings = $this->subscription->earningsList($data['start_date'],$data['end_date']);
                $winnings = $this->subscription->earnings($data['start_date'],$data['end_date']);

                $data['expensesList'] = $expensesLosses;
                $data['subscriptionWinnings'] = $subscriptionWinnings;                
                $data['expenses'] = $losses;
                $data['winnings'] = $winnings;
                $data['total'] = $winnings-$losses;
                $data['status'] = 'ShowTable';
                
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('expenses/earnings', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $data['status'] = '';
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('expenses/earnings', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }
    
}