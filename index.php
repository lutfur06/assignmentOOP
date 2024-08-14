<?php
//create Invoice - My First Invoice.txt
/**
My First Invoice
Item 1 - 100
Item 2 - 200
-----------------
Total = 300
 */
class InvoiceBuilder{
public string $title;
public array $orderData = [];
    public string $item;
    public int  $price;
    public int  $total;

    function addTitle(string $title):string{
        $this->title = $title;
        $this->orderData['title'] = $title;
        return "{$this->title}";
    }
    function addItem(string $item, int $price): string{
        $newArray = [];
        $this->item = $item;
        $this->price = $price;
        array_push($newArray, $this->item,$this->price);
        $this->orderData['order'][] = $newArray;
        return "{$this->item} - {$this->price}";
    }

     function addTotal():string{
        $total = 0;
        $total += $this->price;
        $this->total = $total;
        $this->orderData['total'] = $total;
         return "Total: {$total}";
}
    function createInvoice():?string{
        $titleOfInvoice = "{$this->orderData['title']} \n";
        $file = fopen("data.txt","w");
        fwrite($file,$titleOfInvoice);


foreach ($this->orderData['order'] as $item){
    $data = "{$item[0]} - {$item[1]} \n";
    fwrite($file,$data);
    //file_put_contents("data.txt", $data);
};
$dashedLine = "--------------\n";
        fwrite($file,$dashedLine);
        $totalPrice = "Total  = {$this->orderData['total']}\n";
        fwrite($file,$totalPrice);
        echo "Done";
        fclose($file);
        return Null;
}
}

$inv = new InvoiceBuilder();
$inv->addTitle("My First Invoice");

 $inv->addItem("Item 1", 100);
$inv->addItem("Item 2", 200);
$inv->addItem("Item 3", 300);
$inv->addTotal();
//`var_dump($inv->orderData) ;
//var_dump($inv->title) ;
$inv->createInvoice();
