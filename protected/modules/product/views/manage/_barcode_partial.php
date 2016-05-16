<?php // echo Yii::app()->getBaseUrl(true); ?>
<?php
$webroot = Yii::getPathOfAlias('webroot');
$pdfs_path = $webroot . DIRECTORY_SEPARATOR . 'barcode_pdfs' . DIRECTORY_SEPARATOR;
$now = date('Ymd_His');

ob_start();
?>

<?php
if (!empty($purchaseRecords)) {
    $c = 0;
    $k = 0;
    $i_purchase_row_ids = array();
    foreach ($purchaseRecords as $pr) {
        ?>
        <?php for ($i = 0; $i < $pr['quantity']; $i++) { ?>
            <div class="code-wrapper print">
                <div class="prod_barcode">
                    <!--<img style="display: none;" src="/product/barcode/generate?filetype=<?php echo $barcode['filetype']; ?>&dpi=<?php echo $barcode['dpi']; ?>&scale=<?php echo $barcode['scale']; ?>&rotation=<?php echo $barcode['rotation']; ?>&font_family=<?php echo $barcode['font_family']; ?>&font_size=<?php echo $barcode['font_size']; ?>&text=<?php echo $pr['code']; ?>&thickness=<?php echo $barcode['thickness']; ?>&code=<?php echo $barcode['codetype']; ?>&pid=<?php echo $pr['product_details_id']; ?>">-->
                    <!--<img src="/bc_images/<?php // echo $pr['product_details_id']; ?>.png" />-->
                    <?php echo $generator->getBarcode($pr['code'], $generator::TYPE_EAN_13, 1, 60) . " ";?>
                </div>
                <div class="prod_name"><?php echo $pr['product_name']; ?></div>
                <div class="prod_ptice"><?php echo ' TK ' . $pr['selling_price']; ?></div>
                <div class="prod_ref_num">
                    <?php
                    $rev_purchase_price = str_replace('.00', '', $pr['purchase_price']);
                    $dotless_rev_purchase_price = strrev($rev_purchase_price);

                    echo $dotless_rev_purchase_price;
                    ?>K<?php echo $pr['code']; ?>-<?php echo $pr['quantity'] . '/' . $pr['quantity']; ?>
                </div>
            </div>
            <?php
            $c++;
            if ($c % 63 == 0) {
                ?>
                <p style="page-break-after:always;"></p>
            <?php } ?>
            <?php
        }
        $k++;
    }
} else {
    ?>
    <label class="control-label">No Product available to generate barcode.</label>
<?php } ?>

    <div class="print-btn">
    <button type="button" id="btn-print">Print</button>
</div>

<style type="text/css" media="all">
    .note {
        color: red;
        font-size: 20px;
        margin-bottom: 30px;
        margin-left: auto; 
        margin-right: auto; 
        text-align: center;
        width: 100%;
    }
    .code-wrapper {
        float: left;
        margin-bottom: 15px;
        margin-left: 20px;
        text-align: center;
        width: 11%;
    }
    .prod_barcode {
        float: left;
        width: 100%;
    }
    .prod_barcode img {
        float: left;
        width: 100%;
    }
    .clearfix {
        clear: both;
    }
    .prod_name, .prod_ptice, .prod_ref_num {
        font-family: 'Tahoma';
        font-size: 10px;
    }
</style>

<?php
$s_pdf_content = ob_get_contents();
ob_end_clean();

if (!empty($purchaseRecords)) {
    $pdf = Yii::app()->ePdf->mpdf('', 'A4');
    $pdf->SetDisplayMode('fullpage');
    $pdf->WriteHTML($s_pdf_content);
    
    if (isset($singleItem) && $singleItem) {
        $pdf->Output($pdfs_path . md5($purchaseRecords[0]['product_details_id']) . '_barcodes.pdf', 'F');
    } else {
        $pdf->Output($pdfs_path . $now . '_barcodes.pdf', 'F');
    }
}
echo $s_pdf_content;

?>

<script type="text/javascript">
    $(document).on('click', '#btn-print', function() {
            var divContents = $(".print").html();
            var printWindow = window.open('', '', 'height=400, width=800');
            console.log(divContents);
            printWindow.document.write('<html><head><title>Print</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
</script>