# Sales Tracking Scripts
Here is the repository for basic sales tracking scripts for different platforms.

## WooCommerce Integration through Google Tag Manager (GTM)
Please have client add the script from WooCommerce-GTM-ecommerce-tracking.php to their "Thank You" page. This will make their sales data available in Google Tag Manager to access for the Zoovu Success tracking script to consume properly.

## WooCommerce Integration via standard Success Tracking script
Please have client add the script from WooCommerce-Success-Tracking.php to their "Thank You" page. Additionally, do not forget to have them add `<script type="text/javascript" src="https://api-tiger.zoovu.com/api/v1/integrations/{ ID }/zoovu-tracking"></script>` with the appropriate ID and correct assistant location (Tiger/Barracuda).