<?php
/**
*/
class update_model extends CI_Model{
// Function To Fetch All Students Record
function show_students(){
$query = $this->db->get('students');
$query_result = $query->result();
return $query_result;
}
// Function To Fetch Selected Student Record
function show_student_id($data){
$this->db->select('*');
$this->db->from('students');
$this->db->where('student_id', $data);
$query = $this->db->get();
$result = $query->result();
return $result;
}
// Update Query For Selected Student
function update_student_id1($id,$data){
$this->db->where('student_id', $id);
$this->db->update('students', $data);
}
}
?>