<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Ltbatch {
	// Retrieve  Batch List 
	public function batch_list()
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Batches');
		$batch_data = $CI->Batches->retrieve_batch_list();

		if(!empty($batch_data)){
			foreach ($batch_data as $key => $rows) {
				$student_ids = json_decode($rows['student_ids'],true);
				foreach ($student_ids as $index=>$val) {
					$final_ids[] = $val;
				}
				$batch_data[$key]['no_of_student'] = count($final_ids);
			}
		}

		$data = array(
				'title' => 'Batch List',
				'batch_list' => $batch_data
			);
		$batchList = $CI->parser->parse('tutor_view/batch/batch',$data,true);
		return $batchList;
	}
	public function insert_batch($data)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Batches');
        $CI->Batches->insert_batch($data);
		return true;
	}
	// batch_edit_data
	public function batch_edit_data($batch_id)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Batches');		
		$batch_list = $CI->Batches->retrieve_batch_editdata($batch_id);
		$data = array(
				'batch_id' => $batch_list[0]['batch_id'],
				'batch_name' => $batch_list[0]['batch_name']
			);
		$quizeList = $CI->parser->parse('tutor_view/batch/edit_batch_form',$data,true);
		return $quizeList;
	}
}
?>