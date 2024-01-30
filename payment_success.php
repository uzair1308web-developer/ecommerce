<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo  time() ?>">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <style>
        .print_btn {
            width: 80px;

        }
    </style>

    <?php
    include 'php_helper.php';
    session_start();
    include 'admin/helper/dbconnect.php';
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        header("location: shop.php");
        exit;
    }

    use Razorpay\Api\Api;
    use Razorpay\Api\Errors\SignatureVerificationError;

    require('razorpay/Razorpay.php');
    require('payment_config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // print_r($_SESSION['cart']);
        $payment_id = $_POST['razorpay_payment_id'];
        $razorpay_order_id = $_POST['razorpay_order_id'];
        $signature = $_POST['razorpay_signature'];

        // $cart[] = array(
        //     'order_id' => $_SESSION['order_id'],
        //     'total_price' => $_SESSION['total_price']
        // );
        $cart =   $_SESSION['cart'];
        $order_id = $_SESSION['order_id'];
        $totalAmnt = $_SESSION['payable_amount'];
        // $quantity = $_SESSION['cart'][1]['quantity'];


        $cartData = json_encode($_SESSION['cart']);


        $api = new Api($keyId, $secretKey);

        try {
            //code...
            $api->utility->verifyPaymentSignature(array('razorpay_order_id' => $razorpay_order_id, 'razorpay_payment_id' => $payment_id, 'razorpay_signature' => $signature));

            // print_r($_SESSION);

            $sql = "UPDATE order_data SET product_detail = '$cartData', razorpay_orderId = '$razorpay_order_id', order_status = 'order complete', total_price = '$totalAmnt', payment_status = 'payment complete' where order_id = '$order_id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                // echo "Payment verification successfull";
                $sql1 = "SELECT * FROM order_data WHERE order_id = $order_id";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $date = $row['order_date'];
                    $email = $row['email'];
                    $address = $row['address'];
                    $name = $row['name'];
                    // $prodName = $row['product_name'];
                    $ndate = date_create($date);
                    $ndate =  date_format($ndate, "d M, Y, l");

    ?>
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <button type="button " class="btn btn-primary print_btn" onclick="printCard()">Print</button>
                                <button type="button" class="btn btn-success" onclick="goHome()">Shop More</button>
                                <div class="card mt-2" id="invoice">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="card-title text-center">Invoice Receipt</h4>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Date:</strong> <?php echo $ndate ?></p>
                                        <p><strong>Invoice Number:</strong> #<?php echo $order_id ?></p>
                                        <hr>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
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

                                                ?>
                                                    <tr>
                                                        <td><?php echo $pName ?></td>
                                                        <td><?php echo $pQuantity ?></td>
                                                        <td>$<?php echo $pPrice ?></td>
                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                        <hr>
                                        <p class="text-right"><strong>Sub Total: $<?php echo $totalAmnt ?></strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   


    <?php
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
                                                                                                                        <span style='font-size:22px;letter-spacing:0px;sans-serif;color:blue'>
                                                                                                                            RazorPay
                                                                                                                        </span>
                                                                                                                    </div>
                                                                                                                    <div style='font-family:sans-serif;font-size:16px;color:#535766;letter-spacing:0px;font-weight:bold'>Paid
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
                    </table>
                ";
                    sendOrdermail($email, "Your Order is confirmed", $message);
                    
                }    // header('location: index.php');
                unset($_SESSION['cart']);
                unset($_SESSION['total_price']);
                unset($_SESSION['amount_payable']);
                unset($_SESSION['discount_amount']);
                unset($_SESSION['shipping_name']);
                unset($_SESSION['shipping_amount']);
                unset($_SESSION['order_id']);
                unset($_SESSION['payable_amount']);
            } else {
                echo "something went wrong";
            }

            echo "<br>";
        } catch (SignatureVerificationError $e) {
            echo $e->getMessage();
        }
    }

    ?>


    <script src="assets/js/vendor.js"></script>
    <script src="assets/js/main.js?v=<?php echo  time() ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>