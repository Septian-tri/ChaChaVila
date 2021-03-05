<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body id="bg">

    <?php include('Navbar.php') ?>
    <div class="container p-0">
        <a class="lightbox" href="s">
            <i class="fa fa-arrow-left fa-3x text-white mb-3" aria-hidden="true"></i>
        </a>
    </div>

    <div class="container bg-light rounded p-4">
        <div class="py-5 text-center">
            <h2>CheckIn form</h2>
            <p class="lead mt-4">Code Book : #WOjdsaWdnaWQ212nsoa</p>
        </div>

        <div class="row">
            <div class="col-md-10 order-md-1 mx-auto">
                <h4 class="mb-3">Book Date</h4>
                <form class="needs-validation was-validated" novalidate="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstDate">Order Date</label>
                            <input type="date" class="form-control" id="firstDate" placeholder="" value="" required="">
                            <div class="invalid-feedback">
                                Valid first date is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastDate">Last Order Date</label>
                            <input type="date" class="form-control" id="lastDate" placeholder="" value="" required="">
                            <div class="invalid-feedback">
                                Valid last date is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">Duration</label>
                        <div class="input-group">
                            <i class="fa fa-clock-o fa-lg mr-2"></i>
                            <span>4 days</span>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="username">Max Guest</label>
                        <div class="input-group">
                            <i class="fa fa-user fa-lg mr-2"></i>
                            <span>6 People</span>
                        </div>
                    </div>

                    <h4 class="mb-3">Payment</h4>

                    <div class="d-block my-3">
                        <label for="username">Rental Costs</label>
                        <h2>Rp. 100.000.000</h2>
                    </div>

                    <hr class="mb-5">
                    <a href="CheckOut.php" class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</a>
                </form>
            </div>
        </div>

        <footer class="my-4 col-md-10 mx-auto px-0 text-muted text-center text-small">
            <span class="d-block text-center mb-4 text-muted"> or </span>

            <label class="lead mb-3">Meet in Person</label>
            
            <div class="card card-body">
                <p>
                    Some contact +62 999 9999 9999
                </p>
                <p>
                    some location weeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeew
                </p>
            </div>

        </footer>
    </div>
</body>

</html>