<script>
Zoovu.Tracking.trackPurchase({
  transactionId: '<?php echo $order->get_id(); ?>',
  currency: 'USD',
  products: [
    <?php
        foreach($order->get_items() as $item):
        /*$product = $order->get_product_from_item($item);*/
        $product_variation_id = $item['variation_id'];

        // Check if product has variation.
        if ($product_variation_id) { 
            $product = new WC_Product($item['variation_id']);
        } else {
            $product = new WC_Product($item['product_id']);
        }

        // Get SKU
        $sku = $product->get_sku();
    ?>
    {
      sku: '<?php echo $sku; ?>',
      name: '<?php echo $item['name']; ?>',
      pricePerUnit: <?php echo $item['total'];?>,
      quantity: <?php echo $item['qty']; ?>,
    }
<?php endforeach; ?>
  ]
})
</script><?php