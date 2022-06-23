<?php
/**
 * 
 */
class simplify extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('hr', TRUE);
        $this->db3 = $this->load->database('cons', TRUE);
    }


    function populate_header_table($table_id,$header)
    {

       $html='
                <table id="'.$table_id.'" class="table table-striped table-bordered dataTable no-footer">
                    <thead>
                        <tr>';
                                for($a=0;$a<count($header);$a++)
                                {
                                    $html.='<th>'.$header[$a].'</th>';
                                }                    

       $html.='         </tr>
                    </thead>
                    <tbody> 
            ';

        return $html;    
    }


    function populate_table_rows($rows,$style)
    {
        $html='<tr>';
            for($b=0;$b<count($rows);$b++)
            {              
                $html.=' 
                         <td style="'.$style[$b].'">'.$rows[$b].'</td>    
                       ';  
            }
        $html.='</tr>';

        return $html;        
    }


    function get_employee_details($emp_id)
    {
        $query=$this->db3->query("
                                    SELECT 
                                           * 
                                    FROM
                                           pis.employee3
                                    WHERE
                                          emp_id='".$emp_id."'
                                ");
        return $query->result_array();

    }

    function custom_query($SELECT,$FROM,$INNER_JOIN,$WHERE,$ORDER_BY)
    {
        $query=$this->db2->query($SELECT.$FROM.$INNER_JOIN.$WHERE.$ORDER_BY);
        return $query->result_array();
    }

}    