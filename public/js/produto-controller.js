window.onload = () => {
    modal_show()

    document.querySelectorAll('.editar').forEach(btn => {
        btn?.addEventListener('click', (e) => {
            $('#id').val(e.target.dataset.id)
            $('#descricao').val(e.target.dataset.descricao)
            $('#custo').val(e.target.dataset.custo)
            $('#precovenda').val(e.target.dataset.precovenda)
            $('#estoque').val(e.target.dataset.estoque)
            $('#estoque').attr('disabled', 'disabled')
            $('#qtd').val(e.target.dataset.qtd)
        })
    });

    document.querySelectorAll('.visualizar').forEach(btn => {
        btn?.addEventListener('click', (e) => {
            document.getElementById('id-if').innerText = (e.target.dataset.id)
            document.getElementById('descricao-if').innerText = (e.target.dataset.descricao)
            document.getElementById('custo-if').innerText = (e.target.dataset.custo)
            document.getElementById('precovenda-if').innerText = (e.target.dataset.precovenda)
            document.getElementById('estoque-if').innerText = (e.target.dataset.estoque)
        })
    });

    document.querySelectorAll('.deletar').forEach(btn => {
        btn?.addEventListener('click', (e) => {
            if (confirm(`desejas apagar o produto -> ${e.target.dataset.descricao} <- ?`)) {
                deleteProduto(e.target.dataset.id)
            }
        })
    });

};

function getValue() {
    document.getElementById('estoque').value = document.getElementById('qtd').value
}

function salvar() {
    let data = {
        id: document.getElementById('id').value,
        descricao: document.getElementById('descricao').value,
        custo: document.getElementById('custo').value,
        precovenda: document.getElementById('precovenda').value,
        qtd: document.getElementById('qtd').value,
        estoque: document.getElementById('estoque').value
    }
    console.log(isNaN(data.custo))
    if (data.descricao === '' || data.descricao === ' ' || data.descricao === null) {
        showMessage('A descrição do produto não pode ser vazio.', 'warning', 2500); 
    } else if (data.custo === '' || data.custo === ' ' || data.custo === null || isNaN(data.custo)) {
        showMessage('O custo de produto não pode ser nulo e não pode ter letras', 'warning', 2500);
    }else if (data.precovenda === '' || data.precovenda === ' ' || data.precovenda === null || isNaN(data.precovenda)) {
        showMessage('O preço de venda de produto não pode ser nulo e não pode ter letras', 'warning', 2500); 
    }else if (data.qtd === '' || data.qtd === ' ' || data.qtd === null || isNaN(data.qtd)) {
        showMessage('O quantidade de venda não pode ser nulo e não pode ter letras', 'warning', 2500); 
    }else if (data.estoque === '' || data.estoque === ' ' || data.estoque === null || isNaN(data.estoque)) {
        showMessage('O estoque não pode ser nulo e não pode ter letras', 'warning.', 2500); 
    }else{
        let id = document.getElementById('id')
        if (id.value === '') {
            adicionarProduto(data)
        } else if (id.value !== '') {
            atualizarProduto(data)
        }
    }
}

function adicionarProduto(data) {
    $.ajax({
        url: "/crud_codeigniter4/create",
        method: "POST",
        data: JSON.stringify(data),
        contentType: 'application/json',
        success: (resp) => {
            showMessage(resp.message, 'success', 4500)
            document.getElementById('close').click();
            setTimeout(() => {
                window.location.reload()
            }, 4700);
        },
        error: (error) => {
            showMessage(resp.errors + '\n' + resp.message, 'warning', 4500)
        }
    });
}

function atualizarProduto(data) {
    $.ajax({
        url: "/crud_codeigniter4/update",
        method: "PUT",
        data: JSON.stringify(data),
        contentType: 'application/json',
        success: (resp) => {
            showMessage(resp.message, 'success', 4500)
            document.getElementById('close').click();
            setTimeout(() => {
                window.location.reload()
            }, 4700);
        },
        error: (error) => {
            showMessage(resp.errors + '\n' + resp.message, 'warning', 4500)
        }
    });
}

function deleteProduto(ids) {
    let data = {
        id: ids
    }
    $.ajax({
        url: "/crud_codeigniter4/deletePD",
        method: "POST",
        data: JSON.stringify(data),
        contentType: 'application/json',
        success: (resp) => {
            showMessage(resp.message, 'success', 4500)
            document.getElementById('close').click();
            setTimeout(() => {
                window.location.reload()
            }, 4700);
        },
        error: (error) => {
            showMessage(error.errors + '\n' + error.message, 'warning', 4500)
        }
    });
}
