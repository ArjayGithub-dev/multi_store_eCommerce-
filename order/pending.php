<?php
session_start(); // Start the session at the beginning
require_once 'filter.php'; 
?>
<table class="table table-hover col-12" id="table-pending" style="width: 100%;">
<thead>
    <tr>
        <th scope="col">Action</th>
        <th scope="col">Product Name</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Order Total</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Delivery Address</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Status</th>
    </tr>
</thead>
<tbody>
    
<?php
require_once '../classes/order.class.php'; // Adjust path as per your class location

if(isset($_SESSION['seller_id'])) {
    $seller_id = $_SESSION['seller_id'];
    echo "Seller ID: " . htmlspecialchars($seller_id); // Debugging statement
    $order = new Order();

    // Fetch records for this specific seller
    $orders = $order->fetchPendingOrder($seller_id);

    // Loop for each record found in the array
    foreach ($orders as $value) { 
?>
    <tr>
        <td>
            <form action="confirm_order.php" method="post">
                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($value['id']); ?>">
                <button type="submit" class="me-2 green confirm-button">Confirm Order</button>
            </form>
        </td>
        <td><?php echo htmlspecialchars($value['product_name']); ?></td>
        <td><?php echo htmlspecialchars($value['price']); ?></td>
        <td><?php echo htmlspecialchars($value['quantity']); ?></td>
        <td><?php echo htmlspecialchars($value['order_total']); ?></td>
        <td><?php echo htmlspecialchars($value['fullname']); ?></td>
        <td><?php echo htmlspecialchars($value['address']); ?></td>
        <td><?php echo htmlspecialchars($value['contact_number']); ?></td>
        <td><?php echo htmlspecialchars($value['status']); ?></td>
    </tr>
<?php 
    }
} else {
    echo "Seller ID is not set. Please log in.";
}
?>
</tbody>
</table>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const confirmButtons = document.querySelectorAll('.confirm-button');
    
    confirmButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            if (form) {
                if (confirm('Are you sure you want to confirm this order?')) {
                    form.submit();
                }
            }
        });
    });
});
</script>

