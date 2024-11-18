<?php

$steps = [
    1 => [
        "title" => "Upload do Relatório",
        "description" => "Adicione relatórios radiológicos em português diretamente no sistema para processamento.",
        "image" => "upload-icon.png",
    ],
    2 => [
        "title" => "Processamento pela AI",
        "description" => "Nossa inteligência artificial analisa e traduz os relatórios com máxima precisão.",
        "image" => "ai-icon.png",
    ],
    3 => [
        "title" => "Resultado em Inglês",
        "description" => "Receba relatórios traduzidos e prontos para uso em segundos.",
        "image" => "result-icon.png",
    ],
];


$currentStep = isset($_GET['step']) ? (int)$_GET['step'] : 1;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedLang AI - Transformando Dados Médicos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    
    <div class="admin-login">
        <a href="login.php" class="admin-button">Login de Admin</a>
    </div>

    
    <header class="header">
        <img src="logo.png" alt="MedLang AI Logo" class="logo">
        <h1>Translate your radiological database to English in seconds</h1>
    </header>

   
    <section class="workflow">
        <h2>Como Funciona</h2>
        <div class="workflow-container">
            <?php foreach ($steps as $step => $data): ?>
                <div class="step-card <?= $step === $currentStep ? 'active' : '' ?>">
                    <a href="?step=<?= $step ?>">
                        <div class="icon-container">
                            <img src="<?= $data['image'] ?>" alt="<?= $data['title'] ?>">
                        </div>
                        <h3><?= $data['title'] ?></h3>
                    </a>
                </div>
                <?php if ($step < count($steps)): ?>
                    <div class="arrow"></div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        
        <div class="details-container">
            <h3><?= $steps[$currentStep]['title'] ?></h3>
            <p><?= $steps[$currentStep]['description'] ?></p>
        </div>
    </section>

    
    <section class="benefits">
        <h2>Benefícios do MedLang AI</h2>
        <div class="benefits-container">
            <div class="benefit">
                <h3>Integração com Bancos de Dados Hospitalares</h3>
                <p>Automatize a tradução de relatórios médicos, facilitando o compartilhamento de dados em nível internacional.</p>
            </div>
            <div class="benefit">
                <h3>Aplicações em Empresas de MedTech</h3>
                <p>Padronize e traduza dados médicos para alimentar algoritmos de inteligência artificial e modelos preditivos.</p>
            </div>
            <div class="benefit">
                <h3>Reduza Custos e Ganhe Tempo</h3>
                <p>Elimine processos manuais demorados e garanta a conformidade com padrões globais.</p>
            </div>
        </div>
    </section>

    
    <section class="links">
        <h2>Explore Mais</h2>
        <a href="about.php" class="button">Sobre Nós</a>
    </section>

    
    <section class="cta">
        <h2>Quer saber mais?</h2>
        <p>Entre em contato para agendar uma demonstração ou entender como podemos transformar o seu negócio.</p>
        <a href="contact.php" class="button">Fale Conosco</a>
    </section>

    
    <footer class="footer">
        <p>All rights reserved | Porto Alegre, Rio Grande do Sul, Brasil</p>
    </footer>

</body>
</html>


