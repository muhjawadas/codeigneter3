<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UAS extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('uas_model');
		$this->load->library('excel');
		$this->load->library('pdf');
	}

	public function index()
	{
		$username = $this->session->userdata('username');

		if ($username == "") {
			$this->load->view('uaslogin');
		} else {
			$this->load->view('uashome');
		}
	}

	public function grid()
	{
		$username = $this->session->userdata('username');

		if ($username == "") {
			$this->index();
		} else {
			$this->load->view('uasgrid');
		}
	}

	public function sales()
	{
		$start = $this->input->get('start');
		$end   = $this->input->get('end');

		$page    = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows    = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

		if (isset($start) && isset($end)) {
			$data = $this->uas_model->get_sales($start, $end);
		} else {
			$data = $this->uas_model->get_sales_filter($page, $rows, $keyword);
		}

		echo json_encode($data);
	}

	public function get_year()
	{
		$data = $this->uas_model->get_year();

		echo json_encode($data);
	}

	public function logout()
	{
		// destroy user session
		$this->session->unset_userdata('username');
		// redirect to home
		$this->index();
	}

	public function action_login()
	{
		$data   = $this->input->post();
		$record = $this->uas_model->get_user($data['username'], $data['password']);

		if (count($record) > 0) {
			$this->session->set_userdata('username', $data['username']);
			echo "valid";
		} else {
			echo "Your login credential is invalid";
		}
	}

	public function action_save($id = null)
	{
		$data = $this->input->post();

		if (isset($id)) {
			$data['id'] = $id;
		}

		$this->uas_model->save($data);
		$this->index();
	}

	public function action_delete($id)
	{
		$this->uas_model->delete($id);

		header('Content-Type: application/json');
		echo json_encode(['code' => 200]);
	}

	public function download_pdf()
	{
		$contacts = $this->uas_model->get_sales();

		$pdf = new FPDF();

		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(190, 7, 'Data Sales', 0, 1, 'C');
		$pdf->SetFont('Arial', 'I', 12);
		$pdf->Cell(190, 7, 'Generate data sales dari Database', 0, 1, 'C');
		$pdf->Cell(10, 7, '', 0, 1);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(60, 8, 'Year', 1, 0);
		$pdf->Cell(85, 8, 'Sales', 1, 0);
		$pdf->Cell(45, 8, 'Purchase', 1, 1);
		$pdf->SetFont('Arial', '', 10);

		foreach ($contacts as $index => $contact) {
			$pdf->Cell(60, 6, $contact->year, 1, 0);
			$pdf->Cell(85, 6, $contact->sales, 1, 0);
			$pdf->Cell(45, 6, $contact->purchase, 1, 1);
		}

		$pdf->output();
	}

	public function download_xls()
	{
		$contacts = $this->uas_model->get_sales();

		$xls = new PHPExcel();

		$xls->setActiveSheetIndex(0)
			->setCellValue('A1', 'Year')
			->setCellValue('B1', 'Sales')
			->setCellValue('C1', 'Purchase');

		foreach ($contacts as $index => $contact) {
			$xls->getActiveSheet()
				->setCellValue('A' . ((int) $index + 2), $contact->year)
				->setCellValue('B' . ((int) $index + 2), $contact->sales)
				->setCellValue('C' . ((int) $index + 2), $contact->purchase);
		}

		foreach (range('A', 'C') as $columnID) {
			$xls->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="data-sales.xlsx"');

		$writer = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
		$writer->save('php://output');
	}
}
