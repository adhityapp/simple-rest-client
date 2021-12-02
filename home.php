<?php
session_start();
if (!isset($_SESSION["user"])) header("Location: index.php");

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://127.0.0.1:8000',
    'timeout' => 5
]);

$response =  $client->request('GET', '/api/futsal',  [
    'headers' => [
        'Authorization' => "Bearer {$_SESSION["token"]}"
    ]
]);

$body = $response->getBody();
$data_body = json_decode($body, true);
//var_dump($data_body);

?>

<html>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <!-- end datatable -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $('#tabel-undangan').DataTable();
        });
    </script>

</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <h2>Daftar <b>Squad Member</b></h2>
                            </div>
                            <div class="row">
                                <p> by <?php echo $_SESSION["user"] ?> </p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <a href="add.php" class="btn btn-secondary"><span class="material-icons-outlined">Tambah Data</span></a>
                        </div>
                        <div class="col-sm-2">
                            <a href="logout.php" class="btn btn-secondary"><span class="material-icons-outlined">Log Out</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover" id="tabel-undangan" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No. Jersey</th>
                            <th>Nama</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_body['data'] as $data) :
                            //var_dump($data['jersey']);
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['jersey']; ?></td>
                                <td><?php echo $data['name']; ?></td>
                                <td><?php echo $data['position']; ?></td>
                            </tr>
                        <?php
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>