    $(document).ready(function() {
        //when - button click
        $('.btn-plus, .btn-minus').click(function(){
            var $parentNode = $(this).parents('tr');
            // var $price = $parentNode.find('#pizzaPrice').val();
            // var $price = $parentNode.find('#pizzaPrice').html();
            var $price = Number($parentNode.find('#pizzaPrice').text());
            // console.log($price);
            var $qty = Number($parentNode.find('#qty').val());

            // console.log($price + "  " + $qty)

            var $total = $price * $qty;
            // console.log($total)

            $parentNode.find('#total').html(`${$total} kyats`);

            $totalPrice = 0;
            $('#dataTable tbody tr').each(function(index, row){
                // console.log($(row).find('#total').text().replace('kyats',''));
                $totalPrice += Number($(row).find('#total').text().replace('kyats',''));
            });
            // console.log($totalPrice);
            $('#subTotalPrice').html(`${$totalPrice} kyats`);
            $('#finalPrice').html(`${$totalPrice+3000} kyats`);
        });

        
    });