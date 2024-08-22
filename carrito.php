<?php require_once "config/conexion.php";
require_once "config/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Carrito de Compras</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" /> -->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/estilos.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="./"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </div>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Carrito</h1>
                <p class="lead fw-normal text-white-50 mb-0">Tus Productos Agregados.</p>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody id="tblCarrito">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-5 ms-auto">
                    <h4>Total a Pagar: <span id="total_pagar">0.00</span></h4>
                    <div class="d-grid gap-2">
                        <div id="paypal-button-container"></div>
                        <button class="btn btn-warning" type="button" id="btnVaciar">Vaciar Carrito</button>
                        <button class="btn btn-primary" type="button" id="btnPagoTarjeta">Pagar con Tarjeta</button>

<div id="formularioPago" style="display: none;">
    <form id="formPagoTarjeta">
        <div class="mb-3">
            <label for="cardNumber" class="form-label">Número de Tarjeta</label>
            <input type="text" class="form-control" id="cardNumber" required>
        </div>
        <div class="mb-3">
            <label for="cardHolder" class="form-label">Titular de la Tarjeta</label>
            <input type="text" class="form-control" id="cardHolder" required>
        </div>
        <div class="mb-3">
            <label for="expiryDate" class="form-label">Fecha de Vencimiento</label>
            <input type="text" class="form-control" id="expiryDate" placeholder="MM/AA" required>
        </div>
        <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cvv" required>
        </div>
        <button type="submit" class="btn btn-success">Pagar</button>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">CARRITO DE COMPRAS &copy; THE LION KINGDON 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&locale=<?php echo LOCALE; ?>"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
        mostrarCarrito();

    // ... (código de script existente) ...

    // Mostrar/ocultar formulario de pago con tarjeta de crédito
    $('#btnPagoTarjeta').click(function() {
        $('#formularioPago').toggle();
    });

    // Manejar el envío del formulario de pago con tarjeta de crédito
    $('#formPagoTarjeta').submit(function(e) {
        e.preventDefault();

        // Aquí, puedes agregar la lógica para procesar el pago con tarjeta de crédito usando JavaScript/jQuery y posiblemente AJAX.
        // Esto puede implicar recopilar los datos del formulario y enviarlos a un punto final de procesamiento de pagos.

        // Ejemplo: Puedes recopilar los datos del formulario y manejar el procesamiento del pago aquí.
        const numeroTarjeta = $('#cardNumber').val();
        const titularTarjeta = $('#cardHolder').val();
        const fechaVencimiento = $('#expiryDate').val();
        const cvv = $('#cvv').val();

        // Es posible que desees usar AJAX para enviar estos datos a un punto final de procesamiento de pagos y manejar la respuesta.

        // Por ejemplo (llamada AJAX):
        // $.ajax({
        //     type: 'POST',
        //     url: 'procesar_pago.php',
        //     data: { numeroTarjeta, titularTarjeta, fechaVencimiento, cvv },
        //     success: function(response) {
        //         // Manejar la respuesta, por ejemplo, mostrar mensajes de éxito o error al usuario.
        //     },
        //     error: function(error) {
        //         // Manejar cualquier error que pueda ocurrir durante el procesamiento del pago.
        //     }
        // });
    });

        function mostrarCarrito() {
            if (localStorage.getItem("productos") != null) {
                let array = JSON.parse(localStorage.getItem('productos'));
                if (array.length > 0) {
                    $.ajax({
                        url: 'ajax.php',
                        type: 'POST',
                        async: true,
                        data: {
                            action: 'buscar',
                            data: array
                        },
                        success: function(response) {
                            console.log(response);
                            const res = JSON.parse(response);
                            let html = '';
                            res.datos.forEach(element => {
                                html += `
                            <tr>
                                <td>${element.id}</td>
                                <td>${element.nombre}</td>
                                <td>${element.precio}</td>
                                <td>1</td>
                                <td>${element.precio}</td>
                            </tr>
                            `;
                            });
                            $('#tblCarrito').html(html);
                            $('#total_pagar').text(res.total);
                            paypal.Buttons({
                                style: {
                                    color: 'blue',
                                    shape: 'pill',
                                    label: 'pay'
                                },
                                createOrder: function(data, actions) {
                                    // This function sets up the details of the transaction, including the amount and line item details.
                                    return actions.order.create({
                                        purchase_units: [{
                                            amount: {
                                                value: res.total
                                            }
                                        }]
                                    });
                                },
                                onApprove: function(data, actions) {
                                    // This function captures the funds from the transaction.
                                    return actions.order.capture().then(function(details) {
                                        // This function shows a transaction success message to your buyer.
                                        alert('Transaction completed by ' + details.payer.name.given_name);
                                    });
                                }
                            }).render('#paypal-button-container');
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            }
        }
   
</script>


</body>

</html>