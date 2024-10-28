document.getElementById("formRegistro").addEventListener("submit", function(event) {
    event.preventDefault(); 

    document.getElementById("erroNome").textContent = "";
    document.getElementById("erroSenha").textContent = "";
    document.getElementById("erroConfirmaSenha").textContent = "";
    document.getElementById("erroData").textContent = "";

    const nomeUtilizador = document.getElementById("nome_utilizador").value;
    if (nomeUtilizador.trim() === "") {
        document.getElementById("erroNome").textContent = "Por favor, insira um nome de utilizador.";
        return;
    }

    
    const senha = document.getElementById("senha").value;
    const confirmaSenha = document.getElementById("confirma_senha").value;
    if (senha.trim() === "") {
        document.getElementById("erroSenha").textContent = "Por favor, insira uma senha.";
        return;
    }
    if (senha !== confirmaSenha) {
        document.getElementById("erroConfirmaSenha").textContent = "As senhas não coincidem.";
        return;
    }

    
    const dataNascimentoInput = document.getElementById("dataNascimento");
    const erroData = document.getElementById("erroData");
    const dataNascimento = new Date(dataNascimentoInput.value);
    const hoje = new Date();

    if (isNaN(dataNascimento.getTime())) {
        erroData.textContent = "Por favor, insira uma data de nascimento válida.";
        return;
    }

    const idade = hoje.getFullYear() - dataNascimento.getFullYear();
    const mes = hoje.getMonth() - dataNascimento.getMonth();
    const dia = hoje.getDate() - dataNascimento.getDate();

    if (idade < 18 || (idade === 18 && mes < 0) || (idade === 18 && mes === 0 && dia < 0)) {
        erroData.textContent = "Você precisa ter pelo menos 18 anos.";
        return;
    }

    alert("Registro bem-sucedido!");
    document.getElementById("formRegistro").submit();
});
