$(document).ready(function(){

    //btn plus click
    $('.btn-plus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#pizzaPrice').text().replace("kyats",""))
        $qty = Number($parentNode.find('#qty').val())

        $total = $price * $qty;
        $parentNode.find('#total').html($total+" kyats")

        summaryCalculation()

    })

    //btn minus click
    $('.btn-minus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#pizzaPrice').text().replace('kyats',""))
        $qty = Number($parentNode.find('#qty').val())

        $total = $price * $qty;
        $parentNode.find('#total').html($total+" kyats")

        summaryCalculation()
    })


    //final price
    function summaryCalculation(){
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index,row){
           $totalPrice+= Number($(row).find('#total').text().replace("kyats",""))
        })
        $('#subTotalPrice').html(`${$totalPrice} kyats`)
        $('#finalPrice').html(`${$totalPrice + 3000} kyats`)
    }
})
