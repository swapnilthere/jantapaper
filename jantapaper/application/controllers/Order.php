<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $admin = $this->session->userdata('admin');
        if (empty($admin)) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {

        $admin = $this->session->userdata('admin');
        $this->load->model('Global_model');


        $categories = $this->Global_model->executeCustomQuery("select products.`id`,products.conversion, material_type.material as material_type, b.material as mat_sub_type, products.`location`, products.`gsm`,products.`weight`, products.`sku`, products.`quantity`, products.`unit`,products.`width`, products.`height`, products.`brand` from products,material_type,material_type b where products.`material_type`=material_type.id and products.`mat_sub_type`=b.id and products.`quantity`>0");

        $data['mainModule'] = 'place_order';
        $data['subModule'] = 'viewPlaceorder';

        $data['categories'] = $categories;
        $data['client'] = $this->Global_model->getData('client');
        $this->load->view('admin/order/list.php', $data);
    }
    public function fetchAddress($custId)
    {
        $this->load->model('Global_model');
        $customerData = $this->Global_model->executeCustomQuery("select client.* from client where client.id=$custId limit 1");
        die(json_encode($customerData[0]));
    }
    public function cart()
    {
        $admin = $this->session->userdata('admin');
        $this->load->model('Global_model');
        //$categories = $this->Global_model->executeCustomQuery("select products.`id`, material_type.material as material_type, b.material as mat_sub_type, products.`location`, products.`gsm`, products.`sku`, products.`quantity`, products.`unit`,products.`width`, products.`height`, products.`brand` from products,material_type,material_type b where products.`material_type`=material_type.id and products.`mat_sub_type`=b.id");

        //$cartData = $this->Global_model->executeCustomQuery("select products.`id`, material_type.material as material_type, b.material as mat_sub_type, products.`location`, products.`gsm`, products.`sku`, products.`quantity`, products.`unit`,products.`width`, products.`height`, products.`brand` from products,material_type,material_type b where products.`material_type`=material_type.id and products.`mat_sub_type`=b.id");
        $cartData = $this->Global_model->executeCustomQuery("select user_cart.*,client.client_name,products.unit,products.gsm,products.brand,products.location,material_type.material as material_type,b.material as mat_sub_type from  user_cart,client,products,material_type,material_type b  where user_cart.selectedCustomer=client.id and products.id=user_cart.productId and products.`material_type`=material_type.id and products.`mat_sub_type`=b.id order by selectedCustomer");

        $data['cartData'] = $cartData;

        $this->load->view('admin/cart/cart.php', $data);
    }

    public function removeItemFromCart($recId)
    {
        $this->load->model('Global_model');

        $cartItem = $this->Global_model->executeCustomQuery("select user_cart.* from user_cart where id=$recId limit 1");
        print_r($cartItem);
        if (!empty($cartItem)) {
            $this->Global_model->deleteCustomQuery("delete from  user_cart where  id=$recId");
        }


        $this->session->set_flashdata('msg', 'Item removed from cart');
        redirect(base_url('cart'));
    }

    public function placeOrder($customerId = 0)
    {
        $this->load->model('Global_model');

        $products = $this->Global_model->executeCustomQuery("select user_cart.*,products.brand,products.location,material_type.material as material_type,b.material as mat_sub_type from  user_cart,products,material_type,material_type b  where  products.id=user_cart.productId and products.`material_type`=material_type.id and products.`mat_sub_type`=b.id and selectedCustomer=$customerId order by selectedCustomer");

        // $products = $this->Global_model->getData('user_cart',  "selectedCustomer=$customerId");

        $data['mainModule'] = 'order';
        $data['subModule'] = 'placeOrder';
        $data['products'] = $products;
        // $data['customerId'] = $customerId;
        $data['customerInfo'] = $this->Global_model->getData('client',  "id=$customerId");
        $this->load->library('form_validation');

        //$this->form_validation->set_rules('invoice_number', 'Invoice Number', 'trim|required');

        // $this->form_validation->set_rules('bhd', 'BHD', 'trim|required');

        // $this->form_validation->set_rules('transportation_charges', 'Transportation Charges', 'trim|required');

        // $this->form_validation->set_rules('vehicle_num', 'Vehicle Number', 'trim|required');
        // print_r($_POST);
        //$this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');


        if (isset($_POST['submit'])) {
            // if ($this->form_validation->run() == TRUE) {

            $formArray['status'] = 'Pending'; //$this->input->post('name');

            $formArray['date'] = date("Y-m-d H:i:s"); //$this->input->post('qtype');

            $formArray['client_id'] = $customerId; //$this->input->post('unit');
            $formArray['invoice_number'] = ''; //$this->input->post('invoice_number');
            $formArray['bhd'] = ''; //$this->input->post('bhd');
            $formArray['transportation_charges'] = ''; //$this->input->post('transportation_charges');
            $formArray['vehicle_num'] = ''; //$this->input->post('vehicle_num');
            //print_r($products);
            $formArray['address'] = @$products[0]['address'];

            $this->Global_model->create('orders', $formArray);

            $orderId = $this->db->insert_id();
            $order = "Thanks for your order, we will notify you once your order is taken up for processing";

            for ($i = 0; $i < count($products); $i++) {

                $prodData = array('order_id' => $orderId, 'conversion' => $products[$i]['conversion'], 'height_inch' => $products[$i]['height_inch'], 'width_inch' => $products[$i]['width_inch'], 'quantity' => $products[$i]['quantity'], 'product_id' => $products[$i]['productId']);
                $this->Global_model->create('order_details', $prodData);


                //get single record
                $prod = $this->Global_model->getDataById('products', $products[$i]['productId']);
                $prod['quantity'] = $prod['quantity'] - $products[$i]['quantity'];
                $this->Global_model->update('products', $products[$i]['productId'], $prod);
                if ($products[$i]['req_customization'] == 1)
                    $order = "Thanks for your order, we will notify you once your order is taken up for processing";
                //products
            }


            //insert this data into order & order details

            $this->Global_model->deleteCustomQuery("delete from  user_cart where  selectedCustomer=$customerId");


            print "<script>alert('$order');window.location='" . base_url('view_order') . "';</script>";
            die();
            //redirect(base_url('view_order'));
        }
        //       $category = $this->Category_model->getCategory($id);
        //orders
        //$cartData = $this->Global_model->executeCustomQuery("select user_cart.*,client.client_name,products.brand,products.location,material_type.material as material_type,b.material as mat_sub_type from  user_cart,client,products,material_type,material_type b  where user_cart.selectedCustomer=client.id and products.id=user_cart.productId and products.`material_type`=material_type.id and products.`mat_sub_type`=b.id order by selectedCustomer");
        $this->load->view('admin/order/placeOrder.php', $data);
    }

    public function viewOrders()
    {
        $admin = $this->session->userdata('admin');

        $this->load->model('Global_model');

        $where = '';
        if ($admin['userType'] == 'user')
            $where = ' and orders.client_id=' . $admin['admin_id'];

        $orders = $this->Global_model->executeCustomQuery("select orders.id,orders.status,orders.date,orders.invoice_number,orders.bhd,orders.transportation_charges,client.client_name from orders,client where orders.client_id=client.id $where order by orders.id desc");


        $data['mainModule'] = 'orders';
        $data['subModule'] = 'viewOrders';
        $data['orders'] = $orders;

        $data['categories'] = []; //$categories;
        $data['client'] = $this->Global_model->getData('client');
        $this->load->view('admin/order/order_list.php', $data);
    }
    public function orderDetails($orderId = "")
    {
        $admin = $this->session->userdata('admin');
        $this->load->model('Global_model');
        if (isset($_POST['order_submit'])) {
            $id = $orderId;
            if ($_POST['oStatus'] == "Received") {
                $updateArray = array('status' => $_POST['oStatus'], 'invoice_number' => 'NA', 'bhd' => 'NA', 'transportation_charges' => 'NA', 'vehicle_num' => 'NA');
            } else if ($_POST['oStatus'] == "Cancelled") {
                $updateArray = array('status' => $_POST['oStatus'], 'invoice_number' => 'NA', 'bhd' => 'NA', 'transportation_charges' => 'NA', 'vehicle_num' => 'NA');

                $orders = $this->Global_model->executeCustomQuery("SELECT * from order_details where order_id=$id");
                //add these products to quantity
                for ($i = 0; $i < count($orders); $i++) {

                    $producId = $orders[$i]['product_id'];
                    $quantity = $orders[$i]['quantity'];


                    //get single record
                    $prod = $this->Global_model->getDataById('products', $producId);
                    $prod['quantity'] = $prod['quantity'] + $quantity;
                    $this->Global_model->update('products', $producId, $prod);

                    //products
                }
            } else
                $updateArray = array('status' => $_POST['oStatus'], 'invoice_number' => $_POST['invoice_number'], 'bhd' => $_POST['bhd'], 'transportation_charges' => $_POST['transportation_charges'], 'vehicle_num' => $_POST['vehicle_num']);
            $this->Global_model->update('orders', $id, $updateArray);
            //update
            print "<script>alert('Order status updated');window.location='" . base_url('order_details') . "/$orderId';</script>";

            die();
        }
        $orders = $this->Global_model->executeCustomQuery("SELECT order_details.conversion,order_details.height_inch, order_details.width_inch,order_details.quantity,material_type.material,b.material AS products_material_type,products.mat_sub_type, products.sku, products.`brand`, products.`unit`,products.`weight`,products.`gsm` FROM order_details JOIN products ON products.id = order_details.product_id JOIN material_type ON material_type.id = products.material_type JOIN material_type b ON b.id = products.mat_sub_type WHERE  order_id = $orderId");

        $categories = $this->Global_model->executeCustomQuery("select products.`id`, material_type.material as material_type, b.material as mat_sub_type, products.`location`, products.`gsm`, products.`sku`, products.`quantity`, products.`unit`,products.`width`, products.`height`, products.`brand` from products,material_type,material_type b where products.`material_type`=material_type.id and products.`mat_sub_type`=b.id");
        $orderStatus = $this->Global_model->executeCustomQuery("SELECT * from orders where id=$orderId");

        $data['orderStatus'] = $orderStatus;
        $data['orders'] = $orders;
        $data['orderId'] = $orderId;
        $data['categories'] = $categories;
        $data['client'] = $this->Global_model->getData('client');
        $this->load->view('admin/order/order_details.php', $data);
    }

    public function generateDeliveryChalan($id)
    {
        $this->load->model('Global_model');
        $this->load->library('pdf');


        $orders = $this->Global_model->executeCustomQuery("select orders.id,orders.vehicle_num,orders.status,orders.date,orders.invoice_number,orders.bhd,orders.transportation_charges,client.client_name,orders.address from orders,client where orders.client_id=client.id and orders.id=$id ");

        $orderDetails = $this->Global_model->executeCustomQuery("SELECT order_details.conversion,order_details.height_inch, order_details.width_inch,order_details.quantity,material_type.material,b.material AS products_material_type,products.mat_sub_type,products.unit, products.sku,products.gsm FROM order_details JOIN products ON products.id = order_details.product_id JOIN material_type ON material_type.id = products.material_type JOIN material_type b ON b.id = products.mat_sub_type WHERE order_id = $id");

        //print_r($orders);
        //print_r($orderDetails);
        $date = date('Y-m-d', strtotime($orders[0]['date']));
        $invoice_num = $orders[0]['invoice_number'];
        $bhdNumber =  $orders[0]['bhd'];
        $vehicle_num = $orders[0]['vehicle_num'];
        $i_transport_charges = $orders[0]['transportation_charges'];
        $partyName = $orders[0]['client_name'];
        $address = $orders[0]['address'];

        // $quantity = $_REQUEST['quantity'];
        // $i_weight_per_package = $_REQUEST['i_weight_per_package'];
        // $width = $_REQUEST['width'];
        // $height = $_REQUEST['height'];
        // $quality = $_REQUEST['quality'];
        // $gsm = $_REQUEST['gsm'];

        //$_REQUEST['i_invoice_num'];


        // $data = array(
        //     array($quantity, $quality, "$width x $height", $gsm, $i_weight_per_package, $i_weight_per_package * $quantity . "kg")
        // );
        $data = [];
        for ($i = 0; $i < count($orderDetails); $i++) {
            // 
            //$weight = $orderDetails[$i]['width_inch'] * $orderDetails[$i]['height_inch'] * $orderDetails[$i]['gsm'] / 1000;
            //$weight = number_format(($orderDetails[$i]['width_inch'] * $orderDetails[$i]['height_inch'] * $orderDetails[$i]['gsm'] * 0.00064516258) / 10, 2);
            $weight = ($orderDetails[$i]['width_inch'] * $orderDetails[$i]['height_inch'] * $orderDetails[$i]['gsm'] * 0.000000645161290322581);
            $w = $orderDetails[$i]['width_inch'];
            $h = $orderDetails[$i]['height_inch'];
            if ($orderDetails[$i]['conversion'] == 1) {
                $w = number_format($w * 2.54, 2);
                $h = number_format($h * 2.54, 2);
            }
            $data[] = array(
                $orderDetails[$i]['quantity'], $orderDetails[$i]['unit'], $orderDetails[$i]['material'] . ' ' . $orderDetails[$i]['products_material_type'],

                $w . " x " . $h, $orderDetails[$i]['gsm'], number_format($weight, 2), number_format($weight * $orderDetails[$i]['quantity'] * $orderDetails[$i]['unit']) . " kg"
            );
        }

        $header = array('Quantity', 'Units', 'Particulars', 'Size', 'GSM', 'Weight', 'Total');


        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 6, 'On Approval Memo', 0, 1, 'C');

        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(0, 8, 'Janta Paper Mart', 0, 1, 'C');



        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, 'GST NO. : 27AABFJ0595J1Z7', 0, 1, 'C');


        $pdf->SetFont('Arial', 'B', 8);

        $pdf->Cell(12, 15, 'BHD No.', 0, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(70, 15, $bhdNumber, 0, 0);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(16, 15, 'Invoice No.', 0, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(70, 15, $invoice_num, 0, 0);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(12, 15, 'Date :', 0, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(18, 15, $date, 0, 1);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(20, 6, 'To,', 0, 0);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(6, 10, 'M/S', 0, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 10, $partyName, 0, 1);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(15, 10, 'Address', 0, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(20, 10, $address, 0, 1);

        $pdf->SetFont('Arial', 'B', 6);
        $pdf->Cell(0, 4, 'GST NO. : Please receive the following goods in good order & condition on aproval basis', 0, 1, 'C');


        foreach ($header as $col)
            $pdf->Cell(25, 7, $col, 1);
        $pdf->Ln();
        // Data
        $pdf->SetFont('Arial', '', 6);
        foreach ($data as $row) {
            foreach ($row as $col)
                $pdf->Cell(25, 6, $col, 1);
            $pdf->Ln();
        }

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(22, 6, 'Pay Cartage Rs.');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(30, 6, $i_transport_charges);

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(16, 6, 'Vehicle No: ');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(40, 6, $vehicle_num);
        $pdf->Ln();
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(10, 4, 'Note:');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(10, 4, ' Please approve Material within 3 days of delivery. After 3 days it will be treated as approved and same shall be billed to you.', 0, 1);
        $pdf->Cell(10, 4, '');
        $pdf->Cell(10, 4, ' No complaint will be entertained after that. GST as applicable.', 0, 1);

        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(0, 8, "Receiver's Signature", 0, 1, 'R');
        $pdf->Output('I', 'Delivery Chalan.pdf');
    }

    public function addToCart()
    {
        $this->load->model('Global_model');
        //check if cart contains same data of product
        $selectedCustomer = $_REQUEST['selectedCustomer'];
        $height_inch = $_REQUEST['height_inch'];
        $width_inch = $_REQUEST['width_inch'];
        $address = $_REQUEST['address'];
        $conversion = $_REQUEST['conversion'];

        $data = $this->Global_model->getData('user_cart',  "selectedCustomer=$selectedCustomer and height_inch='$height_inch' and width_inch='$width_inch'");
        //print_r($data);
        if ($conversion == 1) {
            //conver this cms to inches
            $_REQUEST['height_inch'] = number_format($_REQUEST['height_inch'] / 2.54, 2);
            $_REQUEST['width_inch'] = number_format($_REQUEST['width_inch'] / 2.54, 2);
        }
        $this->Global_model->create('user_cart',  $_REQUEST);

        $data = $this->Global_model->getData('user_cart');
        print json_encode(array('badge' => count($data)));
        exit;
    }
}
