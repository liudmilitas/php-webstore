<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/Order.php";


class OrdersDatabase extends Database
{
    // get all

    public function get_all_orders()
    {
        $query = "SELECT * FROM orders";

        $result = mysqli_query($this->conn, $query);

        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $orders = [];

        foreach ($db_orders as $db_order) {
            $user_id = $db_order["user-id"];
            $status = $db_order["status"];
            $order_date = $db_order["order-date"];
            $id = $db_order["id"];

            $orders[] = new Order($user_id, $status, $order_date, $id);
        }

        return $orders;
    }

    // get one by user id

    public function get_order_by_user_id($user_id)
    {
        $query = "SELECT *, orders.id AS `order-id` FROM `orders`
        JOIN users ON users.id = orders.`user-id`
        WHERE orders.`user-id` = ? ORDER BY `order-id`";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $user_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $orders;
    }

    // get one by id

    public function get_order_by_id($id)
    {
        $query = "SELECT * FROM orders WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_order = mysqli_fetch_assoc($result);

        $order = null;

        if ($db_order) {
            $db_id = $db_order["id"];
            $db_user_id = $db_order["user-id"];
            $db_status = $db_order["status"];
            $db_order_date = $db_order["order-date"];

            $order = new Order($db_user_id, $db_status, $db_order_date, $db_id);
        }

        return $order;

    }

    // create

    public function create(Order $order, $arrayOfOrderProducts)
    {
        $query = "INSERT INTO orders (`user-id`, `status`, `order-date`) VALUES (?,?,?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("iss", $order->user_id, $order->status, $order->order_date);
        $success = $stmt->execute();

        if ($success ^= 1) {
            die('Error in create order (1).');
        }
        $success = false;

        $order_id = mysqli_insert_id($this->conn);

        foreach ($arrayOfOrderProducts as $product) {
            mysqli_report(MYSQLI_REPORT_ALL);
            $query = "INSERT INTO `order-products` (`id`, `product`) VALUES (?, ?)";
            $stmt = mysqli_prepare($this->conn, $query);
            $stmt->bind_param("ii", $order_id, $product->product);
            $success = $stmt->execute();
            if ($success ^= 1) {
                die('Error in create order. (2)');
            }
        }

        return true;
    }

    // update
    public function update_order($status, $id)
    {
        $query = "UPDATE orders SET `status` = ? WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("si", $status, $id);

        return $stmt->execute();
    }
}

?>