<?php // This files is mostly containing things for your view / html
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>USELESS STUFF STORE</title>
</head>
<body>
<div class="container">
    <h1>Place your order</h1>
    <!-- display message that the purchase is successful-->
    <?php if (!empty($result['message'])) { ?>
        <div class="alert <?php if ($result['errors']) {
            echo 'alert-danger';
        } else {
            echo 'alert-success';
        } ?>">
            <?= $result['message'] ?>
        </div>
    <?php }; ?>

    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>">
            </div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control"
                           value="<?php echo isset($_POST["street"]) ? $_POST["street"] : ''; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control"
                           value="<?php echo isset($_POST["streetnumber"]) ? $_POST["streetnumber"] : ''; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control"
                           value="<?php echo isset($_POST["city"]) ? $_POST["city"] : ''; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control"
                           value="<?php echo isset($_POST["zipcode"]) ? $_POST["zipcode"] : ''; ?>">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products as $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" <?php if (isset($_POST['products'][$i])) {
                        foreach ($_POST['products'] as $tmp) {
                            if ($tmp == "1") {
                                echo "checked='checked'";
                            }
                        }
                    } ?> name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?>
                    -
                    &euro; <?= number_format($product['price'], 2) ?></label><br/>
            <?php endforeach; ?>
        </fieldset>

        <button type="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in useless stuff where do you wanna go with this?</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>
