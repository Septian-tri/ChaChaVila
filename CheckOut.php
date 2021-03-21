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
            <h2>Booking Review</h2>
            <p class="lead mt-4">Code Book : #WOjdsaWdnaWQ212nsoa</p>

            <div class="d-block my-5">
                <label class="h4">Pay into this account number</label>
                <h4>2132312312312312</h4>
                <small>we will notif you when payment is complete</small>
            </div>
            <p class="lead text-danger text-uppercase">*expected to make payments before 24.00*</p>
        </div>
        

        <div class="row">
            <div class="col-md-10 order-md-1 mx-auto">
                <h4 class="mb-3">Book Date</h4>
                <form class="needs-validation was-validated" novalidate="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstDate">
                                <i class="fa fa-calendar fa-lg mr-2"></i>
                                Check-In
                            </label>
                            <p>24 juni 1918</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastDate">
                                <i class="fa fa-calendar fa-lg mr-2"></i>
                                Check-Out
                            </label>
                            <p>24 juni 1918</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="h4">Duration</label>
                        <div class="input-group">
                            <i class="fa fa-clock-o fa-lg mr-2"></i>
                            <span>4 days</span>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="h4">Max Guest</label>
                        <div class="input-group">
                            <i class="fa fa-user fa-lg mr-2"></i>
                            <span>6 People</span>
                        </div>
                    </div>

                    <h4 class="mb-3">Payment</h4>

                    <div class="d-block my-5">
                        <label>Rental Costs</label>
                        <h2>Rp. 100.000.000</h2>
                    </div>

                    <hr>

                    <button class="btn btn-danger btn-lg btn-block my-5" type="submit">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <script src="Settings/js/main.js"></script>
</body>
</html>