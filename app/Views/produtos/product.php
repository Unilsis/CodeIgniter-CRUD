<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>CodeIgniter Project Manager</title>
    <meta charset="utf-8">
    <meta name="app-url" content="<?php echo base_url('/'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body>

    <div class="container">
        <h2 class="text-center mt-5 mb-3">CodeIgniter Project Manager</h2>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-outline-primary" onclick="createProject()">
                    Create New Project
                </button>
            </div>
            <div class="card-body">
                <div id="alert-div">

                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th width="240px">Action</th>
                        </tr>
                    </thead>
                    <tbody id="projects-table-body">
                        <?php if (!empty($proj_lista)) : ?>

                            <?php foreach ($proj_lista as $item) : ?>

                                <tr>
                                    <td> <?php echo $item->name; ?> </td>
                                    <td> <?php echo $item->description; ?> </td>
                                    <td>
                                        <button class="ver btn btn-outline-info" data-id='<?php echo $item->id; ?>' data-name='<?php echo $item->name; ?>' data-description='<?php echo $item->description; ?>'>Ver</button>
                                        <button class="editar btn btn-outline-warning" data-id='<?php echo $item->id; ?>' data-name='<?php echo $item->name; ?>' data-description='<?php echo $item->description; ?>'>Editar</button>
                                        <button class="deletar btn btn-outline-warning" data-id='<?php echo $item->id; ?>' data-name='<?php echo $item->name; ?>' data-description='<?php echo $item->description; ?>'>Deletar</button>
                                    </td>
                                </tr>

                            <?php endforeach ?>

                        <?php endif ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- modal for creating and editing function -->
    <div class="modal" tabindex="-1" id="form-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Project Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="error-div"></div>
                    <form>
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                        </div>

                        <button type="submit" class="btn btn-outline-primary mt-3" id="save-project-btn">Save Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- view record modal -->
    <div class="modal" tabindex="-1" id="view-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Project Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <b>Name:</b>
                    <p id="name-info"></p>
                    <b>Description:</b>
                    <p id="description-info"></p>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        /*
            check if form submitted is for creating or updating
        */
        $("#save-project-btn").click(function(event) {
            event.preventDefault();
            if ($("#update_id").val() == null || $("#update_id").val() == "") {
                storeProject();
            } else {
                updateProject();
            }
        })

        function storeProject() {
            $("#save-project-btn").prop('disabled', true);
            let url = "/project/projectos/create";
            let data = {
                name: $("#name").val(),
                description: $("#description").val(),
            };
            $.ajax({
                url: url,
                method: "POST",
                data: data,
                success: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert"><b>Project Created Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#description").val("");
                    $("#form-modal").modal('hide');
                    window.location.reload()
                },
                error: function(response) {
                    /*
                    show validation error
                    */
                    console.log(response)
                    $("#save-project-btn").prop('disabled', false);
                    if (typeof response.responseJSON.messages.errors !== 'undefined') {
                        let errors = response.responseJSON.messages.errors;
                        let descriptionValidation = "";
                        if (typeof errors.description !== 'undefined') {
                            descriptionValidation = '<li>' + errors.description + '</li>';
                        }
                        let nameValidation = "";
                        if (typeof errors.name !== 'undefined') {
                            nameValidation = '<li>' + errors.name + '</li>';
                        }

                        let errorHtml = '<div class="alert alert-danger" role="alert">' +
                            '<b>Validation Error!</b>' +
                            '<ul>' + nameValidation + descriptionValidation + '</ul>' +
                            '</div>';
                        $("#error-div").html(errorHtml);
                    }
                }
            });
        }

        /*
            sumbit the form and will update a record
        */
        function updateProject() {
            $("#save-project-btn").prop('disabled', true);
            let url = "/project/projectos/editar"
            let data = {
                id: $("#update_id").val(),
                name: $("#name").val(),
                description: $("#description").val(),
            };
            $.ajax({
                url: url,
                method: "PUT",
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert"><b>Project Updated Successfully</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#description").val("");
                    window.location.reload()
                    $("#form-modal").modal('hide');
                },
                error: function(response) {
                    /*
                    show validation error
                    */
                    console.log(response)
                    $("#save-project-btn").prop('disabled', false);
                    if (typeof response.responseJSON.messages.errors !== 'undefined') {
                        let errors = response.responseJSON.messages.errors;
                        let descriptionValidation = "";
                        if (typeof errors.description !== 'undefined') {
                            descriptionValidation = '<li>' + errors.description + '</li>';
                        }
                        let nameValidation = "";
                        if (typeof errors.name !== 'undefined') {
                            nameValidation = '<li>' + errors.name + '</li>';
                        }

                        let errorHtml = '<div class="alert alert-danger" role="alert">' +
                            '<b>Validation Error!</b>' +
                            '<ul>' + nameValidation + descriptionValidation + '</ul>' +
                            '</div>';
                        $("#error-div").html(errorHtml);
                    }
                }
            });
        }

        /*
            show modal for creating a record and 
            empty the values of form and remove existing alerts
        */
        function createProject() {
            $("#alert-div").html("");
            $("#error-div").html("");
            $("#update_id").val("");
            $("#name").val("");
            $("#description").val("");
            $("#form-modal").modal('show');
        }

        /*
            submit the form and will be stored to the database
        */
        document.querySelectorAll('.deletar').forEach(e => {

            $(e).click((e) => {
                if (confirm('Desejas mesmo excluir o projecto ' + e.target.dataset.name)) {
                    let data = {
                        id: e.target.dataset.id,
                    };
                    console.log(JSON.stringify(data))
                    let url = "/project/projectos/delete";
                    $.ajax({
                url: url,
                method: "POST",
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    window.location.reload()
                }
            });
                }
            })
        });

        /*
            edit record function
            it will get the existing value and show the project form
        */
        document.querySelectorAll('.editar').forEach(e => {
            $(e).click((e) => {
                $("#form-modal").modal('show');
                $('#update_id').val(e.target.dataset.id)
                $('#name').val(e.target.dataset.name)
                $('#description').val(e.target.dataset.description)
            })
        });

        /*
            get and display the record info on modal
        */
        document.querySelectorAll('.ver').forEach(e => {
            $(e).click((e) => {
                $("#view-modal").modal('show');
                //$('#update_id').text(e.target.dataset.id)
                $('#name-info').text(e.target.dataset.name)
                $('#description-info').text(e.target.dataset.description)
            })
        });
    </script>
</body>

</html>