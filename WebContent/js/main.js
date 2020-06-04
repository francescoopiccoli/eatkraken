// Generic Eatkraken related functions

function editNotes(id) {
    notes = prompt("Enter custom message");

    if(notes != null)
        $("<form>", {
            "action": "checkout.php",
            "method": "post",
        }).append(
            $("<input/>", {"type": "hidden", "name": "restaurant", "value": id})
        ).append(
            $("<input/>", {"type": "hidden", "name": "set_message", "value": notes})
        )
        .appendTo(document.body)
        .submit();
}

function editName() {
fName = prompt("Enter full name");

    if(fName != null)
        $("<form>", {
            "action": "checkout.php",
            "method": "post",
        }).append(
            $("<input/>", {"type": "hidden", "name": "set_full_name", "value": fName})
        )
        .appendTo(document.body)
        .submit();
}
function editAddress() {
    address = prompt("Enter delivery address");

    if(address != null)
            $("<form>", {
            "action": "checkout.php",
            "method": "post",
        }).append(
            $("<input/>", {"type": "hidden", "name": "set_address", "value": address})
        )
        .appendTo(document.body)
        .submit();
}
function editMail() {
    address = prompt("Enter e-mail address");

    if(address != null)
        $("<form>", {
            "action": "checkout.php",
            "method": "post",
        }).append(
            $("<input/>", {"type": "hidden", "name": "set_email", "value": address})
        )
        .appendTo(document.body)
        .submit();
}
function editPhone() {
    phone = prompt("Enter phone number");

    if(phone != null)
        $("<form>", {
            "action": "checkout.php",
            "method": "post",
        }).append(
            $("<input/>", {"type": "hidden", "name": "set_phone", "value": phone})
        )
        .appendTo(document.body)
        .submit();
}
function changeShipping(restaurant) {
    shipping = $("#shipping-"+restaurant).val();
    if(!isNaN(shipping))
        $("<form>", {
            "action": "checkout.php",
            "method": "post",
        }).append(
            $("<input/>", {"type": "hidden", "name": "restaurant", "value": restaurant})
        ).append(
            $("<input/>", {"type": "hidden", "name": "set_shipping", "value": shipping})
        )
        .appendTo(document.body)
        .submit();
}

// usability/feedback: sends form only ("return false" cancels click event) if confirmation is given
function confirmAction() {
    return confirm("Are you sure?");
}


// in product.php, if JS/AJAX is supported, this function add the item to cart using AJAX, otherwise if it fails to execute it will refresh the page and send a normal form without JS
function ajaxAddCart(id) {
    
    $.post("/api/cart_add.php", { code: id })
        .done(function( data ) {
            if(data != "ok") {
                $("#cart-add-msg").val("Error adding, try again?");
                $("#cart-add-btn").val("Add");
            } else {
                $("#cart-add-btn").html("Added!");
                $("#cart").toggleClass("animation-rotate");
                
                countOld = parseInt($("#checkout-items").html());
                if(!countOld) {
                    countOld = 0;
                }
                countNew = countOld + 1

                $("#checkout-items").html(countNew);
                $("#checkout-x").show();

                
            }
        }); 
    
    return false; // we sent the request, so don't submit form
}
