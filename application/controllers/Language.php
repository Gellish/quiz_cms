<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {

    private $table  = "language";
    private $setting_table  = "setting";
    private $phrase = "phrase";

    public function __construct()
    {
        parent::__construct();  
        $this->load->database();
        $this->load->dbforge(); 
        $this->load->helper('language');
        $this->template->current_menu = 'Language';
    } 
    //Language/main page load here
    public function index()
    {
        $data=array(
            'title' =>'Add Language' , 
            'languages' =>$this->languages() ,
            );

        $content = $this->parser->parse('language/main',$data,true);
        $this->template->full_admin_html_view($content);
    }
    //Language change option
    public function change(){
        $this->template->current_menu = 'Language/change';
        $this->form_validation->set_rules('language','Change Language', 'required');

        $language = $this->input->post('language',true);

        if ($this->form_validation->run()) {
            $num_rows = $this->db->count_all($this->setting_table);
            if ($num_rows == 0) {
                $this->db->insert($this->setting_table, array('language', $language));
            } else {
                $this->db->set('language', $language)->update($this->setting_table);
            }
            $this->session->set_flashdata('message','Language change successfully!');
        }

        $data = array(
            'title' => 'Change Language', 
            'languages' =>  $this->languages(), 
            );
        $content = $this->parser->parse('language/change_language',$data,true);
        $this->template->full_admin_html_view($content);
    }
    //Phrase page load here
    public function phrase()
    {
        $data = array(
            'title' => 'Add Language Phrase', 
            'languages' =>  $this->languages(), 
            'phrases' =>  $this->phrases(), 
            );

        $content = $this->parser->parse('language/phrase',$data,true);
        $this->template->full_admin_html_view($content);


    }
    //All languages show here
    public function languages()
    { 
        if ($this->db->table_exists($this->table)) { 

                $fields = $this->db->field_data($this->table);

                $i = 1;
                foreach ($fields as $field)
                {  
                    if ($i++ > 2)
                    $result[$field->name] = ucfirst($field->name);
                }

                if (!empty($result)) return $result;

        } else {
            return false; 
        }
    }
    //Add languages here
    public function addLanguage()
    { 
        $language = preg_replace('/[^a-zA-Z0-9_]/', '', $this->input->post('language',true));
        $language = strtolower($language);

        if (!empty($language)) {
            if (!$this->db->field_exists($language, $this->table)) {
                $this->dbforge->add_column($this->table, [
                    $language => [
                        'type' => 'TEXT'
                    ]
                ]); 
                $this->session->set_flashdata('message', 'Language added successfully');
                redirect('language');
            } 
        } else {
            $this->session->set_flashdata('exception', 'Please try again');
        }
        redirect('language');
    }
    //Edit page here
    public function editPhrase($language = null)
    { 
        $data = array(
            'title' =>'Edit Phrase' , 
            'language' =>$language , 
            'phrases' =>$this->phrases() , 
            );

        $content = $this->parser->parse('language/phrase_edit',$data,true);
        $this->template->full_admin_html_view($content);

    }
    //Add phrase here
    public function addPhrase() {  

        $lang = $this->input->post('phrase'); 

        if (sizeof($lang) > 0) {

            if ($this->db->table_exists($this->table)) {

                if ($this->db->field_exists($this->phrase, $this->table)) {

                    foreach ($lang as $value) {

                        $value = preg_replace('/[^a-zA-Z0-9_]/', '', $value);
                        $value = strtolower($value);

                        if (!empty($value)) {
                            $num_rows = $this->db->get_where($this->table,[$this->phrase => $value])->num_rows();

                            if ($num_rows == 0) { 
                                $this->db->insert($this->table,[$this->phrase => $value]); 
                                $this->session->set_flashdata('message', 'Phrase added successfully');
                            } else {
                                $this->session->set_flashdata('exception', 'Phrase already exists!');
                            }
                        }   
                    }  

                    redirect('language/phrase');
                }  

            }
        } 

        $this->session->set_flashdata('exception', 'Please try again');
        redirect('language/phrase');
    }
    //Phrases access here
    public function phrases()
    {
        if ($this->db->table_exists($this->table)) {

            if ($this->db->field_exists($this->phrase, $this->table)) {

                return $this->db->order_by($this->phrase,'asc')
                    ->get($this->table)
                    ->result();

            }  

        } 

        return false;
    }
    //Add level here
    public function addLebel() { 
        $language = $this->input->post('language', true);
        $phrase   = $this->input->post('phrase', true);
        $lang     = $this->input->post('lang', true);

        if (!empty($language)) {

            if ($this->db->table_exists($this->table)) {

                if ($this->db->field_exists($language, $this->table)) {

                    if (sizeof($phrase) > 0)
                    for ($i = 0; $i < sizeof($phrase); $i++) {
                        $this->db->where($this->phrase, $phrase[$i])
                            ->set($language,$lang[$i])
                            ->update($this->table); 

                    }  
                    $this->session->set_flashdata('message', 'Label added successfully!');
                    redirect('language/editPhrase/'.$language);

                }  

            }
        } 

        $this->session->set_flashdata('exception', 'Please try again');
        redirect('language/editPhrase/'.$language);
    }
}



 