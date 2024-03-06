$(document).ready(function () {

    // Minus button
    $(".btn-minus").click(function () {
        $parent = $(this).parents("tr");
        $productPrice = parseInt($parent.find("#productPrice").text());
        $qty = parseInt($parent.find("#qty").val());
        $total = $productPrice * $qty;
        $parent.find("#productTotal").html(`${$total} kyats`);
        totalCalculation();
    })

    // Plus button
    $(".btn-plus").click(function () {
        $parent = $(this).parents("tr");
        $productPrice = parseInt($parent.find("#productPrice").text());
        $qty = parseInt($parent.find("#qty").val());
        // console.log($qty);
        $total = $productPrice * $qty;
        $parent.find("#productTotal").html(`${$total} kyats`);
        totalCalculation();
    })

    // Subtotal
    function totalCalculation() {
        $result = 0
        $("#tableBody tr").each(function (index, row) {
            $result += parseInt($(row).find("#productTotal").text().replace("kyats", ""));
        })
        $("#subTotal").html(`${$result} kyats`);
        $("#tax").html(`${$result * 0.025} kyats`);
        $("#finalTotal").html(`${$result + $result * 0.025} kyats`);
    }
})
