<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("includes/scriptUp.php") ?>
</head>

<body>


    <div id="">
        <input type="text" name="dato" id="dato">
        <a id="btnMostrar">Mostrar Alertify Prompt</a>

    </div>
    <input name="" id="" class="btn btn-primary" type="button" value="cvcvvc">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
        Launch
    </button>
    <div class="container">
        <div class="card-group">
            <div class="card">
                <img class="card-img-top" data-src="holder.js/100x180/" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">Text</p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" data-src="holder.js/100x180/" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">Text</p>
                </div>
            </div>
        </div>
        <div class="jumbotron">
            <h1 class="display-3">Jumbo heading</h1>
            <p class="lead">Jumbo helper text</p>
            <hr class="my-2">
            <p>More info</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Jumbo action name</a>
            </p>
        </div>
        <div class="alert alert-dark" role="alert">
            <strong>primary</strong>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for=""></label>
                <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">

            </div>
            <div class="form-group">
                <label for=""></label>
                <input type="text" class="form-control form-control-sm" name="" id="" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            <input name="" id="" class="btn btn-primary" type="button" value="">
            <div class="form-group">
                <label for=""></label>
                <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                <small id="helpId" class="text-muted">Help text</small>
            </div>
        </div>

    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Body
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for=""></label>
        <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
        <small id="helpId" class="text-muted">Help text</small>
    </div>

    <?php include("includes/scriptDown.php") ?>
    <script>
        $(document).ready(function() {
            $('#btnMostrar').click(function() {
                alertify.prompt('Prompt Title', 'Prompt Message', '',
                    function(evt, value) {
                        alertify.success('You entered: ' + value)
                        $('#dato').val(value);
                    },
                    function() {
                        alertify.error('Cancel')
                    });


            })

        });
    </script>
</body>

</html>