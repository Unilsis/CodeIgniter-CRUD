<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud CodeInite 4 e Fetch</title>
    <link rel="stylesheet" href="<?php echo base_url('/css/auto_complite.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/css/forms.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/css/label-float.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/css/modal.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/css/table.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/css/produto-style.css'); ?>">
</head>

<body>

    <header>
        <h3>Crud CodeInite 4 e Fetch</h3>
        <div class="navegators">
            <ul>
                <li><a style="color: blue;" href="https://github.com/Unilsis/CodeIgniter-CRUD">CodeIgniter-CRUD</a></li>
            </ul>
        </div>
    </header>
    <div class="card-body">

        <div class="butons">
            <button data-toggle="modals" data-target="#modal-w5001" class="btn md btn-sm btn-outline-primary">Adicionar Produto</button>
        </div>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Custo</th>
                    <th>Preço Venda</th>
                    <th>Estoque</th>
                    <th width="240px">Action</th>
                </tr>
            </thead>
            <tbody id="projects-table-body">
                <?php if (!empty($produto_lista)) : ?>
                    <?php foreach ($produto_lista as $item) : ?>
                        <tr>
                            <td> <?php echo $item->descricao; ?> </td>
                            <td style="text-align: right;"> <?php echo number_format($item->custo, 2, ",", "."); ?> </td>
                            <td style="text-align: right;"> <?php echo number_format($item->precovenda, 2, ",", "."); ?> </td>
                            <td style="text-align: center;"> <?php echo $item->estoque; ?> </td>
                            <td>
                                <button data-toggle="modals" data-target="#modal-w500v" class="md visualizar btn btn-outline-info btn-sm" data-id='<?php echo $item->id; ?>' data-descricao='<?php echo $item->descricao; ?>' data-precovenda='<?php echo $item->precovenda; ?>' data-estoque='<?php echo $item->estoque; ?>' data-qtd='<?php echo $item->qtd; ?>'data-custo='<?php echo $item->custo; ?>'>Ver</button>
                                <button data-toggle="modals" data-target="#modal-w5001" class="md editar btn btn-outline-warning btn-sm" data-id='<?php echo $item->id; ?>' data-descricao='<?php echo $item->descricao; ?>' data-precovenda='<?php echo $item->precovenda; ?>' data-estoque='<?php echo $item->estoque; ?>' data-qtd='<?php echo $item->qtd; ?>'data-custo='<?php echo $item->custo; ?>'>Editar</button>
                                <button class="deletar btn btn-outline-warning btn-sm"                                                   data-id='<?php echo $item->id; ?>' data-descricao='<?php echo $item->descricao; ?>' data-precovenda='<?php echo $item->precovenda; ?>' data-estoque='<?php echo $item->estoque; ?>' data-qtd='<?php echo $item->qtd; ?>'data-custo='<?php echo $item->custo; ?>'>Deletar</button>
                            </td>
                        </tr>

                    <?php endforeach ?>

                <?php endif ?>
            </tbody>
        </table>
    </div>

    <div id="modal-w5001" class="modal modal-static">
        <!-- Modal content -->
        <div class="modal-content w500">
            <i class="modal-title">Cadastrar Produto</i>
            <i id="close" class="md-close close bi bi-x-lg"></i>
            <!-- Modal Body -->
            <form action="/produtos/store" method="POST" class="modal-body">
                <input style="display: none;" type="text" name="id" id="id" />
                <div class="row-inline label-15">
                    <div class="label-float">
                        <input type="text" placeholder=" " name="descricao" id="descricao" />
                        <label class="flabel">Descrição</label>
                    </div>
                    <div class="label-float" style="max-width: 100px;">
                        <input type="text" placeholder=" " name="custo" id="custo" class="algn-rigth" />
                        <label class="flabel">Custo</label>
                    </div>
                    <div class="label-float" style="max-width: 100px;">
                        <input type="text" placeholder=" " name="precovenda" id="precovenda" class="algn-rigth" />
                        <label class="flabel">Preço</label>
                    </div>
                </div>
                <div class="row-inline label-15">
                    <div class="label-float">
                        <input onkeyup="getValue()" type="text" placeholder=" " name="qtd" id="qtd" />
                        <label class="flabel">Quantidade</label>
                    </div>
                    <div class="label-float">
                        <input type="text" placeholder=" " name="estoque" id="estoque" class="algn-rigth" />
                        <label class="flabel">Estoque</label>
                    </div>
                </div>
            </form>
            <!-- Modal footer -->
            <div class="modal_footer">
                <button class="md-close btn btn-warning">Cancelar</button>
                <button onclick="salvar()" class="btn btn-outline-primary">Salvar</button>
            </div>
        </div>
    </div>

    <div id="modal-w500v" class="modal modal-static">
        <div class="modal-content w500">
            <i class="modal-title">Informação de Produto</i>
            <i class="md-close close bi bi-x-lg"></i>
            <div action="/produtos/store" method="POST" class="modal-body">
                <div class="inform"><span>Id</span><label id="id-if">Text</label></div>
                <div class="inform"><span>Descrição</span><label id="descricao-if">Text</label></div>
                <div class="inform"><span>Custo</span><label id="custo-if">0</label></div>
                <div class="inform"><span>Preço Venda</span><label id="precovenda-if">0</label></div>
                <div class="inform"><span>Estoque</span><label id="estoque-if">0</label></div>
            </form>
            <div class="modal_footer">
                <button class="md-close btn btn-warning">Sair</button>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('/js/jquery-3.7.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('/js/alertJs.js'); ?>"></script>
    <script src="<?php echo base_url('/js/modals.js'); ?>"></script>
    <script src="<?php echo base_url('/js/auto_complite.js'); ?>"></script>
    <script src="<?php echo base_url('/js/produto-controller.js'); ?>"></script>
</body>

</html>