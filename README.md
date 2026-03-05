📇 **Catálogo de Clientes**

Sistema web desenvolvido em Laravel para gerenciamento de clientes de uma loja de materiais de construção.

O objetivo do projeto é permitir o cadastro, organização e busca eficiente de contatos comerciais, facilitando o relacionamento com clientes e profissionais do setor.

Este sistema foi criado para resolver um problema real: organizar contatos de clientes e profissionais que compram na loja, permitindo acesso rápido às informações.

🚀 **Funcionalidades**

- Cadastro de clientes
- Edição de informações de clientes
- Exclusão de clientes
- Listagem e busca de contatos
- Organização por categorias e subcategorias (profissões)
- Cadastro de informações como nome, telefone, CPF
- Interface administrativa simples e funcional
- Estrutura preparada para expansão futura

🧩 **Possíveis Categorias de Clientes**

O sistema permite classificar clientes por profissão ou área de atuação, por exemplo:

Pedreiro
Eletricista
Encanador
Arquiteto
Engenheiro
Representante comercial

Isso permite que a loja encontre rapidamente profissionais específicos quando necessário.

🛠️ **Tecnologias Utilizadas**

PHP
Laravel
Blade Templates
MySQL
Bootstrap
JavaScript
HTML5
CSS3

🏗️ **Arquitetura**

O projeto segue a arquitetura padrão do Laravel:

<img width="268" height="335" alt="image" src="https://github.com/user-attachments/assets/7422f08b-1d1e-481b-b765-3f922e9a18dd" />


Essa organização facilita manutenção, escalabilidade e evolução do sistema.

⚙️ **Instalação**

1️⃣ Clonar o repositório
git clone

2️⃣ Acessar a pasta do projeto
cd catalogo-clientes

3️⃣ Instalar dependências
composer install

4️⃣ Criar arquivo de ambiente
cp .env.example .env

5️⃣ Gerar chave da aplicação
php artisan key:generate

6️⃣ Configurar banco de dados
Editar no arquivo .env:

DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha

7️⃣ Executar migrations
php artisan migrate

8️⃣ Rodar o servidor
php artisan serve

🎯 **Objetivo do Projeto**

Este projeto foi desenvolvido como uma solução prática para gestão de contatos comerciais, permitindo que pequenas empresas organizem seus clientes e profissionais parceiros de forma simples e eficiente.

Também serve como projeto de portfólio para desenvolvimento backend em Laravel, demonstrando:

- Estrutura MVC
- Implementação de CRUD completo
- Organização de dados em banco relacional
- Desenvolvimento de sistemas administrativos
