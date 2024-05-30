<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid text-bg-primary">
        <h1 class="text-center p-2">Painel de Controle</h1>
    </div>

    <div class="container mt-3">
        <div class="row">
            <h2>Dados da API</h2>
        </div>
        <div class="row">
            <div class="col-sm mt-sm-3">
                <div class="row">
                    <div class="card mb-3 p-3 border-primary" style="max-width: 500px;">
                        <div class="row g-0">
                            <div class="col-md-4 position-relative">
                                <h1 class="display-1 position-absolute top-50 start-50 translate-middle text-primary"><span id="temperatura"></span><small class="fs-1 position-absolute top-0 start-100">°C</small></h1>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title ps-5 fw-bold text-primary">Temperatura</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm mt-sm-3">
                <div class="card mb-3 p-3 border-primary " style="max-width: 500px;">
                    <div class="row g-0">
                        <div class="col-md-4 position-relative">
                            <h1 class="display-1 position-absolute top-50 start-50 translate-middle text-primary"><span id="umidade"></span><small class="fs-1 position-absolute top-0 start-100">%</small></h1>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title ps-5 fw-bold text-primary">Umidade</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <h2 class="text-center">Enviar Dados</h2>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-sm-5">
                <form action="enviarDados.php" method="post">
                    <label for="lcd" class="form-label">Valor para LCD:</label><br>
                    <input type="text" class="form-control border-black" id="lcd" name="lcd" placeholder="Digite algo..."><br><br>
                    <div class="d-flex justify-content-center">
                        <input type="submit" class="btn btn-primary mb-3" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>


<script>
    function buscarDados() {
        $.ajax({
            url: 'obterDados.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#umidade').text(data.umidade);
                $('#temperatura').text(data.temperatura);
            },
            error: function(xhr, status, error) {
                console.error('Erro ao obter dados:', error);
            }
        });
    }

    // Chama a função fetchData quando a página é carregada
    $(document).ready(function() {
        buscarDados();
        setInterval(buscarDados, 3000);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
