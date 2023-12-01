$(document).ready(() => {
    $.ajax({
        url: 'elements/E_navbar.php',
        type: 'POST',
        data: {
            relative: '' // Passe o ID desejado aqui
        },
        success: (result) => {
            $("#navbarSt").html(result);
        }
    });
    $.ajax({
        url: 'CRUD/listaUser.php',
        type: 'POST',
        data: {
            
        },
        success: (result) => {
            var confirm = "<table id='lista-users' style='width: 100%;' class='table-hover display nowrap'><caption>Lista de usuários</caption><thead><tr><th></th><th scope='col'>ID</th><th scope='col'>Usuário</th><th scope='col'>Nome</th><th scope='col'>Email</th><th scope='col'>Nível de permissão</th><th scope='col'>Data de cadastro</th></tr></thead><tbody id='mytable'>";
            for (var i = 0; i < result.length; i++) {
                var id = result[i]['id'];

                confirm += "<tr id='" + id + "' style='max-width: 90%;'>";
                confirm += ("<td></td>");
                confirm += ("<td>" + id + "</td>");
                confirm += ("<td>" + result[i]['usuario'] + "</td>");
                confirm += ("<td>" + result[i]['nome'] + "</td>");
                confirm += ("<td>" + result[i]['email'] + "</td>");
    
                confirm += ("<td><select data-id='" + id + "' name='tipo' class='type_user form-select'>");
                confirm += result[i]['tipo']==1?"<option selected value='1'>Administrador</option>":"<option value='1'>Administrador</option>";
                confirm += result[i]['tipo']==0?"<option selected value='0'>Usuário</option>":"<option value='0'>Usuário</option>";

                confirm += ("</select></td>");

                confirm += ("<td>" + result[i]['data'] + "</td>");
                confirm += "</tr>";
            }

            confirm += "<tfoot style='font-size: 10px;'><tr><th></th><th rowspan='1' colspan='1' scope='col'>ID</th><th rowspan='1' colspan='1' scope='col'>Usuário</th><th rowspan='1' colspan='1' scope='col'>Nome</th><th rowspan='1' colspan='1' scope='col'>Email</th><th rowspan='1' colspan='1' scope='col'>Nível de permissão</th><th rowspan='1' colspan='1' scope='col'>Data de cadastro</th></tr></tfoot>";
            confirm += "</tbody></table>";

            $("#users").html(confirm);
            $('#lista-users').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
                },
                pageLength: 10,
                columnDefs: [
                    {
                        className: 'dtr-control',
                        orderable: false,
                        targets: 0
                    }
                ],
                order: [1, 'asc'],
                responsive: {
                    details: {
                        type: 'column'
                    }
                }
            });
        }
    });

    $(document).on('change', '.type_user', function () {
        var id = $(this).data('id');
        var tipo = $(this).val();
        // console.log(id);
        // debugger;
        $.ajax({
            url: 'CRUD/update_account.php',
            type: 'POST',
            data: {
                tipo: tipo,
                usuario: id
            },
            // success: (result) => {
            // }
        });
    });
});