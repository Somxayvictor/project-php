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
$items = $conn->query("SELECT * FROM tblorder WHERE DATE_FORMAT(created_at,'%Y-%m-%d') BETWEEN '$start' AND '$end' ORDER By tblorder.created_at ASC");
$nav = 'report';
$subnav = 'report-by-bill';
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
                                <button  type="submit" class="btn btn-primary" style="font-family: phetsarat OT;">ຕົກລົງ</button>
                            </div>
                        </div>

                    </form>
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table style="background-color: whitesmoke;" class="table table-bordered">
                            <thead style="text-align: center;">
                                <tr style="font-family: phesarat OT;">
                                    <th>ລຳດັບ</th>
                                    <th>ລະຫັດໃບບີນ</th>
                                    <th>ວັນທີ</th>
                                    <th>ທັງໝົດ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $total_amount = 0;
                                while ($row = $items->fetch_assoc()) {
                                ?>
                                    <tr id="item-<?php echo ($row['id']); ?>">
                                        <td><?php echo ($i); ?></td>
                                        <td><?php echo ($row['bill_no']); ?></td>

                                        <td>
                                            <?php echo (date('d-m-Y H:i:s', strtotime($row['created_at']))); ?>
                                        </td>
                                        <td><?php echo (number_format($row['total_amount'])); ?></td>

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
                                        <strong style="font-family: phesarat OT;"> ລາຄາລວມທັງໝົດ</strong>
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