<?php
  
  /**
	 * @author entol
	 * @see more  http://www.entol.net
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */  
function nice_input($value, $field, $primary_key, $list, $xcrud)
{
	return $value.' - test';
}


function my_functions($xcrud){
	$myvalue = $xcrud->get('kode_kustomer'); // data-myvalue attr.
	// some manipulations
	$postdata->set('kode_kustomer', $myvalue );
	// die($myvalue);
	// $xcrud->set_exception('password','Your password is too simple.');
} 

function publish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE message SET `bool` = b\'1\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function unpublish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE message SET `bool` = b\'0\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function exception_example($postdata, $primary, $xcrud)
{
    $xcrud->set_exception('ban_reason', 'Lol!', 'error');
    $postdata->set('ban_reason', 'lalala');
}

function test_column_callback($value, $fieldname, $primary, $row, $xcrud)
{
    return $value . ' - nice!';
}

function after_upload_example($field, $file_name, $file_path, $params, $xcrud)
{
    $ext = trim(strtolower(strrchr($file_name, '.')), '.');
    if ($ext != 'pdf' && $field == 'uploads.simple_upload')
    {
        unlink($file_path);
        $xcrud->set_exception('simple_upload', 'This is not PDF', 'error');
    }
}

function date_example($postdata, $primary, $xcrud)
{
    $created = $postdata->get('datetime')->as_datetime();
    $postdata->set('datetime', $created);
}

function movetop($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `officeCode` FROM `offices` ORDER BY `ordering`,`officeCode`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['officeCode'] == $primary && $key != 0)
            {
                array_splice($result, $key - 1, 0, array($item));
                unset($result[$key + 1]);
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `offices` SET `ordering` = ' . $key . ' WHERE officeCode = ' . $item['officeCode'];
            $db->query($query);
        }
    }
}
function movebottom($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `officeCode` FROM `offices` ORDER BY `ordering`,`officeCode`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['officeCode'] == $primary && $key != $count - 1)
            {
                unset($result[$key]);
                array_splice($result, $key + 1, 0, array($item));
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `offices` SET `ordering` = ' . $key . ' WHERE officeCode = ' . $item['officeCode'];
            $db->query($query);
        }
    }
}
// function open_dn($xcrud)
// {
    // if ($xcrud->get('primary'))
    // {
        // $db = Xcrud_db::get_instance();
        // $query = 'UPDATE trans_transaksi_invoice_detail_dn a
									// SET a.status = "Open", a.total = 0
									// WHERE a.nid = ' . (int)$xcrud->get('primary');
        // $query2 = 'UPDATE trans_transaksi_dn_header_new a
									// SET a.status_surat_jalan = "Open"
									// WHERE a.no_surat_jalan = (select b.no_surat_jalan from trans_transaksi_invoice_detail_dn b
										// WHERE b.nid = ' . (int)$xcrud->get('primary') . ')';
        // $db->query($query);
        // $db->query($query2);
    // }
// }
// function close_dn($xcrud)
// {
    // if ($xcrud->get('primary'))
    // {
        // $db = Xcrud_db::get_instance();
        // $query = 'UPDATE trans_transaksi_invoice_detail_dn a
									// SET a.status = "Close1", a.total = 
															// (SELECT b.total 
																	// FROM trans_transaksi_dn_detail_new b 
																	// WHERE b.no_surat_jalan = a.no_surat_jalan)
									// WHERE a.nid = ' . (int)$xcrud->get('primary');
        // $query2 = 'UPDATE trans_transaksi_dn_header_new a
									// SET a.status_surat_jalan = "Close1"
									// WHERE a.no_surat_jalan = (select b.no_surat_jalan from trans_transaksi_invoice_detail_dn b
										// WHERE b.nid = ' . (int)$xcrud->get('primary') . ')';
        // $db->query($query);
        // $db->query($query2);
    // }
// }
function open_dns($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE trans_transaksi_invoices_detail_dn a
									SET a.status = "Open", a.total = 0
									WHERE a.nid = ' . (int)$xcrud->get('primary');
        $query2 = 'UPDATE trans_transaksi_dn_detail_new a
									SET a.status_surat_jalan = "Open"
									WHERE a.no_surat_jalan = (select b.no_surat_jalan from trans_transaksi_invoice_detail_dn b
										WHERE b.nid = ' . (int)$xcrud->get('primary') . ')';
        $db->query($query);
        $db->query($query2);
    }
}
function close_dns($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE trans_transaksi_invoices_detail_dn a
									SET a.status = "Proses Penagihan", a.total = 
															(SELECT sum(b.total) 
																	FROM trans_transaksi_dn_detail_new b 
																	WHERE b.no_surat_jalan = a.no_surat_jalan)
									WHERE a.nid = ' . (int)$xcrud->get('primary');
        $query2 = 'UPDATE trans_transaksi_dn_detail_new a
									SET a.status_surat_jalan = "Proses Penagihan"
									WHERE a.no_surat_jalan = (select b.no_surat_jalan from trans_transaksi_invoices_detail_dn b
										WHERE b.nid = ' . (int)$xcrud->get('primary') . ')';
        $db->query($query);
        $db->query($query2);
    }
}
function update_balance($postdata,$xcrud)
{
	Xcrud_config::$dbname = 'bcspurchase_2015';
	Xcrud_config::$dbuser = 'root';
	Xcrud_config::$dbpass = '';
	Xcrud_config::$dbhost = 'localhost';
	$db = Xcrud_db::get_instance();
	//$db->query("INSERT INTO test(test) values ('".$postdata->get('po_item_id')."')");
	$qty_lpb = $postdata->get('qty');
	$po_item_id = $postdata->get('po_item_id');
	$unit = $postdata->get('unit');

	$a = 'select po_item.qty from po_item where po_item_id="'.$po_item_id.'"'; 
	$db->query($a);
	$qty_po = $db->row()['qty'];
	$balance =($qty_po -$qty_lpb);
	$query = $db->query("UPDATE po_item SET lpb_balance ='".$balance."' WHERE po_item_id ='".$po_item_id."'");			
	$db->query($query);
				
}
	function make_new_row_last($postdata,$primary){
    $db = Xcrud_db::get_instance();
    $q = 'SELECT COUNT(*) as num FROM your_table';
    $db->query($q);
    $num = $db->row()['num'];
    $q = 'UPDATE your_table SET ordering = ' . $db->quote($num) . ' WHERE id = ' . $db->quote($primary);
    $db->query($q);
}
				
?>