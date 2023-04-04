<?php
class Cart {
  private $items = array(); // an array to hold the items in the cart
  private $count = 0; // the total number of items in the cart

  // add an item to the cart
  public function addItem($productID, $name, $price, $quantity) {
    if ($quantity <= 0) return; // do not add a zero or negative quantity
    $this->count += $quantity; // increase the item count
    // check if the same product is already in the cart
    if (isset($this->items[$productID])) { // if yes, increase the quantity
      $this->items[$productID]['quantity'] += $quantity;
    } else { // if no, add a new item
      $this->items[$productID] = array(
        'name' => $name,
        'price' => $price,
        'quantity' => $quantity
      );
    }
  }

  // remove an item from the cart
  public function removeItem($productID, $quantity = 1) {
    if ($quantity <= 0) return; // do not remove a zero or negative quantity
    if (isset($this->items[$productID])) { // check if the product is in the cart
      $this->count -= $quantity; // decrease the item count
      if ($quantity >= $this->items[$productID]['quantity']) { // remove the entire item
        unset($this->items[$productID]);
      } else { // decrease the item quantity
        $this->items[$productID]['quantity'] -= $quantity;
      }
    }
  }

  // get the total price of the items in the cart
  public function getTotal() {
    $total = 0;
    foreach ($this->items as $item) {
      $total += $item['price'] * $item['quantity'];
    }
    return $total;
  }

  // get the item count in the cart
  public function getCount() {
    return $this->count;
  }

  // clear the cart (remove all items)
  public function clear() {
    $this->items = array();
    $this->count = 0;
  }
}
