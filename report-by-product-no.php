<?php
include('./inc/connDB.php');
include('./inc/security.php');
if (isset($_GET['start']) && isset($_GET['end'])) {
    $start = $_GET['start'];
    $end = $_GET['end'];
} else {
    $start = date('Y-m-d');
    $end = date('Y-m-d');
}
$items = $conn->query("SELECT tblorderlist.bill_no,tblorderlist.bill_no,tblproduct.product_name,sum(tblorderlist.qty) AS base_qty, sum (tblorderlist.total_price) AS base_total_price FROM tblorderlist INNER JOIN tblproduct ON(tblproduct.product_no = tblorderlist.product_no) WHERE DATE_FORMAT(tblorderlist.created_at,'%Y,m,d') BETWEEN '$start' AND '$end' GROUP By tblorderlist.product_no ORDER BY tblorderlist.created_at ASC");
$nav = 'report';
$subnav = 'report-by-product_no';
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>User List</title>
    <?php
    include('inc/header.php');
    ?>
</head>

<body class="d-flex flex-column h-100">
    <header>
        <!-- Fixed navbar -->
        <?php
        include('inc/nav.php');
        ?>
    </header>
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br><br><br><br>
                </div>
                <div class="col-md-12">
                    <form>
                        <div class="row">
                            <div class="col-md-2">
                                <input type="date" name="start" class="form-control" value="<?php echo ($start);?>">
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="end" class="form-control" value="<?php echo ($end);?>">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">ok</button>
                            </div>
                        </div>

                    </form>
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bil NO</th>
                                    <th>Product NO</th>
                                    <th>Product Name</th>
                                    <th>qty</th>
                                    <th> Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $total_amount = 0;
                                while ($row = $items->fetch_assoc()) {
                                ?>
                                        <td><?php echo ($i); ?></td>
                                        <td><?php echo ($row['bill_no']); ?></td>
                                        <td><?php echo ($row['product_no']); ?></td>
                                        <td><?php echo ($row['product_name']); ?></td>
<td align="center"><?php echo($row['base_qty']);?></td>
<td ><?php echo(number_format($row['base_total_price']))?></td>       
                                    </tr>
                                <?php
                                    $total_amount += $row['total_amount'];
                                    $i++;
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" align="right">
                                        <strong> Total Amount</strong>
                                    </td>
                                    <td align="right">
                                        <strong> <?php echo (number_format($total_amount)) ?></strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include('inc/footer.php');
    include('inc/script.php');
    ?>
</body>

</html>