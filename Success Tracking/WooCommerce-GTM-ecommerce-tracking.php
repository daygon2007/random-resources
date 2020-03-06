<script>
    dataLayer.push({
      'event': 'transaction',
      'ecommerce': {
        'purchase': {
          'actionField': {
            'id': '<?php echo $order->get_id(); ?>',                         // Transaction ID. Required for purchases and refunds.
            'revenue': '<?php echo $order->get_total(); ?>',                     // Total transaction value (incl. tax and shipping)
            'tax':'<?php echo $order->get_total_tax(); ?>',
            'shipping': '<?php echo $order->get_shipping_total(); ?>',
          },
          'products': [
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
              {                            // List of productFieldObjects.
            'name': '<?php echo $item['name']; ?>',     // Name or ID is required.
            'id': '<?php echo $sku; ?>',
            'price': '<?php echo $item['total'];?>',
            'quantity': <?php echo $item['qty']; ?>,
              },<?php endforeach; ?>]
        }
      }
    });
</script>