<?php include 'admin/helper/dbconnect.php' ?>
<?php
session_start();

include 'php_helper.php';

use Razorpay\Api\Api;

require('razorpay/Razorpay.php');
require('payment_config.php');



$response = [];
if (isset($_POST['isset_payment'])) {

    $orderid = $_SESSION['order_id'];

    $sql = "SELECT * FROM order_data WHERE order_id = '$orderid'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $contact = $row['contact'];
            $email = $row['email'];
            $name = $row['name'];
            $amount = $_SESSION['payable_amount'];
        }
        $api = new Api($keyId, $secretKey);
        $orderData = [

            'amount'          => $amount * 100, // 39900 rupees in paise
            'currency'        => 'INR'
        ];

        $razorpayOrder = $api->order->create($orderData);

        $response['status'] = true;
        $response['message'] = 'order id generated';

        // print_r($razorpayOrder);
        $paymentData = [
            "key"               => $keyId,
            "currency"          => $orderData['currency'],
            "amount"            => $orderData['amount'],
            "name"              => "developeruzair.com",
            "image"             => "https://images.unsplash.com/photo-1611488006001-eb993d4d2ec4?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            "confirm_close" => true,
            "prefill"           => [
                "name"              => $name,
                "email"             => $email,
                "contact"           => $contact,
            ],
            "theme"             => [
                "color"             => "#00234d"
            ],
            "order_id"          => $razorpayOrder['id'],
            "callback_url"      => "payment_success.php"
        ];
        echo json_encode($paymentData);
    }
}

if (isset($_POST['isset_order_confirm'])) {
    // $cart =   $_SESSION['cart'];
    
    $order_id = $_SESSION['order_id'];
    $totalAmnt = $_SESSION['payable_amount'];
    $method = $_POST['payment_method'];
    $src = $_POST['src'];
    // $orderid = $_SESSION['order_id'];

    $sql = "SELECT * FROM order_data WHERE order_id = '$order_id'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $contact = $row['contact'];
            $email = $row['email'];
            $name = $row['name'];
            $address = $row['address'];
            $amount = $_SESSION['payable_amount'];
            $cartData = json_encode($_SESSION['cart']);
            $sql1 = "UPDATE order_data SET product_detail = '$cartData', shipping_method = '$method', order_status = 'order complete', total_price = '$totalAmnt', payment_status = 'payment complete' where order_id = '$order_id'";
            $result1 = mysqli_query($conn, $sql1);
            if ($result1) {
                $fetch = "SELECT * FROM order_data WHERE order_id = $order_id";
                $result_fetch = mysqli_query($conn, $fetch);
                if (mysqli_num_rows($result_fetch) > 0) {
                    $row = mysqli_fetch_assoc($result_fetch);
                }
                $prod_detail = json_decode($row['product_detail'], true);
                $prod_detail =  array_values($prod_detail);

                $product_li = '';

                foreach ($prod_detail as $prod => $data) {
                    $pName =  $data['name'];
                    $pQuantity =  $data['quantity'];
                    $pPrice =  $data['price'];


                    $product_li .= "
                    <li style='float:left;width:100%;border:none;margin:0;padding:0;margin-top:12px;height:19px;font-size:16px;font-weight:normal;font-stretch:normal;font-style:normal;line-height:normal;letter-spacing:0.29px;color:#282c3f'>
                    
                    <span style='font-family:sans-serif;font-weight:bold'>$pName</span>
                    </li>
                    <li style='float:left;width:100%;border:none;margin:0;padding:0;margin-top:12px;height:19px;font-size:16px;font-weight:normal;font-stretch:normal;font-style:normal;line-height:normal;letter-spacing:0.29px;color:#282c3f'>
                    
                    Qty <span style='font-family:sans-serif;font-weight:bold'>$pQuantity</span>
                    </li>
                    <li style='float:left;width:100%;border:none;margin:0;padding:0;margin-top:12px;height:19px;font-size:16px;font-weight:normal;font-stretch:normal;font-style:normal;line-height:normal;letter-spacing:0.29px;color:#282c3f'>
                    
                    Qty <span style='font-family:sans-serif;font-weight:bold'>$pPrice</span>
                    </li>
                    ";
                }

                $body = "<table>
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Contact</td>
                        <td>Address</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$name</td>
                        <td>$email</td>
                        <td>$contact</td>
                        <td>$address</td>
                    </tr>
                </tbody>
            </table>";

                $message = "
                    <table width='100%' style='width:100%'>
                    <tbody>
                    <tr style='margin:0;padding:0'>
                    <td style='padding:0;float:none;margin:0 auto;width:100%' width='100%'>
                    <table style='float:none;margin:0 auto;width:100%' width='100%'>
                    <tbody>
                    <tr>
                    <td>
                    <table style='text-align:center;width:100%'>
                    <tbody>
                    
                    <tr>
                    <td>
                    <div
                    style='font-size:30px;font-family:sans-serif;margin-top:20px;color:#282c3f;font-stretch:normal;font-style:normal;line-height:normal;letter-spacing:normal'>
                    Hello
                    <span
                    id='m_2366383160850774210m_-1319292045817622686ReceiverName'
                    style='font-weight:bold'>$name!</span>
                    </div>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </td>
                    </tr>
                    <tr style='margin:0;padding:0'>
                    <td style='margin:0;padding:0px 40px 20px 40px;margin-top:20px;width:calc(100% - (40px*2))'
                    width='calc(100% - (40*2))'>
                    <table style='border-collapse:collapse;border-spacing:0px;margin-top:20px;width:100%'>
                    <tbody>
                    <tr style='margin:0;padding:0'>
                    <td style='margin:0;padding:0;border-spacing:0'>
                    <table style='border-collapse:collapse;border-spacing:0px;margin:0 auto' width='100%'>
                    <tbody>
                    <tr style='margin:0;padding:0'>
                    <td width='calc(100% - (30*2))' style='margin:0;padding:30px;width:calc(100% - (30px*2));padding-top:20px;background-color:#03a685;color:white' bgcolor='#03a685'>
                    <table style='border-collapse:collapse' width='100%'>
                    <tbody>
                    <tr style='margin:0;padding:0'>
                    <td valign='top' style='margin:0;padding:0'>
                    <div style='margin:0;padding-top:5px;width:30px;margin-right:20px'>
                    <img style='width:30px;object-fit:contain' src='https://ci3.googleusercontent.com/meips/ADKq_NbB8xyb_XH31SLWtjHorrVGo6LtRIeDTlFVmnDZ33weVngcIxRRQTgIi8vYp_LLXwcLlS11oMxkFDWBjufwBRB7f2qg3aXtFpS09f_IkB6sOIyFVgpf6CyxURSIZvvdjsJsIHN9SV_9vmcwZAdQV6-bAOmlQ8cTrNReMD0FoFp93x1nI19CFMoSvrsm8msumTAPvIWfmzpTTXtkEcQACFw=s0-d-e1-ft#http://assets.myntassets.com/assets/images/retaillabs/2020/2/10/3d5e9899-76a9-4e38-abf5-6c43e04691481581334473847-ic_rad_chk_white-3x.png' class='CToWUd'
                    data-bit='iit'>
                    </div>
                    </td>
                    <td valign='top'
                    style='margin:0;padding:0'>
                    <table
                    style='border-collapse:collapse'
                    width='100%'>
                    <tbody>
                    <tr
                    style='margin:0;padding:0'>
                    <td style='padding:0% 3% 0% 0%'
                    colspan='2'>
                
                    
                    
                    <p
                    style='margin:0;font-family:sans-serif;color:white;padding:0;float:left;width:100%;font-size:30px;line-height:normal'>
                                                                                                                        Your Order is currently being
                                                                                                                        
                                                                                                                        <strong
                                                                                                                            style='font-family:sans-serif;letter-spacing:0.5px;font-weight:bold'>Processed
                                                                                                                            </strong>
                                                                                                                    </p>
                                                                                                                    </td>
                                                                                                                    </tr>
                                                                                                                    <tr
                                                                                                                    style='margin:0;padding:0'>
                                                                                                                    <td style='padding:0% 3% 0% 0%'
                                                                                                                    colspan='2'>
                                                                                                                    <p
                                                                                                                        style='line-height:1.38;padding:0;float:left;width:100%;font-size:16px;opacity:0.9;font-family:sans-serif;margin-top:10px'>
                                                                                                                        Thank You for shopping with us.
                                                                                                                    </p>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                    </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    </td>
                                                                            </tr>
                                                                            <tr style='margin:0;padding:0'>
                                                                                <td style='margin:0;padding:0' width='calc(100% - 2px)'>
                                                                                    <table
                                                                                    style='border-collapse:collapse;border:1px solid rgba(40,44,63,0.15);border-top:0'
                                                                                    width='100%'>
                                                                                    <tbody>
                                                                                    <tr style='margin:0;padding:0'>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr style='height:16px'></tr>
                                                                            <tr>
                                                                                <td align='center' valign='top' style='font-size:0'>
                                                                                    <table
                                                                                        style='background:#f5f5f6;border-radius:4px;width:100%'
                                                                                        border='0' cellpadding='0' cellspacing='0'
                                                                                        role='presentation' width='100%'>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td valign='top'
                                                                                                    style='width:46%;padding:2% 2% 2% 2%'>
                                                                                                    <table style='width:100%'>
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                            <td
                                                                                                            style='padding-left:7%;border-right:1px solid #bfc0c6;line-height:20px'>
                                                                                                            <ul
                                                                                                            style='padding:0;margin:0;list-style:none;font-size:16px'>
                                                                                                            <li
                                                                                                            style='color:#94969f;font-size:13px;letter-spacing:0.39px;font-family:,sans-serif;padding-bottom:7px'>
                                                                                                            Total
                                                                                                            Payable
                                                                                                            </li>
                                                                                                            <li style='color:#3e4152;font-size:22px;letter-spacing:0px;font-family:,sans-serif;padding-bottom:7px'>
                                                                                                            <strong id='m_2366383160850774210m_-1319292045817622686TotalAmountValueId'>
                                                                                                                               Rs.$totalAmnt
                                                                                                                            </strong>
                                                                                                                        </li>
                
                                                                                                                    </ul>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                
                
                
                
                                                                                                <td valign='top'
                                                                                                    style='padding:2% 2% 2% 0%;line-height:24px'>
                                                                                                    <table
                                                                                                    style='width:100%;padding:0;margin:0;list-style:none;font-size:16px'>
                                                                                                    
                                                                                                    <tbody>
                                                                                                    <tr>
                                                                                                    <td colspan='2' ='color:#94969f;font-size:13px;letter-spacing:0.39px;font-family:sans-serif'>Payment mode</td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td valign='top'
                                                                                                                    style='width:17%'>
                                                                                                                    <span style='float:left;margin-right:9px;margin-top:1px'>
                
                                                                                                                        <img width='50' src='https://ci3.googleusercontent.com/meips/ADKq_NbzfDBfdLeCSyY_QLcjF1b2Y0YfGzXIwdSuE32HrS0YpOS-Sc2uZ2iubPbA40GeLH40e6xY4Blh9gnFRBNbysyn8QXfWL9e4z9OFbwONlCj9ulYNvf6BEo=s0-d-e1-ft#https://myntracrm.myntassets.com/crm-assets/email/icons/cod_3x.png' class='CToWUd' data-bit='iit'>
                                                                                                                    </span>
                                                                                                                </td>
                                                                                                                <td valign='top'
                                                                                                                    style='color:#3e4152;font-size:21px;font-weight:bold;letter-spacing:0px;font-family:sans-serif'>
                                                                                                                    <div
                                                                                                                        style='width:100%'>
                                                                                                                        <img src='$src' style='width: 100px;'>
                                                                                                                    </div>
                                                                                                                    
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    </td>
                                                                    </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                
                                            <tr style='margin:0;padding:0'>
                                                <td style='padding:0;float:none;margin:0 auto;width:100%' width='100%'>
                                                    <table style='float:none;margin:0 auto;width:100%' width='100%'>
                                                        <tbody>
                                                            <tr style='margin:0;padding:0'>
                                                                <td style='margin:0;padding:30px 40px 20px 40px;background-color:#f5f5f6!important;width:calc(100% - (40px*2));border-radius:8px'
                                                                width='calc(100% - (40*2))'>
                                                                    <table width='100%'>
                                                                        <tbody>
                                                                            <tr style='margin:0;padding:0'>
                                                                            <td style='border-bottom-left-radius:0px;border-bottom-right-radius:0px;border-top-left-radius:8px;border-top-right-radius:8px;padding:20px 30px 24px 30px;background-color:white;margin-top:20px;font-size:17px;line-height:23px;color:#7e818c;border:solid 0.5px rgba(190,147,71,0.11);margin:0;border-bottom:solid 0.5px #eaeaec'>
                                                                                    <ul style='margin:0;padding:0;float:left;width:100%;list-style:none;line-height:normal'>
                                                                                    <li style='margin:0;padding:0;float:left;width:100%'>
                                                                                    <p style='margin:0;float:left;width:100%;sans-serif;color:#282c3f;font-size:25px'>
                                                                                                Order Details
                                                                                                </p>
                                                                                        </li>
                                                                                        <ul style='margin-top:16px;padding:0;float:left;width:100%;list-style:none;line-height:normal'>
                                                                                        <li style='margin:0;padding:0;float:left;width:100%;font-size:13px;color:#94969f;letter-spacing:0.39px'>
                                                                                                Your Order Id 
                                                                                            </li>
                                                                                            <li style='padding:0;float:left;width:100%;font-size:18px;font-family:sans-serif;color:#282c3f;margin-top:4px;margin-left:0'
                                                                                                >$order_id</li>
                                                                                        </ul>
                                                                                        <ul style='margin:0;font-family:sans-serif;padding:0;display:flex;float:left;list-style:none;width:59%;color:#535766;'>         
                                                                                        $product_li
                                                                                            </ul>
                                                                                    </ul>
                                                                                </td>
                                                                            </tr>
                                
                                                                            <tr style='margin:0;padding:0'>
                                                                                <td style='margin:0;padding:0'>
                                                                                    <div>
                                                                                        <div style='display:table;margin:20px 0;width:100%'>
                                                                                        <div id='m_2366383160850774210m_-1319292045817622686AddressBlockId'
                                                                                                style='vertical-align:top;display:table-cell;width:100%;background-repeat:no-repeat;background-size:32px;background-position:right 16px top 16px;background-image:url();border:solid 0.5px rgba(190,147,71,0.11);border-radius:4px;background-color:#ffffff'>
                                                                                                <div style='margin:0;font-size:17px;line-height:23px;padding:20px 20px 20px 20px;color:#282c3f'>
                                                                                                <p style='margin:0;padding:0;width:100%;font-family:sans-serif;color:#282c3f;font-size:25px;margin-bottom:16px;font-weight:normal;font-stretch:normal;font-style:normal;line-height:normal;letter-spacing:normal'>
                                                                                                Delivering to</p>
                                                                                                <div
                                                                                                style='margin:0 0 0 0;padding:0 0 0 0;width:100%;font-family:sans-serif;font-size:16px;line-height:1.38;letter-spacing:0.29px;color:#7e818c;font-weight:normal;font-stretch:normal;font-style:normal'>
                                                                                                <span id='m_2366383160850774210m_-1319292045817622686ReceiverName'><strong
                                                                                                style='font-weight:bold;color:#3e4152'>$name</strong>,</span>
                                                                                                <span id='m_2366383160850774210m_-1319292045817622686AddressId'>N.B
                                                                                                $address</span>,
                                                                                                </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div style='width:calc(100% - 4px);margin:0 2px;border-bottom:1px solid #ddd'>
                                                                                        </div>
                                                                                        <div style='display:table;margin-top:20px;width:100%'>
                                                                                            <div style='background-color:transparent;width:0;padding:0 10px;display:table-cell'>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>";

                $order_mail =     sendOrdermail($email, "Your Order is confirmed", $message);
                $user_mail =     sendMail('uzairkhan7521@gmail.com', "Order Data", $body);
            }
            unset($_SESSION['cart']);
            unset($_SESSION['total_price']);
            unset($_SESSION['amount_payable']);
            unset($_SESSION['discount_amount']);
            unset($_SESSION['shipping_name']);
            unset($_SESSION['shipping_amount']);
            unset($_SESSION['order_id']);
            unset($_SESSION['payable_amount']);
        }
    }

    echo json_encode($order_mail);
}
