<?php
/**
 * @package     redSHOP
 * @subpackage  Controllers
 *
 * @copyright   Copyright (C) 2008 - 2012 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later, see LICENSE.
 */

defined('_JEXEC') or die('Restricted access');

require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'core' . DS . 'controller' . DS . 'default.php';

class orderreddesignController extends RedshopCoreControllerDefault
{
    public function cancel()
    {
        $this->setRedirect('index.php');
    }

    public function update_status()
    {
        $model = $this->getModel('orderreddesign');
        $model->update_status();
    }

    public function allstatus()
    {
        $model = $this->getModel('orderreddesign');
        $model->update_status_all();
    }

    public function export_data()
    {
        require_once(JPATH_COMPONENT . DS . 'helpers' . DS . 'order.php');

        $order_function = new order_functions();

        $model = $this->getModel('orderreddesign');

        $data = $model->export_data();

        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-type: text/x-csv");
        header("Content-type: text/csv");
        header("Content-type: application/csv");
        header('Content-Disposition: attachment; filename=Orderreddesign.csv');

        echo "Order id,Fullname,Order Status,Order Date,Total\n\n";

        for ($i = 0; $i < count($data); $i++)
        {
            echo $data[$i]->order_id . ",";
            echo $data[$i]->firstname . " " . $data[$i]->lastname . ",";

            echo $order_function->getOrderStatusTitle($data[$i]->order_status) . ",";
            echo date('d-m-Y H:i', $data[$i]->cdate) . ",";
            echo REDCURRENCY_SYMBOL . $data[$i]->order_total . "\n";
        }
        exit;
    }

    public function downloaddesign()
    {
        $filename = $this->input->get('filename');
        $type     = $this->input->get('type');

        if ($type == "pdf")
        {
            $filename = $filename . ".pdf";
            $file     = JPATH_ROOT . "/components/com_reddesign/assets/order/pdf/" . $filename;
            header("Content-Type: application/force-download");
        }

        else if ($type == "eps")
        {
            $filename = $filename . ".eps";
            $file     = JPATH_ROOT . "/components/com_reddesign/assets/order/eps/" . $filename;
            header("Content-Type: application/eps");
        }

        else if ($type == "original")
        {
            $filename = "bg_" . $filename . ".jpeg";
            $file     = JPATH_ROOT . "/components/com_reddesign/assets/order/eps/" . $filename;
            header('Content-Description: File Transfer');
            header('Content-Type: image/jpg');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

            header('Content-Length: ' . filesize($file));
        }

        else if ($type == "design")
        {
            $filename = $filename . ".jpeg";
            $file     = JPATH_ROOT . "/components/com_reddesign/assets/order/design/" . $filename;

            header('Content-Type: image/jpg');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

            header('Content-Length: ' . filesize($file));
        }
        flush(); // this doesn't really matter.
        ob_start();
        readfile($file);

        exit;
    }
}
