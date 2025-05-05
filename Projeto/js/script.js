function enableEdit(button) 
{
    const chamadoBox = button.closest('.chamado-box');

    chamadoBox.querySelectorAll('input, textarea, select').forEach(field => {
        field.removeAttribute('readonly');
        field.removeAttribute('disabled');
    });

    button.style.display = 'none';
    const saveButton = chamadoBox.querySelector('.salvar');
    saveButton.style.display = 'inline-block';

    const excluirButton = chamadoBox.querySelector('.excluir');
    const liberarButton = chamadoBox.querySelector('.liberar');
    excluirButton.classList.add('disabled');
    liberarButton.classList.add('disabled');
    excluirButton.setAttribute('disabled', 'true');
    liberarButton.setAttribute('disabled', 'true');
}

function saveChanges(button) 
{
    const chamadoBox = button.closest('.chamado-box');
    const id = chamadoBox.querySelector('.id-box input').dataset.originalId; 
    const newId = chamadoBox.querySelector('.id-box input').value; 
    const status = chamadoBox.querySelector('.status-box select').value;
    const nome = chamadoBox.querySelector('input[name="clientName"]').value;
    const email = chamadoBox.querySelector('input[name="clientEmail"]').value;
    const telefone = chamadoBox.querySelector('input[name="clientTelefone"]').value;
    const cpf = chamadoBox.querySelector('input[name="clientCPF"]').value;
    const dispositivo = chamadoBox.querySelector('input[name="clientDispositive"]').value;
    const descricao = chamadoBox.querySelector('textarea[name="problemDescription"]').value;

    fetch('../model/updateClient.php', 
    {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            updateData: true,
            codeBox: id, // ID original
            newCodeBox: newId, // Novo ID
            clientBox: nome,
            dispositiveBox: dispositivo,
            telefoneBox: telefone,
            cpfBox: cpf,
            emailBox: email,
            problemDescriptionBox: descricao,
            statusBox: status
        })
    })
    .then(response => response.text())
    .then(data => {
        alert(data); 

        chamadoBox.querySelector('.id-box input').value = newId;
        chamadoBox.querySelector('.id-box input').dataset.originalId = newId;
        chamadoBox.querySelector('input[name="clientName"]').value = nome;
        chamadoBox.querySelector('input[name="clientEmail"]').value = email;
        chamadoBox.querySelector('input[name="clientTelefone"]').value = telefone;
        chamadoBox.querySelector('input[name="clientCPF"]').value = cpf;
        chamadoBox.querySelector('input[name="clientDispositive"]').value = dispositivo;
        chamadoBox.querySelector('textarea[name="problemDescription"]').value = descricao;

       
        const resultadoPesquisa = document.querySelector('#resultadoPesquisa .chamado-box');

        if (resultadoPesquisa) 
        {
            const pesquisadoId = resultadoPesquisa.querySelector('.id-box input').dataset.originalId;
            if (pesquisadoId === id) 
            {
                resultadoPesquisa.querySelector('.id-box input').value = newId;
                resultadoPesquisa.querySelector('.id-box input').dataset.originalId = newId;
                resultadoPesquisa.querySelector('input[name="clientName"]').value = nome;
                resultadoPesquisa.querySelector('input[name="clientEmail"]').value = email;
                resultadoPesquisa.querySelector('input[name="clientTelefone"]').value = telefone;
                resultadoPesquisa.querySelector('input[name="clientCPF"]').value = cpf;
                resultadoPesquisa.querySelector('input[name="clientDispositive"]').value = dispositivo;
                resultadoPesquisa.querySelector('textarea[name="problemDescription"]').value = descricao;
            }
        }

        const allChamados = document.querySelectorAll('#listaChamados .chamado-box');
        allChamados.forEach(box => {
            const boxId = box.querySelector('.id-box input').dataset.originalId;
            
            if (boxId === id) 
            {
                box.querySelector('.id-box input').value = newId;
                box.querySelector('.id-box input').dataset.originalId = newId;
                box.querySelector('input[name="clientName"]').value = nome;
                box.querySelector('input[name="clientEmail"]').value = email;
                box.querySelector('input[name="clientTelefone"]').value = telefone;
                box.querySelector('input[name="clientCPF"]').value = cpf;
                box.querySelector('input[name="clientDispositive"]').value = dispositivo;
                box.querySelector('textarea[name="problemDescription"]').value = descricao;
            }
        });

        chamadoBox.querySelectorAll('input, textarea, select').forEach(field => {
            field.setAttribute('readonly', 'true');
            field.setAttribute('disabled', 'true');
        });

        button.style.display = 'none';
        const alterarButton = chamadoBox.querySelector('.alterar');
        alterarButton.style.display = 'inline-block';

        const excluirButton = chamadoBox.querySelector('.excluir');
        const liberarButton = chamadoBox.querySelector('.liberar');
        excluirButton.classList.remove('disabled');
        liberarButton.classList.remove('disabled');
        excluirButton.removeAttribute('disabled');
        liberarButton.removeAttribute('disabled');
    })
    .catch(error => {
        console.error('Erro ao atualizar o chamado:', error);
        alert('Erro ao atualizar o chamado.');
    });
}

function deleteRequest(id) 
{
    if (confirm('Tem certeza que deseja excluir este chamado?')) 
    {
        window.location.href = `../model/deleteClient.php?requestID=${id}`;
    }
}

function releaseRequest(id) 
{
    const chamadoBox = document.querySelector(`.chamado-box input[value="${id}"]`).closest('.chamado-box');
    const status = chamadoBox.querySelector('.status-box select').value;

    if (status === 'Liberado') 
    {
        alert('Este chamado já foi liberado!');
        return;
    }

    if (confirm('Tem certeza que deseja liberar este chamado?')) 
    {
        fetch('../model/liberateRequest.php', 
        {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ requestID: id })
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload();
        });
    }
}

function createBackgroundEffects() 
{
    const starCount = 150;
    const starsContainer = document.querySelector('.stars');
    const colors = ['#fff', '#ffff99'];

    for (let i = 0; i < starCount; i++) 
        {
        const star = document.createElement('div');
        star.classList.add('star');
        const size = Math.random() * 2 + 1;
        star.style.width = `${size}px`;
        star.style.height = `${size}px`;
        star.style.top = `${Math.random() * 100}vh`;
        star.style.left = `${Math.random() * 100}vw`;
        star.style.background = colors[Math.floor(Math.random() * colors.length)];
        star.style.animationDelay = `${Math.random() * 3}s`;
        starsContainer.appendChild(star);
    }

    const dustCount = 40;
    const dustContainer = document.querySelector('.dust');
    for (let i = 0; i < dustCount; i++) {
        const dust = document.createElement('div');
        dust.classList.add('dust-particle');
        dust.style.top = `${Math.random() * 100}vh`;
        dust.style.left = `${Math.random() * 100}vw`;
        dust.style.animationDelay = `${Math.random() * 10}s`;
        dustContainer.appendChild(dust);
    }
}

    const starCount = 80;
    for (let i = 0; i < starCount; i++) 
    {
        const star = document.createElement('div');
        star.classList.add('star');
        star.style.top = `${Math.random() * 100}vh`;
        star.style.left = `${Math.random() * 100}vw`;
        star.style.animationDelay = `${Math.random() * 3}s`;
        document.body.appendChild(star);
    }

function adjustAnimationHeight() 
{
    const galaxyBackground = document.querySelector('.galaxy-background');
    const pageHeight = document.body.scrollHeight; 
    galaxyBackground.style.height = `${pageHeight}px`; 
}

document.addEventListener('DOMContentLoaded', adjustAnimationHeight);

window.addEventListener('resize', adjustAnimationHeight);

document.addEventListener('DOMContentLoaded', createBackgroundEffects);